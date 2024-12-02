<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function verify($id, $token)
    {
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }
    
        // Cek apakah token cocok
        $expectedToken = sha1($user->email . $user->created_at);
        if ($expectedToken !== $token) {
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }
    
        // Cek apakah token sudah kedaluwarsa
        if (Carbon::now()->greaterThan($user->verification_expires_at)) {
            return redirect()->route('login')->with('error', 'Tautan verifikasi telah kedaluwarsa. Harap minta tautan baru.');
        }
    
        // Cek apakah sudah diverifikasi
        if ($user->is_verified) {
            return redirect()->route('login')->with('error', 'Email already verified.');
        }
    
        // Tandai sebagai terverifikasi
        $user->is_verified = true;
        $user->verification_expires_at = null; // Hapus waktu kedaluwarsa
        $user->save();
    
        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Anda sekarang dapat masuk.');
    }

    public function resendverify ()
    {
        return view('auth.resend-verifikasi',[
            'title' => 'Kirim Ulang Verifikasi'
        ]);
    }

    public function resendVerification(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $user = User::where('email', $request->email)->first();

    // Cek apakah pengguna ada
    if (!$user) {
        return redirect()->back()->with('error', 'Email tidak ditemukan.');
    }

    // Cek apakah sudah diverifikasi
    if ($user->is_verified) {
        return redirect()->route('login')->with('success', 'Email sudah diverifikasi.');
    }

    // Perbarui token verifikasi dan waktu kedaluwarsa
    $verificationToken = sha1($user->email . $user->created_at);
    $user->verification_expires_at = Carbon::now()->addMinutes(60); // Set ulang waktu kedaluwarsa
    $user->save();

    // Kirim ulang email verifikasi
    Mail::send('emails.verify', [
        'id' => $user->id,
        'token' => $verificationToken,
        'username' => $user->username,
    ], function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Kirim Ulang Verifikasi Email');
    });

    return redirect()->route('login')->with('success', 'Email verifikasi berhasil dikirim ulang. Periksa kotak masuk Anda.');
}

    
}

