<?php

namespace App\Models;

use App\Models\Desarrolladora;
use App\Models\Dropbox;
use App\Models\Genero;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Traits\HasFind;
use App\Traits\HasSlug;


/**
 * @OA\Schema(
 *   @OA\Xml(name="Juego"),
 *   @OA\Property(property="nombre", description="Nombre del juego", type="string", example="Test123"),
 *   @OA\Property(property="descripcion", description="descripción del juego", type="string", example="insertando juego de prueba..."),
 *   @OA\Property(property="desarrolladora", description="nombre de la desarrolladora que pertenece al juego", type="string", example="Test123 Studios"),
 *   @OA\Property(property="fecha", type="string", description="fecha de salida de lanzamiento del juego", example="2021-01-01"),
 *   @OA\Property(property="generos", type="string", description="Slugs de generos ya existentes en la base de datos de tipo array (No se puede insertar generos que no esten registrado en la base de datos).", example={"aventura", "rpg-de-accion", "multijugador"}),
 *   @OA\Property(property="slug", type="string", description="Url amigable del nombre del juego", example="test123")
 * )
 * Class BaseModel
 *
 * 
 * @package App\Models
 */
class Juego extends Model
{
    use HasFind, HasSlug;

    public $timestamps = false;
    protected $table = 'juegos';
    protected $hidden = array('id');
    protected $fillable = array('nombre', 'descripcion', 'fecha', 'url_imagen', 'slug');

    //Relaciones de muchos a muchos inversa polimorfica
    public function desarrolladoras()
    {
        return $this->morphedByMany(Desarrolladora::class, 'juegable');
    }

    public function generos()
    {
        return $this->morphedByMany(Genero::class, 'juegable');
    }

