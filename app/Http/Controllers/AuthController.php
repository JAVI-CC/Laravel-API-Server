<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @OA\Post(
     *   path="/api/auth/register",
     *   tags={"User"},
     *   summary="Registrar un usuario",
     *   description="Registrar un usuario para que pueda insertar, actualizar y eliminar cualquier juego",
     *   operationId="register",
     *   @OA\RequestBody(
     *     required=true,
     *     description="{name, email, password, password_confirmation}",
     *     @OA\JsonContent(
     *       required={"name", "email", "password", "password_confirmation"},
     *       @OA\Property(property="name", ref="#/components/schemas/User/properties/name"),
     *       @OA\Property(property="email", ref="#/components/schemas/User/properties/email"),
     *       @OA\Property(property="password", ref="#/components/schemas/User/properties/password"),
     *       @OA\Property(property="password_confirmation", ref="#/components/schemas/User/properties/password"),
     *    ),
     *   ),
     *   @OA\Response(response=201, description="Created"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function register(Request $request)
    {
        $validator = $this->user->validation_register($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 220);
        } else {
            $user = $this->user->add_register($request);
            return response()->json($user, 201);
        }
    }

    /**
     * @OA\Post(
     *   path="/api/auth/login",
     *   tags={"User"},
     *   summary="Iniciar session un usuario",
     *   description="Iniciar session con un usuario ya existente en la base de datos",
     *   operationId="login",
     *   @OA\RequestBody(
     *     required=true,
     *     description="{email, password}",
     *     @OA\JsonContent(
     *       required={"email", "password"},
     *       @OA\Property(property="email", ref="#/components/schemas/User/properties/email"),
     *       @OA\Property(property="password", ref="#/components/schemas/User/properties/password"),
     *    ),
     *   ),
     *   @OA\Response(response=201, description="Created"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function login(Request $request)
    {
        $validator = $this->user->validation_login($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 220);
        } else {
            $user = $this->user->login($request);
            return response()->json($user, 201);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/auth/userinfo",
     *   tags={"User"},
     *   summary="Para ver la informacion de un usuario",
     *   description="Para ver iformacion adicional del usuario autenticado",
     *   operationId="userinfo",
     *   security={ * {"SANCTUM": {}}, * },
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function userinfo()
    {
        return auth()->user();
    }

    /**
     * @OA\Post(
     *   path="/api/auth/logout",
     *   tags={"User"},
     *   summary="Cerrar session un usuario",
     *   description="Cerrar session con un usuario ya existente en la base de datos",
     *   operationId="logout",
     *   security={ * {"SANCTUM": {}}, * },
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function logout()
    {
        return $this->user->logout();
    }
}