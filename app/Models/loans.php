<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'fechanuevoprestamo',
        'monto',
        'cuota',
        'frecuencia',
        'filecedula',
        'firmanuevoprestamo',
        'estado',
        'cedula_user'
    ];
}
