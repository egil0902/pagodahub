<?php

namespace App\Http\Controllers;

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
        dump($opciones,$opciones2);
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

        $unidades = $request->input('unit');
        $productos = $request->input('product');
        dump($productos);
        dump($request);
        foreach ($productos as $nombre) {
            if ($nombre != "") {
                $producto = units::where('name', $nombre)->first();
                if (!$producto) {
                    dump($nombre);
                    $producto = new products;
                    $producto->name = $nombre;
                    $producto->save();
                }
                // continuar con la lógica de tu aplicación...
            }
        }
        foreach ($unidades as $nombre) {
            if ($nombre != "") {
                $unidad = units::where('name', $nombre)->first();
                if (!$unidad) {
                    dump($nombre);
                    $unidad = new units;
                    $unidad->name = $nombre;
                    $unidad->save();
                }
                // continuar con la lógica de tu aplicación...
            }
        }
        
        $opciones = units::all();
        $opciones2 = products::all();
        return view('market', compact('opciones', 'opciones2'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
