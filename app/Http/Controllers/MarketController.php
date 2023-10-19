<?php

namespace App\Http\Controllers;

use App\Models\marketshopping;
use App\Models\products;
use App\Models\units;
use App\Models\Facture;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Models\Cheque;
use App\Models\Budget;

use PDF;
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
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        /*$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        */$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

        // Inicializa un array para almacenar los AD_Org_ID
        $orgs = []; // Inicializa un array para almacenar los registros de AD_Org
        
        foreach ($user->records as $record) {
            $orgId = $record->AD_Org_ID->id;
            $response = $APIController->getModel('RV_GH_Org', '', 'AD_Org_ID eq ' . $orgId);
            
            if(isset($response->records[0]->Parent_ID)){
                if($response->records[0]->Parent_ID->id!==0){
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->Parent_ID->id);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }else{
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $orgId);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }
            }else{
                    // Primera solicitud para AD_Org_ID = 1000009
                    $response1 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000009');

                    // Segunda solicitud para AD_Org_ID = 1000008
                    $response2 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000008');

                    // Combinar las respuestas en un único array
                    $response->records = array_merge($response1->records, $response2->records);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs=$response->records;
                        
                    }
            }
        }
        session()->put('misDatos', $orgs);
        return view('market', compact('opciones', 'opciones2', 'presupuesto','orgs'));
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
        $shop->sucursal = $request->input('sucursal');
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
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        /*$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        */$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

        // Inicializa un array para almacenar los AD_Org_ID
        $orgs = []; // Inicializa un array para almacenar los registros de AD_Org
        
        foreach ($user->records as $record) {
            $orgId = $record->AD_Org_ID->id;
            $response = $APIController->getModel('RV_GH_Org', '', 'AD_Org_ID eq ' . $orgId);
            
            if(isset($response->records[0]->Parent_ID)){
                if($response->records[0]->Parent_ID->id!==0){
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->Parent_ID->id);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }else{
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $orgId);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }
            }else{
                    // Primera solicitud para AD_Org_ID = 1000009
                    $response1 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000009');

                    // Segunda solicitud para AD_Org_ID = 1000008
                    $response2 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000008');

                    // Combinar las respuestas en un único array
                    $response->records = array_merge($response1->records, $response2->records);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs=$response->records;
                        
                    }
            }
        }
        session()->put('misDatos', $orgs);
        return view('marketinvoice', compact('carton','comprasdeldia','presupuesto','vuelto','orgs'));
    }

    public function shopday(Request $request)
    {
        //dump($request);
        $day = $request->input('day');
        //dd($day);
        
        
        $presupuesto=0;
        $comprasdeldia = marketshopping::where('shoppingday', $day)->where('sucursal', 'ilike', "%$request->AD_Org_ID%")->get();
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
        
        $facturas = Facture::where('fecha', $day)->where('sucursal', 'ilike', "%$request->AD_Org_ID%")->get();
        
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
        $cheques = Cheque::where('fecha',$day)->where('pago_presupuesto',true)->where('sucursal', 'ilike', "%$request->AD_Org_ID%")->get();
        if ($cheques->count()>0) {
            foreach ($cheques as $check) {
                    $presupuesto-=$check->monto;
                }
        }
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        /*$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        */$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

        // Inicializa un array para almacenar los AD_Org_ID
        $orgs = []; // Inicializa un array para almacenar los registros de AD_Org
        
        foreach ($user->records as $record) {
            $orgId = $record->AD_Org_ID->id;
            $response = $APIController->getModel('RV_GH_Org', '', 'AD_Org_ID eq ' . $orgId);
            
            if(isset($response->records[0]->Parent_ID)){
                if($response->records[0]->Parent_ID->id!==0){
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->Parent_ID->id);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }else{
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $orgId);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }
            }else{
                    // Primera solicitud para AD_Org_ID = 1000009
                    $response1 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000009');

                    // Segunda solicitud para AD_Org_ID = 1000008
                    $response2 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000008');

                    // Combinar las respuestas en un único array
                    $response->records = array_merge($response1->records, $response2->records);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs=$response->records;
                        
                    }
            }
        }
        session()->put('misDatos', $orgs);
        return view('marketinvoice', compact('comprasdeldia','presupuesto','carton','facturas','vuelto','orgs'));
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
        $presupuesto =$comprasdeldia[0]->budget;
        
        return view('marketEdit', compact('comprasdeldia','opciones', 'opciones2','presupuesto'));
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
            return view('marketEdit', compact('comprasdeldia', 'opciones', 'opciones2','presupuesto','mensajeExito'));
        
        } catch (Exception $e) {
            $opciones = units::all();
            $opciones2 = products::all();
            //dump($opciones, $opciones2);
            $presupuesto =-1;
            $comprasdeldia = marketshopping::where('shoppingday', $request->input('date-day'))->get();
            $dia=$request->input('date-day');
            $presupuesto=$comprasdeldia[0]->budget ;
            return view('marketEdit', compact('comprasdeldia','opciones', 'presupuesto','opciones2'))->withErrors($e->getMessage());
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
        $sucursal=$request->AD_Org_ID;
        $budget=Budget::where('fecha', $request->input('date-day'))->where('sucursal', 'ilike', "%$request->AD_Org_ID%" )->first();
        if($budget){
            $presupuesto=$budget->presupuesto;
        }

        $comprasdeldia = marketshopping::where('shoppingday', $request->input('date-day'))->where('sucursal', 'ilike', "%$request->AD_Org_ID%" )->where('id_compra',null )->get();
        if ($comprasdeldia->count()>0) {
            
            if($budget&&$presupuesto!=$comprasdeldia[0]->budget){
                $presupuesto=$budget->presupuesto;
                return view('marketEdit', compact('comprasdeldia','opciones', 'opciones2', 'presupuesto','sucursal'));
            }
            $presupuesto=$comprasdeldia[0]->budget;
            return view('marketEdit', compact('comprasdeldia','opciones', 'opciones2', 'presupuesto','sucursal'));
        }
        $dia =$request->input('date-day');


        if($presupuesto>=0){
            return view('market', compact('opciones', 'opciones2', 'presupuesto','dia','sucursal'));
        }
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        /*$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        */$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

        // Inicializa un array para almacenar los AD_Org_ID
        $orgs = []; // Inicializa un array para almacenar los registros de AD_Org
        
        foreach ($user->records as $record) {
            $orgId = $record->AD_Org_ID->id;
            $response = $APIController->getModel('RV_GH_Org', '', 'AD_Org_ID eq ' . $orgId);
            
            if(isset($response->records[0]->Parent_ID)){
                if($response->records[0]->Parent_ID->id!==0){
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->Parent_ID->id);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }else{
                    // Consulta el registro de AD_Org para el AD_Org_ID actual
                    $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $orgId);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs[] = $response->records[0];
                    }
                }
            }else{
                    // Primera solicitud para AD_Org_ID = 1000009
                    $response1 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000009');

                    // Segunda solicitud para AD_Org_ID = 1000008
                    $response2 = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq 1000008');

                    // Combinar las respuestas en un único array
                    $response->records = array_merge($response1->records, $response2->records);
                    //tabla rv_gh_org  campo AD_Org_ID
                    // Verifica si la consulta fue exitosa
                    if ($response && isset($response->records[0])) {
                        // Agrega el registro de AD_Org al array de resultados
                        $orgs=$response->records;
                        
                    }
            }
        }
        session()->put('misDatos', $orgs);
        return view('market', compact('opciones', 'opciones2', 'presupuesto','dia','orgs'))->withErrors("No hay un presupuesto creado");
    }

    public function print(Request $request){
        $day = $request->fecha_registro;

        $presupuesto=0;
        $comprasdeldia = marketshopping::where('shoppingday', $day)->where('sucursal', 'ilike', "%$request->AD_Org_ID%")->get();
        $carton =0;
        $vuelto=0;
        if($comprasdeldia->count() > 0) {
            $vuelto=$comprasdeldia[0]->vuelto;
            $carton =$comprasdeldia[0]->carton;
            $presupuesto = $comprasdeldia[0]->budget;
            $productos = json_decode($comprasdeldia[0]->product);
            $quantity = json_decode($comprasdeldia[0]->quantity);
            $facturas = Facture::where('id_market', $comprasdeldia[0]->id)->get();
            $pprice = json_decode($comprasdeldia[0]->product);
            for ($i = 0; $i < $facturas->count(); $i++) {
                $Fproductos = json_decode($facturas[$i]->product);
                $Fquantity = json_decode($facturas[$i]->Factured_quantity);
                $Fprice = json_decode($facturas[$i]->price);
                
                // Comparar los elementos de los arreglos y restar las cantidades correspondientes
                foreach ($productos as $posicion => $producto) {
                    if (in_array($producto, $Fproductos)) {
                        $fPosicion = array_search($producto, $Fproductos);
                        $quantity[$posicion] -= $Fquantity[$fPosicion];
                        $pprice[$posicion] = $Fprice[$fPosicion];
                    }
                }
            }
            // Recorre el arreglo y aplica la función para reemplazar valores no numéricos
            $price = array_map(function($value) {
                return is_numeric($value) ? $value : 0;
            }, $pprice);
            
            //$comprasdeldia[0]->quantity = json_encode($quantity);
        }
        
        $facturas = Facture::where('fecha', $day)->get();
        
            $pdf = PDF::loadView('download-pdf_marketinvoice', ['comprasdeldia' => $comprasdeldia,'presupuesto'=>$presupuesto,'carton'=>$carton,'facturas'=>$facturas,'vuelto'=>$vuelto,'quantity'=>$quantity,'price'=>$price]);
            return $pdf->download("marketinvoice.pdf");

    }
       
    
}
