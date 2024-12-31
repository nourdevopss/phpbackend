<?php
 
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function index()
    {
        // $users = User::all();
        $user = Auth()->user();
        return response()->json([
            'message' => 'Users',
            'user' => $user,
        ]);
    }

}