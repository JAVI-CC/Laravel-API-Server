<?php

namespace Tests\Feature;

use App\Models\Desarrolladora;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateNewJuego;
use Tests\Traits\GetResourceDesarrolladora;
use Tests\Traits\GetResourceJuego;

class DesarrolladoraTest extends TestCase
{
    use DatabaseMigrations, GetResourceDesarrolladora, GetResourceJuego, CreateNewJuego;

    private const PATH = '/api/juegos/desarrolladoras/';

    public function test_obtener_todas_las_desarrolladoras(): void
    {
        $res = $this->getJson(self::PATH . 'show/all');

        $res->assertStatus(200);
        $res->assertExactJson($this->getResourceCollectionDesarrolladora(Desarrolladora::orderBy('nombre')->get()));
    }

    public function test_obtener_juegos_de_una_desarrolladora(): void
    {
        $juego = $this->createNewJuegoTest();

        $res = $this->getJson(self::PATH . $juego->desarrolladoras[0]->slug);

        $res->assertStatus(200);
        $res->assertJsonStructure($this->getResourceCollectionStructureJuego());
    }
}
