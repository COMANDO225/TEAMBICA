@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('content')
    <div class="background"></div>
    <div class="container nuevos cursos">
        <h2 class="titulo titulo-categoria text-uppercase mb-4">Cursos Nuevos </h2>
    </div>

    <div class="owl-carousel owl-theme">
        @foreach ($nuevas as $nueva)
                <div class="card " style="border-radius: 12px; overflow: hidden">
                    <img src="/storage/{{ $nueva->imagen}}" class="card-img-top" alt="imagen cuso">
                    <div class="card-body" style="padding: 1rem !important;">
                        <h3 class="titulo" style="font-weight: 600; font-size: 1.4rem">{{$nueva->titulo}}</h3>
                        
                        <a href="" style="padding: 15px 0px; margin: 0px !important;" class="btn btn-danger d-block font-weight-bold text-uppercase">Ver Curso</a>
                    </div>
                </div>
        @endforeach
    </div>

    @foreach($cursos as $cat => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{ str_replace('-', ' ',$cat)}}</h2>

            <div class="row">
                @foreach ($grupo as $cursos)
                    @foreach ($cursos as $curso)
                        <div class="col-md-4 mt-4">
                            <div class="cardcurso card">
                                <img src="/storage/{{$curso->imagen}}" alt="curso-imagen" class="card-img-top">
                                <div class="card-body">
                                    <h3 class="titulo card-title">
                                        {{$curso->titulo}}
                                    </h3>

                                    <div class="meta-curso d-flex justify-content-between">
                                        <p>
                                            @php
                                                $fecha = $curso->created_at
                                            @endphp
                            
                                            <fecha-curso fecha="{{$fecha}}" ></fecha-curso>   
                                        </p>
                                        <span class="font-weight-bold text-danger" style="font-size: 25px; font-weight:900!important">$9.99</span>
    
                                    </div>
                                    <div class="botonver">
                                        <a href="{{ route('cursos.show', ['curso' => $curso->id])}}" style="padding: 15px 0px; margin: 0px !important;" class="btn btn-danger d-block font-weight-bold text-uppercase">Ver Curso</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                @endforeach
            </div>
        </div>
    @endforeach

@endsection

