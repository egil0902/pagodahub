<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presupuestoBank;

class PresupuestoBankController extends Controller
{
    public function index()
    {   
        return view('pBank');
    }
    public function create(Request $request)
    {
        $brink = new presupuestoBank;
        $brink->fecha=$request->date;
        $brink->monto=$request->presupuesto;
        $brink->save();
        return redirect()->back()->with('mensaje', 'Presupuesto ha sido creado exitosamente');
    }
}
