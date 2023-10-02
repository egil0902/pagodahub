<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function index()
    {   
        return view('tdc');
    }
    public function create(Request $request)
    {
        
        $card = new Card;
        $card->numero=$request->numero;
        $card->descripcion=$request->entrega;
        $card->save();
        return redirect()->back()->with('mensaje', 'Tarjeta ha sido creado exitosamente');
    }
}
