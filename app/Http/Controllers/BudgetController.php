<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    public function index()
    {   
        return view('budget');
    }
    public function create(Request $request)
    {
        $brink = new Budget;
        $brink->fecha=$request->date;
        $brink->responsable_entrega=$request->entrega;        
        $brink->responsable_recibe=$request->recibe;
        $brink->presupuesto=$request->presupuesto;
        $brink->save();
        return redirect()->back()->with('mensaje', 'Presupuesto ha sido creado exitosamente');
    }
}
