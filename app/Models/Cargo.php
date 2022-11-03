<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $table = 'cargos';
    protected $primaryKey = 'idCargo';
    protected $fillable = ['cargo','jefatura'];
    protected $casts = ['jefatura'=> 'boolean'];
}
