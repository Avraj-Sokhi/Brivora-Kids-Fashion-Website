<?php

namespace App\Http\Controller;

use App\Models\User;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::orderBy('create_at', 'desc')->get();

        return view('admin.users', compact('users'));

    }
}