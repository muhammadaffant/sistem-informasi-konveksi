<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataMemberController extends Controller
{
    public function index ()
    {
        $users = User::role('user')->get();
        return view('admin.managementuser.datamember.index',[
            'title' => 'Data Member',
            'active' => 'List Member',
            'users' => $users
        ]);
    }
}
