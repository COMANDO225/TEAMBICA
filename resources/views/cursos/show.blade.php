@extends('layouts.app')

@section('content')
    {{-- <h1> {{$curso}} </h1> --}}
    <article class="contenido-curso bg-white p-4">
        <h1 class="titulo text-center mb-4"> {{$curso->titulo}} </h1>

        <div class="imagen-curso">
            <img src="/storage/{{$curso->imagen}}" class="w-100">
        </div>

        <div class="mt-4 curso-meta">
            <p>
                <span class="font-weight-bold text-danger">Categoria:  </span>
                {{$curso->categoria->nombre}}
            </p>

            <p>
                <span class="font-weight-bold text-danger">Creado por: </span>
                {{$curso->autor->name}}
            </p>

            <p>
                <span class="font-weight-bold text-danger">Publicado el: </span>
                
                @php
                    $fecha = $curso->created_at
                @endphp

                <fecha-curso fecha="{{$fecha}}" ></fecha-curso>

            </p>


            <div class="descripcion">
                <h2 class="my-3 text-danger">Descripción</h2>

                {!! $curso->descripcion !!}
            </div>

            <div class="contenido">
                <h2 class="my-3 text-danger">Contenido del Curso</h2>

                {!! $curso->contenido !!}
            </div>

            <a href="{{ url('/paypal/pay')}}" class="d-block btn btn-success mr-2" style="font-size: 30px; font-weight: bolder; padding: 20px 0px">COMPRAR CURSO</a>



        </div>
        
    </article>
@endsection