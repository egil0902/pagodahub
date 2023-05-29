<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\marketshopping;
use DB;
use PDF;
class FactureController extends Controller
{
    public function index()
    {
        $facturas = Facture::all(); // Obtener todos los facturas de la tabla
        return view('facture', compact('facturas')); // Pasar los facturas a la vista
    }

    public function store(Request $request)
    {
        // Buscar si existe un registro con el mismo número de factura
        $existingFacture = Facture::where('id_compra', $request->NFactura)->first();
        if ($existingFacture) {
            // Si se encuentra un registro con el mismo número de factura, devuelve un mensaje de error
            $request->session()->flash('mensaje', 'El numero de factura ya existe');
            $day = $request->fecha_registro;
            $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
            return view('marketinvoice', compact('comprasdeldia'));
        }
        //dd($request);
        $registro = new Facture();
        $registro->id_compra = $request->NFactura;
        $registro->fecha = $request->fecha_registro;
        $registro->proveedor = $request->proveedor;
        $registro->monto_abonado = $request->abono;
        $registro->medio_de_pago = $request->metodo;
        $registro->total =$request->pfinal;
        $registro->diferencia =$request->diff;
        $registro->Total_compra =$request->pfinal;
        $registro->Factured_quantity =json_encode($request->differenceFactura);
        $registro->price =json_encode($request->price);
        
        if (!empty($request->archivosimg) && is_array($request->archivosimg) && count($request->archivosimg) > 0) {
            $registro->file = $request->archivosimg[0];
        }
        $registro->total = $request->sumdifac;
        
        $updateMarket = marketshopping::where('id', $request->id)->first();
        $updateMarket->id_compra = $request->NFactura;
        $updateMarket->save();
        
        // Asignar los valores del formulario a las propiedades del modelo
        $registro->save(); // Guardar el nuevo registro en la base de datos
        return redirect()->route('marketinvoice')->with('refresh', true);
        //return redirect()->route('tabla.index')->with('success', 'Registro creado exitosamente'); // Redirigir a la vista principal con un mensaje de éxito
    }

    
    public function searchByProvider(Request $request)
    {
        $providerName = $request->input('provider');
        $query = Facture::query();
        if (!empty($providerName)) {
            $query->where('proveedor', $providerName);
        }
        $facturas = $query->get();
        
        return view('factureFilter', compact('facturas'))->with('ok',true);
    }

    public function getAllCredit(Request $request)
    {
        //RECORDATORIO QUE TODOS LOS CREDITOS ESTAN EN LA DB CON VALOR 1
        $facturas = Facture::where('medio_de_pago', 1)->get();
        
        return view('factureFilter', compact('facturas'))->with('refresh', true);
    }
    public function borrar($id)
    {
        // Buscar la factura por su ID y eliminarla directamente
        $facture = Facture::find($id);

        if (!$facture) {
            return redirect()->back()->with('error', 'La factura no existe');
        }

        $facture->delete();

        return redirect()->back()->with('success', 'La factura ha sido borrada exitosamente');
    }

    public function show($id)
    {
        // Buscar la factura por su ID 
        $factura = Facture::find($id);
        $comprasdeldia = DB::table('marketshoppings')
            ->join('factures', 'factures.id_compra', '=', 'marketshoppings.id_compra')
            ->where('factures.id_compra', $factura->id_compra)
            ->get();
        if (!$comprasdeldia) {
            return redirect()->back()->with('error', 'La factura no existe');
        }
        //dd($comprasdeldia);
        return view('editmarketinvoice', compact('comprasdeldia'));
    }

    public function downloadPdf(Request $request)
    {
        /*   $pdf= PDF::loadHTML('<h1>Test</h1>'); */
        $idCompras = $request->input('factura_ids');
        $idCompras = explode(',', $idCompras);
        
        
        $resultados = DB::table('marketshoppings')
            ->join('factures', 'factures.id_compra', '=', 'marketshoppings.id_compra')
            ->whereIn('factures.id_compra', $idCompras)
            ->get();
        $pdf = PDF::loadView('download-pdf_compras', ['resultados' => $resultados]);
        
        return $pdf->download("factura".".pdf");
    }

    public function update(Request $request, $id)
    {
        // Obtener el registro existente de la base de datos
        $registro = Facture::findOrFail($id);

        // Actualizar los valores del registro con los datos del formulario
        $registro->id_compra = $request->NFactura;
        $registro->fecha = $request->fecha_registro;
        $registro->proveedor = $request->proveedor;
        $registro->monto_abonado = $request->abono;
        $registro->medio_de_pago = $request->metodo;
        $registro->total = $request->pfinal;
        $registro->diferencia = $request->diff;
        $registro->Total_compra = $request->pfinal;
        $registro->Factured_quantity = json_encode($request->differenceFactura);
        $registro->price = json_encode($request->price);

        if (!empty($request->archivosimg) && is_array($request->archivosimg) && count($request->archivosimg) > 0) {
            $registro->file = $request->archivosimg[0];
        }
        $registro->total = $request->sumdifac;

        $registro->save(); // Guardar los cambios en la base de datos

        // Actualizar el registro relacionado en la tabla marketshopping
        $updateMarket = marketshopping::where('id', $request->id)->first();
        $updateMarket->id_compra = $request->NFactura;
        $updateMarket->save();

        $facturas = Facture::all(); // Obtener todos los facturas de la tabla
        return view('facture', compact('facturas')); // Pasar los facturas a la vista
    }

}
