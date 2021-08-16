<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\Response\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PromotionController extends Controller
{
    public function smsBroadcast(Request $request)
    {
        try {

            $request->validate([
                'message' => ['required', 'string'],
                'contact' => ['required', 'array'],
                'contact.*' => ['string', function ($att, $val, $fail) {
                    if (substr($val, 0, 4) != '+628') {
                        $fail("$att format is +628xxx");
                    }
                }]
            ]);

            $response = Http::withHeaders([
                'x-api-key' => env('X_API_KEY_BIGBOX_SMS_BROADCAST_MESSAGE', '80TbuyyhHMkxHgt2BMF47Pubus18eDLi')
            ])->post('https://api.thebigbox.id/sms-broadcast/1.0.0/send', [
                'msisdns' => $request->contact,
                'text' => $request->message,
            ]);

            return ResponseFormatter::success('Success', $response->json());
        } catch (\Exception $e) {
            return ResponseFormatter::failed($e);
        }
    }
}
