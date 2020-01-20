@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                    <table>
                        <tr>
                            <th>Id Profesor</th>
                            <th>Numero de incidencia</th>
                            <th>Equipo</th>
                            <th>Clase</th>
                            <th>Descripcion</th>
                            <th>Comentario</th>
                            <th>Estado</th>
                            <th>Hora/Fecha</th>
                            <th>Cambiar</th>
                            <th>Añadir Comentario</th>
                        </tr>
                        @foreach ($datos as $dato)
                        @if($dato->estado=="Finalizado")
                        <tr style="background-color:#4FD32E">
                        @elseif($dato->estado=="Detenido")
                        <tr style="background-color:#E53E1D">
                        @else
                        <tr>
                        @endif
                            <td>{{$dato->id_profesor}}</td>
                            <td>{{$dato->id}}</td>
                            <td>{{$dato->equipo}}</td> 
                            <td>{{$dato->clase}}</td> 
                            <td>{{$dato->descripcion}}</td> 
                            <td>{{$dato->comentario}}</td> 
                            <td>{{$dato->estado}}</td>
                            <td>{{$dato->created_at}}</td>
                            <td><a href="/estado/{{$dato->id}}"><button>Cambiar Estado</button></a></td>
                            <td><a href="/comentario/{{$dato->id}}"><button>Añadir comentario</button></a></td>
                           </tr>
                        @endforeach
                        </table>
    </div>
</div>
@endsection