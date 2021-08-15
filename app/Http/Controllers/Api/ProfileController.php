<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\Response\ResponseFormatter;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function read(){
        try {
            $user = User::getAuth();
            $user->avatar = $user->getFullUrlAvatar();

            $user->business ;


            return ResponseFormatter::success('Success', [
                'user' => $user,
            ]);

        } catch (\Exception $e) {
            return ResponseFormatter::failed($e);
        }
    }
}
