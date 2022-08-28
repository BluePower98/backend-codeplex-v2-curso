<?php

namespace App\Virtual\Http\Requests\Product;

/**
 * @OA\Schema(
 *      title="Product Update Request",
 *      description="Product update request form data",
 *      type="object",
 *      @OA\Xml(
 *         name="ProductUpdateRequest"
 *      ),
 *      required={"idempresa", "idlinea", "idlineasub", "idtipoproducto", "codigo", "descripcion"}
 * )
 */
class ProductUpdateRequest
{
    /**
     * @OA\Property(
     *     property="idempresa",
     *     type="string",
     *     description="Id de la empresa",
     *     example="1-20539782232"
     * )
     */
    public $idempresa;

    /**
     * @OA\Property(
     *     property="idlinea",
     *     type="integer",
     *     description="Id de la línea",
     *     example="1"
     * )
     */
    public $idlinea;

    /**
     * @OA\Property(
     *     property="idlineasub",
     *     type="integer",
     *     description="Id de la sub-línea",
     *     example="1"
     * )
     */
    public $idlineasub;

    /**
     * @OA\Property(
     *     property="idtipoproducto",
     *     type="integer",
     *     description="Id del tipo de producto",
     *     example="1"
     * )
     */
    public $idtipoproducto;

    /**
     * @OA\Property(
     *     property="idsunatt07",
     *     type="string",
     *     maxLength=3,
     *     description="Id Sunat 07",
     *     example=""
     * )
     */
    public $idsunatt07;

    /**
     * @OA\Property(
     *     property="codigo",
     *     type="string",
     *     maxLength=50,
     *     description="Código de producto",
     *     example="2257"
     * )
     */
    public $codigo;

    /**
     * @OA\Property(
     *     property="descripcion",
     *     type="string",
     *     maxLength=3000,
     *     description="Nombre o descripción del producto",
     *     example="Chocolates"
     * )
     */
    public $descripcion;

    /**
     * @OA\Property(
     *     property="activo",
     *     type="string",
     *     description="¿El producto está activo?. Activo: 1, Inactivo: 0",
     *     enum={"1", "0"},
     *     default="1"
     * )
     */
    public $activo;

    /**
     * @OA\Property(
     *     property="infad1",
     *     type="string",
     *     maxLength=3000,
     *     description="",
     *     example=""
     * )
     */
    public $infad1;

    /**
     * @OA\Property(
     *     property="infad2",
     *     type="string",
     *     description="",
     *     maxLength=3000,
     *     example=""
     * )
     */
    public $infad2;

    /**
     * @OA\Property(
     *     property="infad3",
     *     type="string",
     *     description="",
     *     maxLength=3000,
     *     example=""
     * )
     */
    public $infad3;

    /**
     * @OA\Property(
     *     property="porpercepcion",
     *     type="integer",
     *     description="",
     *     example=""
     * )
     */
    public $porpercepcion;

    /**
     * @OA\Property(
     *     property="porisc",
     *     type="integer",
     *     description="",
     *     example=""
     * )
     */
    public $porisc;

    /**
     * @OA\Property(
     *     property="estadoventa",
     *     type="string",
     *     description="Estado de venta. Activo: 1, Inactivo: 0",
     *     enum={"1", "0"},
     *     default="1"
     * )
     */
    public $estadoventa;

    /**
     * @OA\Property(
     *     property="escombo",
     *     type="string",
     *     description="SI: 1, NO: 0",
     *     enum={"1", "0"},
     *     default="0"
     * )
     */
    public $escombo;

    /**
     * @OA\Property(
     *     property="icbper",
     *     type="string",
     *     description="SI: 1, NO: 0",
     *     enum={"1", "0"},
     *     default="0"
     * )
     */
    public $icbper;

    /**
     * @OA\Property(
     *     property="urlapi",
     *     type="string",
     *     description="",
     *     example=""
     * )
     */
    public $urlapi;

    /**
     * @OA\Property(
     *     property="itemPrecios",
     *     type="string",
     *     description="Listado de precios. Debe ser un JSON convertido a string",
     *     example=""
     * )
     */
    public $itemPrecios;

    /**
     * @OA\Property(
     *     property="upload_path",
     *     type="string",
     *     description="Ruta donde se almacenan las imágenes del producto",
     *     example=""
     * )
     */
    public $upload_path;

    /**
     * @OA\Property(
     *     property="imagen1",
     *     type="file",
     *     description="Imagen nro 1",
     *     example=""
     * )
     */
    public $imagen1;

    /**
     * @OA\Property(
     *     property="imagen2",
     *     type="file",
     *     description="Imagen nro 2",
     *     example=""
     * )
     */
    public $imagen2;

    /**
     * @OA\Property(
     *     property="imagen3",
     *     type="file",
     *     description="Imagen nro 3",
     *     example=""
     * )
     */
    public $imagen3;

    /**
     * @OA\Property(
     *     property="imagen4",
     *     type="file",
     *     description="Imagen nro 4",
     *     example=""
     * )
     */
    public $imagen4;
}
