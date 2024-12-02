<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PasswordReset;


class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password',[
            'title' => 'forgot password'
        ]);
    }

    
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return back()->with('error', 'Email address not found.');
        }
        
        $existingToken = PasswordReset::where('email', $user->email)->first();
        
        if ($existingToken) {
            // deleted old token
            $existingToken->delete();
        }

        $token = Str::random(40);

        // Set expired token
        $createdAt = now();
        $expiresAt = $createdAt->addMinutes(60);

        $emailParameter = '?email=' . urlencode($user->email);

        PasswordReset::updateOrCreate(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => $createdAt, 'expires_at' => $expiresAt]
        );

        $resetLink = route('reset.password.form', $token) . $emailParameter;

        Mail::send('emails.reset-password', ['resetLink' => $resetLink, 'username' => $user->username], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password Reset');
        });

        return back()->with('success', 'Tautan pengaturan ulang kata sandi telah dikirim ke email Anda..');
    }

    public function resetPasswordForm($token)
    {
        return view('auth.reset-password',[
            'token' => $token,
            'title' => 'Reset Password'
        ]);
    }

    // Proses reset password
    public function resetPassword( Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            return back()->with('error', 'Invalid password reset token.');
        
        }

        if (now()->gt($passwordReset->expires_at)) {
            $passwordReset->delete();
                return back()->with('error', 'Expired password reset token.');
            }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');
        
        if (strlen($password) < 8) {
            return back()->with('error', 'Password must be at least 8 characters long.');
        }

        if ($password !== $passwordConfirmation) {
            return back()->with('error', 'Password and confirmation do not match.');
        }

        $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}[\]:;<>,.?~\-])/';

        if (!preg_match($passwordPattern, $password)) {
            return back()->with('error', 'The password must contain at least one uppercase letter, number, and special character and be at least 8 characters long.');
        }

        $user->update([
            'password' => Hash::make($password),
        ]);

        // Hapus token reset kata sandi
        $passwordReset->delete();
    
        return redirect()->route('login')->with('success', 'Kata sandi telah disetel ulang. Anda sekarang dapat masuk dengan kata sandi baru Anda..');
    }
}
