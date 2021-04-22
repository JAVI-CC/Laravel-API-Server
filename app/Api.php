<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


/**
 * @OA\Schema(
 *   @OA\Xml(name="Api"),
 *   @OA\Property(property="nombre", description="Nombre del juego", type="string", example="Test123"),
 *   @OA\Property(property="descripcion", description="descripción del juego", type="string", example="insertando juego de prueba..."),
 *   @OA\Property(property="desarrolladora", description="nombre de la desarrolladora que pertenece al juego", type="string", example="Test Software"),
 *   @OA\Property(property="fecha", type="string", description="fecha de salida de lanzamiento del juego", example="2021-01-01"),
 *   @OA\Property(property="slug", type="string", description="Url amigable del nombre del juego", example="test123")
 * )
 * Class BaseModel
 *
 * 
 * @package App\Models
 */
class Api extends Model
{
    public $timestamps = false;
    protected $table = 'juegos';
    protected $hidden = array('id');
    protected $fillable = array('nombre', 'descripcion', 'desarrolladora', 'fecha', 'url_imagen', 'slug');

    protected function convert_url($txt)
    {
        $txt = substr($txt, 0, 140);
        $txt = strtr($txt, " _ÀÁÂÃÄÅÆàáâãäåæÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñÞßÿý",  "--aaaaaaaaaaaaaaoooooooooooooeeeeeeeeecceiiiiiiiiuuuuuuuunntsyy");
        $txt = strtolower($txt);
        $txt = preg_replace("/[^a-z0-9\-.]/", "", $txt);
        return str_replace("--", "-", $txt);
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
        $slug = API::convert_url($request->nombre);
        $url_imagen = API::upload_imagen($request->imagen);
        $request->request->add(['slug' => $slug, 'url_imagen' => $url_imagen]);
        $juego = API::create(array_merge($request->all()));
        return $request->nombre;
    }

    public function exists_id_update($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $slug = API::convert_url($request->nombre);
            $url_imagen = API::update_imagen($id_juego['url_imagen'], $request->imagen);
            $request->request->add(['slug' => $slug, 'url_imagen' => $url_imagen]);
            $id_juego->fill($request->all())->save();
            return response()->json(['success' => 'Se ha modificado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function exists_id_delete($id_juego)
    {
        if (method_exists($id_juego, 'getData')) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->delete();
            API::delete_imagen($id_juego['url_imagen']);
            return response()->json(['success' => 'Se ha eliminado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function show_id($slug)
    {
        $juego = Api::WHERE('slug', $slug)->first();
        $juego = Api::exists_slug($juego);
        return $juego;
    }

    public function upload_imagen($imagen) {
        
        $ruta_enlace = Storage::disk('dropbox')->put('/media/juegos', $imagen);

        $dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
        
        $response_enlace = $dropbox->createSharedLinkWithSettings($ruta_enlace, ["requested_visibility" => "public"]);

        $url_enlace = str_replace('dl=0','raw=1',$response_enlace['url']);

        return $url_enlace;
    }

    public function update_imagen($imagen, $imagen_nueva) {
        API::delete_imagen($imagen);
        $url_enlace = API::upload_imagen($imagen_nueva);
        return $url_enlace;
    }

    public function delete_imagen($imagen) {
        $url_imagen = str_replace('?raw=1', '', $imagen);
        $url_imagen = str_replace('https://www.dropbox.com/s/', '', $url_imagen);
        $url_imagen = substr($url_imagen, 16);
        Storage::disk('dropbox')->delete('media/juegos/'.$url_imagen);
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

        $juegos = Api::WHERE('nombre', 'LIKE', '%' . $request->search . '%')
            ->OrWhere('desarrolladora', 'LIKE', '%' . $request->search . '%')
            ->OrWhere('descripcion', 'LIKE', '%' . $request->search . '%')
            ->OrWhere('fecha', 'LIKE', '%' . $request->search . '%')
            ->orderBy($request->filter, $request->order)->get();


        if ($juegos == '[]') {
            return response()->json(['error' => 'La búsqueda de ' . $request->search . ' no obtuvo ningún resultado'], 221);
        } else {
            return $juegos;
        }
    }
}
