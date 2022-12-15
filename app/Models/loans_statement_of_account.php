<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans_statement_of_account extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'loans_users_id',
        'datetrx',
        'id',
        'created_at',
        'updated_at',
        'monto',
        'cedula',
        'nombre'
    ];
}
