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
        $productos = $request->product;
        $cantidadRecibida =$request->differenceFactura;
        $precio = $request->price;
        $unidadMedida =$request->unit;
        $cantidadFact =$request->quantity;
        $contador=0;
        for ($i=0; $i <= count($cantidadRecibida); $i++) { 
            if(isset($cantidadRecibida[$i]) &&$cantidadRecibida[$i]==0){
                array_splice($productos, $i, 1);
                array_splice($cantidadRecibida, $i, 1);
                array_splice($precio, $i, 1);
                array_splice($unidadMedida, $i, 1);
                array_splice($cantidadFact, $i, 1);
                $i--;
            }
        }
        $registro = new Facture();
        $registro->id_compra = $request->NFactura;
        $registro->fecha = $request->fecha_registro;
        $registro->proveedor = $request->proveedor;
        $registro->monto_abonado = $request->abono;
        $registro->medio_de_pago = $request->metodo;
        $registro->diferencia =$request->diff;
        $registro->Total_compra =$request->sumdifac;
        //$registro->vuelto =$registro->vuelto;
        $registro->vuelto=$request->pfinal;
        if($request->pfinal>=0){
            $registro->pagada=true;
        }else{
            $registro->pagada=false;
        }
        $registro->carton = $request->cart;
        $registro->Factured_quantity =json_encode($cantidadRecibida);
        $registro->price =json_encode($precio);
        $registro->product = json_encode($productos);
        $registro->units = json_encode($unidadMedida);
        
        if (!empty($request->archivosimg) && is_array($request->archivosimg) && count($request->archivosimg) > 0) {
            $registro->file = $request->archivosimg[0];
        }
        $registro->total = $request->sumdifac;
        $updateMarket = new marketshopping;
        $updateMarket->id_compra = $request->NFactura;
        $updateMarket->shoppingday = $request->input('fecha_registro');
        $updateMarket->buyer = $request->input('comprador');
        $updateMarket->budget = $request->input('Presupuesto');
        $updateMarket->product = json_encode($productos);
        $updateMarket->unit = json_encode($unidadMedida);
        $updateMarket->quantity = json_encode($cantidadRecibida);

        $updateMarket->save();
        $updateCarton = Facture::where('fecha', $registro->fecha)->get();
        if($updateCarton->count()>0){
            foreach ($updateCarton as $carton) {
                $carton->carton= $request->cart;
                $carton->save();
            }
        }
        
        // Asignar los valores del formulario a las propiedades del modelo
        $registro->save(); // Guardar el nuevo registro en la base de datos
        
        $comprasdeldia = marketshopping::where('shoppingday', $registro->fecha)->where('id_compra',null)->get();
        $presupuesto=0;
        if($comprasdeldia->count() > 0) {
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->pfinal;
                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->abono;
                }
            }
            
        }
        //return view('marketinvoice', compact('comprasdeldia','presupuesto'));
        return redirect()->back()->with('success', 'Registro creado exitosamente'); // Redirigir a la vista principal con un mensaje de éxito
    }

    
    public function searchByProvider(Request $request)
    {
        $providerName = $request->input('provider');
        $query = Facture::query();
        if (!empty($providerName)) {
            $query->where('proveedor', $providerName)->where('pagada', false);
        }
        $facturas = $query->get();
        
        return view('factureFilter', compact('facturas'))->with('ok',true);
    }

    public function getAllCredit(Request $request)
    {
        //RECORDATORIO QUE TODOS LOS CREDITOS ESTAN EN LA DB CON VALOR 1
        $facturas = Facture::where('pagada', false)->get();
        
        return view('factureFilter', compact('facturas'))->with('refresh', true);
    }
    public function borrar($id)
    {
        // Buscar la factura por su ID y eliminarla directamente
        $facture = facture::where('id_compra', $id)->delete();
        if (!$facture) {
            return redirect()->back()->with('error', 'La factura no existe');
        }

       
        $market = marketshopping::where('id_compra', $id)->delete();

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
    public function pagar(Request $request)
    {
        /*   $pdf= PDF::loadHTML('<h1>Test</h1>'); */
        $idCompras = $request->input('facturas_ids');
        $idCompras = explode(',', $idCompras);
        
        
        for ($i=0; $i < count($idCompras); $i++) { 
            
            $factura = Facture::where('id_compra', $idCompras[$i])->first();
            $factura->pagada=true;
            $factura->save();
        }
        $facturas = Facture::all(); // Obtener todos los facturas de la tabla
        return view('facture', compact('facturas')); // Pasar los facturas a la vista
    }

    public function update(Request $request, $id)
    {
        $updateCarton = Facture::where('fecha', $request->fecha_registro)->get();
        if($updateCarton->count()>0){
            foreach ($updateCarton as $carton) {
                if($carton->carton!= $request->carton){
                    
                    $carton->carton= $request->carton;
                    $carton->save();
                }
            }
        }
        // Obtener el registro existente de la base de datos
        $registro = Facture::findOrFail($id);
        $updateMarket = marketshopping::where('id_compra', $registro->id_compra)->first();
        $registro->id_compra = $request->NFactura;
        // Actualizar los valores del registro con los datos del formulario
        
        $registro->id_compra = $request->NFactura;
        $registro->fecha = $request->fecha_registro;
        $registro->proveedor = $request->proveedor;
        $registro->monto_abonado = $request->abono;
        $registro->medio_de_pago = $request->metodo;
        $registro->diferencia =$request->diff;
        $registro->Total_compra =$request->pfinal;
        
        //$registro->vuelto =$registro->vuelto;
        $registro->vuelto=$request->pfinal;
        $registro->carton = $request->carton;
        $registro->Factured_quantity =json_encode($request->differenceFactura);
        $registro->price =json_encode($request->price);

        if (!empty($request->archivosimg) && is_array($request->archivosimg) && count($request->archivosimg) > 0) {
            $registro->file = $request->archivosimg[0];
        }
        $registro->total = $request->sumdifac;


        // Actualizar el registro relacionado en la tabla marketshopping
        $updateMarket->id_compra = $request->NFactura;
        $updateMarket->save();
        
        $registro->save(); // Guardar los cambios en la base de datos

        
        $facturas = Facture::all(); // Obtener todos los facturas de la tabla
        return view('facture', compact('facturas')); // Pasar los facturas a la vista
    }

}
