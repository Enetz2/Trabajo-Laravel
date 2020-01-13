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

    <form action="/homeinci" method="POST">
        @csrf
        Equipo  <input type="text" name="Equipo" class="form-control @error('Equipo') is-invalid @enderror" value="{{ old('Equipo') }}" required autocomplete="Equipo" ><br><br>
        @error('Equipo')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
        @enderror
        Clase  <input type="text" name="Clase" class="form-control @error('Clase') is-invalid @enderror" value="{{ old('Clase') }}" required autocomplete="Equipo" autofocus><br><br>
        @error('Clase')
            <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
            </span>
        @enderror
        Descripcion <select name="Descripcion" onchange="if(this.value=='Otro'){document.getElementById('otro').disabled = false} else {document.getElementById('otro').disabled = true}"><br><br>
            <option value="No se enciende la CPU/ CPU ez da pizten">No se enciende la CPU/ CPU ez da pizten</option>
            <option value="No se enciende la pantalla/Pantaila ez da pizten">No se enciende la pantalla/Pantaila ez da pizten</option>
            <option value="No entra en mi sesión/ ezin sartu nere erabiltzailearekin">No entra en mi sesión/ ezin sartu nere erabiltzailearekin</option>
            <option value="No navega en Internet/ Internet ez dabil">No navega en Internet/ Internet ez dabil</option>
            <option value="No se oye el sonido/ Ez da aditzen">No se oye el sonido/ Ez da aditzen</option>
            <option value="No lee el DVD/CD">No lee el DVD/CD</option>
            <option value="Teclado roto/ Tekladu hondatuta">Teclado roto/ Tekladu hondatuta</option>
            <option value="No funciona el ratón/Xagua ez dabil">No funciona el ratón/Xagua ez dabil</option>
            <option value="Muy lento para entrar en la sesión/oso motel dijoa">Muy lento para entrar en la sesión/oso motel dijoa</option>
            <option value="Otro">Otro</option>
          </select><br><br>
        Otro <input type="text" name="Otro" id="otro" disabled><br><br>
        Comentario  <input type="text" name="Comentario" class="form-control @error('Comentario') is-invalid @enderror" value="{{ old('Comentario') }}" ><br><br>
        <input type="submit" value="Añadir">

    </div>
</div>
</div>
</div>
</div>
@endsection