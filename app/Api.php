<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
    protected $fillable = array('nombre', 'descripcion', 'desarrolladora', 'fecha', 'slug');

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
        $slug = $this->convert_url($request->nombre);
        $request->request->add(['slug' => $slug]);
        $juego = $this->create(array_merge($request->all()));
        $this->upload_imagen($juego->id, $slug, $request->imagen);
        return $request->nombre;
    }

    public function exists_id_update($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $slug = $this->convert_url($request->nombre);
            $request->request->add(['slug' => $slug]);
            $id_juego->fill($request->all())->save();
            $this->update_imagen($id_juego['id'], $slug, $request->imagen);
            return response()->json(['success' => 'Se ha modificado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function exists_id_update_without_image($id_juego, $request)
    {

        if ($id_juego == null) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $slug = $this->convert_url($request->nombre);
            $slug_antiguo = $request->input('slug');
            $request->request->add(['slug' => $slug]);
            $id_juego->fill($request->all())->save();

            //Cambiar el nombre del archivo
            $id = $this->where('slug', $request->input('slug'))->first()->id;
            FILE::move(public_path('media/juegos/'.$id.'-'.$slug_antiguo.'.png'), public_path('media/juegos/'.$id.'-'.$slug.'.png'));

            return response()->json(['success' => 'Se ha modificado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function exists_id_delete($id_juego)
    {
        if (method_exists($id_juego, 'getData')) {
            return response()->json(['error' => 'Juego no encontrado']);
        } else {
            $id_juego->delete();
            $this->delete_imagen($id_juego['id']);
            return response()->json(['success' => 'Se ha eliminado correctamente el juego: ' . $id_juego->nombre]);
        }
    }

    public function show_id($slug)
    {
        $juego = $this->WHERE('slug', $slug)->first();
        $juego = $this->exists_slug($juego);
        return $juego;
    }

    public function upload_imagen($id, $slug, $imagen) {
        $filename = "eliminar." .$imagen->getClientOriginalExtension();
        $filenamePNG = $id . "-" . $slug . ".png";
        $imagen->move(public_path('media/juegos/'), $filename);
        imagepng(imagecreatefromstring(file_get_contents(public_path('media/juegos/'.$filename))), public_path('media/juegos/'.$filenamePNG));
        File::delete(File::glob(public_path('media/juegos/eliminar.*')));
    }

    public function update_imagen($id, $slug, $imagen) {
        File::delete(File::glob(public_path('media/juegos/'.$id.'-*')));
        $this->upload_imagen($id, $slug, $imagen);
    }

    public function delete_imagen($id) {
        File::delete(File::glob(public_path('media/juegos/'.$id.'-*')));
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
