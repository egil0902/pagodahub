<?php

namespace App\Http\Controllers;

use App\Models\marketshopping;
use App\Models\products;
use App\Models\units;
use App\Models\Facture;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Models\Cheque;
use Exception;


class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opciones = units::all();
        $opciones2 = products::all();
        //dump($opciones, $opciones2);
        $presupuesto =-1;
        
        return view('market', compact('opciones', 'opciones2', 'presupuesto'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = $request->input('product');
        
        $productos = array_values(array_filter($productos, function ($valor) {
            return !is_null($valor) && $valor !== '';
        }));
        //var_dump($productos);
        foreach ($productos as $nombre) {
            if ($nombre != "") {
                $producto = products::where('name', $nombre)->first();
                if (!$producto) {
                    //dump($nombre);
                    $producto = new products;
                    $producto->name = $nombre;
                    $producto->save();
                }
            }
        }


        $unidades = $request->input('unit');
        foreach ($unidades as $nombre) {
            if ($nombre != "") {
                $unidad = units::where('name', $nombre)->first();
                if (!$unidad) {
                    //dump($nombre);
                    $unidad = new units;
                    $unidad->name = $nombre;
                    $unidad->save();
                }
                // continuar con la lógica de tu aplicación...
            }
        }
        $shop = new marketshopping;
        $quantity =$request->input('quantity');
        $quantity = array_values(array_filter($quantity, function ($valor) {
            return !is_null($valor) && $valor !== '';
        }));
        $presupuesto = $request->input('Presupuesto');

        // Paso 1: Crear un arreglo asociativo con información de productos, unidades y cantidades
        $info_productos = [];
        for ($i = 0; $i < count($productos); $i++) {
            $info_productos[$productos[$i]] = [
                'unidad' => $unidades[$i],
                'cantidad' => $quantity[$i]
            ];
        }

        // Paso 2: Ordenar el arreglo $productos
        sort($productos);

        // Paso 3: Crear arreglos vacíos para unidades y cantidades ordenadas
        $unidades_ordenadas = [];
        $quantity_ordenado = [];

        // Paso 4: Recorrer el arreglo $productos ordenado
        foreach ($productos as $producto) {
            // Paso 5: Encontrar el índice del producto en el arreglo original
            $indice = array_search($producto, $request->input('product'));

            // Paso 6: Obtener las unidades y la cantidad correspondiente del arreglo original
            $unidades_ordenadas[] = $info_productos[$producto]['unidad'];
            $quantity_ordenado[] = $info_productos[$producto]['cantidad'];
        }

        // Paso 8: Actualizar los arreglos originales con los arreglos ordenados
        $unidades = $unidades_ordenadas;
        $quantity = $quantity_ordenado;

        $shop->shoppingday = $request->input('date-day');
        $shop->buyer = $request->input('comprador');
        $shop->budget = $request->input('Presupuesto');
        $shop->product = json_encode($productos);
        $shop->unit = json_encode($unidades);
        $shop->quantity = json_encode($quantity);
        $shop->save();

        // Procesar los datos enviados a través del formulario

        $request->session()->flash('mensaje', 'El formulario de compra ha sido guardado correctamente.');
        // Redirigir a la página del mercado
        return redirect()->route('market');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $day = "3000-01-01";
        $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
        $presupuesto=0;        
        $carton=0;
        $vuelto=0;
        if($comprasdeldia->count() > 0) {
            $presupuesto=$comprasdeldia[0]->budget;
            $carton=$comprasdeldia[0]->carton;
        }
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        return view('marketinvoice', compact('carton','comprasdeldia','presupuesto','vuelto'));
    }

    public function shopday(Request $request)
    {
        //dump($request);
        $day = $request->input('day');
        //dd($day);
        
        
        $presupuesto=0;
        $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
        $carton =0;
        $vuelto=0;
        if($comprasdeldia->count() > 0) {
            $vuelto=$comprasdeldia[0]->vuelto;
            $carton =$comprasdeldia[0]->carton;            
            $presupuesto = $comprasdeldia[0]->budget;
            $productos = json_decode($comprasdeldia[0]->product);
            $quantity = json_decode($comprasdeldia[0]->quantity);
            $facturas = Facture::where('id_market', $comprasdeldia[0]->id)->get();
            
            for ($i = 0; $i < $facturas->count(); $i++) {
                $Fproductos = json_decode($facturas[$i]->product);
                $Fquantity = json_decode($facturas[$i]->Factured_quantity);
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
        
        $facturas = Facture::where('fecha', $day)->get();
        
        if($facturas->count() > 0) {
            foreach ($facturas as $factura) {
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

        return view('marketinvoice', compact('comprasdeldia','presupuesto','carton','facturas','vuelto'));
    }
    /**
     * edit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $comprasdeldia = marketshopping::where('id', $id)->get();
        
        $opciones = units::all();
        $opciones2 = products::all();
        return view('marketEdit', compact('comprasdeldia','opciones', 'opciones2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        
        try{
            $shop = MarketShopping::findOrFail($id);  
            $productos = $request->input('product');        
            $productos = array_values(array_filter($productos, function ($valor) {
                return !is_null($valor) && $valor !== '';
            }));

            $quantity =$request->input('quantity');
            $quantity = array_values(array_filter($quantity, function ($valor) {
                return !is_null($valor) && $valor !== '';
            }));

            $presupuesto = $request->input('Presupuesto');
            $unidades = $request->input('unit');

            // Paso 1: Crear un arreglo asociativo con información de productos, unidades y cantidades
            $info_productos = [];
            for ($i = 0; $i < count($productos); $i++) {
                $info_productos[$productos[$i]] = [
                    'unidad' => $unidades[$i],
                    'cantidad' => $quantity[$i]
                ];
            }

            // Paso 2: Ordenar el arreglo $productos
            sort($productos);

            // Paso 3: Crear arreglos vacíos para unidades y cantidades ordenadas
            $unidades_ordenadas = [];
            $quantity_ordenado = [];

            // Paso 4: Recorrer el arreglo $productos ordenado
            foreach ($productos as $producto) {
                // Paso 5: Encontrar el índice del producto en el arreglo original
                $indice = array_search($producto, $request->input('product'));

                // Paso 6: Obtener las unidades y la cantidad correspondiente del arreglo original
                $unidades_ordenadas[] = $info_productos[$producto]['unidad'];
                $quantity_ordenado[] = $info_productos[$producto]['cantidad'];
            }

            // Paso 8: Actualizar los arreglos originales con los arreglos ordenados
            $unidades = $unidades_ordenadas;
            $quantity = $quantity_ordenado;
            $productList = [];
            $facturas = Facture::where('fecha',$shop->shoppingday)->get();
            foreach ($facturas as $p) {
                $productsArray = json_decode($p->product, true);
                foreach ($productsArray as $product) {
                    $productList[] = $product;
                }
            }
            $missingProducts = array_diff($productList, $productos);

            if (!empty($missingProducts)) {
                $missingProductNames = implode(', ', $missingProducts);
                throw new Exception("Los siguientes productos no pueden ser borrados: $missingProductNames");
            }

            
            $shop->shoppingday = $request->input('date-day');
            $shop->buyer = $request->input('comprador');
            $shop->budget = $request->input('Presupuesto');
            $shop->product = json_encode($productos);
            $shop->unit = json_encode($unidades);
            $shop->quantity = json_encode($quantity);
            $shop->save();
            
            $day = "3000-01-01";
            $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
            $presupuesto=0;
            $opciones = units::all();
            $opciones2 = products::all();
            //dump($opciones, $opciones2);
            $presupuesto =-1;
            $comprasdeldia = marketshopping::where('shoppingday', $request->input('date-day'))->get();
            $dia=$request->input('date-day');
            $presupuesto=$comprasdeldia[0]->budget ;
            $mensajeExito='¡La operación se realizó con éxito!';
            return view('marketEdit', compact('comprasdeldia', 'opciones', 'opciones2','mensajeExito'));
        
        } catch (Exception $e) {
            $opciones = units::all();
            $opciones2 = products::all();
            //dump($opciones, $opciones2);
            $presupuesto =-1;
            $comprasdeldia = marketshopping::where('shoppingday', $request->input('date-day'))->get();
            $dia=$request->input('date-day');
            $presupuesto=$comprasdeldia[0]->budget ;
            return view('marketEdit', compact('comprasdeldia','opciones', 'opciones2'))->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function charge(Request $request)
    {
        $opciones = units::all();
        $opciones2 = products::all();
        //dump($opciones, $opciones2);
        $presupuesto =-1;
        $comprasdeldia = marketshopping::where('shoppingday', $request->input('date-day'))->where('id_compra',null )->get();
        if ($comprasdeldia->count()>0) {
            $presupuesto=$comprasdeldia[0]->budget ;
            return view('marketEdit', compact('comprasdeldia','opciones', 'opciones2'));
        }
        else {
            $presupuesto=0;
        }
        $dia =$request->input('date-day');


        
        return view('market', compact('opciones', 'opciones2', 'presupuesto','dia'));
    }
}
