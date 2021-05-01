<?php

use Illuminate\Database\Seeder;

class DesarrolladoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('desarrolladoras')->truncate();

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Ubisoft',
            'slug' => 'ubisoft',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'SIE Bend Studio',
            'slug' => 'sie-bend-studio',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Electronics Arts',
            'slug' => 'electronic-arts',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Vicarious Visions',
            'slug' => 'vicarious-visions',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Team ICO',
            'slug' => 'team-ico',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'From Software',
            'slug' => 'from-software',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Id Software',
            'slug' => 'id-software',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Rockstar Games',
            'slug' => 'rockstar-games',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Toys for Bob',
            'slug' => 'toys-for-bob',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Rebelion',
            'slug' => 'rebelion',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'StudioMDHR',
            'slug' => 'studiomdhr',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Bungie Studios',
            'slug' => 'bungie-studios',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Other Ocean',
            'slug' => 'other-ocean',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Radical Entertainment',
            'slug' => 'radical-entertaiment',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Santa Monica Studio',
            'slug' => 'santa-monica-studio',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Sucker Punch Productions',
            'slug' => 'sucker-punch-productions',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Nintendo Entertainment',
            'slug' => 'nintendo-entertaiment',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Guerrilla Games',
            'slug' => 'guerrilla-games',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Mojang Studios',
            'slug' => 'mojang-studios',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'CD Projekt RED',
            'slug' => 'cd-projekt-red',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Konami',
            'slug' => 'konami',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'The Coalition',
            'slug' => 'the-coalition',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Bethesda Game Studios',
            'slug' => 'bethesda-game-studios',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Retro Studios',
            'slug' => 'retro-studios',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Square Enix',
            'slug' => 'square-enix',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Game Freak',
            'slug' => 'game-freak',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Beenox',
            'slug' => 'beenox',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Capcom',
            'slug' => 'capcom',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Tripwire Interactive',
            'slug' => 'tripwire-interactive',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Hangar 13',
            'slug' => 'hangar-13',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Naughty Dog',
            'slug' => 'nauhty-dog',
        ]);

        DB::table('desarrolladoras')->insert([
            'nombre' => 'Warhorse Studios',
            'slug' => 'warhose-studios',
        ]);
    }
}
