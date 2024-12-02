<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataOwnerController extends Controller
{
    public function index()
    {
        $owners = User::role('owner')->with('roles')->get();
        return view('admin.managementuser.dataowner.index',[
            'title' => 'List Owner',
            'active' => 'List Owner',
            'owners' => $owners,
        ]);
    }
}
