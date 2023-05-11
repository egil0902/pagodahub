<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\marketshopping;
class FactureController extends Controller
{
    public function index()
    {
        $registros = Facture::all(); // Obtener todos los registros de la tabla
        return view('tabla.index', compact('registros')); // Pasar los registros a la vista
    }

    public function create()
    {
        return view('tabla.create'); // Mostrar el formulario para crear un nuevo registro
    }

    public function store(Request $request)
    {
        //dd($request);
        $registro = new Facture();
        $registro->id_compra = $request->NFactura;
        $registro->fecha = $request->fecha_registro;
        $registro->proveedor = $request->proveedor;
        $registro->monto_abonado = $request->abono;
        $registro->medio_de_pago = $request->metodo;
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

    public function edit(Facture $registro)
    {
        return view('tabla.edit', compact('registro')); // Mostrar el formulario para editar un registro existente
    }

    public function update(Request $request, Facture $registro)
    {
        $registro->campo1 = $request->campo1;
        $registro->campo2 = $request->campo2;
        // Actualizar los valores del formulario en las propiedades del modelo
        $registro->save(); // Guardar los cambios en la base de datos
        return redirect()->route('tabla.index')->with('success', 'Registro actualizado exitosamente'); // Redirigir a la vista principal con un mensaje de éxito
    }

    /*
    public function destroy(Facture $registro)
    {
        $registro->delete(); // Eliminar el registro de la base de datos
        return redirect()->route('tabla.index')->with('success', 'Registro eliminado exitosamente'); // Redirigir a la vista principal con un mensaje de éxito
    }
    */
    public function searchByProvider(Request $request)
{
    $providerName = $request->input('proveedor');
    $invoices = Facture::whereHas('proveedor', function($query) use ($providerName) {
        $query->where('proveedor', 'LIKE', '%' . $providerName . '%');
    })->get();
    
    return view('facture.index', compact('invoices'));
}
}
