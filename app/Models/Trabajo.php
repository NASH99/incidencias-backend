<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamento;

class Trabajo extends Model
{
    use HasFactory;
    protected $table = 'trabajos';
    protected $primaryKey = 'idTrabajo';
    protected $fillable = ['idDepartamento','descripcion'];


    public function departamento() {
        return $this->belongsTo(Departamento::class, 'idDepartamento');
    }
}
