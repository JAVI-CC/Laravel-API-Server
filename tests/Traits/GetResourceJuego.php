<?php

namespace Tests\Traits;

trait GetResourceJuego
{
    private function getResourceCollectionJuego($juegos): array
    {
        return $juegos->map(function ($juego) {
            return [
                'nombre' => $juego->nombre,
                'descripcion' => $juego->descripcion,
                'desarrolladora' => ['nombre' => $juego->desarrolladoras[0]->nombre, 'slug' => $juego->desarrolladoras[0]->slug],
                'generos' => $juego->generos->map(function ($genero) {
                    return ['nombre' => $genero->nombre, 'slug' => $genero->slug];
                })->toArray(),
                'fecha' => $juego->fecha,
                'slug' => $juego->slug,
                //'imagen' 
            ];
        })->toArray();
    }

    private function getNewResourceJuego($juego): array
    {
        return [
            'nombre' => $juego->nombre,
            'descripcion' => $juego->descripcion,
            'desarrolladora' => ['nombre' => $juego->desarrolladoras[0]->nombre, 'slug' => $juego->desarrolladoras[0]->slug],
            'generos' => $juego->generos->map(function ($genero) {
                return ['nombre' => $genero->nombre, 'slug' => $genero->slug];
            })->toArray(),
            'fecha' => $juego->fecha,
            'slug' => $juego->slug,
            //'imagen'
        ];
    }

    private function getNewResourceStructureJuego(): array
    {
        return [
            "nombre",
            "descripcion",
            "desarrolladora" => ["nombre", "slug"],
            "generos" => ['*' =>  ["nombre", "slug"]],
            "fecha",
            "slug",
            "imagen"
        ];
    }

    private function getResourceCollectionStructureJuego(): array
    {
        return [
            '*' => [
                "nombre",
                "descripcion",
                "desarrolladora" => ["nombre", "slug"],
                "generos" => ['*' =>  ["nombre", "slug"]],
                "fecha",
                "slug",
                "imagen"
            ]
        ];
    }
}
