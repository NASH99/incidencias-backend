<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trabajo;

class Departamento extends Model
{
    use HasFactory;
    protected $table ='departamentos';
    protected $primaryKey = 'idDepartamento';
    protected $fillable = ['nombre'];

    public function trabajos(){
        return $this->hasMany(Trabajo::class,'idDepartamento');
    }
}

