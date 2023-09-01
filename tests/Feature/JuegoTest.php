<?php

namespace Tests\Feature;

use App\Models\Juego;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Traits\CreateNewJuego;
use Tests\Traits\CreateNewUser;
use Tests\Traits\GetResourceJuego;

class JuegoTest extends TestCase
{
    use DatabaseMigrations, CreateNewJuego, GetResourceJuego, CreateNewUser;

    private const PATH = '/api/juegos/';
    private const FAKE_STORAGE = 'juegos';

    public function test_obtener_todos_los_juegos(): void
    {
        $juegos = $this->createNewJuego(3);
        $juegos = $juegos->sortByDesc('id')->values();

        $res = $this->getJson(self::PATH);
        $json = $this->getResourceCollectionJuego($juegos);

        $res->assertStatus(200);
        $res->assertExactJson($json);
    }

    public function test_obtener_juegos_con_paginacion_y_orden(): void
    {
        $juegos = $this->createNewJuego(12);
        $juegos = $juegos->sortByDesc('nombre')->values();
        $page = 1;
        $items = 8;
        $order = 'nombreDesc';

        $res = $this->getJson(self::PATH . 'paginate?page=' . $page . '&items=' . $items . '&order=' . $order);
        $json = $this->getResourceCollectionJuego($juegos);
        $json = array_slice($json, 0, 8);

        $res->assertJsonCount(8);
        $res->assertStatus(200);
        $res->assertExactJson($json);
    }

    public function test_obtener_juegos_en_orden_random(): void
    {
        $this->createNewJuego(8);
        $items = 5;

        $res = $this->getJson(self::PATH . 'random?items=' . $items);

        $res->assertJsonCount(5);
        $res->assertStatus(200);
        $res->assertJsonStructure($this->getResourceCollectionStructureJuego());
    }

    public function test_obtener_juego_mediante_slug(): void
    {
        $juego = $this->createNewJuegoTest();

        $res = $this->getJson(self::PATH . $juego->slug);
        $json = $this->getNewResourceJuego($juego);

        $res->assertStatus(200);
        $res->assertExactJson($json);
    }

    public function test_buscador_juegos(): void
    {
        $this->createNewJuegoTest();
        $this->createNewJuego(9);
        $juegos = Juego::all();
        $juegos = $juegos->sortBy('nombre')->values();
        $search = 'testing';
        $filter = 'nombre';
        $order = 'ASC';

        $res = $this->postJson(self::PATH . 'filter/search?search=' . $search . '&filter=' . $filter . '&order=' . $order);

        $res->assertStatus(200);
        $res->assertJsonStructure($this->getResourceCollectionStructureJuego());
    }

    public function test_insertar_juego(): void
    {
        Storage::fake(self::FAKE_STORAGE);
        $user = $this->createNewUser();
        $data = [
            'nombre' => 'nuevo juego para hacer el test',
            'descripcion' => 'Juego para realizar el test de creación',
            'fecha' => '2022-02-25',
            'generos' => ['accion', 'aventura', 'plataformas'],
            'desarrolladora' => 'TEAM ICO',
            'imagen' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg=='
        ];

        $res = $this->actingAS($user)->postJson(self::PATH, $data);
        $juego = Juego::first();

        $this->assertEquals($data['nombre'], $juego->nombre);
        $this->assertEquals($data['descripcion'], $juego->descripcion);
        $this->assertEquals($data['fecha'], $juego->fecha);
        $this->assertEquals(strtolower($data['desarrolladora']), strtolower($juego->desarrolladoras[0]->nombre));
        $this->assertEquals($data['generos'], $juego->generos->pluck('slug')->toArray());
        Storage::disk(self::FAKE_STORAGE)->assertExists('juegos/' . $juego->id . "-" . $juego->slug . ".png");
        $res->assertStatus(201);
        $this->assertDatabaseCount(Juego::class, 1);
        $res->assertExactJson($this->getNewResourceJuego($juego));

        Storage::fake('juegos')->deleteDirectory('juegos');
    }

    public function test_actualizar_juego(): void
    {
        Storage::fake(self::FAKE_STORAGE);
        $newJuego = $this->createNewJuegoTest();
        $user = $this->createNewUser();
        $data = [
            'nombre' => 'juego actualizado',
            'slug' => $newJuego->slug,
            'descripcion' => 'descripcion del juego actualizado...',
            'fecha' => '2023-05-19',
            'generos' => ['deportes', 'lucha', 'multijugador'],
            'desarrolladora' => 'Other Ocean',
            'imagen' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg=='
        ];

        $res = $this->actingAS($user)->postJson(self::PATH . 'edit', $data);
        $updateJuego = Juego::first();

        $this->assertEquals($data['nombre'], $updateJuego->nombre);
        $this->assertEquals($data['descripcion'], $updateJuego->descripcion);
        $this->assertEquals($data['fecha'], $updateJuego->fecha);
        $this->assertEquals(strtolower($data['desarrolladora']), strtolower($updateJuego->desarrolladoras[0]->nombre));
        $this->assertEquals($data['generos'], $updateJuego->generos->pluck('slug')->toArray());
        Storage::disk(self::FAKE_STORAGE)->assertExists('juegos/' . $updateJuego->id . "-" . $updateJuego->slug . ".png");
        $res->assertStatus(200);
        $this->assertDatabaseCount(Juego::class, 1);
        $res->assertExactJson($this->getNewResourceJuego($updateJuego));

        Storage::fake('juegos')->deleteDirectory('juegos');
    }

    public function test_eliminar_juego(): void
    {
        Storage::fake(self::FAKE_STORAGE);
        $juego = Juego::factory()->create();
        $user = $this->createNewUser();

        $res = $this->actingAS($user)->deleteJson(self::PATH . 'delete/' . $juego->slug);
        
        Storage::disk(self::FAKE_STORAGE)->assertDirectoryEmpty('juegos');
        $this->assertDatabaseCount(Juego::class, 0);
        $res->assertStatus(200);
        $res->assertExactJson(['success' => 'Se ha eliminado correctamente el juego: ' . $juego->nombre]);

        Storage::fake('juegos')->deleteDirectory('juegos');
    }

}
