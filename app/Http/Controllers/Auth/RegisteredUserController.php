<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'phone_number' => 'nullable|string|max:20',
    'date_of_birth' => 'nullable|date',
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
             'name' => $request->name,
    'email' => $request->email,
    'phone_number' => $request->phone_number,
    'date_of_birth' => $request->date_of_birth,
    'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
