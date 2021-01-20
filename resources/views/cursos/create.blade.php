@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href=" {{ route('cursos.index') }} " class="btn btn-primary mr-2"> Volver con tu ex</a>
@endsection

@section('content')
    <h2 class="titulo text-center mb-5">Crear nuevo curso</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('cursos.store') }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo Curso</label>

                    <input type="text"
                        name ="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titulo"
                        placeholder="Titulo del Curso"
                        value="{{old('titulo')}}"
                        
                        >   

                        @error('titulo')
                            
                            <span class="invalid-feedback d-block" role="alert">
                                <strong> {{$message}} </strong>
                            </span>


                        @enderror
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoria</label>

                    <select name="categoria" class="form-control " id="categoria">
                        <option value=""> -- Seleccione una categoria, papasito --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{old('categoria') == $categoria->id ? 'selected' : ''}}   > {{$categoria->nombre}} </option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>

                    <input id="descripcion" type="hidden" name="descripcion" value="{{old ('descripcion')}}">

                    <trix-editor 
                        class="form-control @error('descripcion') is-invalid @enderror "
                        input="descripcion">
                    </trix-editor>
                    @error('descripcion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido del Curso</label>

                    <input id="contenido" type="hidden" name="contenido" value="{{old ('contenido')}}">

                    <trix-editor
                        class="form-control @error('contenido') is-invalid @enderror "
                        input="contenido">
                    </trix-editor>
                    @error('contenido')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="imagen">Elige una imagen</label>
                    <input id="imagen" type="file" class="form-control" name="imagen">
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                    @enderror
                </div>
                

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Curso">
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