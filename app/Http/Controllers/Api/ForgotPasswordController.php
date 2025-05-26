<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\ForgotPasswordService;

class ForgotPasswordController extends BaseController
{
    public function __construct(ForgotPasswordService $service, Request $request)
    {
        parent::__construct($service, null, $request, null);
    }

    public function sendResetCode()
    {
        $data = $this->request->validate([
            'email' => 'required|email|string',
        ]);
        $email = $data['email'];
        $this->service->sendCode($email);
        return $this->successResponse(null, 'Reset code sent successfully');
    }

    public function verifyCode()
    {
        $data = $this->request->validate([
            'email' => 'required|email|string',
            'code' => 'required|string',
        ]);

        $this->service->verifyCode($data['email'], $data['code']);
        return $this->successResponse(null, 'Code verified successfully');
    }

    public function resetPassword()
    {
        $data = $this->request->validate([
            'email' => 'required|email|string',
            'code' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = $this->service->resetPassword($data['email'], $data['code'], $data['password']);
        return $this->successResponse(null, 'Password reset successfully');
    }
}