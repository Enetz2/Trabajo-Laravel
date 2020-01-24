<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Expeciton;
use Illuminate\Support\Facades\Schema;
use App\Profesor;
use App\Incidencia;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     //Funcion para enviar los datos de la incidencia que hemos seleccionado a la vista del home
    public function homeadmin()
    {
        $inciusuario = Incidencia::select('id','id_profesor','equipo','clase','descripcion','comentario','estado','created_at')->get();
        return view('homeadmin',['datos'=>$inciusuario]);
    }
    //Funcion para enviar los datos de la incidencia que hemos seleccionado a la vista de estado
    public function estado($id)
    {
        $estado = Incidencia::select('id')->where('id',$id)->get();
        return view('estado',['datos'=>$estado]);
    }
     //Funcion para enviar los datos de la incidencia que hemos seleccionado a la vista de comentario
    public function comentario($id)
    {
        $estado = Incidencia::select('id')->where('id',$id)->get();
        return view('comentario',['datos'=>$estado]);
    }
     //Funcion para modificar el comentario
    public function añadircomentario(Request $request,$id)
    {
        $datos= Incidencia::find($id);
        $datos->comentario=$request['Comentario'];
        $datos->update();
        return redirect("/homeadmin");
    }
     //Funcion para modificar el estado de la incidencia y enviar un correo
    public function añadirestado(Request $request,$id)
    {
        $validardatos= $request->validate([
            'Estado' => 'required | integer| between:0,3',
         ] ,[
             'required' => 'El campo :attribute es obligatorio.',
             'integer' => 'El:attribute tiene que ser numerico',
             'between' =>'El:attribute tiene que ser del 0 al 3',
             ]);
        $lista=['En proceso','Detenido','Finalizado','Revisando'];
        $datos= Incidencia::find($id);
        $datos->estado=$lista[$request['Estado']];
        $datos->update();
        return redirect("/correoestado/$id");
    }

}