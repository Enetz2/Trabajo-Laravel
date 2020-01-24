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

class ProfeController extends Controller
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
           'Clase' => 'required | integer|between:100,999',
           'Descripcion' => 'required| numeric',
           
        ] ,[
            'required' => 'El campo :attribute es obligatorio.',
            'Clase.min' => 'La :attribute tiene m que tener 3 numeros',
            'Clase.max' => 'La :attribute tiene M que tener 3 numeros',
            'Equipo.min' => 'El :attribute tiene que ser HZ y 6 numeros',
            'Equipo.max' => 'El :attribute tiene que ser HZ y 6 numeros',
            'Equipo.regex' => 'El :attribute tiene que ser HZ y 6 numeros',
            'Descripcion.max' => 'El :attribute tiene que ser del 0 al 9',
            'Descripcion.min' => 'El :attribute tiene que ser del 0 al 9',
            'numeric' => 'El:attribute tiene que ser numerico',
            ]);
        $lista=["No se enciende la CPU/ CPU ez da pizten","No se enciende la pantalla/Pantaila ez da pizten",
        "No entra en mi sesión/ ezin sartu nere erabiltzailearekin"
        ,"No navega en Internet/ Internet ez dabil"
        ,"No se oye el sonido/ Ez da aditzen"
        ,"No lee el DVD/CD"
        ,"Teclado roto/ Tekladu hondatuta"
        ,"No funciona el ratón/Xagua ez dabil"
        ,"Muy lento para entrar en la sesión/oso motel dijoa"
        ,"Otro"];
        if($lista[$request['Descripcion']]!=9){
            $otro="";
        }else{
            $otro=$request['Otro'];
        }
        $newUser = Incidencia::create([
            'id_profesor' => Auth::user()->id,
            'equipo' => $request['Equipo'],
            'clase'=> $request['Clase'],
            'descripcion'=>$lista[$request['Descripcion']],
            'otro'=>$otro,
            'comentario'=>$request['Comentario'],
            'estado'=>'En proceso',
        ]);
        return redirect('/homeinci');
    }
     //Funcion para eliminar la incidencia seleccionada
    public function eliminar($id){
        $post = Incidencia::find($id);   
        $this->authorize('eliminar', $post);
        Incidencia::find($id)->delete();
        return redirect("/home");
    }
     //Funcion para enviar los datos de la incidencia que hemos seleccionado a la vista de editar
    public function editar($id){
        $post = Incidencia::find($id);   
        $this->authorize('editar', $post);
        $inciusuario = Incidencia::select('id','id_profesor','equipo','clase','descripcion','comentario','estado')->where('id', $id)->get();
        return view('editar',['datos'=>$inciusuario]);
    }
     //Funcion para modificar los datos de la incidencia y enviar un correo
    public function upgrade(Request $request,$id){
        $post = Incidencia::find($id);   
        $this->authorize('editar', $post);
        $validardatos= $request->validate([
           'Equipo' => 'required | string | max:8 | min:8 | regex:/[HZ]\d{6}$/',
           'Clase' => 'required | integer|between:100,999',
           'Descripcion' => 'required| numeric',
        ] ,[
            'required' => 'El campo :attribute es obligatorio.',
            'Clase.min' => 'La :attribute tiene que tener 3 numeros',
            'Clase.max' => 'La :attribute tiene que tener 3 numeros',
            'Equipo.min' => 'El :attribute tiene que ser HZ y 6 numeros',
            'Equipo.max' => 'El :attribute tiene que ser HZ y 6 numeros',
            'Descripcion.max' => 'El :attribute tiene que ser del 0 al 9',
            'Descripcion.min' => 'El :attribute tiene que ser del 0 al 9',
            'Equipo.regex' => 'El :attribute tiene que ser HZ y 6 numeros',
            'numeric' => 'El:attribute tiene que ser numerico',
            'integer' => 'El:attribute tiene que ser numerico',
            'between' => 'El :attribute tiene que tener 3 numeros',
            ]);

        $lista=["No se enciende la CPU/ CPU ez da pizten","No se enciende la pantalla/Pantaila ez da pizten",
        "No entra en mi sesión/ ezin sartu nere erabiltzailearekin"
        ,"No navega en Internet/ Internet ez dabil"
        ,"No se oye el sonido/ Ez da aditzen"
        ,"No lee el DVD/CD"
        ,"Teclado roto/ Tekladu hondatuta"
        ,"No funciona el ratón/Xagua ez dabil"
        ,"Muy lento para entrar en la sesión/oso motel dijoa"
        ,"Otro"];

        if($lista[$request['Descripcion']]!=9){
            $otro="";
        }else{
            $otro=$request['Otro'];
        }
        $datos= Incidencia::find($id);
        $datos->equipo = $request['Equipo'];
        $datos->clase= $request['Clase'];
        $datos->descripcion=$lista[$request['Descripcion']];
        $datos->otro=$otro;
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
