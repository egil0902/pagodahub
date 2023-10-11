<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\closecash;
use App\Models\User;
use FontLib\Table\Type\name;
use Illuminate\Database\Console\DumpCommand;
use Laravel\Ui\Presets\React;
use PDF;

class test extends Controller
{
    public function test()
    {
        $users = DB::table('users')->get();
    }
}
