<?php

namespace App\Virtual\Http\Requests\Auth;

/**
 * @OA\Schema(
 *      title="Register Request",
 *      description="Register request body data",
 *      type="object",
 *      @OA\Xml(
 *         name="RegisterRequest"
 *      ),
 *      required={"idplan", "nombre", "email", "password", "ruc", "razon", "telefono"}
 * )
 */
class RegisterRequest
{
    /**
     * @OA\Property(
     *     property="idplan",
     *     type="integer",
     *     description="Id del plan contratado por la empresa",
     *     example="1"
     * )
     */
    public $idplan;

    /**
     * @OA\Property(
     *     property="nombre",
     *     type="string",
     *     maxLength=100,
     *     description="Nombre de usuario",
     *     example="donpepito"
     * )
     */
    public $nombre;

    /**
     * @OA\Property(
     *     property="email",
     *     type="string",
     *     maxLength=50,
     *     description="Email de la empresa",
     *     example="empresa@gmail.com"
     * )
     */
    public $email;

    /**
     * @OA\Property(
     *     property="password",
     *     type="string",
     *     minLength=6,
     *     description="Contraseña de acceso al sistema para la empresa",
     *     example="secret"
     * )
     */
    public $password;

    /**
     * @OA\Property(
     *     property="ruc",
     *     type="string",
     *     maxLength=11,
     *     minLength=11,
     *     description="RUC de la empresa",
     *     example="10201239871"
     * )
     */
    public $ruc;

    /**
     * @OA\Property(
     *     property="razon",
     *     type="string",
     *     maxLength=100,
     *     description="Razón social de la empresa",
     *     example="Don Pepito SA"
     * )
     */
    public $razon;

    /**
     * @OA\Property(
     *     property="telefono",
     *     type="string",
     *     maxLength=100,
     *     description="Teléfono de la empresa",
     *     example="963896712"
     * )
     */
    public $telefono;
}
