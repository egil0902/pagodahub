<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Card;

class InvoiceController extends Controller
{
    public function index()
    {   
        $tarjetas = Card::all();
        return view('invoice',['tarjetas'=>$tarjetas]);
    }
    public function list()
    {   
        $Invoice = Invoice::all();
        return view('invoiceList');
    }
    public function create(Request $request)
    {
        $brink = new Invoice;
        $brink->fecha_ingreso=$request->fecha_ingreso;
        $brink->fecha_pago=$request->fecha_pago;        
        $brink->proveedor=$request->proveedor;
        $brink->monto_total=$request->monto_total;
        $brink->monto_impuesto=$request->monto_impuesto;
        $brink->foto=$request->foto;//revisar
        $brink->responsable_ingreso=$request->responsable_ingreso;
        $brink->responsable_pago=$request->responsable_pago;
        $brink->forma_pago=$request->forma_pago;
        if($request->forma_pago==='credito'){
            $brink->forma_pago= $request->forma_pago.' '.$request->credito_options;
            $brink->banco=$request->banco_credito;
            $brink->comprobante=$request->num_comprobante_credito;
        }
        if($request->forma_pago==='banco'){
            $brink->forma_pago= $request->forma_pago.' '.$request->banco_options;
            if($request->banco_options==='cheque'){                
                $brink->banco=$request->banco_banco;
                $brink->comprobante=$request->num_comprobante;
            }
        }
        $brink->fecha_pago=$request->fecha_pago;
        if($request->forma_pago==='tarjeta_credito'){
            $brink->tarjeta=$request->tarjeta;
        }
        $brink->save();
        return redirect()->back()->with('mensaje', 'Factura ha sido creada exitosamente');
    }
}
