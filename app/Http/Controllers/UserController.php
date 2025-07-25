<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'sometimes|string|max:255|unique:users,username,'.$user->id,
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->update($validatedData);

        return response()->json($user);
    }
}
