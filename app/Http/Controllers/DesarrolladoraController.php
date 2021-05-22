<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Desarrolladora;
use App\Http\Resources\JuegoResource;
use Illuminate\Http\Request;

class DesarrolladoraController extends Controller
{
    protected $desarrolladora;

    public function __construct(Desarrolladora $desarrolladora)
    {
        $this->desarrolladora = $desarrolladora;
    }

    /**
     * @OA\Get(
     *   path="/api/juegos/desarrolladoras/{slug}",
     *   tags={"Desarrolladoras"},
     *   summary="Obtener los juegos de una desarrolladora",
     *   description="Muestra la información de los juegos que pertenece de una desarrolladora en especifico segun el valor del parametro slug.",
     *   operationId="getDesarrolladora",
     *   @OA\Parameter(
     *     name="slug",
     *     description="Url del nombre de la desarrolladora",
     *     in="path",
     *     required=true, 
     *     @OA\Schema(
     *       type="string",
     *       example="test-studios"
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
        $id_des = $this->desarrolladora->findBySlug($slug)->juegables;
        if (isset($id_des['error'])) {
            return response()->json(['error' => 'Desarrolladora no encontrada'], 200);
        }
        return response()->json(JuegoResource::collection(($id_des)), 200);
    }
}
