<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends Controller
{
    public function AllUsers(){
        $users = User::where('role','user')->latest()->get();
        return view('admin.backend.users.all_users',compact('users'));

    }
    public function AllInstructor(){
        $users = User::where('role','instructor')->latest()->get();
        return view('admin.backend.users.all_instructor',compact('users'));

    }
}
