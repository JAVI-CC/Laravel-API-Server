<?php

namespace Tests\Traits;

use App\Models\User;

trait CreateNewUser
{
    private function createNewUser(): User
    {
        $user = User::factory()->create([
            'name' => 'User testing',
            'email' => 'testing@email.com',
            'password' => bcrypt('12345678'),
        ]);

        return $user;
    }
}