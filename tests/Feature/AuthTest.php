<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\CreateNewUser;

class AuthTest extends TestCase
{
    use DatabaseMigrations, CreateNewUser;

    private const PATH = '/api/auth/';

    public function test_user_pueda_hacer_login(): void
    {
        //Organizar
        $user = $this->createNewUser();
        $data = ['email' => 'testing@email.com', 'password' => '12345678'];

        //Actuar
        $res = $this->post(self::PATH . 'login', $data);

        //Afirmar
        $res->assertStatus(201);
        $res->assertJsonCount(3);
        $res->assertJson([
            'name' => $user->name,
            'email' => $data['email']
        ]);
        $this->assertDatabaseCount('personal_access_tokens', 1);
        $this->assertStringContainsString('Bearer', $res->json()['token']);
    }

    public function test_registrar_nuevo_user(): void
    {
        $data = ['name' => 'Test Registro', 'email' => 'testregistro@email.com', 'password' => '12345678', 'password_confirmation' => '12345678'];

        $res = $this->post(self::PATH . 'register', $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $res->assertStatus(201);
        $res->assertJsonCount(3);
        $res->assertJson([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
        $this->assertDatabaseCount(User::class, 1);
        $this->assertArrayHasKey('token', $res->json());
    }

    public function test_cerrar_session_del_user(): void
    {
        $user = $this->createNewUser();

        $res = $this->actingAs($user)->postJson(self::PATH . 'logout');

        $res->assertStatus(200);
        $this->assertDatabaseCount('personal_access_tokens', 0);
        $res->assertExactJson(['message' => 'Tokens Revoked']);
    }

    /*Es un falso positivo ya que el usuario admin le devuelve el email_verified_at
    y el resto de users no.*/
    public function test_obtener_informacion_del_user(): void
    {
        $user = $this->createNewUser();

        $res = $this->actingAs($user)->getJson(self::PATH . 'userinfo');

        $res->assertStatus(200);
        $res->assertJsonCount(4);
        $res->assertJson([
            'name' => $user->name,
            'email' => $user->email,
            // 'email_verified_at' => $user->email_verified_at,
        ]);
        $this->assertArrayHasKey('created_at', $res->json());
        $this->assertArrayHasKey('updated_at', $res->json());
    }

    /*Es un falso positivo ya que el usuario admin le devuelve el email_verified_at
    y el resto de users no.*/
    public function test_comprobar_que_el_user_este_autenticado(): void
    {
        $user = $this->createNewUser();

        $res = $this->actingAs($user)->getJson(self::PATH . 'check');

        $res->assertStatus(200);
        $res->assertExactJson([
            'logged' => true,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function test_comprobar_que_el_user_no_este_autenticado(): void
    {
        $res = $this->getJson(self::PATH . 'check');

        $res->assertStatus(200);
        $res->assertExactJson(['logged' => false]);
    }

    public function test_darse_de_baja(): void
    {
        $user = $this->createNewUser();

        $res = $this->actingAs($user)->deleteJson(self::PATH . 'delete');

        $this->assertDatabaseCount(User::class, 0);
        $res->assertStatus(200);
        $res->assertExactJson(['message' => 'El usuario ' . $user->name . ' se ha eliminado correctamente']);
    }
}
