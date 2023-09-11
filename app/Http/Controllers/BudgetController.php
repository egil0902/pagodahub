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
        if($request->numero&& $request->numero>0){

            $cheques=[];
            for ($i = 1; $i <= $request->numero; $i++) {
                $cheques[$i]="N°: ".$request->input("n_cheque_".$i)." Banco: ".$request->input("banco_".$i);
            }
            $brink->cheques=Json_encode($cheques);
        }
        $brink->save();
        return redirect()->back()->with('mensaje', 'Presupuesto ha sido creado exitosamente');
    }
}
