<?php

namespace App\Models;

use App\Models\Desarrolladora;
use App\Models\Dropbox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


/**
 * @OA\Schema(
 *   @OA\Xml(name="Juego"),
 *   @OA\Property(property="nombre", description="Nombre del juego", type="string", example="Test123"),
 *   @OA\Property(property="descripcion", description="descripción del juego", type="string", example="insertando juego de prueba..."),
 *   @OA\Property(property="desarrolladora", description="nombre de la desarrolladora que pertenece al juego", type="string", example="Test123 Studios"),
 *   @OA\Property(property="fecha", type="string", description="fecha de salida de lanzamiento del juego", example="2021-01-01"),
 *   @OA\Property(property="slug", type="string", description="Url amigable del nombre del juego", example="test123")
 * )
 * Class BaseModel
 *
 * 
 * @package App\Models
 */
class Juego extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';
    protected $hidden = array('id');
    protected $fillable = array('nombre', 'descripcion', 'fecha', 'url_imagen', 'slug');

    //Relacion de muchos a muchos inversa polimorfica
    public function desarrolladoras()
    {
        return $this->morphedByMany(Desarrolladora::class, 'juegable');
    }

    public function validation_add($request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|min:2|max:255|unique:juegos',
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required|date_format:Y-m-d',
            'imagen' => 'required|mimes:jpg,jpeg,png|max:1024|',
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
            'nombre' => 'required|min:2|max:255' . $exp,
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required|date_format:Y-m-d',
            'imagen' => 'required|mimes:jpg,jpeg,png|max:1024|',
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
            'nombre' => 'required|min:2|max:255' . $exp,
            'descripcion' => 'required|min:10|max:255',
            'desarrolladora' => 'required|min:2|max:255',
            'fecha' => 'required|date_format:Y-m-d',
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
        $request->merge(['desarrolladorssa' => $desarrolladora->id]);

        $juego = $this->create(array_merge($request->all()));
        $desarrolladora->juegables()->attach($juego->id);
        return $juego;
    }

    public function exists_id_update($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $slug = $this->sluggable($request->nombre);
            $dropbox = new Dropbox();
            $url_imagen = $dropbox->update_imagen($id_juego['url_imagen'], $request->imagen);
            $request->request->add(['slug' => $slug, 'url_imagen' => $url_imagen]);

            $desarrolladora = new Desarrolladora();
            $desarrolladora = $desarrolladora->similar_name($request->input('desarrolladora'));
            $request->merge(['desarrolladora' => $desarrolladora->id]);

            $id_juego->fill($request->all())->save();
            $id_juego->desarrolladoras()->update(['juegable_id' => $desarrolladora->id]);
            return $id_juego;
        }
    }

    public function exists_id_update_without_image($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $slug = $this->sluggable($request->nombre);
            $request->request->add(['slug' => $slug]);

            $desarrolladora = new Desarrolladora();
            $desarrolladora = $desarrolladora->similar_name($request->input('desarrolladora'));
            $request->merge(['desarrolladora' => $desarrolladora->id]);
            
            $id_juego->fill($request->all())->save();
            $id_juego->desarrolladoras()->update(['juegable_id' => $desarrolladora->id]);
            return $id_juego;
        }
    }

    public function exists_id_delete($id_juego)
    {
        if (method_exists($id_juego, 'getData')) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->delete();
            $id_juego->desarrolladoras()->detach();
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


        if ($juegos == '[]') {
            return response()->json(['error' => 'La búsqueda de ' . $request->search . ' no obtuvo ningún resultado'], 221);
        } else {
            return $juegos;
        }
    }
}
