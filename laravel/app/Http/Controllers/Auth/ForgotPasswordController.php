<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('client.auth.rest_form');
    }

    public function ResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|exists:users,email'],
            [
                'email.required' => 'Email không được để trống',
                'email.exists' => 'Email không tồn tại',
            ]);
        $token = strtoupper(Str::random(10));
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update(['reset_password_token' => $token]);
            $mailSent = Mail::send('client.auth.mail_reset', compact('user'), function ($email) use ($user) {
                $email->subject('SportShop - Reset Password');
                $email->to($user->email, $user->name);
            });

            if ($mailSent) {
                return redirect()->back()->with('success', 'Vui lòng kiểm tra email để lấy lại mật khẩu');
            } else {
                return redirect()->back()->withErrors(['email' => 'Có lỗi trong quá trình gửi email']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại']);
        }
    }


}
