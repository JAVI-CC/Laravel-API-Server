<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dropbox extends Model
{

    public function upload_imagen($imagen)
    {

        $ruta_enlace = Storage::disk('dropbox')->put('/media/juegos', $imagen);

        $dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();

        $response_enlace = $dropbox->createSharedLinkWithSettings($ruta_enlace, ["requested_visibility" => "public"]);

        $url_enlace = str_replace('dl=0', 'raw=1', $response_enlace['url']);

        return $url_enlace;
    }

    public function update_imagen($imagen, $imagen_nueva)
    {
        $this->delete_imagen($imagen);
        $url_enlace = $this->upload_imagen($imagen_nueva);
        return $url_enlace;
    }

    public function delete_imagen($imagen)
    {
        $url_imagen = str_replace('?raw=1', '', $imagen);
        $url_imagen = str_replace('https://www.dropbox.com/s/', '', $url_imagen);
        $url_imagen = substr($url_imagen, 16);
        Storage::disk('dropbox')->delete('media/juegos/' . $url_imagen);
    }
}
