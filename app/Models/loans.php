<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'Nombre',
        'Cedula',
        'Telefono',
        'Solicitante',
        'Direccion',
        'FotoCedula',
        'FechaNuevoPrestamo',
        'Monto',
        'Cuota',
        'Frecuencia',
        'Filecedula',
        'FirmaNuevoPrestamo'
    ];
}
