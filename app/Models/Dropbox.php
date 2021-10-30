<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FacadesFile;

class Dropbox extends Model
{

    public function upload_imagen($imagen)
    {

        $image_64 = $imagen; //base64 encoded data
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        //buscar subcadena para reemplazar aquí, por ejemplo: data:image/png;base64,
        $imagen = str_replace($replace, '', $image_64);
        $imagen = str_replace(' ', '+', $imagen);
        $imagen = base64_decode($imagen);
        $filename = "eliminar." . $extension;
        file_put_contents($filename, $imagen);

        // this just to help us get file info.
        $tmpFile = new File($filename);

        $imagen = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        $ruta_enlace = Storage::disk('dropbox')->put('/media/juegos', $imagen);

        $dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();

        $response_enlace = $dropbox->createSharedLinkWithSettings($ruta_enlace, ["requested_visibility" => "public"]);

        $url_enlace = str_replace('dl=0', 'raw=1', $response_enlace['url']);

        FacadesFile::delete($filename);

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
