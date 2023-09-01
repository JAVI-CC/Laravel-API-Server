<?php

namespace Tests\Feature;

use App\Models\Genero;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateNewJuego;
use Tests\Traits\GetResourceGenero;
use Tests\Traits\GetResourceJuego;

class GeneroTest extends TestCase
{
    use DatabaseMigrations, GetResourceGenero, GetResourceJuego, CreateNewJuego;

    private const PATH = '/api/juegos/generos/';

    public function test_obtener_todos_los_generos(): void
    {
        $res = $this->getJson(self::PATH . 'show/all');

        $res->assertStatus(200);
        $res->assertExactJson($this->getResourceCollectionGeneros(Genero::orderBy('nombre')->get()));
    }

    public function test_obtener_juegos_de_un_genero(): void
    {
        $juego = $this->createNewJuegoTest();
        
        $res = $this->getJson(self::PATH . $juego->generos[0]->slug);

        $res->assertStatus(200);
        $res->assertJsonStructure($this->getResourceCollectionStructureJuego());
    }
}
