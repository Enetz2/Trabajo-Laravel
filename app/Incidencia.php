<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Incidencia extends Model

    {
        use Notifiable;
        //Para unir dos tablas con el foreing key
        public function Incendia(){
            return $this->hasOne("App/Profesor");
        }
        protected $fillable = [
            'id','id_profesor', 'comentario', 'estado', 'clase','equipo','descripcion','created_at',
        ];
    }
