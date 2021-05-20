<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public function sluggable($string)
    {
        $slug = substr($string, 0, 140);
        $slug = strtr($slug, " _ÀÁÂÃÄÅÆàáâãäåæÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñÞßÿý",  "--aaaaaaaaaaaaaaoooooooooooooeeeeeeeeecceiiiiiiiiuuuuuuuunntsyy");
        $slug = strtolower($slug);
        $slug = preg_replace("/[^a-z0-9\-.]/", "", $slug);
        return str_replace("--", "-", $slug);
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
}
