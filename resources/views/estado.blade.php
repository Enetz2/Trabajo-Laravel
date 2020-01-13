@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Estado</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/estado/{{$datos[0]->id}}" method="POST">
                        @csrf
                    <select name="Select">
                        <option value="En proceso">En proceso</option>
                        <option value="Detenido">Detenido</option>
                        <option value="Finalizado">Finalizado</option>
                        <option value="Revisando">Revisando</option>
                      </select>
                      <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection