<?php

namespace App\Http\Controllers;

use App\Curso;
use App\CategoriaCurso;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //Obtener los cursos mas nuevos
        $nuevas = Curso::latest()->take(5)->get();

        // Obtener todas las categorias
        $categorias = CategoriaCurso::all();

        // return $categorias;
        
        //Agrupar lOS CURSOS por categoria
        $cursos = [];

        foreach($categorias as $categoria){
            $cursos [ Str::slug($categoria->nombre)] [] = Curso::where('categoria_id', $categoria->id)->take(3)->get();
        }
        // return $cursos;

        return view('inicio.index', compact('nuevas', 'cursos'));
    }
}
