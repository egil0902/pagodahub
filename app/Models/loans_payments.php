<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans_payments extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'datepayment',
        'amount',
        'loans_id',
        'loans_users_id',
        'file',
        'signature'
    ];
}
