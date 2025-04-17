<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(UserResource::collection(User::all()));
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('login', $validated['login'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'ERR_NO_ACCESS',
                'message' => 'invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 'OK',
            'token' => $token,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|unique:users|min:3',
            'password' => 'required|min:3',
        ]);

        $user = User::create([
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
        ]);

        return response(  )->json([
            'status' => 'OK',
            'user' => new UserResource($user)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user && $id != 1) {
            $user->delete();
            return response(null, 204);
        }
        return response()->json([
            'status' => 'ERR_NOT_FOUND',
            'message' => 'User not found'
        ], 404);
    }
}
