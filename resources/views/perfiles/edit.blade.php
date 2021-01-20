@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href=" {{ route('perfiles.show', ['perfil' => Auth::user()->id]) }} " class="btn btn-outline-danger mr-20"> Volver</a>
@endsection


@section('content')

    <h1 class="titulo text-center">Editar mi Perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">

            <form method="POST" enctype="multipart/form-data" action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}">

                @csrf
                @method('PUT')

                <div class="form-group">
                    @if ($perfil->imagen)
                        <div class="mt-4">
                            <p>Foto actual</p>
                            <img src="/storage/{{$perfil->imagen}}" alt="" style="width: 200px; border-radius:150px">
                        </div>


                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong> {{$message}} </strong>
                            </span>
                        @enderror
                    @endif
                    <label for="imagen">Cambiar foto de perfil</label>
                    <input id="imagen" type="file" class="form-control" name="imagen">

                    
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>

                    <input type="text"
                        name ="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        placeholder="Tu nombre"
                        value="{{$perfil->usuario->name}}"
                    >   

                    @error('nombre')   
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}">
                    <trix-editor 
                        class="form-control @error('biografia') is-invalid @enderror "
                        input="biografia">
                    </trix-editor>

                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Actualizar Perfil">
                </div>
                
            </form>
        </div>
    </div>
    

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" 
    integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" 
    crossorigin="anonymous"defer ></script>
@endsection