<?php

namespace App\Virtual\Http\Requests\Auth;

/**
 * @OA\Schema(
 *      title="Login Request",
 *      description="Login request body data",
 *      type="object",
 *      @OA\Xml(
 *         name="LoginRequest"
 *      ),
 *      required={"email", "password"}
 * )
 */
class LoginRequest
{
    /**
     * @OA\Property(
     *     property="email",
     *     type="string",
     *     maxLength=255,
     *     description="Email de usuario",
     *     example="giluchi8@gmail.com"
     * )
     */
    public $email;

    /**
     * @OA\Property(
     *     property="password",
     *     type="string",
     *     maxLength=100,
     *     description="Contraseña del usuario",
     *     example="secret_password"
     * )
     */
    public $password;
}
