@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:900px">
                <div class="card-header">Lista de incidencias</div>

                <div class="card-body"style="width:150px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
                        <tr>
                            <th style="border:1px solid black">Id Profesor</th>
                            <th style="border:1px solid black">Numero de incidencia</th>
                            <th style="border:1px solid black">Equipo</th>
                            <th style="border:1px solid black">Clase</th>
                            <th style="border:1px solid black">Descripcion</th>
                            <th style="border:1px solid black">Comentario</th>
                            <th style="border:1px solid black">Estado</th>
                            <th style="border:1px solid black">Hora/Fecha</th>
                            <th style="border:1px solid black">Cambiar</th>
                            <th style="border:1px solid black">Añadir Comentario</th>
                        </tr>
                        @foreach ($datos as $dato)
                        @if($dato->estado=="Finalizado")
                        <tr style="background-color:#4FD32E">
                        @elseif($dato->estado=="Detenido")
                        <tr style="background-color:#E53E1D">
                        @else
                        <tr>
                        @endif
                            <td style="border:1px solid black">{{$dato->id_profesor}}</td>
                            <td style="border:1px solid black">{{$dato->id}}</td>
                            <td style="border:1px solid black">{{$dato->equipo}}</td> 
                            <td style="border:1px solid black">{{$dato->clase}}</td> 
                            <td style="border:1px solid black">{{$dato->descripcion}}</td> 
                            <td style="border:1px solid black">{{$dato->comentario}}</td> 
                            <td style="border:1px solid black">{{$dato->estado}}</td>
                            <td style="border:1px solid black">{{$dato->created_at}}</td>
                            <td style="border:1px solid black"><a href="/estado/{{$dato->id}}"><button>Cambiar Estado</button></a></td>
                            <td style="border:1px solid black"><a href="/comentario/{{$dato->id}}"><button>Añadir comentario</button></a></td>
                           </tr>
                        @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection