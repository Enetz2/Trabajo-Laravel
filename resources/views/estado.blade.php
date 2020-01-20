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
                    <select name="Estado">
                        <option value="0">En proceso</option>
                        <option value="1">Detenido</option>
                        <option value="2">Finalizado</option>
                        <option value="3">Revisando</option>
                      </select>
                      @error('Estado')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection