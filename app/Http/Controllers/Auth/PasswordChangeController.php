<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewUserChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PasswordChangeController extends Controller
{
    public function index()
    {
        return view('auth.passwords.change');
    }

    public function update(NewUserChangePasswordRequest $request)
    {
        auth()->user()->update([
            'password' => Hash::make($request->password),
            'password_changed_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }
}
