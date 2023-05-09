<?php

namespace App\Http\Controllers;

use App\Models\marketshopping;
use App\Models\products;
use App\Models\units;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

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
        return view('market', compact('opciones', 'opciones2'));
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
        
        array_push($productos, 'Carton');
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
        array_push($unidades, 'Carton');
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
        /* $prod = implode(' ', $request->input('product'));*/
        /* $unit = implode(' ', $request->input('unit')); */
        /* $quan = implode(' ', $request->input('quantity')); */
        $quantity =$request->input('quantity');
        $quantity = array_values(array_filter($quantity, function ($valor) {
            return !is_null($valor) && $valor !== '';
        }));
        $shop->shoppingday = $request->input('date-day');
        $shop->buyer = $request->input('comprador');
        $shop->budget = $request->input('Presupuesto');
        $shop->product = json_encode($productos);
        $shop->unit = json_encode($unidades);
        $shop->quantity = json_encode($quantity);
        $shop->save();

        //dd($shop);
        //$opciones = units::all();
        //$opciones2 = products::all();
        //return view('market', compact('opciones', 'opciones2'));

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
        return view('marketinvoice', compact('comprasdeldia'));
    }

    public function shopday(Request $request)
    {
        //dump($request);
        $day = $request->input('day');
        //dd($day);
        $comprasdeldia = marketshopping::where('shoppingday', $day)->get();
        //dd($comprasdeldia);
        return view('marketinvoice', compact('comprasdeldia'));
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
        //
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
}
