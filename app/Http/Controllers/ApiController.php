<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *    title="Laravel Api Juegos",
 *    version="1.0.0",
 * )
 */
class ApiController extends Controller
{

    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }


    /**
     * @OA\Get(
     *   path="/api/juegos",
     *   tags={"Juegos"},
     *   summary="Obtener todos los juegos",
     *   description="Muestra todos los registros de juegos en formato JSON",
     *   operationId="getAllJuegos",
     *   @OA\Parameter(
     *     name="API-KEY",
     *     description="Añadir token",
     *     in="header",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu"
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=401, description="No autorizado"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function index()
    {
        $juegos = Api::orderBy('id', 'DESC')->get();
        return response()->json($juegos, 200);
    }

    /**
     * @OA\Post(
     *   path="/api/juegos",
     *   tags={"Juegos"},
     *   summary="Añadir un juego",
     *   description="Añadir el registro de un juego nuevo con parametros.",
     *   operationId="addJuego",
     *   @OA\Parameter(
     *     name="API-KEY",
     *     description="Añadir token",
     *     in="header",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu"
     *     ),
     *   ),
     *  
     *   @OA\RequestBody(
     *     required=true,
     *     description="{nombre, descripcion, desarrolladora, fecha}",
     *     @OA\JsonContent(
     *       required={"nombre", "descripcion", "desarrolladora", "fecha"},
     *       @OA\Property(property="nombre", ref="#/components/schemas/Api/properties/nombre"),
     *       @OA\Property(property="descripcion", ref="#/components/schemas/Api/properties/descripcion"),
     *       @OA\Property(property="desarrolladora", ref="#/components/schemas/Api/properties/desarrolladora"),
     *       @OA\Property(property="fecha", ref="#/components/schemas/Api/properties/fecha")
     *    ),
     *   ),
     *   @OA\Response(response=201, description="Se ha creado correctamente"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=401, description="No autorizado"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function store(Request $request)
    {

        $validator = $this->api->validation_add($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 220);
        } else {
            $juego = $this->api->add_juego($request);
            return response()->json(['success' => 'Se ha añadido correctamente el juego: ' . $juego], 201);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/juegos/{slug}",
     *   tags={"Juegos"},
     *   summary="Obtener un juego",
     *   description="Muestra la información de un juego especifico segun el valor del parametro slug.",
     *   operationId="getJuego",
     *   @OA\Parameter(
     *     name="API-KEY",
     *     description="Añadir token",
     *     in="header",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu"
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="slug",
     *     description="Url del nombre del juego",
     *     in="path",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="test123"
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=401, description="No autorizado"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function show($slug)
    {
        $juego = Api::WHERE('slug', $slug)->first();
        $juego = $this->api->exists_slug($juego);
        return $juego;
    }

    /**
     * @OA\Put(
     *   path="/api/juegos/{slug}",
     *   tags={"Juegos"},
     *   summary="Actualizar un juego",
     *   description="Actulizar un juego ya existente con parametros.",
     *   operationId="editJuego",
     *   @OA\Parameter(
     *     name="API-KEY",
     *     description="Añadir token",
     *     in="header",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu"
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="slug",
     *     description="Url del nombre del juego",
     *     in="path",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="test123"
     *     ),
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     description="{nombre, descripcion, desarrolladora, fecha}",
     *     @OA\JsonContent(
     *       required={"nombre", "descripcion", "desarrolladora", "fecha"},
     *       @OA\Property(property="nombre", ref="#/components/schemas/Api/properties/nombre"),
     *       @OA\Property(property="descripcion", ref="#/components/schemas/Api/properties/descripcion"),
     *       @OA\Property(property="desarrolladora", ref="#/components/schemas/Api/properties/desarrolladora"),
     *       @OA\Property(property="fecha", ref="#/components/schemas/Api/properties/fecha")
     *    ),
     *   ),
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=401, description="No autorizado"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function update($slug, Request $request)
    {
        $juego = $this->show($slug);
        if (isset($juego->original['error'])) {
            return $juego;
        } else {
            $validator = $this->api->validation_update($request, $juego->nombre);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 220);
            } else {
                $juego = $this->api->exists_id_update($juego, $request);
                return $juego;
            }
        }
    }

    /**
     * @OA\Delete(
     *   path="/api/juegos/delete/{slug}",
     *   tags={"Juegos"},
     *   summary="Eliminar un juego",
     *   description="Elimina un juego especifico segun el valor del parametro slug.",
     *   operationId="deleteJuego",
     *   @OA\Parameter(
     *     name="API-KEY",
     *     description="Añadir token",
     *     in="header",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu"
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="slug",
     *     description="Url del nombre del juego",
     *     in="path",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="test123"
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=401, description="No autorizado"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function delete($slug)
    {
        $id_juego = $this->show($slug);
        $juego = $this->api->exists_id_delete($id_juego);
        return $juego;
    }

    /**
     * @OA\Post(
     *   path="/api/juegos/filter/searc",
     *   tags={"Juegos"},
     *   summary="Busqueda",
     *   description="Busqueda por nombres de juegos y también ordena el resultado de distintas maneras.",
     *   operationId="filterJuego",
     *   @OA\Parameter(
     *     name="API-KEY",
     *     description="Añadir token",
     *     in="header",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="$2y$10$f01jcbsMhFuNif8yHAotQuGr4OaqwfXi6g96Y4DHVIkw3HjQgMwMu"
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="search",
     *     description="Nombre del juego que quieres buscar",
     *     in="query",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="dark"
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="filter",
     *     description="Ordenar por diferente tipo. Ejemplos ['nombre', 'descripcion', 'desarolladora', 'fecha'] ",
     *     in="query",
     *     required=false, 
     *     @OA\Schema(
     *       type="string",
     *       example="fecha"
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="order",
     *     description="ordenar de forma 'ASC' o 'DESC'",
     *     in="query",
     *     required=false, 
     *     @OA\Schema(
     *       type="string",
     *       example="DESC"
     *     ),
     *   ),
     * 
     *   @OA\Response(response=200, description="Success"),
     *   @OA\Response(response=220, description="No se cumple todos los requisitos"),
     *   @OA\Response(response=401, description="No autorizado"),
     *   @OA\Response(response=500, description="Error interno del servidor")
     * )
     *
     */
    public function filter(Request $request)
    {
        $juegos = $this->api->search($request);
        return $juegos;
    }
}