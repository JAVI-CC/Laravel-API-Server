<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getAll() {
        $juegos = Api::orderBy('id', 'DESC')->select(DB::raw('md5(id) AS uid'), 'nombre', 'descripcion', 'desarrolladora', 'fecha')->get();
        return $juegos;
      }
  
      public function add(Request $request){
          $juego = Api::create($request->all());
          return $juego;
      }
  
      public function get($id) {
          $juego = Api::where(DB::raw('md5(id)'), $id)->select(DB::raw('md5(id) AS uid'), 'nombre', 'descripcion', 'desarrolladora', 'fecha')->first();
          return $juego;
      }
  
      public function edit($id, Request $request) {
          $juego = Api::where(DB::raw('md5(id)'), $id)->update($request->all());
          return $juego;
      }
  
      public function delete($id) {
          $juego = Api::where(DB::raw('md5(id)'), $id)->delete();
          return $juego;
      }
}
