<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    use HasFactory;
    protected $fillable = ['C_BPartner_ID', 'AD_Org_ID', 'AD_User_ID','LoanAmt','CreatedBy'];

}
