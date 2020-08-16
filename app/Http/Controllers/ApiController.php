<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAll(){
        $juegos = Api::orderBy('id', 'DESC')->get();
        return $juegos;
      }

      public function getPaginate($num){
        $juegos = Api::paginate($num);
        return $juegos;
      }
  
      public function add(Request $request){
          $juego = Api::create($request->all());
          return $juego;
      }
  
      public function get($id) {
          $juego = Api::find($id);
          return $juego;
      }
  
      public function edit($id, Request $request) {
          $juego = $this->get($id);
          $juego->fill($request->all())->save();
          return $juego;
      }
  
      public function delete($id) {
          $juego = $this->get($id);
          $juego->delete();
          return $juego;
      }
}
