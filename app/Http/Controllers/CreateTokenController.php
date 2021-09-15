<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class CreateTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Check if the user exists
        $user = User::where('email', $request->email)->first();
        if (is_null($user) || !password_verify($request->password, $user->password)) {
            return response()->json([
                'error' => 'Usuario y/o contraseña invalida, intente de nuevo.'
            ], 401); // 401 => No autorizado (HTTP Status Code)
        }

        // If the user exists, we have to create the token
        return response()->json([
            'token' => $user->createToken('SIT-MXLI')->plainTextToken
        ], 200);
    }
}
