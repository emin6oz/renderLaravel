<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // GET /api/profile
    public function show(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    // PUT /api/profile
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'email'         => 'sometimes|email|unique:users,email,' . $user->id,
            'phone'         => 'sometimes|string|nullable',
            'date_of_birth' => 'sometimes|date|nullable',
            'password'      => 'sometimes|string|min:6|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user'    => $user,
        ]);
    }

    // DELETE /api/profile
    public function destroy(Request $request)
    {
        $request->user()->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
