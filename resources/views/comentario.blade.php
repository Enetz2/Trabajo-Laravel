@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comentario</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center>
    <form action="/comentario/{{$datos[0]->id}}" method="POST">
        @csrf
        Comentario  <input type="text" name="Comentario"><br><br>
        <input type="submit" value="Añadir">

    </center>
    </div>
</div>
</div>
</div>
</div>
@endsection