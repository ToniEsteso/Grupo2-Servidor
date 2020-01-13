<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function payload()
    {
        return response()->json(auth()->payload());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Registra el usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $credentials = request(['nombre', 'apellidos', 'email', 'nickName', 'password1', 'password2', 'avatar']);
        return request()->all();
        foreach ($credentials as $key => $value) {
            $key = strip_tags($key);
        }
        //comprobar las contraseñas
        if ($credentials["password1"] !== $credentials["password2"]) {
            return "contraseñas no iguales";
            return response()->json([
                'codigo' => config('codigosRespuesta.500'),
            ]);
            //comprobar la disponibilidad del nickname
        } else if (User::where("email", $credentials["email"])->count() != 0) {
            return "email no disponible";
        } else if (User::where("nickName", $credentials["nickName"])->count() != 0) {
            return "nickname no disponible";
            return response()->json([
                'codigo' => config('codigosRespuesta.500'),
            ]);
        } else {
            $usuario = new User();
            $usuario->nombre = $credentials["nombre"];
            $usuario->apellidos = $credentials["apellidos"];
            $usuario->email = $credentials["email"];
            $usuario->nickName = $credentials["nickName"];
            $usuario->password = Hash::make($credentials["password1"]);
            $usuario->avatar = $credentials["avatar"];
            $usuario->save();
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}
