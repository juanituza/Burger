<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion; //include_once "app/Entidades/Sistema/Menu.php";
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPostulacion extends Controller
{
    public function nuevo()
    {
        $titulo = "Nueva Postulacion";
        return view('postulacion.postulacion-nuevo', compact('titulo'));
            
    }
}
