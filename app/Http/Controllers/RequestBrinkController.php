<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestBrink;

class RequestBrinkController extends Controller
{
    public function index()
    {
        return view('requestBrink');
    }

    public function store(Request $request)
    {
        $brink= new RequestBrink;
        $brink->fecha =$request->date;
        $brink->billete_1=$request->x_sistema1;
        $brink->billete_5=$request->x_sistema2;
        $brink->billete_10=$request->x_sistema3;
        $brink->billete_20=$request->x_sistema4;
        //rollos hace referencia a los rollos de 0.50        
        $brink->rollos_01=$request->x_sistema5;
        $brink->rollos_05=$request->x_sistema6;        
        $brink->rollos_10=$request->x_sistema7;
        $brink->rollos_25=$request->x_sistema8;
        $brink->rollos_50=$request->x_sistema9;
        $brink->total=$request->BrinkresultColumn;
        $brink->observaciones=$request->observaciones;
        $brink->foto=$request->foto;
        

        $brink->save();
        return view('requestBrink')->with('mensaje', 'Brink ha sido guardado exitosamente');
    }
}
