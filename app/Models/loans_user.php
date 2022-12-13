<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans_user extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'nombre',
        'cedula',
        'telefono',
        'solicitante',
        'direccion',
        'fotocedula',
        'montototal'
    ];
}
