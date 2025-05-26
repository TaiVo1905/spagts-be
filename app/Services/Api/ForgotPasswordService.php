<?php

namespace App\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Services\BaseService;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class ForgotPasswordService extends BaseService
{
    public function sendCode($email)
    {
        Log::info('Sending reset code for email: ' . $email);
        echo $email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            Log::error('User not found for email: ' . $email);
            abort(404, 'Email not found');
        }

        $key = 'send_reset_code_' . $email;
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            Log::warning('Too many attempts for email: ' . $email);
            abort(429, "Too many attempts. Please try again in {$seconds} seconds.");
        }

        $code = rand(1000, 9999);
        Log::info('Generated code: ' . $code);

        try {
            Cache::put('reset_code_' . $email, $code, now()->addMinutes(3));
            Log::info('Cache stored for email: ' . $email);
        } catch (\Exception $e) {
            Log::error('Cache error: ' . $e->getMessage());
            abort(500, 'Failed to store reset code in cache');
        }

        $html = "
            <p>Xin chào,</p>
            <p>Mã xác minh đặt lại mật khẩu của bạn là: <strong>{$code}</strong></p>
            <p>Mã này sẽ hết hạn sau 3 phút.</p>
        ";

        try {
            Mail::html($html, function ($message) use ($email) {
                $message->to($email)->subject('Mã xác minh đặt lại mật khẩu');
            });
            Log::info('Email sent to: ' . $email);
        } catch (\Exception $e) {
            Log::error('Email sending error: ' . $e->getMessage());
            abort(500, 'Failed to send reset code email');
        }

        RateLimiter::hit($key, 300);

        return true;
    }

    public function verifyCode($email, $code)
    {
        if (!is_string($email)) {
            abort(400, 'Email must be a string');
        }

        $cachedCode = Cache::get('reset_code_' . $email);
        if (!$cachedCode || $cachedCode != $code) {
            abort(422, 'Invalid or expired code');
        }
    }

    public function resetPassword($email, $code, $newPassword)
    {
        if (!is_string($email)) {
            abort(400, 'Email must be a string');
        }

        $cachedCode = Cache::get('reset_code_' . $email);
        if (!$cachedCode || $cachedCode != $code) {
            abort(422, 'Invalid or expired code');
        }

        $user = User::where('email', $email)->firstOrFail();
        $user->password = Hash::make($newPassword);
        $user->save();

        Cache::forget('reset_code_' . $email);

        return $user;
    }
}
