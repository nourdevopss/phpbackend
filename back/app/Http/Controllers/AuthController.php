<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            // Return a JSON response instead of a redirect
            return response()->json([
                'message' => 'Authentication successful',
                'user' => Auth::user(),
            ]);
        }
 
        return response()->json([
            'message' => 'The provided credentials do not match our records.',
        ], 422);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::create([
            'name' => 'ahcene',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return response()->json([
            'message' => 'Registration successful.',
            'user' => $user,
        ]);
    }
}