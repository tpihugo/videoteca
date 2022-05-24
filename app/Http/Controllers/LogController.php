<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::orderBy('fecha_accion', 'desc')->get();
        $vsLogs = $this->cargarDT($logs);

        return view('logs.index')->with('logs',$vsLogs);
    }

    public function cargarDT($query)
    {
        $logs = [];
        foreach($query as $key => $value){
            $logs[$key] = array(

                $value['entidad'],
                $value['accion'],
                $value['descripcion'],
                $value['nombre_usuario'],
                $value['numRegistro_mod'],
                $value['fecha_accion'],



            );
        }

        return $logs;

    }

}
