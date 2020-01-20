@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-8">
          

                   
                    <table>
                        <tr>
                            <th >Numero de incidencia</th>
                            <th >Equipo</th>
                            <th >Clase</th>
                            <th >Descripcion</th>
                            <th >Comentario</th>
                            <th>Estado</th>
                            <th>Hora/Fecha</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                        @foreach ($datos as $dato)
                        @if($dato->estado=="Finalizado")
                        <tr style="background-color:#4FD32E">
                        @elseif($dato->estado=="Detenido")
                        <tr style="background-color:#E53E1D">
                        @else
                        <tr>
                        @endif
                            <td>{{$dato->id}}</td>
                            <td>{{$dato->equipo}}</td> 
                            <td>{{$dato->clase}}</td> 
                            <td>{{$dato->descripcion}}</td> 
                            <td>{{$dato->comentario}}</td> 
                            <td>{{$dato->estado}}</td>
                            <td>{{$dato->created_at}}</td>
                            <td><a href="/edit/{{$dato->id}}"><button>Modificar</button></a></td>
                            <td><a href="/eliminar/{{$dato->id}}"><button>Eliminar</button></a></td>
                        </tr>
                        @endforeach
                        </table>
                        <br>

            <br>
            <a href="{{ route('nueva_incidencia') }}"><img src="https://cdn.pixabay.com/photo/2013/07/12/17/44/file-152331_960_720.png" width="40px"> Añadir una nueva incidencia</a>

        
    </div>
</div>
@endsection
