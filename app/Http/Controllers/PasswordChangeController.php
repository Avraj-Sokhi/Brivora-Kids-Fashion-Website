<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showForm()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        // Validate passwords
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Update user
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->must_change_password = false; // turn off first-login requirement
        $user->save();

        // Redirect based on role
        return redirect()->route(
            $user->role === 'admin' ? 'admin.dashboard' : 'dashboard'
        )->with('status', 'Password changed successfully.');
    }
}
