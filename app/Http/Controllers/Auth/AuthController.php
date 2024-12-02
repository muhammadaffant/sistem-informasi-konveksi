<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
//     public function getProvinces(Request $request)
// {
//     $country = $request->query('country');

//     $provinces = [];

//     if ($country == 'Indonesia') {
//         $provinces = ['West Java', 'Central Java', 'East Java'];
//     } elseif ($country == 'Malaysia') {
//         $provinces = ['Kuala Lumpur', 'Selangor', 'Penang'];
//     }

//     // Kembalikan sebagai JSON
//     return response()->json($provinces);
// }

    public function register()
    {
        // $countries = ['Indonesia', 'Malaysia', 'Thailand', 'Singapore'];
        return view('auth.register');
    }
 
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'fullname' => 'required|string|max:100',
            'username' => 'required|string|max:50|regex:/^\S*$/|unique:users',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|digits_between:10,15|numeric|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ])->validate();
 
        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_verified' => false,
            'verification_expires_at' => Carbon::now()->addMinutes(60), // Token kedaluwarsa dalam 60 menit
        ]);
        $user->assignRole('user');
        
        $verificationToken = sha1($user->email . $user->created_at);

        // Kirim email verifikasi
        Mail::send('emails.verify', ['id' => $user->id, 'token' => $verificationToken, 'username' => $user->username], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verify Your Email');
        });

        return redirect()->route('login')->with('success', 'Registration successful! Please verify your email.');
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }
 
    public function loginAction(Request $request)
    {
        // Validasi input
        Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Jika login gagal, kirim pesan error
            return back()->with('error', 'Invalid username or password')
            ->withInput($request->only('email', 'remember'));

        }
        // Cek apakah email sudah diverifikasi
        if (!Auth::user()->is_verified) {
            // Jika email belum diverifikasi, logout user dan tampilkan pesan
            Auth::logout();
            return back()->with('error', 'Email Anda belum diverifikasi. Silakan periksa kotak masuk Anda untuk tautan verifikasi.')
                ->withInput($request->only('email', 'remember'));
        }

        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();
        session()->flash('login_success', true);

        // Cek peran user yang login dan arahkan sesuai dengan perannya
        if (Auth::user()->hasRole('owner')) {
            return redirect()->route('owner.dashboard');
        }

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->hasRole('user')) {
            return redirect()->route('user.home');
        }

    }
 
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/');
    }
 
}