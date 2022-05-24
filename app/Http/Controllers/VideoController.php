<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *https://www.google.com/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // all videos

        // $allVideos = Video::where('activo','1')->get();
        // $vsVideos = $this->cargarDT($allVideos);
        // return view('videos.index')->with('videos',$vsVideos);
    }

    function cargarDT($query){
      $videos = [];
      foreach ($query as $key => $value) {

       $edit =  route('videos.edit', $value['id']);
       $delete =  route('videos.remove', $value['id']);
       $acciones = '';
       $IDs = '';
       if(Auth::check() && Auth::user()->role == 'normal'){
         $IDs = '<strong> '.$value['id'].' </strong>';
         $acciones = '
             <div class="btn-acciones">
                 <div class="btn-circle">
                     <a href="'.$edit.'" class="btn btn-success" title="editar">
                         <i class="far fa-edit"></i>
                     </a>
                 </div>
             </div>

             <div class="btn-acciones">
                 <div class="btn-circle">
                     <a href="'.$delete.'" class="btn btn-danger"  title="Borrar video">
                        <i class="fas fa-eraser"></i>
                     </a>
                 </div>
             </div>
         ';
       }

       if(Auth::check() && Auth::user()->role == 'normal') {
         $videos[$key] = array(
             $acciones,
              // $value['id'],
              $IDs,
              $value['Titulo_Original'],
              $value['Titulo_en_Mexico'],
              $value['Nombre_del_Director'],
              $value['Guion'],
              $value['Actor_Principal'],
              $value['Actriz_Principal'],
              $value['Pais_de_Produccion'],
              $value['Anio_de_Produccion'],
              $value['Duracion_en_Minutos'],
              $value['Genero'],
              $value['Numero_en_Archivo'],
              $value['Formato'],
              $value['Subtitulo'],
              $value['Presentacion'],
              $value['Forma_de_Copiado'],
              $value['Fecha_de_Ingreso'],
          );
       }else{
         $videos[$key] = array(
             $acciones,
             $value['Titulo_Original'],
             $value['Titulo_en_Mexico'],
             $value['Nombre_del_Director'],
             $value['Guion'],
             $value['Actor_Principal'],
             $value['Actriz_Principal'],
             $value['Pais_de_Produccion'],
             $value['Anio_de_Produccion'],
             $value['Duracion_en_Minutos'],
             $value['Genero'],
             $value['Numero_en_Archivo'],
             $value['Formato'],
             $value['Subtitulo'],
             $value['Presentacion'],
             $value['Forma_de_Copiado'],
             $value['Fecha_de_Ingreso'],
          );
       }
      }
      return $videos;
    }

    public function search(Request $request){

       $fieldSelected = $request->input('fieldSelected');
       $search = $request->input('search');
       $videos = '';

       if(isset($search) && !is_null($search) ){

           $validateData = $this->validate($request,[
                  'search'=>'required'
              ]);

              if($fieldSelected != 'id'){
                $videos = Video::where('activo','1')
                   ->where($fieldSelected,'LIKE','%'.$search.'%')
                   ->get();
               }else{
                    $videos = Video::where('activo','1')
                   ->where($fieldSelected,$search)
                   ->get();
               }
       }else if($request->input('Genero')){
            // dd('gender exist');

          $genderSelected = $request->input('Genero');
          $videos = Video::where('activo','1')
              ->where('Genero','LIKE','%'.$genderSelected.'%')
              ->get();
        }
       $vsVideos = $this->cargarDT($videos);
       return view('videos.index')->with('videos',$vsVideos);
    }

    public function deleteVideo($id){
      // dd($id);
      $video = Video::find($id);

      if($video){

        $video->activo = 0;
        $video->update();

        $NewLog =  new Log();
        $NewLog->entidad = 'Videos';
        $NewLog->accion = 'Eliminacion';
        $NewLog->descripcion = 'Eliminacion(logica) de Video';
        $NewLog->nombre_usuario = Auth::user()->name;
        $NewLog->numRegistro_mod = $video->id;
        $NewLog->fecha_accion = date('Y-m-d');
        $NewLog->save();

        return redirect('home')->with(array(
              'message'=> 'Video eliminado completamente'
          ));

      }else {
        return redirect('home')->with(array(
              'message'=> 'No se pudo eliminar el video'
          ));
      }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $this->validate($request,[
              'Titulo_Original'=>'required',
              'Titulo_en_Mexico'=>'required',
              'Nombre_del_Director'=>'required',
              'Guion'=>'required',
              'Actor_Principal'=>'required',
              'Actriz_Principal'=>'required',
              'Pais_de_Produccion'=>'required',
              'Anio_de_Produccion'=>'required',
              'Duracion_en_Minutos'=>'required',
              'Genero'=>'required',
              'Numero_en_Archivo'=>'required',
              'Formato'=>'required',
              'Subtitulo'=>'required',
              'Forma_de_Copiado'=>'required',
              'Fecha_de_Ingreso'=>'required',
          ]);
        $newVideo = new Video;
        $newVideo->activo = 1;
        $newVideo->Titulo_Original = $request->input('Titulo_Original');
        $newVideo->Titulo_en_Mexico = $request->input('Titulo_en_Mexico');
        $newVideo->Nombre_del_Director = $request->input('Nombre_del_Director');
        $newVideo->Guion = $request->input('Guion');
        $newVideo->Actor_Principal = $request->input('Actor_Principal');
        $newVideo->Actriz_Principal = $request->input('Actriz_Principal');
        $newVideo->Pais_de_Produccion = $request->input('Pais_de_Produccion');
        $newVideo->Anio_de_Produccion = $request->input('Anio_de_Produccion');
        $newVideo->Duracion_en_Minutos = $request->input('Duracion_en_Minutos');
        $newVideo->Genero = $request->input('Genero');
        $newVideo->Numero_en_Archivo = $request->input('Numero_en_Archivo');
        $newVideo->Formato = $request->input('Formato');
        $newVideo->Subtitulo = $request->input('Subtitulo');
        $newVideo->Presentacion = $request->input('Presentacion');
        $newVideo->Forma_de_Copiado = $request->input('Forma_de_Copiado');
        // $newVideo->Fecha_de_Ingreso = $request->input('Fecha_de_Ingreso');
        $d = strtotime( $request->input('Fecha_de_Ingreso'));
        $newVideo->Fecha_de_Ingreso = date("d/m/Y", $d);
        $newVideo->Password = '-';
        $newVideo->save();

        $NewLog =  new Log();
        $NewLog->entidad = 'Videos';
        $NewLog->accion = 'Captura';
        $NewLog->descripcion = 'Nueva captura de video';
        $NewLog->nombre_usuario = Auth::user()->name;
        $NewLog->numRegistro_mod = $newVideo->id;
        $NewLog->fecha_accion = date('Y-m-d');
        // $NewLog->fecha_accion = Carbon::now()->format("Y-m-d H:m");
        // dd($NewLog->fecha_accion);
        $NewLog->save();

        return redirect()->route('home')->with('message', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('videos.edit')->with('video', $video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        // dd('inside update method');
        $video->Titulo_Original = $request->input('Titulo_Original');
        $video->Titulo_en_Mexico = $request->input('Titulo_en_Mexico');
        $video->Nombre_del_Director = $request->input('Nombre_del_Director');
        $video->Guion = $request->input('Guion');
        $video->Actor_Principal = $request->input('Actor_Principal');
        $video->Actriz_Principal = $request->input('Actriz_Principal');
        $video->Pais_de_Produccion = $request->input('Pais_de_Produccion');
        $video->Anio_de_Produccion = $request->input('Anio_de_Produccion');
        $video->Duracion_en_Minutos = $request->input('Duracion_en_Minutos');
        $video->Genero = $request->input('Genero');
        $video->Numero_en_Archivo = $request->input('Numero_en_Archivo');
        $video->Formato = $request->input('Formato');
        $video->Subtitulo = $request->input('Subtitulo');
        $video->Presentacion = $request->input('Presentacion');
        $video->Forma_de_Copiado = $request->input('Forma_de_Copiado');
        // $newVideo->Fecha_de_Ingreso = $request->input('Fecha_de_Ingreso');
        $d = strtotime( $request->input('Fecha_de_Ingreso'));
        $video->Fecha_de_Ingreso = date("d/m/Y", $d);
        $video->Password = '-';
        $video->update();

        $NewLog =  new Log();
        $NewLog->entidad = 'Videos';
        $NewLog->accion = 'Edicion';
        $NewLog->descripcion = 'Modificacion de video existente';
        $NewLog->nombre_usuario = Auth::user()->name;
        $NewLog->numRegistro_mod = $video->id;
        $NewLog->fecha_accion = date('Y-m-d');
        $NewLog->save();

        return redirect()->route('home')->with('message', 'Registro actualizado correctamente!');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */

     public function removeVideo($id)
     {
        $videoSelected = Video::find($id);

        if($videoSelected){
            $videoSelected->activo = 0;
            $videoSelected->update();

            $NewLog =  new Log();
            $NewLog->entidad = 'Videos';
            $NewLog->accion = 'Eliminacion';
            $NewLog->descripcion = 'Eliminacion de video existente';
            $NewLog->nombre_usuario = Auth::user()->name;
            $NewLog->numRegistro_mod = $videoSelected->id;
            $NewLog->fecha_accion = date('Y-m-d');
            $NewLog->save();



            return redirect()->route('home')->with('message', 'Registro eliminado correctamente!');
        }else
            return redirect()->route('home')->with('message', 'No se pudo eliminar, Registro no encontrado!');
     }


    public function destroy(Video $video)
    {
        //
    }
}
