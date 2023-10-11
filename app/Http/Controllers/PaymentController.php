<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;
        session()->put('misDatos', $orgs);
    }
    public function index()
    {   
        return view('payment');
    }
    public function create(Request $request)
    {
        $brink = new Payment;
        $brink->fecha=$request->date;
        $brink->monto=$request->monto;        
        $brink->foto=$request->foto;
        $brink->observaciones=$request->observaciones;        
        $brink->save();
        return redirect()->back()->with('mensaje', 'Pago de factura ha sido creado exitosamente');
    }
}
