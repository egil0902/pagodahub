<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValesPagoda extends Model
{
    use HasFactory;
    protected $fillable = ['value', 'name', 'taxid','CreatedBy','AD_Org_ID'];

}
