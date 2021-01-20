<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obteniendo recetas con paginacion en la vista de perfil de usuario
        $cursos = Curso::where('user_id', $perfil->user_id)->paginate(20);
        //Usando, modelo de receta

        //
        return view('perfiles.show', compact('perfil','cursos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
        $this->authorize('view', $perfil);

        return view('perfiles.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Ejecutar Policy
        $this->authorize('update', $perfil);
        

        // Validar
        $data = request()->validate([
            'nombre' => 'required',
            'biografia' => 'required'
        ]);

        // Si el usuario sube una imagen
        if($request['imagen']){
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

            // Resize de la imagen mediante  intervention image
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //crear un arreglo
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        //Asignar nombre y URL
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();


        //Eliminar name de $data
        unset($data['nombre']);


        //Guardar informacion
        //Asignar Biografia e imagen
        auth()->user()->perfil()->update( array_merge(
            $data,
            $array_imagen ?? []
        ));


        //redireccionar
        return redirect()->action('CursoController@index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
