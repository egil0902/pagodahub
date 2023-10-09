<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Card;
use App\Models\presupuestoBank;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;

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
        if($request->forma_pago&&isset($request->presupuest_banco)){
            $presupuesto= presupuestoBank::where('fecha',$request->fecha_pago)->sum('monto');
            $invoice = Invoice::where('fecha_pago',$request->fecha_pago)->where('forma_pago',$request->forma_pago.' '.$request->credito_options)->sum('presupuest_banco');;
            if(($invoice+$request->presupuest_banco)>$presupuesto){
                return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                'ya que el monto puesto($'.$request->presupuest_banco.') es superior a lo que queda en caja ($'.($presupuesto-$invoice).')');
            }
        }

        $brink = new Invoice;
        $brink->fecha_ingreso=$request->fecha_ingreso;
        $brink->fecha_pago=$request->fecha_pago;        
        $brink->proveedor=$request->proveedor;
        
        $brink->monto_impuesto = number_format($request->monto_total * ($request->impuesto_select / 100), 2, '.', '');
        $brink->foto=$request->foto;//revisar
        $brink->responsable_ingreso=$request->responsable_ingreso;
        $brink->responsable_pago=$request->responsable_ingreso;
        $brink->forma_pago=$request->forma_pago;
        if(isset($request->monto_total)){
            $brink->monto_total=$request->monto_total;
        }
        if(isset($request->monto_7)){
            $brink->monto_7=$request->monto_7;
            $brink->monto_impuesto_7=$request->monto_7*0.07;
        }
        if(isset($request->monto_10)){
            $brink->monto_10=$request->monto_10;
            $brink->monto_impuesto_10=$request->monto_10*0.1;
        }
        if(isset($request->monto_15)){
            $brink->monto_15=$request->monto_15;
            $brink->monto_impuesto_15=$request->monto_15*0.15;
        }
        $brink->monto_impuesto=$brink->monto_7+$brink->monto_10+$brink->monto_15;
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
            if($request->banco_options==='efectivo'){
                $brink->presupuest_banco=$request->presupuest_banco;
            }
        }
        $brink->fecha_pago=$request->fecha_pago;
        if($request->forma_pago==='tarjeta_credito'){
            $brink->tarjeta=$request->tarjeta;
        }
        $brink->save();
        return redirect()->back()->with('mensaje', 'Factura ha sido creada exitosamente');
    }
    public function getExcel(Request $request) {
        $lista = json_decode($request->input('lista'), true);

        return Excel::download(new InvoiceExport($lista["data"]), 'facturas.xlsx');
    }
    
}
