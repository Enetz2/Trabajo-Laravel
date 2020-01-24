@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Incidencia</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

    <form action="/edit/{{$datos[0]->id}}" method="POST">
        @csrf
        @foreach ($datos as $dato)
        Equipo  <input type="text" name="Equipo" value="{{$dato->equipo}}">
        <br><br>
        Clase  <input type="text" name="Clase" value="{{$dato->clase}}">
        <br><br>
        Descripcion <select name="Descripcion" onchange="if(this.value=='9'){document.getElementById('otro').disabled = false} else {document.getElementById('otro').disabled = true}">
            <option value="0">No se enciende la CPU/ CPU ez da pizten</option>
            <option value="1">No se enciende la pantalla/Pantaila ez da pizten</option>
            <option value="2">No entra en mi sesión/ ezin sartu nere erabiltzailearekin</option>
            <option value="3">No navega en Internet/ Internet ez dabil</option>
            <option value="4">No se oye el sonido/ Ez da aditzen</option>
            <option value="5">No lee el DVD/CD</option>
            <option value="6">Teclado roto/ Tekladu hondatuta</option>
            <option value="7">No funciona el ratón/Xagua ez dabil</option>
            <option value="8">Muy lento para entrar en la sesión/oso motel dijoa</option>
            <option value="9">Otro</option>
          </select><br><br>
        Otro <input type="text" name="Otro" id="otro" disabled><br><br>
        Comentario  <input type="text" name="Comentario" value="{{$dato->comentario}}"><br><br>
        @endforeach
        <input type="submit" value="Añadir">
        @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
        @endif

    </div>
</div>
</div>
</div>
</div>
@endsection