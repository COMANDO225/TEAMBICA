<?php

namespace App\Http\Controllers;

use App\CategoriaCurso;
use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Return_;

class CursoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->cursos->dd();

        $usuario = auth()->user()->id;

        //Paginacion para los cursos
        $cursos = Curso::where('user_id', $usuario)->paginate(5);
        //Con modelos podemos tener acceso al paginate

        return view('cursos.index')
            ->with('cursos', $cursos);
            // ->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // DB::table('categoria_curso')->get()->pluck('nombre', 'id')->dd();
        //obtener categoria sin modelo
        // $categorias = DB::table('categoria_curso')->get()->pluck('nombre', 'id');

        //con modelo
        $categorias = CategoriaCurso::all(['id','nombre']);

        return view('cursos.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd( $request['imagen']->store('upload-cursos','public'));

        //validación
        $data = $request->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required',
            'contenido' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required'
        ]);
        
        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-cursos','public');

        // Resize de la imagen mediante  intervention image
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();



        //guardando cursos sin modelo
        // DB::table('cursos')->insert([
        //     'titulo' => $data['titulo'],
        //     'descripcion' => $data['descripcion'],
        //     'contenido' => $data['contenido'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']
        // ]);

        //Almacenar a una base de datos con modelo
        
        auth()->user()->cursos()->create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'contenido' => $data['contenido'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']
        ]);




        //Redireccionar
        return redirect()->action('CursoController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {

        //con modelo
        $categorias = CategoriaCurso::all(['id','nombre']);

        //
        return view('cursos.edit' , compact('categorias', 'curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {

        //Revisar que se cumpla la policy
        $this->authorize('update', $curso);

        //validación
        $data = $request->validate([
            'titulo' => 'required|min:3',
            'descripcion' => 'required',
            'contenido' => 'required',
            'categoria' => 'required'
        ]);

        //Asignando valores
        $curso->titulo = $data['titulo'];
        $curso->descripcion = $data['descripcion'];
        $curso->contenido = $data['contenido'];
        $curso->categoria_id = $data['categoria'];

        

        //Si el usuario sube una nueva imagen
        if(request('imagen')){
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-cursos','public');

            // Resize de la imagen mediante  intervention image
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //Asignar al objeto
            $curso->imagen = $ruta_imagen;
        }
        
        $curso->save();

        return redirect()->action('CursoController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        //Ejecutar Policy
        $this->authorize('delete', $curso);

        //Eliminar el curso
        $curso->delete();
        return redirect()->action('CursoController@index');
    }
}
