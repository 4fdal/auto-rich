<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserBusiness;
use App\Utils\Response\ResponseFormatter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $credentials = request(['email', 'password']);

            $token = Auth::guard('api-jwt')->attempt($credentials);

            if (!$token) {
                return ResponseFormatter::otherFailedResponse(__('auth.failed'), null, [
                    'authorize' => ['no authorization'],
                ], 401);
            }

            $user = Auth::guard('api-jwt')->user();

            $user->avatar = env('APP_URL')+"/storage/"+$user->avatar ;

            $user->business ;

            return ResponseFormatter::success(__('auth.success'), [
                'auth' => $this->resultsWithToken($token),
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return ResponseFormatter::failed($e);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::guard('api-jwt')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api-jwt')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->resultsWithToken(Auth::guard('api-jwt')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function resultsWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api-jwt')->factory()->getTTL() * 60,
        ];
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'owner_name' => ['required'],
                'business_name' => ['required'],
                'business_address' => ['required'],
                'type' => ['required'],
                'business_mode' => ['required', Rule::in(['online', 'offline'])],
                'email' => ['required', 'unique:users,email', 'email'],
                'password' => ['required', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $request->owner_name,
                'role_id' => 2,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => 'users/default.png',
            ]);


            $business = UserBusiness::create([
                'user_id' => $user->id,
                'name' => $request->business_name,
                'address_line1' => $request->business_address,
                'type' => $request->type,
                'mode' => $request->business_mode,
            ]);


            DB::commit();

            return ResponseFormatter::success('success register', [
                'user' => $user,
                'business' => $business,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseFormatter::failed($e);
        }
    }

    public function resendVerificationCode(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'email' => ['required', 'email'],
            ]);

            $user = User::where('email', $request->email)->first();
            if (!isset($user)) {
                throw new Exception('Email not match on any account');
            }

            DB::commit();

            return ResponseFormatter::success('Success resend code verification account');
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseFormatter::failed($e);
        }
    }

    public function registerVerification(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'token' => ['required', 'numeric', 'min:6', function ($key, $token, $failed) use ($request) {
                    if (isset($request->email)) {
                        $user = User::where('email', $request->email)->first();

                        if (!isset($user)) {
                            return $failed('Your email not yet register account');
                        }
                    }
                }],
            ]);

            return ResponseFormatter::success('Success register verification', [
                'user_verification' => [
                    'status' => true,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseFormatter::failed($e);
        }
    }

    public function forgetPassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'email' => ['required', 'email'],
            ]);

            $user = User::where('email', $request->email)->first();

            DB::commit();

            return ResponseFormatter::success('Success request forget password');
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseFormatter::failed($e);
        }
    }

    public function resetPassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'token' => ['required'],
                'password' => ['required', 'confirmed'],
            ]);

            DB::commit();

            return ResponseFormatter::success('Success request reset password');
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseFormatter::failed($e);
        }
    }
}
