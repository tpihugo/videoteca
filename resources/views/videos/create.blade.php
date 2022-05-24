@extends('layouts.app')

@section('content')

<div class="container-fluid">

      @if (session('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif
            <form action="{{route('videos.store')}}" method="post" enctype="multipart/form-data" class="col-12">
                @csrf
                <div class="row">
                    <div class="col">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>

                        </div>
                        <br>

                        <div class="row g-3 align-items-center">

                        <p class="h3">Nota: Colocar un "-" en caso de no requerir un campo</p>

                            <div class="col-md-4">
                                <label for="Titulo_Original">Título Original</label>
                                <input type="text" class="form-control" id="Titulo_Original" name="Titulo_Original" value="{{old('Titulo_Original')}}"  >
                            </div>
                            <div class="col-md-4">
                                <label for="Titulo_en_Mexico">Título en Mexico</label>
                                <input type="text" class="form-control" id="Titulo_en_Mexico" name="Titulo_en_Mexico" value="{{old('Titulo_en_Mexico')}}"  >
                            </div>

                            <div class="col-md-4">
                                <label for="Nombre_del_Director">Director </label>
                                <input type="text" class="form-control" id="Nombre_del_Director" name="Nombre_del_Director" value="{{old('Nombre_del_Director')}}"  >
                            </div>
                        </div>

                        <div class="row g-3 align-items-center">


                            <div class="col-md-4">
                                <label for="Guion">Guión</label>
                                <input type="text" class="form-control" id="Guion" name="Guion" value="{{old('Guion')}}"  >
                            </div>

                            <div class="col-md-4">
                                <label for="Actor_Principal">Actor principal</label>
                                <input type="text" class="form-control" id="Actor_Principal" name="Actor_Principal" value="{{old('Actor_Principal')}}" >
                            </div>

                            <div class="col-md-4">
                                <label for="Actriz_Principal">Actriz principal</label>
                                <input type="text" class="form-control" id="Actriz_Principal" name="Actriz_Principal" value="{{old('Actriz_Principal')}}"  >
                            </div>
                      </div>

                      <div class="row g-3 align-items-center">

                          <div class="col-md-4">
                              <label for="Pais_de_Produccion">País de producción</label>
                              <input type="text" class="form-control" id="Pais_de_Produccion" name="Pais_de_Produccion" value="{{old('Pais_de_Produccion')}}"  >
                          </div>

                          <div class="col-md-4">
                              <label for="Anio_de_Produccion">Año de producción</label>
                              <input type="text" class="form-control" id="Anio_de_Produccion" name="Anio_de_Produccion" value="{{old('Anio_de_Produccion')}}"  >
                          </div>

                          <div class="col-md-4">
                              <label for="Duracion_en_Minutos">Duracción en minutos</label>
                              <input type="number" class="form-control" id="Duracion_en_Minutos" name="Duracion_en_Minutos" value="{{old('Duracion_en_Minutos')}}"  >
                          </div>
                    </div>

                    <div class="row g-3 align-items-center">

                        <div class="col-md-4">
                            <label for="Genero">Género</label>
                            <input type="text" class="form-control" id="Genero" name="Genero" value="{{old('Genero')}}"   >
                        </div>

                        <div class="col-md-4">
                            <label for="Numero_en_Archivo">Número en archivo</label>
                            <input type="number" class="form-control" id="Numero_en_Archivo" name="Numero_en_Archivo" value="{{old('Numero_en_Archivo')}}"    >
                        </div>

                        <div class="col-md-4">
                            <label for="Formato">Formato</label>
                            <input type="text" class="form-control" id="Formato" name="Formato" value="{{old('Formato')}}"  >
                        </div>

                  </div>

                  <div class="row g-3 align-items-center">

                        <div class="col-md-4">
                            <label for="Subtitulo">Subtítulo</label>
                            <input type="text" class="form-control" id="Subtitulo" name="Subtitulo"  value="{{old('Subtitulo')}}"  >
                        </div>

                        <div class="col-md-4">
                            <label for="Presentacion">Presentación</label>
                            <input type="text" class="form-control" id="Presentacion" name="Presentacion"  value="{{old('Presentacion')}}" >
                        </div>

                        <div class="col-md-4">
                            <label for="Forma_de_Copiado">Forma de Copiado</label>
                            <input type="text" class="form-control" id="Forma_de_Copiado" name="Forma_de_Copiado"  value="{{old('Forma_de_Copiado')}}" >
                        </div>
                  </div>

                  <div class="row g-3 align-items-center">

                      <div class="col-md-4">
                          <label for="Fecha_de_Ingreso">Fecha de Ingreso</label>
                          <input type="date" class="form-control" id="Fecha_de_Ingreso" name="Fecha_de_Ingreso" value="{{old('Fecha_de_Ingreso')}}" >
                      </div>

                  </div>

                  <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                        {{-- @if(Auth::Check())
                            <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancelar</a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                        @endif --}}
                                <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
                                <button type="submit" class="btn btn-success">Guardar datos</button>
                        </div>
                    </div>
              </form>

  </div>





@endsection
