<?php

namespace App\Http\Controllers;

use App\Profesor;
use Illuminate\Http\Request;
use Mail;
use Auth;
use App\Incidencia;

class EmailController extends Controller

{
    //Enviar un correo de que se ha añadido una nueva incidencia
    public function añadir(Request $request){
        $subject = "Has creado una incidencia";
        $usuario= Auth::user()->email;
        $email="escobillasmanolo@gmail.com";
        $for = $usuario;
        Mail::send('email',$request->all(), function($msj) use($subject,$for){
            $msj->from("escobillasmanolo@gmail.com","Incidencias");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect('/home');
    }
    //Enviar un correo de que se ha modificado una incidencia
    public function modificacion(Request $request,$id){
        $numero = $id;
        $subject = "Ha habido una modificancion en la incidencia $numero";
        $usuario= "ik012108bhn@plaiaundi.net";
        $email="escobillasmanolo@gmail.com";
        $for = $usuario;
        Mail::send('emaileditar',$request->all(), function($msj) use($subject,$for){
            $msj->from("escobillasmanolo@gmail.com","Incidencias");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect('/home');
    }
    //Enviar un correo de que se ha modificado el estado de la incidencia
    public function estado(Request $request,$id){
        $numero = $id;
        $subject = "Se ha cambiado el estado en la incidencia $numero";
        $idprofesor=Incidencia::select('id_profesor')->where('id', $numero)->get();
        $emailusuario=Profesor::select('email')->where('id', $idprofesor)->get();
        $usuario= "ik012108bhn@plaiaundi.net";
        $email="escobillasmanolo@gmail.com";
        $for = $usuario;
        Mail::send('emailestado',$request->all(), function($msj) use($subject,$for){
            $msj->from("escobillasmanolo@gmail.com","Incidencias");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect('/homeadmin');
    }
}