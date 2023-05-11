<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';

    protected $fillable = [
        'id_compra',
        'fecha',
        'proveedor',
        'monto_abonado',
        'medio_de_pago',
        'file',
        'total',
    ];
}