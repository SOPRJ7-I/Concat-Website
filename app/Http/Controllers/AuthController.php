<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ],
        [
            
            'name.required' => 'Naam is verplicht.',
            'email.required' => 'email is verplicht.',
            'password.required' => 'wachtwoord is verplicht.',
        ]
    
    );

        $validated['role'] = 'client';
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('index_evenement');       
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'

        ],
        [
            'email.required' => 'Uw email alstublieft.',
            'password.required' => 'Uw wachtwoord alstublieft.',

        ]
    
    );

        if(Auth::attempt($validated))
        {
            $request->session()->regenerate();
            return redirect()->route('index_evenement');
        }

        throw ValidationValidationException::withMessages([
            'credentials' => 'Sorry, onjuiste inloggegevens'
        ]);
            
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index_evenement');
    }
}
