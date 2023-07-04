<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\marketshopping;
use App\Models\Cheque;
use DB;
use PDF;
class FactureController extends Controller
{
    public function index()
    {
        $facturas = Facture::orderBy('fecha', 'desc')->get(); // Obtener todos los facturas de la tabla
        $day = date('Y-m-d'); // Obtener la fecha actual
        $presupuesto = "no asignado para el dia";
        $calculo = marketshopping::where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $comprasdeldia = Facture::where('fecha', $day)->get();
            
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;

                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    if($presupuesto == "no asignado para el dia"){
                        $presupuesto=0;
                    }
                    $presupuesto-=$check->monto;
                }
        }
        return view('facture', compact('facturas', 'presupuesto')); // Pasar los facturas a la vista
    }


    public function store(Request $request)
    {
        
        // Buscar si existe un registro con el mismo número de factura
        $existingFacture = Facture::where('id_compra', $request->NFactura)->first();
        if ($existingFacture) {
            // Si se encuentra un registro con el mismo número de factura, devuelve un mensaje de error
            $request->session()->flash('mensaje', 'El numero de factura '.$request->NFactura.' ya existe');
            
            return redirect()->back();
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
        $registro->pagada=false;
        $registro->fecha_pago="Sin pagar";
        if($request->metodo==="true"){
            $registro->pagada=true;
            $registro->fecha_pago="No aplica";
        }
        if (isset($request->cart) && strpos($request->cart, ':') !== false) {
            $valorDespuesDeDosPuntos = substr($request->cart, strpos($request->cart, ':') + 1);
            $request->cart = trim($valorDespuesDeDosPuntos); // Elimina posibles espacios en blanco antes o después del valor
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
        
        $presupuesto=0;
        $comprasdeldia = marketshopping::where('shoppingday', $request->input('fecha_registro'))->orderBy('created_at', 'asc')->get();
        if($comprasdeldia->count() > 0) {
            $presupuesto=$comprasdeldia[0]->budget;
        }
        if ($comprasdeldia->count() > 1) {
            $presupuesto = $comprasdeldia[0]->budget;
            $productos = json_decode($comprasdeldia[0]->product);
            $quantity = json_decode($comprasdeldia[0]->quantity);
        
            for ($i = 1; $i < $comprasdeldia->count(); $i++) {
                $Fproductos = json_decode($comprasdeldia[$i]->product);
                $Fquantity = json_decode($comprasdeldia[$i]->quantity);
        
                // Comparar los elementos de los arreglos y restar las cantidades correspondientes
                foreach ($productos as $posicion => $producto) {
                    if (in_array($producto, $Fproductos)) {
                        $fPosicion = array_search($producto, $Fproductos);
                        $quantity[$posicion] -= $Fquantity[$fPosicion];
                    }
                }
            }
        
            $comprasdeldia[0]->quantity = json_encode($quantity);
        }
        
        $facturas = Facture::where('fecha', $request->input('fecha_registro'))->get();
        $carton =0;
        if($facturas->count() > 0) {
            foreach ($facturas as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;
                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
                
                if($factura->carton>0){
                    $carton =$factura->carton;
                }
                
            }
        }
        foreach ($comprasdeldia as $posicion => $compra) {
            foreach ($facturas as $posicion_diferente => $factura) {
                if ($compra->id_compra === $factura->id_compra) {
                    $comprasdeldia[$posicion]->factura = $factura;
                }
            }
        }
        $cheques = Cheque::where('fecha',$request->input('fecha_registro'))->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        
        return view('marketinvoice', compact('comprasdeldia','presupuesto'));
        //return redirect()->back()->with('success', 'Registro creado exitosamente'); // Redirigir a la vista principal con un mensaje de éxito
    }

    
    public function searchByProvider(Request $request)
    {
        $providerName = $request->input('provider');
        $query = Facture::query();
        if (!empty($providerName)) {
            $query->whereRaw("LOWER(REPLACE(proveedor, ' ', '')) LIKE '%' || LOWER(REPLACE(?, ' ', '')) || '%'", [$providerName])
                ->where('pagada', false);
        }else{
            $query->where('pagada', false);
        }
        $facturas = $query->get();

        $day = date('Y-m-d'); // Obtener la fecha actual
        $presupuesto = "no asignado para el dia";
        $calculo = marketshopping::where('shoppingday', $day)->where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $comprasdeldia = Facture::where('fecha', $day)->get();
            
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;

                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        
        return view('factureFilter', compact('facturas','presupuesto','providerName'))->with('ok',true);
    }

    public function getAllCredit(Request $request)
    {
        //RECORDATORIO QUE TODOS LOS CREDITOS ESTAN EN LA DB CON VALOR 1
        $facturas = Facture::where('pagada', false)->get();
        $day = date('Y-m-d'); // Obtener la fecha actual
        $presupuesto = "no asignado para el dia";
        $calculo = marketshopping::where('shoppingday', $day)->where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $comprasdeldia = Facture::where('fecha', $day)->get();
            
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;

                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    if($presupuesto == "no asignado para el dia"){
                        $presupuesto=0;
                    }
                    $presupuesto-=$check->monto;
                }
        }
        $providerName="";
        return view('factureFilter', compact('facturas','presupuesto','providerName'))->with('refresh', true);
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
    public function eliminar(Request $request)
    {   
        // Buscar la factura por su ID y eliminarla directamente
        $facture = facture::where('id', $request->id)->first();
        $market = marketshopping::where('id_compra', $facture ->id_compra)->delete();
        $facture->delete();
        
        if (!$facture) {
            return redirect()->back()->with('error', 'La factura no existe');
        }

       

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
        $day =$comprasdeldia[0]->shoppingday; // Obtener la fecha actual
        $presupuesto = "no asignado para el dia";
        $calculo = marketshopping::where('shoppingday', $day)->where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $compras = Facture::where('fecha', $day)->get();
            
            foreach ($compras as $fact) {
                if($fact->medio_de_pago){
                    $presupuesto-=$fact->total;

                }
                if(!$fact->medio_de_pago){
                    $presupuesto-=$fact->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        if (!$comprasdeldia) {
            return redirect()->back()->with('error', 'La factura no existe');
        }
        $presupuesto+=$comprasdeldia[0]->total;
        return view('editmarketinvoice', compact('comprasdeldia','presupuesto'));
    }

    public function downloadPdf(Request $request)
    {
        $idCompras = $request->input('factura_ids');
        $idCompras = explode(',', $idCompras);
        $resultados = DB::table('marketshoppings')
            ->join('factures', 'factures.id_compra', '=', 'marketshoppings.id_compra')
            ->whereIn('factures.id_compra', $idCompras)
            ->get();
        
        $pdf = PDF::loadView('download-pdf_compras', ['resultados' => $resultados]);
        $idCompras = $request->input('facturas_ids');
        $idCompras = explode(',', $idCompras);
        $pagoPresupuesto=false;
        if($request->pagoPresupuesto){
            $pagoPresupuesto=$request->pagoPresupuesto;
        }
        $monto=0;
        if($request->monto){
            //pago parcial
            $monto=$request->monto;
        }
        
        if (count($idCompras)>0) {
            for ($i=0; $i < count($idCompras); $i++) { 
                $factura = Facture::where('id_compra', $idCompras[$i])->first();
                
                if($monto===0){
                    $factura->monto_abonado=($factura->total-$factura->monto_abonado);
                }
                if($monto!==0){
                    $factura->monto_abonado+=$monto;
                    
                }
                if($factura->monto_abonado>=$factura->total){
                    $factura->pagada=true;
                    $factura->fecha_pago=date('Y-m-d');
                }

                $factura->save();
                
                $cheque = Cheque::create([
                    'fecha' => date('Y-m-d'),
                    'id_factura' => $factura->id_compra,
                    'pago_presupuesto' => $pagoPresupuesto,
                    'monto' => $monto,
                ]);
            }
            # code...
        }
    $providerName = $request->input('provider');
        $query = Facture::query();
        if (!empty($providerName)) {
            $query->whereRaw("LOWER(REPLACE(proveedor, ' ', '')) LIKE '%' || LOWER(REPLACE(?, ' ', '')) || '%'", [$providerName])
                ->where('pagada', false);
        }else{
            $query->where('pagada', false);
        }
        $facturas = $query->get();

        $day = date('Y-m-d'); // Obtener la fecha actual
        $presupuesto = "no asignado para el dia";
        $calculo = marketshopping::where('shoppingday', $day)->where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $comprasdeldia = Facture::where('fecha', $day)->get();
            
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;

                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    if($presupuesto == "no asignado para el dia"){
                        $presupuesto=0;
                    }
                    $presupuesto-=$check->monto;
                }
        }
        return $pdf->download("factura".".pdf");
    }
    public function pagar(Request $request)
    {
        $idCompras = $request->input('facturas_ids');
        $idCompras = explode(',', $idCompras);
        $pagoPresupuesto=false;
        if($request->pagoPresupuesto){
            $pagoPresupuesto=$request->pagoPresupuesto;
        }
        $monto=0;
        if($request->monto){
            $monto=$request->monto;
        }
        if (count($idCompras)>0) {
            
            for ($i=0; $i < count($idCompras); $i++) { 
                
                $factura = Facture::where('id_compra', $idCompras[$i])->first();
                
                if($monto===0){
                    $monto=($factura->total-$factura->monto_abonado);
                }
                if($monto!==0){
                    $factura->monto_abonado+=$monto;
                    if($factura->monto_abonado>=$factura->total){
                        $factura->pagada=true;
                        $factura->fecha_pago=date('Y-m-d');
                    }
                }

                $factura->save();
                
                $cheque = Cheque::create([
                    'fecha' => date('Y-m-d'),
                    'id_factura' => $factura->id_compra,
                    'pago_presupuesto' => $pagoPresupuesto,
                    'monto' => $monto,
                ]);
            }
            # code...
        }
        $facturas = Facture::all(); // Obtener todos los facturas de la tabla
        $presupuesto = "no asignado para el dia";
        $day = date('Y-m-d'); // Obtener la fecha actual
        $calculo = marketshopping::where('shoppingday', $day)->where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $comprasdeldia = Facture::where('fecha', $day)->get();
            
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;

                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        

        return view('facture', compact('facturas','presupuesto')); // Pasar los facturas a la vista
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
        $day = date('Y-m-d'); // Obtener la fecha actual
        $presupuesto = "no asignado para el dia";
        $calculo = marketshopping::where('shoppingday', $day)->whereNotNull('budget')->get();
        if ($calculo->count()>0) {
            $presupuesto=$calculo[0]->budget;
            $comprasdeldia = Facture::where('fecha', $day)->get();
            
            foreach ($comprasdeldia as $factura) {
                if($factura->medio_de_pago){
                    $presupuesto-=$factura->total;

                }
                if(!$factura->medio_de_pago){
                    $presupuesto-=$factura->monto_abonado;
                }
            }
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        return view('facture', compact('facturas','presupuesto')); // Pasar los facturas a la vista
    }

    public function resume(Request $request){
        $calculo = marketshopping::where('shoppingday', $request->day)->whereNotNull('budget')->orderBy('shoppingday', 'desc')->get();
        $facturas = Facture::where('fecha', $request->day)->orderBy('fecha', 'desc')->get();
        $cantidadProductos=0;
        $tFactura=0;        
        $abonado=0;
        $tEfectivo=0;
        $tCredito=0;
        $deuda=0;
        foreach ($facturas as $f) {
            $cantidades=json_decode($f->Factured_quantity);
            foreach ($cantidades as $cantidad) {
                $cantidadProductos+=$cantidad;
            }
            $tFactura+=$f->total;
            $abonado+=$f->monto_abonado;
            if($f->medio_de_pago==true){
                $tEfectivo+=$f->total;
            }
            if($f->medio_de_pago==false){
                $tCredito+=$f->total;
                $deuda+=$f->total-$f->monto_abonado;
            }
        }
        
        $pagosAnteriores=0;
        $cheques = Cheque::where('fecha',$request->day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $pagosAnteriores+=$check->monto;
                }
        }
        
        $fecha=$request->day;
        $presupuesto=0;
        $carton=0;
        if(count($calculo)){
            $presupuesto=$calculo[0]->budget;            
        }
        if(count($facturas)){
            $carton=$facturas[0]->carton;
        }
        
        $tComprado=0;
        $vuelto=$presupuesto+$carton-$tEfectivo-$abonado-$pagosAnteriores;
        return view('factureResume',compact('fecha',
        'cantidadProductos',
        'presupuesto',
        'facturas',
        'carton',
        'tComprado',
        'tFactura',
        'tEfectivo',
        'tCredito',
        'abonado',
        'pagosAnteriores',
        'vuelto',
        'cheques',
        'deuda'
        ));
    }
}
