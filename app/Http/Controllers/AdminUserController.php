<?php

namespace App\Http\Controller;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));

    }
}