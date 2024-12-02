<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function profile ()
    {
        return view('user.profile',[
            'title' => 'profile'
        ]);
    }

    public function update(Request $request)
    {
    
    $validated = $request->validate([
        'fullname' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'phone' => 'nullable|string|max:15',
    ]);

    $user = Auth::user();
    $user->update($validated);

    return redirect()->back()->with('success', 'Profil berhasil diperbarui!');

    }
}
