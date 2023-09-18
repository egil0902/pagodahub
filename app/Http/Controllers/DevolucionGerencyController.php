<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevolucionGerency;

class DevolucionGerencyController extends Controller
{
    public function index()
    {   
        return view('devolucionGerency');
    }
    public function create(Request $request)
    {
        
        $brink = new DevolucionGerency;
        $brink->fecha=$request->date;
        $brink->responsable_entrega=$request->entrega;        
        $brink->responsable_recibe=$request->recibe;
        $brink->devolucion=$request->devolucion;
        $brink->save();
        return redirect()->back()->with('mensaje', 'Registro ha sido creado exitosamente');
    }
}
