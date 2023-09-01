<?php

namespace Tests\Traits;

trait GetResourceGenero
{
    private function getResourceCollectionGeneros($generos): array
    {
        return $generos->map(function ($genero) {
            return [
                'nombre' => $genero->nombre,
                'slug' => $genero->slug,

            ];
        })->toArray();
    }

    private function getNewResourceGenero($genero): array
    {
        return [
            'nombre' => $genero->nombre,
            'slug' => $genero->slug,
        ];
    }

    private function getResourceCollectionStructureGenero(): array
    {
        return [
            '*' => [
                "nombre",
                "slug"
            ]
        ];
    }
}
