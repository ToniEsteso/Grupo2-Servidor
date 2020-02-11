<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'getNumeroUsuarios', 'getAll']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $numUsuario = User::where("nickName", $credentials["email"])->count();

        if ($numUsuario == 1) {
            $credentials["email"] = User::where("nickName", $credentials["email"])->get()[0]->email;
        }
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
        echo "credentials";
        var_dump($credentials);
        echo "credentials";
        foreach ($credentials as $key => $value) {
            $key = strip_tags($key);
        }
        if ($credentials["password1"] !== $credentials["password2"]) {
            //comprobar las contraseñas
            return response()->response('Contraseñas incorrectas', 500);
        } else if (User::where("email", $credentials["email"])->count() != 0) {
            //comprobar la disponibilidad del nickname
            return response()->response('Nickname no disponible', 500);
        } else if (User::where("nickName", $credentials["nickName"])->count() != 0) {
            // comprobar el nickname
            return response()->response('algo', 500);
        } else {
            //insertar el usuario
            $usuario = new User();
            $usuario->nombre = $credentials["nombre"];
            $usuario->apellidos = $credentials["apellidos"];
            $usuario->email = $credentials["email"];
            $usuario->nickName = $credentials["nickName"];
            $usuario->password = Hash::make($credentials["password1"]);
            echo $credentials["nickName"];

            $nombreImagen = $this->subirImagen($credentials["nickName"]);

            $usuario->avatar = $nombreImagen;
            if ($nombreImagen != null) {
                $usuario->save();
                return response()->json(['usuario' => $usuario]);
            } else {
                return response()->json(['mensaje' => "Vas a engañar a otro"]);
            }

        }
    }

    public function subirImagen($nick)
    {
        $dir_subida = public_path() . str_replace("\\", "/", explode("public", Storage::disk('public_images_usuarios')->getDriver()->getAdapter()->getPathPrefix())[1]);
        // $dir_subida = '/var/www/html/public/'.str_replace("\\", "/", explode("public",Storage::disk('public_images_usuarios')->getDriver()->getAdapter()->getPathPrefix())[1]);

        $tipos = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/PNG', 'image/JPEG', 'image/JPG');

        if (in_array($_FILES['avatar']['type'], $tipos)) {
            $fichero_subido = $dir_subida . $nick . "." . explode("/", $_FILES['avatar']['type'])[1];
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $fichero_subido)) {
                return $nick . "." . explode("/", $_FILES['avatar']['type'])[1];
            } else {
                return null;
            }
        } else {
            return null;
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

    public function getNumeroUsuarios()
    {
        $numUsuarios = User::count();
        $respuesta = [
            "mensaje" => config('codigosRespuesta.200'),
            "data" => $numUsuarios];

        return $respuesta;
    }

    public function getAll()
    {
        $usuarios = User::get();

        if (empty($usuarios)) {
            $respuesta = config('codigosRespuesta.404');
        } else {
            $respuesta = [
                "mensaje" => config('codigosRespuesta.200'),
                "rutaImagenesServer" => str_replace("\\", "/", explode("public", Storage::disk('public_images_usuarios')->getDriver()->getAdapter()->getPathPrefix())[1]),
                "data" => $usuarios];
        }

        return $respuesta;
    }

    public function borrarUsuario($idUsuario)
    {
        $rutaImagenes = Storage::disk('public_images_usuarios')->getDriver()->getAdapter()->getPathPrefix();
        $usuario = User::find($idUsuario);
        $mi_imagen = $rutaImagenes . $usuario->avatar;
        if (@getimagesize($mi_imagen)) {
            echo "El archivo existe";
            unlink($mi_imagen);
        }
        else
        {
            echo "El archivo no existe";
        }
        $usuario->delete();

        $respuesta = array("mensaje" => config('codigosRespuesta.200'), "data" => "Borrado exitosamente.");
        return $respuesta;
    }
}
