<?php

namespace Tests\Traits;

use App\Models\Desarrolladora;
use App\Models\Genero;
use App\Models\Juego;
use Illuminate\Database\Eloquent\Collection;

trait CreateNewJuego
{
    private function createNewJuego(int $count = 1): Collection
    {
        $juegos = Juego::factory($count)->create();

        foreach ($juegos as $juego) {
            $juego->desarrolladoras()->attach(Desarrolladora::all()->random(1)->first()->id);
            $juego->generos()->attach(Genero::all()->random(rand(1, 5))->pluck('id'));
        }

        return $juegos;
    }

    private function createNewJuegoTest(): Juego
    {
        $juego = Juego::factory()->create([
            'nombre' => 'Testing el videojuego',
            'descripcion' => 'Descubre el mundo del testing...',
            'fecha' => '2023-09-01',
            'slug' => 'testing-el-videojuego',
        ]);

        $juego->desarrolladoras()->attach([33]); //THQ NORDIC
        $juego->generos()->attach([5, 59, 64]); //Aventura, RPG de acción y Sandbox

        return $juego;
    }
}
