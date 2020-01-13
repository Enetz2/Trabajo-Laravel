<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Expeciton;
use Illuminate\Support\Facades\Schema;
use App\Profesor;
use App\Incidencia;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
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

      //Funcion para añadir una nueva incidencia a la base de datos
    public function añadirincidencia(Request $request){
        $validardatos= $request->validate([
           'Equipo' => 'required | string | max:8 | min:8 | regex:/[HZ]\d{6}$/',
           'Clase' => 'required | max:3 | min:3',
           'Descripcion' => 'required',
        ]);
        $newUser = Incidencia::create([
            'id_profesor' => Auth::user()->id,
            'equipo' => $request['Equipo'],
            'clase'=> $request['Clase'],
            'descripcion'=>$request['Descripcion'],
            'otro'=>$request['Otro'],
            'comentario'=>$request['Comentario'],
            'estado'=>'En proceso',
        ]);
        return redirect('/homeinci');
    }
     //Funcion para eliminar la incidencia seleccionada
    public function eliminar($id){
        Incidencia::find($id)->delete();
        return redirect("/home");
    }
     //Funcion para enviar los datos de la incidencia que hemos seleccionado a la vista de editar
    public function editar($id){
        $inciusuario = Incidencia::select('id','id_profesor','equipo','clase','descripcion','comentario','estado')->where('id', $id)->get();
        return view('editar',['datos'=>$inciusuario]);
    }
     //Funcion para modificar los datos de la incidencia y enviar un correo
    public function upgrade(Request $request,$id){
        $validardatos= $request->validate([
            'Equipo' => 'required | string | max:8 | min:8 | regex:/(HZ)\d{6}$/',
            'Clase' => 'required | max:3 | min:3',
            'Descripcion' => 'required',
         ]);
        $datos= Incidencia::find($id);
        $datos->equipo = $request['Equipo'];
        $datos->clase= $request['Clase'];
        $datos->descripcion=$request['Descripcion'];
        $datos->otro=$request['Otro'];
        $datos->comentario=$request['Comentario'];
        $datos->update();
        return redirect("/correomodifi/$id");
    }
     //Funcion para enviar los datos de la incidencia que hemos seleccionado a la vista del home
    public function index()
    {
        $id=Auth::user()->id;
        $inciusuario = Incidencia::select('id','id_profesor','equipo','clase','descripcion','comentario','estado','created_at')->where('id_profesor', $id)->get();
        return view('home',['datos'=>$inciusuario]);
    }
}
