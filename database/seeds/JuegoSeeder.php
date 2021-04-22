<?php

use Illuminate\Database\Seeder;

class JuegoSeeder extends Seeder
{
    /**
     ** Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('juegos')->truncate();

        DB::table('juegos')->insert([
            'nombre' => 'Rainbow Six: Siege',
            'descripcion' => 'Es un título de acción first person shooter en el que podremos tomar parte en arriesgadas operaciones antiterroristas en modalidades multijugador cooperativas y competitivas.',
            'desarrolladora' => 'Ubisoft',
            'fecha' => '2015-12-01', 
            'slug' => 'rainbow-six-siege',
            'url_imagen' => 'https://www.dropbox.com/s/f1v7ymtjftj0ue4/1-rainbow-six-siege.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Days gone',
            'descripcion' => 'Es un videojuego de acción y horror de supervivencia ambientado en un entorno de mundo abierto,​post-apocalíptico y jugado desde una perspectiva en tercera persona.',
            'desarrolladora' => 'SIE Bend Studio',
            'fecha' => '2019-04-26', 
            'slug' => 'days-gone',
            'url_imagen' => 'https://www.dropbox.com/s/90rdw0a57pej2su/2-days-gone.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Battlefield 1',
            'descripcion' => 'Es un videojuego de disparos y acción bélica en primera persona.',
            'desarrolladora' => 'Electronics Arts',
            'fecha' => '2016-10-21', 
            'slug' => 'battlefield-1',
            'url_imagen' => 'https://www.dropbox.com/s/wghqqqzekzs71zr/3-battlefield-1.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Crash Bandicoot N Sane Trilogy',
            'descripcion' => 'N. Sane Trilogy es una colección de remakes de los tres primeros videojuegos de la serie Crash Bandicoot (Crash Bandicoot, Crash Bandicoot 2: Cortex Strikes Back y Crash Bandicoot 3: Warped), que cuentan con el personaje protagonista Crash Bandicoot.',
            'desarrolladora' => 'Vicarious Visions',
            'fecha' => '2017-06-30', 
            'slug' => 'crash-bandicoot-n-sane-trilogy',
            'url_imagen' => 'https://www.dropbox.com/s/wk0wulndv78m3wr/4-crash-bandicoot-n-sane-trilogy.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Shadow of the Colossus',
            'descripcion' => 'El juego trata de un joven, conocido únicamente como Wander, que debe viajar a caballo a través de un vasto territorio y derrotar a 16 gigantes.',
            'desarrolladora' => 'Bluepoint Games',
            'fecha' => '2018-02-17', 
            'slug' => 'shadow-of-the-colossus',
            'url_imagen' => 'https://www.dropbox.com/s/q6wg9ijkwbigfer/5-shadow-of-the-colossus.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Dark Souls Remastered',
            'descripcion' => 'Dark Souls es un RPG de acción en tercera persona, que se caracteriza por una atmósfera oscura y una dificultad muy por encima de los estándares actuales.',
            'desarrolladora' => 'From Software',
            'fecha' => '2018-05-24', 
            'slug' => 'dark-souls-remastered',
            'url_imagen' => 'https://www.dropbox.com/s/vf0en3lbc5htw0f/6-dark-souls-remastered.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'DOOM ETERNAL',
            'descripcion' => 'Es la secuela directa del celebrado título de acción tipo shooter de 2016, el reboot de tan mítica franquicia. En el papel del DOOM Slayer, descubrirás a tu regreso que los demonios han invadido la Tierra.',
            'desarrolladora' => 'Id Software',
            'fecha' => '2020-03-20', 
            'slug' => 'doom-eternal',
            'url_imagen' => 'https://www.dropbox.com/s/ogwwzeuvnk7wxxd/7-doom-eternal.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Grand Theft Auto V',
            'descripcion' => 'És un videojuego de acción-aventura de mundo abierto desarrollado por el estudio Rockstar North y distribuido por Rockstar Games.',
            'desarrolladora' => 'Rockstar North',
            'fecha' => '2013-09-13', 
            'slug' => 'grand-theft-auto-v',
            'url_imagen' => 'https://www.dropbox.com/s/h3yl93k5ulwmli6/8-grand-theft-auto-v.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Bloodborne',
            'descripcion' => 'Cuenta con una vista en tercera persona y su jugabilidad se enfoca en el combate basado en armas y la exploración. Los jugadores luchan contra enemigos bestiales, entre ellos jefes, usando elementos tales como armas blancas y de fuego.',
            'desarrolladora' => 'From Software',
            'fecha' => '2015-03-24', 
            'slug' => 'bloodborne',
            'url_imagen' => 'https://www.dropbox.com/s/kr5usqsz8rzogpe/9-bloodborne.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Spyro Reignited Trilogy',
            'descripcion' => 'Spyro, un pequeño dragón morado que cuenta con habilidades como escupir fuego, saltar y volar, que le permiten enfrentarse en diversas aventuras contra Gnasty Gnorc, Ripto y La Hechicera.',
            'desarrolladora' => 'Toys for Bob',
            'fecha' => '2018-11-13',
            'slug' => 'spyro-reignited-trilogy', 
            'url_imagen' => 'https://www.dropbox.com/s/4q5iyvo8t9j4oi7/10-spyro-reignited-trilogy.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Zombie Army Trilogy',
            'descripcion' => 'Es un videojuego shooter táctico en tercera persona. El juego es compatible con Campaña y el modo Horda, que se puede jugar ya sea en solitario o en cooperación.',
            'desarrolladora' => 'Rebelion',
            'fecha' => '2015-03-15', 
            'slug' => 'zombie-army-trilogy',
            'url_imagen' => 'https://www.dropbox.com/s/rgz928s5t8yzoue/11-zombie-army-trilogy.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Cuphead',
            'descripcion' => 'Cuphead es un videojuego de plataformas de scroll lateral en 2D de tipo shot em up ya que se pueden recolectar poderes y modificarlos.',
            'desarrolladora' => 'StudioMDHR',
            'fecha' => '2017-09-29', 
            'slug' => 'cuphead',
            'url_imagen' => 'https://www.dropbox.com/s/hyi4pzmnatyxh1r/12-cuphead.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Halo 3',
            'descripcion' => 'Es un Shooter en Primera Persona (FPS) de ciencia ficción, tiene los modos Campaña, Matchmaking, Multijugador, Forge y Cine.',
            'desarrolladora' => 'Bungie Studios',
            'fecha' => '2007-09-25', 
            'slug' => 'halo-3',
            'url_imagen' => 'https://www.dropbox.com/s/z1cptroz4d5qzo8/13-halo-3.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Medievil',
            'descripcion' => 'En el reino de Gallowmere, año 1286, el poderoso mago Zarok, desterrado por nigromancia, reunió a un numeroso ejército de zombis, demonios y otros monstruos con la intención de conquistar el reino al que pertenecía y vengarse de la familia real.',
            'desarrolladora' => 'Other Ocean',
            'fecha' => '2019-10-25', 
            'slug' => 'medievil',
            'url_imagen' => 'https://www.dropbox.com/s/3awo5d8u1anadn5/14-medievil.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'The Simpsons Hit & Run',
            'descripcion' => 'El juego sigue la historia de la Familia Simpson y de los ciudadanos de Springfield, quienes son testigos de muchos incidentes extraños que ocurren en la ciudad. Cuando varios residentes deciden tomar el asunto por sus propias manos.',
            'desarrolladora' => 'Radical Entertainment',
            'fecha' => '2003-09-16', 
            'slug' => 'the-simpsons-hit-run',
            'url_imagen' => 'https://www.dropbox.com/s/buzvyafg2a2338h/15-the-simpsons-hit-run.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Dark Souls II: Scholar of the First Sin',
            'descripcion' => 'Dark Souls II és un videojuego de rol de acción que tiene lugar en un mundo abierto.',
            'desarrolladora' => 'From Software',
            'fecha' => '2014-04-15', 
            'slug' => 'dark-souls-ii-scholar-of-the-first-sin',
            'url_imagen' => 'https://www.dropbox.com/s/jsmj5vqao32hrd4/16-dark-souls-ii-scholar-of-the-first-sin.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Dark Souls III: The Fire Fades Edition',
            'descripcion' => 'Es un RPG de acción en tercera persona en el que nos enfrentamos a diversos enemigos y peligros en los escenarios. Además, los jefes finales del videojuego destacan por sus diseños y tamaños, exigiendo al jugador a observar el patrón de movimientos de sus',
            'desarrolladora' => 'From Software',
            'fecha' => '2017-04-21', 
            'slug' => 'dark-souls-iii-the-fire-fades-edition',
            'url_imagen' => 'https://www.dropbox.com/s/218rjkp7e6s3fwp/17-dark-souls-iii-the-fire-fades-edition.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'DOOM',
            'descripcion' => 'Es un videojuego FPS (First Person Shooter o disparos en primera persona), que constituye un reinicio de la serie de Doom.',
            'desarrolladora' => 'Id Software',
            'fecha' => '2016-05-13', 
            'slug' => 'doom',
            'url_imagen' => 'https://www.dropbox.com/s/9t6jl2vwhbwt73w/18-doom.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'God of War',
            'descripcion' => 'El retorno de un dios por la puerta grande. God of War 4, el videojuego protagonizado por el espartano y sanguinario Kratos, introduciendo de lleno a Kratos en la mitología nórdica con un papel nunca visto hasta entonces: el de padre con su hijo Atreus.',
            'desarrolladora' => 'Sant Monica Studio',
            'fecha' => '2018-04-20', 
            'slug' => 'god-of-war',
            'url_imagen' => 'https://www.dropbox.com/s/rp84uex5arzynw0/19-god-of-war.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'GHOST OF TSUSHIMA',
            'descripcion' => 'Es un juego de aventura de acción ambientada en el Japón feudal y en el que un samurái trata de hacer frente a la invasión del ejército mongol en el año 1274.',
            'desarrolladora' => 'Sucker Punch Productions',
            'fecha' => '2020-07-17', 
            'slug' => 'ghost-of-tsushima',
            'url_imagen' => 'https://www.dropbox.com/s/zmxhzlmtvjbhreu/20-ghost-of-tsushima.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Super Mario 64',
            'descripcion' => 'Super Mario 64 es un videojuego de plataformas de mundo abierto para la videoconsola Nintendo 64, desarrollado por Nintendo Entertainment Analysis and Development y publicado por la propia Nintendo.',
            'desarrolladora' => 'Nintendo Entertainment',
            'fecha' => '1996-06-23', 
            'slug' => 'super-mario-64',
            'url_imagen' => 'https://www.dropbox.com/s/s4es3c470pi1ef6/21-super-mario-64.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'The Legend of Zelda Ocarina of Time',
            'descripcion' => 'The Legend of Zelda: Ocarina of Time 3D es un juego de acción y aventuras desarrollado por Grezzo y publicado por Nintendo para la consola de juegos portátil Nintendo 3DS.',
            'desarrolladora' => 'Nintendo Entertainment',
            'fecha' => '2011-06-21', 
            'slug' => 'the-Legend-of-zelda-ocarina-of-time-3d',
            'url_imagen' => 'https://www.dropbox.com/s/ld5whldgtv62zfp/22-the-Legend-of-zelda-ocarina-of-time-3d.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Horizon Zero Dawn',
            'descripcion' => 'Horizon Zero Dawn es un videojuego de acción, aventura y de mundo abierto desarrollado por Guerrilla Games y distribuido por Sony Interactive Entertainment.',
            'desarrolladora' => 'Guerrilla Games',
            'fecha' => '2017-02-28', 
            'slug' => 'horizon-zero-dawn',
            'url_imagen' => 'https://www.dropbox.com/s/83wjls0qaad6q8k/23-horizon-zero-dawn.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Minecraft',
            'descripcion' => 'Minecraft es un juego de mundo abierto, por lo que no posee un objetivo específico, permitiéndole al jugador una gran libertad en cuanto a la elección de su forma de jugar.',
            'desarrolladora' => 'Mojang Studios',
            'fecha' => '2011-11-28', 
            'slug' => 'minecraft',
            'url_imagen' => 'https://www.dropbox.com/s/fckvytwabllm0xp/24-minecraft.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Splatton 2',
            'descripcion' => 'La acción transcurre dos años después del último festival de Splatoon, en el que Tina derrotó a su prima Mar en la encuesta de popularidad del dúo que ambas forman, las Calamarciñas.',
            'desarrolladora' => 'Nintendo Entertainment',
            'fecha' => '2017-07-21', 
            'slug' => 'splatoon-2',
            'url_imagen' => 'https://www.dropbox.com/s/vhy2r9ohixufgpx/25-splatoon-2.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Cyberpunk 2077',
            'descripcion' => 'Siendo una adaptación del juego de rol de mesa Cyberpunk 2020, se establece cincuenta y siete años más tarde en la ciudad distópica de Night City, California. Es un mundo abierto con seis distritos diferentes.',
            'desarrolladora' => 'CD Projekt RED',
            'fecha' => '2020-12-10', 
            'slug' => 'cyberpunk-2077',
            'url_imagen' => 'https://www.dropbox.com/s/jdz0rirl6vv5uoc/26-cyberpunk-2077.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Metal Gear Solid',
            'descripcion' => 'Metal Gear Solid sigue a Solid Snake, un soldado que se infiltra en una instalación de armas nucleares para neutralizar la amenaza terrorista de FOXHOUND, una unidad genéticamente mejorada de fuerzas especiales.​',
            'desarrolladora' => 'Konami',
            'fecha' => '1998-09-03', 
            'slug' => 'metal-gear-solid',
            'url_imagen' => 'https://www.dropbox.com/s/9exvdj7bwk5ptgi/27-metal-gear-solid.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Gears 5',
            'descripcion' => 'Tras los eventos de Gears of War 4, el mundo se está desmoronando. La dependencia de la tecnología de los humanos se ha convertido en su caída y los enemigos se están uniendo para eliminar a todos los supervivientes.',
            'desarrolladora' => 'The Coalition',
            'fecha' => '2019-09-10', 
            'slug' => 'gears-5',
            'url_imagen' => 'https://www.dropbox.com/s/8yvcmhn8fz6rii5/28-gears-5.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Zombie Army 4',
            'descripcion' => 'Es una secuela del juego recopilatorio de 2015 Zombie Army Trilogy, un spin-off de la serie Sniper Elite.',
            'desarrolladora' => 'Rebellion Developments',
            'fecha' => '2020-02-04', 
            'slug' => 'zombie-army-4',
            'url_imagen' => 'https://www.dropbox.com/s/lf8qsv6d8kx4n0s/29-zombie-army-4.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Fallout 4',
            'descripcion' => 'Como es común en el título, puedes volver a elegir entre un modo en primera persona y tercera persona, y donde puedes ir con total libertad a cualquier punto del mapa.',
            'desarrolladora' => 'Bethesda Game Studios',
            'fecha' => '2015-11-10', 
            'slug' => 'fallout-4',
            'url_imagen' => 'https://www.dropbox.com/s/bj978fbgqsu310h/30-fallout-4.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Los Simpsons el videojuego',
            'descripcion' => 'El juego tiene 16 niveles y todos tienen relación con los capítulos de Los Simpson. Se ha revelado que los jugadores podrán controlar cuatro de los cinco miembros de la familia con sus propios niveles y capacidades únicas.',
            'desarrolladora' => 'Electronic Arts',
            'fecha' => '2007-10-30', 
            'slug' => 'los-simpsons-el-videojuego',
            'url_imagen' => 'https://www.dropbox.com/s/d1cs509vtceoirv/31-los-simpsons-el-videojuego.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Metroid Prime 2 Echoes',
            'descripcion' => 'Transcurridos seis meses desde los eventos de Metroid Prime, Samus Aran ha sido contratada por la Federación Galáctica para investigar la desaparición de un grupo de soldados en el planeta Aether.',
            'desarrolladora' => 'Retro Studios',
            'fecha' => '2005-05-16', 
            'slug' => 'metroid-prime-2-echoes',
            'url_imagen' => 'https://www.dropbox.com/s/3l8c0xyx1y0hurl/32-metroid-prime-2-echoes.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Far Cry 3',
            'descripcion' => 'Far Cry 3 es un videojuego de disparos en primera persona, que contiene elementos de un videojuego de rol, tales como los puntos de experiencia,árboles de habilidades y un menú de creación.',
            'desarrolladora' => 'Ubisoft Montreal',
            'fecha' => '2012-11-29', 
            'slug' => 'far-cry-3',
            'url_imagen' => 'https://www.dropbox.com/s/o8w8mj3v8l004my/33-far-cry-3.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Mario Kart 8',
            'descripcion' => 'La jugabilidad principal sigue siendo la misma de las ediciones anteriores de Mario Kart. Incluye el mismo diseño de Karts de Mario Kart 7, se puede planear con ala deltas y conducir bajo el agua como en la entrega anterior.',
            'desarrolladora' => 'Nintendo EAD',
            'fecha' => '2014-05-29', 
            'slug' => 'mario-kart-8',
            'url_imagen' => 'https://www.dropbox.com/s/4js23f8cv2kiscp/34-mario-kart-8.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Final Fantasy VII Remake',
            'descripcion' => 'La nueva versión de Final Fantasy VII, vuelve a contar la historia del videojuego original, que sigue a Cloud Strife, un exsoldado de Shinra que se une al grupo ecoterrorista AVALANCHE como un mercenario para luchar contra la corporación Shinra.',
            'desarrolladora' => 'Square Enix',
            'fecha' => '2020-04-10', 
            'slug' => 'final-fantasy-vii-remake',
            'url_imagen' => 'https://www.dropbox.com/s/x1kbg64j0823qpv/35-final-fantasy-vii-remake.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'A Way Out',
            'descripcion' => 'A Way Out es un videojuego de acción-aventura jugado desde la perspectiva de tercera persona. Está diseñado para ser jugado en cooperativo a pantalla partida, lo que significa que debe ser jugado con otro jugador tanto en línea como local.',
            'desarrolladora' => 'Electronics Arts',
            'fecha' => '2018-03-23', 
            'slug' => 'a-way-out',
            'url_imagen' => 'https://www.dropbox.com/s/qvtb87x1htefa9b/36-a-way-out.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'The Witcher 3 Wild Hunt',
            'descripcion' => 'The Witcher 3: Wild Hunt es un juego de rol de acción con una perspectiva en tercera persona . Los jugadores controlan a Geralt de Rivia, un cazador de monstruos conocido como brujo. Geralt camina, corre, rueda y esquiva.',
            'desarrolladora' => 'CD Projekt Red',
            'fecha' => '2015-05-19', 
            'slug' => 'the-witcher-3-wild-hunt',
            'url_imagen' => 'https://www.dropbox.com/s/g3qefs369xrr06t/37-the-witcher-3-wild-hunt.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Red Dead Redemption 2',
            'descripcion' => 'Al igual que la primera entrega, Red Dead Redemption 2 es un juego de acción y aventura, jugado tanto como primera como tercera persona.',
            'desarrolladora' => 'Rockstar Games',
            'fecha' => '2018-10-26', 
            'slug' => 'red-dead-redemption-2',
            'url_imagen' => 'https://www.dropbox.com/s/8tvho16679skoc5/38-red-dead-redemption-2.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Pokémon Lets Go, Pikachu! y Lets Go, Eevee!',
            'descripcion' => 'Los juegos se desarrollan en la región de Kanto. Cuenta con los elementos comunes de la franquicia, como entrenadores pokémon y combates de gimnasio.',
            'desarrolladora' => 'Game Freak',
            'fecha' => '2018-11-16', 
            'slug' => 'pokemon-Lets-go-pikachu-eevee',
            'url_imagen' => 'https://www.dropbox.com/s/078lgosbiffy6m2/39-pokemon-Lets-go-pikachu-eevee.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Crash Team Racing Nitro-Fueled',
            'descripcion' => 'La dinámica del videojuego es similar al original, la cual consistía en disputar distintas modalidades de carreras junto a una serie de contrincantes a los que se puede atacar mediante diversas armas.',
            'desarrolladora' => 'Beenox',
            'fecha' => '2019-06-21', 
            'slug' => 'crash-team-racing-nitro-fueled',
            'url_imagen' => 'https://www.dropbox.com/s/90hvimt5mmsj7ng/40-crash-team-racing-nitro-fueled.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'The Last Guardian',
            'descripcion' => 'The Last Guardian es un videojuego en tercera persona que combina elementos de acción y aventura con rompecabezas. El jugador controla a un niño sin nombre que debe cooperar con la criatura mitad pájaro y mitad mamífero.',
            'desarrolladora' => 'genDesign',
            'fecha' => '2016-12-06', 
            'slug' => 'the-last-guardian',
            'url_imagen' => 'https://www.dropbox.com/s/r6z3vsqjewlt56q/41-the-last-guardian.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Monster Hunter World',
            'descripcion' => 'Monster Hunter: World es un videojuego de rol y acción, ambientado en un entorno de mundo abierto, y jugado desde una perspectiva en tercera persona. Al igual que en los juegos anteriores de la serie.',
            'desarrolladora' => 'Capcom',
            'fecha' => '2018-01-26', 
            'slug' => 'monster-hunter-world',
            'url_imagen' => 'https://www.dropbox.com/s/oh14odhtacu3ore/42-monster-hunter-world.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Killing Floor 2',
            'descripcion' => 'Killing Floor 2 es un videojuego de disparos en primera persona que se puede jugar solo o de forma cooperativa con hasta seis jugadores.',
            'desarrolladora' => 'Tripwire Interactive',
            'fecha' => '2016-11-18', 
            'slug' => 'killing-floor-2',
            'url_imagen' => 'https://www.dropbox.com/s/00slom4pe5fd0pt/43-killing-floor-2.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Sekiro Shadows Die Twice',
            'descripcion' => 'En un reinventado período Sengoku de finales del siglo XVI en Japón, el señor de la guerra Isshin Ashina organizó un golpe sangriento y tomó el control de la tierra de Ashina del Ministerio del Interior.',
            'desarrolladora' => 'From Software',
            'fecha' => '2019-03-22', 
            'slug' => 'sekiro-shadows-die-twice',
            'url_imagen' => 'https://www.dropbox.com/s/ixiwrplywghkrft/44-sekiro-shadows-die-twice.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Resident Evil 7 BioHazard',
            'descripcion' => 'Resident Evil 7 es el primer título de la saga principal que emplea una perspectiva en primera persona. A diferencia de otros videojuegos más cercanos al género del horror puro, como Amnesia: The Dark Descent y Outlast.',
            'desarrolladora' => 'Capcom',
            'fecha' => '2017-01-24', 
            'slug' => 'resident-evil-7-biohazard',
            'url_imagen' => 'https://www.dropbox.com/s/j3co18leq3rn3w4/45-resident-evil-7-biohazard.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Resident Evil 4',
            'descripcion' => 'Resident Evil 4 cuenta con un personaje principal llamado Leon S. Kennedy. Este es el principal protagonista masculino controlable de la franquicia debido a su popularidad dicho esto por el mismo Shinji Mikami.',
            'desarrolladora' => 'Capcom',
            'fecha' => '2005-01-11', 
            'slug' => 'resident-evil-4',
            'url_imagen' => 'https://www.dropbox.com/s/f3afzvksmjqwv28/46-resident-evil-4.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Mafia Definitive Edition',
            'descripcion' => 'En 1930, durante la Gran Depresión, dos miembros de la familia Salieri, Paulie Lombardo y Sam Trapani, obligan al taxista empobrecido Tommy Angelo a ayudarlos a escapar de una emboscada de la familia Morello.',
            'desarrolladora' => 'Hangar 13',
            'fecha' => '2020-09-25', 
            'slug' => 'mafia-definitive-editon',
            'url_imagen' => 'https://www.dropbox.com/s/nlfvkxsxep4pl5h/47-mafia-definitive-editon.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'The Last of Us Part 2',
            'descripcion' => 'En las afueras de Jackson (Wyoming), Joel relata los eventos de Salt Lake City, el escape de St. Marys Hospital y la mentira que le dijo a Ellie para protegerla de la verdad; a su hermano Tommy.',
            'desarrolladora' => 'Naughty Dog',
            'fecha' => '2020-06-19', 
            'slug' => 'the-last-of-us-part-2',
            'url_imagen' => 'https://www.dropbox.com/s/zlu77u01qb7cm94/48-the-last-of-us-part-2.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Kingdom Come Deliverance',
            'descripcion' => 'Kingdom Come: Deliverance es un videojuego de rol y acción ambientado en un mundo abierto y jugado desde una perspectiva en primera persona que utiliza un sistema RPG sin clases.',
            'desarrolladora' => 'Warhorse Studios',
            'fecha' => '2018-02-13', 
            'slug' => 'kingdom-come-deliverance',
            'url_imagen' => 'https://www.dropbox.com/s/51dhlr1l76yy104/49-kingdom-come-deliverance.png?raw=1',
        ]);

        DB::table('juegos')->insert([
            'nombre' => 'Need For Speed Hot Pursuit',
            'descripcion' => 'El juego está inspirado en Need for Speed: Hot Pursuit original, basado a su vez en las persecuciones de alta velocidad con autos exóticos. Como se ha visto en juegos anteriores.',
            'desarrolladora' => 'Criterion Games',
            'fecha' => '2010-11-16', 
            'slug' => 'need-for-speed-hot-pursuit',
            'url_imagen' => 'https://www.dropbox.com/s/r5t7y4qtgl09sjq/50-need-for-speed-hot-pursuit.png?raw=1',
        ]);

    }
}
