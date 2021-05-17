<?php

namespace App\Models;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    public function upload($id, $slug, $imagen, $nombre)
    {
        $filename = "eliminar." . $imagen->getClientOriginalExtension();
        $filenamePNG = $id . "-" . $slug . ".png";
        $imagen->move(public_path('media/'.$nombre.'/'), $filename);
        imagepng(imagecreatefromstring(file_get_contents(public_path('media/'.$nombre.'/' . $filename))), public_path('media/'.$nombre.'/' . $filenamePNG));
        File::delete(File::glob(public_path('media/'.$nombre.'/eliminar.*')));
    }

    public function updati($id, $slug, $imagen, $nombre)
    {
        File::delete(File::glob(public_path('media/'.$nombre.'/' . $id . '-*')));
        $this->upload($id, $slug, $imagen, $nombre);
    }

    public function rename($id, $slug_antiguo, $slug, $nombre) {
        FILE::move(public_path('media/'.$nombre.'/' . $id . '-' . $slug_antiguo . '.png'), public_path('media/'.$nombre.'/' . $id . '-' . $slug . '.png'));
    }

    public function deleti($id, $nombre)
    {
        File::delete(File::glob(public_path('media/'.$nombre.'/' . $id . '-*')));
    }
}
