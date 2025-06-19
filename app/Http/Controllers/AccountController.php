<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function show()
    {
        return view('account.show');
    }

    // Toon formulier om gegevens te bewerken
    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    // Verwerk de bewerking
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required_with:password|nullable|current_password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('account.show')->with('success', 'Gegevens succesvol bijgewerkt');
    }
}
