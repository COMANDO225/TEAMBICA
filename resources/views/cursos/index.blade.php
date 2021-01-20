@extends('layouts.app')

@section('botones')
    <a href=" {{ route('cursos.create') }} " class="btn btn-primary mr-2"> Crear Curso</a>
    {{-- <a href=" {{ route('perfiles.edit', ['perfil' => Auth::user()->id]) }} " class="btn btn-primary mr-2"> Editar Perfil</a>
    <a href=" {{ route('perfiles.show', ['perfil' => Auth::user()->id]) }} " class="btn btn-primary mr-2"> Ver Perfil</a> --}}
@endsection

@section('content')
    <h2 class="titulo text-center mb-5">Administra tus Cursos</h2>

    <div class="col-md-10 mx-auto bg-white p-3" style="border-radius: 10px; outline: none">
        <table class="table table-hover ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($cursos as $curso)
                    <tr>
                        <td style="font-size: 20px"> {{$curso->titulo}} </td>
                        <td style="font-size: 20px"> {{$curso->categoria->nombre}} </td>
                        <td >
                            <a href="/cursos/{{$curso->id}}" class="btn btn-success d-block mb-1">Ver</a>
                            <a href="/cursos/{{$curso->id}}/edit" class="btn btn-dark d-block mb-1">Editar</a>
                            
                            <eliminar-curso
                                curso-id={{$curso->id}}
                            ></eliminar-curso>

                        {{-- <form action=" {{route('cursos.destroy', ['curso' => $curso->id ])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger d-block w-100" value="Eliminar &times;">
                        </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-12 mt-2 d-flex justify-content-between">
            {{ $cursos->links() }}
        </div>
        


    </div>

@endsection
