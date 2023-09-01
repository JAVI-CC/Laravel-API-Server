<?php

namespace Tests;

use Database\Seeders\DesarrolladoraSeeder;
use Database\Seeders\GeneroSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->seed(DesarrolladoraSeeder::class);
        $this->seed(GeneroSeeder::class);
    }
}
