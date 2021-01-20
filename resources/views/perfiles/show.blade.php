@extends('layouts.app')



@section('content')
    <a href=" {{ route('perfiles.edit', ['perfil' => Auth::user()->id]) }} " class="btn btn-primary mr-2"> Editar Perfil</a>
    
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if ($perfil->imagen)
                        <img src="/storage/{{$perfil->imagen}}" class="w-100 rounded-circle" alt="mi fotito bb">
                @endif
            </div>
            <div class="col-md-7 mt-5">
                <h1 class="titulo text-center mb-2 text-danger" style="font-weight: 900">{{$perfil->usuario->name}}</h1>
                <h2 style="margin-top: 40px">Un poco sobre mi</h2>
                <div class="biografia">
                    {!!$perfil->biografia!!}
                </div>
                
            </div>
        </div>
    </div>
    <h2 class="subtitulo text-center mt-5">Mis cursos ({{count($cursos) }})</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4 mt-5">
            @if (count($cursos)>0)
                @foreach ($cursos as $curso)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{$curso->imagen}}" alt="imagen del curso" class="card-img-top">

                            <div class="card-body">
                                <h3>{{ $curso->titulo}}</h3>
                                {{-- <a href="" class="btn btn-success d-block mt-4 text-uppercase font-weight-bold">Comprar</a> --}}
                                <h4> {{ $curso->created_at}}</h3>
                                <a href="{{route('cursos.show', ['curso'=>$curso->id]) }}" class="btn btn-dark d-block mt-1 text-uppercase font-weight-bold">Ver curso</a>
                                
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            @else
                    <p class="text-center w-100">El Instructor no tiene cursos...</p>
            @endif            
           
        </div>
    </div>

    {{$cursos}}

@endsection