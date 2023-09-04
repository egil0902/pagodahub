<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestGerency;

class RequestGerencyController extends Controller
{
    public function index()
    {
        return view('requestGerency');
    }
    public function store(Request $request)
    {
        $brink= new RequestGerency;
        $brink->fecha = $request->date;
        $brink->monto = $request->Monto;
        $brink->observaciones=$request->observaciones;
        $brink->foto=$request->foto;
        $brink->save();
        return view('requestGerency')->with('mensaje', 'Brink ha sido guardado exitosamente');
    }
}
