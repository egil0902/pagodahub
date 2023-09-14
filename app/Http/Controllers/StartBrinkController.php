<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StartBrink;

class StartBrinkController extends Controller
{
    public function index()
    {   
        return view('startBrink');
    }
    public function create(Request $request)
    {
        
        $brink = new StartBrink;
        $brink->fecha=$request->date;
        $brink->responsable_entrega=$request->entrega;        
        $brink->responsable_recibe=$request->recibe;
        $brink->devolucion=$request->devolucion;
        $brink->presupuesto=$request->presupuesto;        
        $brink->save();
        return redirect()->back()->with('mensaje', 'Presupuesto ha sido creado exitosamente');
    }
}
