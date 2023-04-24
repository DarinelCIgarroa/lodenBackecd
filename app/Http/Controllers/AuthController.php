<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', Password::min(8)->numbers()->letters()],
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' =>  $e->getMessage(),
                'success' => false,
            ], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Las credenciales registradas no coinciden con nuestros registros.'],
                ]);
            }

            $token = $user->createToken('auth:token')->plainTextToken;

            return response()->json([
                'message' => 'Sesión iniciada con éxito',
                'success' => true,
                'user' => $user,
                'token' => $token
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' =>  $e->getMessage(),
                'success' => false,
            ], 400);
        }
    }

    public function logout($id)
    {
        try {
            $user = User::find($id);
            $user->tokens()->delete();
            return response()->json([
                'success' => true
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' =>  $e->getMessage(),
                'success' => false
            ]);
        }
    }
}