    public function validation_add($request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:2|max:255|unique:juegos',
            'descripcion' => 'required|min:10|max:800',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required|date_format:Y-m-d',
            'generos' => 'required|array|between:1,5',
            'generos.*' => 'required|distinct|exists:generos,slug',
            'imagen' => 'required|mimes:jpg,jpeg,png|max:4096|',
        ]);

        return $validator;
    }

    public function validation_update($request, $nombre)
    {

        if ($request->nombre == $nombre) {
            $exp = '';
        } else {
            $exp = '|unique:juegos';
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|min:2|max:255' . $exp,
            'descripcion' => 'nullable|min:10|max:800',
            'desarrolladora' => 'nullable|min:2|max:255',
            'fecha' => 'nullable|date_format:Y-m-d',
            'generos' => 'nullable|array|between:1,5',
            'generos.*' => 'nullable|distinct|exists:generos,slug',
            'imagen' => 'required|mimes:jpg,jpeg,png|max:4096|',
        ]);

        return $validator;
    }

    public function validation_update_without_image($request, $nombre)
    {

        if ($request->nombre == $nombre) {
            $exp = '';
        } else {
            $exp = '|unique:juegos';
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|min:2|max:255' . $exp,
            'descripcion' => 'nullable|min:10|max:800',
            'desarrolladora' => 'nullable|min:2|max:255',
            'generos' => 'nullable|array|between:1,5',
            'generos.*' => 'nullable|distinct|exists:generos,slug',
            'fecha' => 'nullable|date_format:Y-m-d',
        ]);

        return $validator;
    }

    public function exists_slug($id_juego)
    {
        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            return $id_juego;
        }
    }

    public function add_juego($request)
    {
        $slug = $this->sluggable($request->nombre);
        $dropbox = new Dropbox();
        $url_imagen = $dropbox->upload_imagen($request->imagen);
        $request->request->add(['slug' => $slug, 'url_imagen' => $url_imagen]);

        $desarrolladora = new Desarrolladora();
        $desarrolladora = $desarrolladora->similar_name($request->input('desarrolladora'));
        //$request->merge(['desarrolladorssa' => $desarrolladora->id]);

        $juego = $this->create(array_merge($request->all()));
        $desarrolladora->juegables()->attach($juego->id);

        $class_genero = new Genero();
        foreach($request->input('generos') as $genero) {
          $class_genero->findBySlug($genero)->juegables()->attach($juego->id);
        }

        return $juego;
    }

    public function exists_id_update($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {

            if($request->input('nombre') != null) {
              $slug = $this->sluggable($request->nombre);
            } else {
              $slug = $request->input('slug');
            }

            $dropbox = new Dropbox();
            $url_imagen = $dropbox->update_imagen($id_juego['url_imagen'], $request->imagen);
            $request->request->add(['slug' => $slug, 'url_imagen' => $url_imagen]);
            
            if($request->input('desarrolladora') != null) {
              $desarrolladora = new Desarrolladora();
              $desarrolladora = $desarrolladora->similar_name($request->input('desarrolladora'));
              $request->merge(['desarrolladora' => $desarrolladora->id]);
            }

            $id_juego->update($request->only([
                'nombre',
                'descripcion',
                'desarrolladora',
                'fecha',
                'generos',
                'slug',
                'url_imagen'
            ]));

            if($request->input('desarrolladora') != null) {
              $id_juego->desarrolladoras()->update(['juegable_id' => $desarrolladora->id]);
            }

            if($request->input('generos') != null) {
              $class_genero = new Genero();
              $id_juego->generos()->detach();
              foreach($request->input('generos') as $genero) {
                $class_genero->findBySlug($genero);
                $id_juego->generos()->syncWithoutDetaching($class_genero->findBySlug($genero)->id);
              }
            }
            
            return $id_juego;
        }
    }

    public function exists_id_update_without_image($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {

            if($request->input('nombre') != null) {
                $slug = $this->sluggable($request->nombre);
                $request->request->add(['slug' => $slug]);
              } else {
                $slug = $request->input('slug');
              }

            if($request->input('desarrolladora') != null) {
              $desarrolladora = new Desarrolladora();
              $desarrolladora = $desarrolladora->similar_name($request->input('desarrolladora'));
              $request->merge(['desarrolladora' => $desarrolladora->id]);
            }
            
            $id_juego->update($request->only([
                'nombre',
                'descripcion',
                'desarrolladora',
                'fecha',
                'generos',
                'slug',
                'url_imagen'
            ]));
            
            if($request->input('desarrolladora') != null) {
              $id_juego->desarrolladoras()->update(['juegable_id' => $desarrolladora->id]);
            }

            if($request->input('generos') != null) {
              $class_genero = new Genero();
              $id_juego->generos()->detach();
              foreach($request->input('generos') as $genero) {
                $class_genero->findBySlug($genero);
                $id_juego->generos()->syncWithoutDetaching($class_genero->findBySlug($genero)->id);
              }
            }

            return $id_juego;
        }
    }

    public function exists_id_delete($id_juego)
    {
        if (method_exists($id_juego, 'getData')) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->delete();
            $dropbox = new Dropbox();
            $dropbox->delete_imagen($id_juego['url_imagen']);
            return response()->json(['success' => 'Se ha eliminado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function show_id($slug)
    {
        $juego = $this->WHERE('slug', $slug)->first();
        $juego = $this->exists_slug($juego);
        return $juego;
    }

    public function search($request)
    {
        if ($request->search == "" || $request->search == NULL) {
            $request->search = '';
        }

        if ($request->filter == "" || $request->filter == NULL) {
            $request->filter = 'id';
        }

        if ($request->order == "" || $request->order == NULL) {
            $request->order = 'DESC';
        }

        if (DB::getDriverName() === 'mysql' || DB::getDriverName() === 'sqlite') {
            $like = 'LIKE';
        } else if (DB::getDriverName() === 'pgsql') {
            $like = 'ilike';
        } else {
            $like = 'like';
        }

        $juegos = $this->WHERE('nombre', $like, '%' . $request->search . '%')
            ->OrWhere('descripcion', $like, '%' . $request->search . '%')
            ->OrWhere('fecha', $like, '%' . $request->search . '%')
            ->orderBy($request->filter, $request->order)->get();

        $desarrolladora = new Desarrolladora();
        $juegos = $desarrolladora->search_desarrolladora($juegos, $request->search);
    
        $genero = new Genero();
        $juegos = $genero->search_genero($juegos, $request->search);

        if ($juegos == '[]') {
            return response()->json(['error' => 'La búsqueda de ' . $request->search . ' no obtuvo ningún resultado'], 221);
        } else {
            return $juegos;
        }
    }
}
