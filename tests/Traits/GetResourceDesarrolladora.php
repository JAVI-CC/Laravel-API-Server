<?php

namespace Tests\Traits;

trait GetResourceDesarrolladora
{
    private function getResourceCollectionDesarrolladora($desarrolladoras): array
    {
        return $desarrolladoras->map(function ($desarrolladora) {
            return [
                'nombre' => $desarrolladora->nombre,
                'slug' => $desarrolladora->slug,

            ];
        })->toArray();
    }

    private function getNewResourceDesarrolladora($desarrolladora): array
    {
        return [
            'nombre' => $desarrolladora->nombre,
            'slug' => $desarrolladora->slug,
        ];
    }

    private function getResourceCollectionStructureDesarrolladora(): array
    {
        return [
            '*' => [
                "nombre",
                "slug"
            ]
        ];
    }
}
