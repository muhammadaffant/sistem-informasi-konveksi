<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserKontakController extends Controller
{
    public function index ()
    {
        return view('user.kontak',[
            'active' => 'contact',
            'title' => 'Kontak'
        ]);
    }
}
