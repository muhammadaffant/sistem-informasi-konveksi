<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    public function index()
    {
        $admins = User::role('admin')->with('roles')->get();
        return view('admin.managementuser.dataadmin.index',[
            'title' => 'Data Admin',
            'active' => 'List Admin',
            'admins' => $admins
        ]);
    }

    public function storeAdmin(Request $request)
    {
        // Validasi input
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // validasi password
        ]);

        // Buat user baru dengan role admin
        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role admin ke user baru
        $user->assignRole('admin');

        return redirect()->route('admin.listadmin')->with('success', 'Admin berhasil ditambahkan.');
    }
}
