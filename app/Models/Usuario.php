<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    protected $fillable = ['nombreUsuario','nombre','apellido','correo','clave','fono','idCargo','idDepartamento'];
}
