<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trabajo;
use App\Models\Detalle;

class Incidencia extends Model
{
    use HasFactory;
    protected $table = 'incidencias';
    protected $primaryKey = 'idIncidencia';
    protected $fillable = ['estado','fecha','idTecnico','idTrabajo','idSolicitante','comentario'];

    public function trabajo(){
        return $this->belongsTo(Trabajo::class,'idTrabajo');
    }

    public function detalles() {
        return $this->hasMany(Detalle::class, 'idIncidencia');
    }
}
