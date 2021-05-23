<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Base extends Model
{
    public function sluggable($string)
    {
        return Str::slug($string);
    }

    public function findById($id) {
        $value = self::where('id', $id)->first();
        if($value == null) {
            return ['error' => 'No encontrado'];
        }
        return $value;
    }

    public function findBySlug($slug) {
        $value = self::where('slug', $slug)->first();
        if($value == null) {
            return ['error' => 'No encontrado'];
        }
        return $value;
    }

    public function findByNombre($nombre) {

        if (DB::getDriverName() === 'pgsql') {
            $like = 'ilike';
        } else {
            $like = 'like';
        }

        $value = self::where('nombre', $like, '%' . $nombre . '%')->first();
        if($value == null) {
            return ['error' => 'No encontrado'];
        }
        return $value;
    }
}
