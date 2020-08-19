<?php

use Illuminate\Database\Seeder;

class JuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('juegos')->truncate();

        DB::table('juegos')->insert([
            'nombre' => 'Rainbow Six: Siege',
            'descripcion' => 'Es un título de acción first person shooter en el que podremos tomar parte en arriesgadas operaciones antiterroristas en modalidades multijugador cooperativas y competitivas.',
            'desarrolladora' => 'Ubisoft',
            'fecha' => '2015-12-01', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Days gone',
            'descripcion' => 'Es un videojuego de acción y horror de supervivencia ambientado en un entorno de mundo abierto,​post-apocalíptico y jugado desde una perspectiva en tercera persona.',
            'desarrolladora' => 'SIE Bend Studio',
            'fecha' => '2019-04-26', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Battlefield 1',
            'descripcion' => 'Es un videojuego de disparos y acción bélica en primera persona.',
            'desarrolladora' => 'Electronics Arts',
            'fecha' => '2016-10-21', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Crash Bandicoot N Sane Trilogy',
            'descripcion' => 'N. Sane Trilogy es una colección de remakes de los tres primeros videojuegos de la serie Crash Bandicoot (Crash Bandicoot, Crash Bandicoot 2: Cortex Strikes Back y Crash Bandicoot 3: Warped), que cuentan con el personaje protagonista Crash Bandicoot.',
            'desarrolladora' => 'Vicarious Visions',
            'fecha' => '2017-06-30', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Shadow of the Colossus',
            'descripcion' => 'El juego trata de un joven, conocido únicamente como Wander, que debe viajar a caballo a través de un vasto territorio y derrotar a 16 gigantes.',
            'desarrolladora' => 'Bluepoint Games',
            'fecha' => '2018-02-17', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Dark Souls Remastered',
            'descripcion' => 'Dark Souls es un RPG de acción en tercera persona, que se caracteriza por una atmósfera oscura y una dificultad muy por encima de los estándares actuales.',
            'desarrolladora' => 'From Software',
            'fecha' => '2018-05-24', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'DOOM ETERNAL',
            'descripcion' => 'Es la secuela directa del celebrado título de acción tipo shooter de 2016, el reboot de tan mítica franquicia. En el papel del DOOM Slayer, descubrirás a tu regreso que los demonios han invadido la Tierra.',
            'desarrolladora' => 'Id Software',
            'fecha' => '2020-03-20', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Grand Theft Auto V',
            'descripcion' => 'És un videojuego de acción-aventura de mundo abierto desarrollado por el estudio Rockstar North y distribuido por Rockstar Games.',
            'desarrolladora' => 'Rockstar North',
            'fecha' => '2013-09-13', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Bloodborne',
            'descripcion' => 'Cuenta con una vista en tercera persona y su jugabilidad se enfoca en el combate basado en armas y la exploración. Los jugadores luchan contra enemigos bestiales, entre ellos jefes, usando elementos tales como armas blancas y de fuego.',
            'desarrolladora' => 'From Software',
            'fecha' => '2015-03-24', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Spyro Reignited Trilogy',
            'descripcion' => 'Spyro, un pequeño dragón morado que cuenta con habilidades como escupir fuego, saltar y volar, que le permiten enfrentarse en diversas aventuras contra Gnasty Gnorc, Ripto y La Hechicera.',
            'desarrolladora' => 'Toys for Bob',
            'fecha' => '2018-11-13', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Zombie Army Trilogy',
            'descripcion' => 'Es un videojuego shooter táctico en tercera persona. El juego es compatible con Campaña y el modo Horda, que se puede jugar ya sea en solitario o en cooperación.',
            'desarrolladora' => 'Rebelion',
            'fecha' => '2015-03-15', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Cuphead',
            'descripcion' => 'Cuphead es un videojuego de plataformas de scroll lateral en 2D de tipo shot em up ya que se pueden recolectar poderes y modificarlos.',
            'desarrolladora' => 'StudioMDHR',
            'fecha' => '2017-09-29', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Halo 3',
            'descripcion' => 'Es un Shooter en Primera Persona (FPS) de ciencia ficción, tiene los modos Campaña, Matchmaking, Multijugador, Forge y Cine.',
            'desarrolladora' => 'Bungie Studios',
            'fecha' => '2007-09-25', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Medievil',
            'descripcion' => 'En el reino de Gallowmere, año 1286, el poderoso mago Zarok, desterrado por nigromancia, reunió a un numeroso ejército de zombis, demonios y otros monstruos con la intención de conquistar el reino al que pertenecía y vengarse de la familia real.',
            'desarrolladora' => 'Other Ocean',
            'fecha' => '2019-10-25', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'The Simpsons Hit & Run',
            'descripcion' => 'El juego sigue la historia de la Familia Simpson y de los ciudadanos de Springfield, quienes son testigos de muchos incidentes extraños que ocurren en la ciudad. Cuando varios residentes deciden tomar el asunto por sus propias manos.',
            'desarrolladora' => 'Radical Entertainment',
            'fecha' => '2003-09-16', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Dark Souls II: Scholar of the First Sin',
            'descripcion' => 'Dark Souls II és un videojuego de rol de acción que tiene lugar en un mundo abierto.',
            'desarrolladora' => 'From Software',
            'fecha' => '2014-04-15', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Dark Souls III: The Fire Fades Edition',
            'descripcion' => 'Es un RPG de acción en tercera persona en el que nos enfrentamos a diversos enemigos y peligros en los escenarios. Además, los jefes finales del videojuego destacan por sus diseños y tamaños, exigiendo al jugador a observar el patrón de movimientos de sus',
            'desarrolladora' => 'From Software',
            'fecha' => '2017-04-21', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'DOOM',
            'descripcion' => 'Es un videojuego FPS (First Person Shooter o disparos en primera persona), que constituye un reinicio de la serie de Doom.',
            'desarrolladora' => 'Id Software',
            'fecha' => '2016-05-13', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'God of War',
            'descripcion' => 'El retorno de un dios por la puerta grande. God of War 4, el videojuego protagonizado por el espartano y sanguinario Kratos, introduciendo de lleno a Kratos en la mitología nórdica con un papel nunca visto hasta entonces: el de padre con su hijo Atreus.',
            'desarrolladora' => 'Sant Monica Studio',
            'fecha' => '2018-04-20', 
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'GHOST OF TSUSHIMA',
            'descripcion' => 'Es un juego de aventura de acción ambientada en el Japón feudal y en el que un samurái trata de hacer frente a la invasión del ejército mongol en el año 1274.',
            'desarrolladora' => 'Sucker Punch Productions',
            'fecha' => '2020-07-17', 
        ]);
    }
}
