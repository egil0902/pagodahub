<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Card;
use App\Models\Check;
use App\Models\Provider;
use App\Models\Responsable;
use App\Models\presupuestoBank;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index_viejo()
    {   
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        //$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        //$response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

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
        if(count($orgs)==1){
            $sucursal=$orgs[0]->Name;

            $tarjetas = Card::where('sucursal', 'ilike', "%$sucursal%" )->get();
            
        }else{
            $tarjetas = Card::all();
        }
        $providers = Provider::all();
        $responsables = Responsable::all();
        $checkers = Check::all();
        
        $pbankME = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto');
        $pbankDE = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto');
        $pbankML = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto_l');
        $pbankDL = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto_l');
        $pbankMC = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto_c');
        $pbankDC = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto_c');
        $invoices = Invoice::where('fecha_pago',date('Y-m-d'))->get();
        foreach ($invoices as $invoice) {
            if($invoice->sucursal =="La Doña"){
                $pbankDE-=$invoice->p_e;
                $pbankDL-=$invoice->p_l;
                $pbankDC-=$invoice->p_c;
            }else{
                $pbankME-=$invoice->p_e;
                $pbankML-=$invoice->p_l;
                $pbankMC-=$invoice->p_c;
            }
        }
        return view('invoice',['providers'=>$providers,'responsables'=>$responsables,'checkers'=>$checkers,'tarjetas'=>$tarjetas,'orgs' => $orgs,  'permisos' => $user
                ,'pbankME'=>$pbankME,'pbankDE'=>$pbankDE,'pbankML'=>$pbankML,'pbankDL'=>$pbankDL,'pbankMC'=>$pbankMC,'pbankDC'=>$pbankDC]);
    }

    public function index()
    {   
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        //$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        //$response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

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
        $Invoice = Invoice::all();
        return view('invoice.index',['orgs' => $orgs,  'permisos' => $user]);
    }

    /*public function list()
    {   
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        //$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        //$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

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
        $Invoice = Invoice::all();
        return view('invoiceList',['orgs' => $orgs,  'permisos' => $user]);
    }*/
    public function create(Request $request)
    {
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        //$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        //$response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

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
        if(count($orgs)==1){
            $sucursal=$orgs[0]->Name;

            $tarjetas = Card::where('sucursal', 'ilike', "%$sucursal%" )->get();
            
        }else{
            $tarjetas = Card::all();
        }
        $providers = Provider::all();
        $responsables = Responsable::all();
        $checkers = Check::all();
        
        $pbankME = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto');
        $pbankDE = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto');
        $pbankML = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto_l');
        $pbankDL = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto_l');
        $pbankMC = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto_c');
        $pbankDC = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto_c');
        $invoices = Invoice::where('fecha_pago',date('Y-m-d'))->get();
        foreach ($invoices as $invoice) {
            if($invoice->sucursal =="La Doña"){
                $pbankDE-=$invoice->p_e;
                $pbankDL-=$invoice->p_l;
                $pbankDC-=$invoice->p_c;
            }else{
                $pbankME-=$invoice->p_e;
                $pbankML-=$invoice->p_l;
                $pbankMC-=$invoice->p_c;
            }
        }
        return view('invoice.create',['providers'=>$providers,'responsables'=>$responsables,'checkers'=>$checkers,'tarjetas'=>$tarjetas,'orgs' => $orgs,  'permisos' => $user
                ,'pbankME'=>$pbankME,'pbankDE'=>$pbankDE,'pbankML'=>$pbankML,'pbankDL'=>$pbankDL,'pbankMC'=>$pbankMC,'pbankDC'=>$pbankDC]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $forma_pago_multiple = collect();
        
        $sucursal=$request->AD_Org_ID;
       
        $brink = new Invoice;
        $brink->fecha_ingreso=$request->fecha_ingreso;
        $brink->fecha_pago=$request->fecha_pago;        
        $brink->proveedor=$request->proveedor;
        $brink->sucursal=$request->AD_Org_ID;
        $brink->monto_impuesto = number_format($request->monto_total * ($request->impuesto_select / 100), 2, '.', '');
        $brink->total_factura=$request->total_factura;
        $brink->foto=$request->foto;//revisar
        $brink->responsable_ingreso=$request->responsable_ingreso;
        $brink->responsable_pago=$request->responsable_ingreso;
        $brink->forma_pago="";
        //$brink->forma_pago=$forma_pago;
        $brink->chequeador=$request->check;
        $brink->observaciones=$request->observaciones;

        $index = 0;

        foreach ($request->forma_pago as $forma_pago) {

            $obj = new \stdClass();
            $obj->forma_pago = $forma_pago;

            if($forma_pago=="banco"){
                $pbankME = presupuestoBank::where('fecha',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->sum('monto');
                $pbankML = presupuestoBank::where('fecha',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->sum('monto_l');
                $pbankMC = presupuestoBank::where('fecha',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->sum('monto_c');
                $invoices = Invoice::where('fecha_pago',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->get();
                $aPagar=0;

                foreach ($invoices as $invoice) {                
                        $pbankME-=$invoice->p_e;
                        $pbankML-=$invoice->p_l;
                        $pbankMC-=$invoice->p_c;
                }
                foreach ($request->banco_options as $options) {
                    if($options=="cheque"){
                        $aPagar=$request->cheque_banco[$index];
                        if($pbankMC-$aPagar<0){
                            return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                        'ya que el monto puesto($'.$aPagar.') es superior a lo que queda en caja ($'.($pbankMC).')');
                    
                        }
                    }
                    if($options=="loteria"){
                        $aPagar=$request->loteria_banco[$index];
                        if($pbankML-$aPagar<0){
                            return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                        'ya que el monto puesto($'.$aPagar.') es superior a lo que queda en caja ($'.($pbankML).')');
                        }
                    }
                    if($options=="efectivo"){
                        $aPagar=$request->presupuest_banco[$index];
                        if($pbankME-$aPagar<0){
                            return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                        'ya que el monto puesto($'.$aPagar.') es superior a lo que queda en caja ($'.($pbankME).')');
                        }
                    }
                }
                
            }

            if($forma_pago==='credito'){
                $brink->forma_pago= $forma_pago.' '.$request->credito_options[$index];
                $brink->banco=$request->banco_credito[$index];
                $brink->comprobante=$request->num_comprobante_credito[$index];

                $obj->descripcion_forma_pago = 'Crédito';
                $obj->credito_options = $request->credito_options[$index];
                $obj->banco = $request->banco_credito[$index];
                $obj->comprobante = $request->num_comprobante_credito[$index];
                $obj->valor = $request->valor_credito[$index];
            }
            
            if($forma_pago==='banco'){
                //$brink->forma_pago= $forma_pago.' '.$request->banco_options;
                $brink->forma_pago = "";
                $obj->descripcion_forma_pago = 'Banco';
                $bcheque = "";
                $befectivo = "";
                $bloteria = "";
                foreach ($request->banco_options as $options) {

                    $obj_banco_options = new \stdClass();
                    $obj_banco_options->option = $options;

                    if ($options === 'cheque') {
                        $brink->banco = $request->banco_banco[$index];
                        $brink->comprobante = $request->num_comprobante[$index];
                        $brink->p_c=$request->cheque_banco[$index];
                        $bcheque .= $forma_pago . ' ' . $options . ' $' . $request->cheque_banco[$index] . "\n";

                        $obj_banco_options->banco = $request->banco_banco[$index];
                        $obj_banco_options->comprobante = $request->num_comprobante[$index];
                        $obj_banco_options->valor = $request->cheque_banco[$index];
                    }
                
                    if ($options === 'efectivo') {
                        $brink->p_e=$request->presupuest_banco[$index];
                        $befectivo .= $forma_pago . ' ' . $options . ' $' . $request->presupuest_banco[$index] . "\n";

                        $obj_banco_options->valor = $request->presupuest_banco[$index];
                    }
                
                    if ($options === 'loteria') {
                        $brink->p_l=$request->loteria_banco[$index];
                        $bloteria .= $forma_pago . ' ' . $options . ' $' . $request->loteria_banco[$index] . "\n";

                        $obj_banco_options->valor = $request->loteria_banco[$index];
                    }

                    $obj->banco_options[] = $obj_banco_options;
                }
                
                $brink->forma_pago = $bcheque . $befectivo . $bloteria;
                
                
            }
            
            if($forma_pago==='tarjeta_credito'){
                $brink->tarjeta=$request->tarjeta[$index];
                $obj->descripcion_forma_pago = 'Tarjeta de crédito';
                $obj->tarjeta = $request->tarjeta[$index];
                $obj->valor = $request->valor_tarjeta[$index];
            }

            if($forma_pago==='caja'){
                $obj->descripcion_forma_pago = 'Caja';
                $obj->valor = $request->valor_caja[$index];
            }

            $forma_pago_multiple->push($obj);
            $index++;

        }

        $chequeador = Check::where('name', $request->check)->first();
        if (!$chequeador && !empty($request->check)) {
            //dump($nombre);
            $chequeador = new Check;
            $chequeador->name = $request->check;
            $chequeador->save();
        }
        $responsable = Responsable::where('name', $request->responsable_ingreso)->first();
        if (!$responsable && !empty($request->responsable_ingreso)) {
            //dump($nombre);
            $responsable = new Responsable;
            $responsable->name = $request->responsable_ingreso;
            $responsable->save();
        }
        $proveedor = Provider::where('name', $request->proveedor)->first();
        if (!$proveedor && !empty($request->proveedor)) {
            //dump($nombre);
            $proveedor = new Provider;
            $proveedor->name = $request->proveedor;
            $proveedor->save();
        }
        
        if($request->hasFile('pdf')){
            $pdfFile = $request->file('pdf');
            $pdfBase64 = base64_encode(file_get_contents($pdfFile->getRealPath()));

            $brink->nameFile = $request->file('pdf')->getClientOriginalName();

            $brink->pdf_data = $pdfBase64;
        }
    
        if(empty($request->forma_pago[0])){
            $brink->forma_pago_multiple="[]";
        }
        else{
            $brink->forma_pago_multiple=$forma_pago_multiple->toJson();
        }
             
        if(isset($request->devolucion)){
            $brink->devolucion=$request->devolucion;
        }
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
        $brink->fecha_pago=$request->fecha_pago;

        try {
            
            $brink->save();
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->back()->with('mensaje', 'Factura ha sido creada exitosamente');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Invoice = Invoice::find($id);

        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        //$user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        
        //$response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $user->records[0]->AD_Org_ID->id);
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

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
        if(count($orgs)==1){
            $sucursal=$orgs[0]->Name;

            $tarjetas = Card::where('sucursal', 'ilike', "%$sucursal%" )->get();
            
        }else{
            $tarjetas = Card::all();
        }
        $providers = Provider::all();
        $responsables = Responsable::all();
        $checkers = Check::all();
        
        $pbankME = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto');
        $pbankDE = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto');
        $pbankML = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto_l');
        $pbankDL = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto_l');
        $pbankMC = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%mañanitas%" )->sum('monto_c');
        $pbankDC = presupuestoBank::where('fecha',date('Y-m-d'))->where('sucursal', 'ilike', "%La Doña%" )->sum('monto_c');
        $invoices = Invoice::where('fecha_pago',date('Y-m-d'))->get();
        foreach ($invoices as $invoice) {
            if($invoice->sucursal =="La Doña"){
                $pbankDE-=$invoice->p_e;
                $pbankDL-=$invoice->p_l;
                $pbankDC-=$invoice->p_c;
            }else{
                $pbankME-=$invoice->p_e;
                $pbankML-=$invoice->p_l;
                $pbankMC-=$invoice->p_c;
            }
        }
        return view('invoice.edit',['providers'=>$providers,'responsables'=>$responsables,'checkers'=>$checkers,'tarjetas'=>$tarjetas,'orgs' => $orgs,  'permisos' => $user
                ,'pbankME'=>$pbankME,'pbankDE'=>$pbankDE,'pbankML'=>$pbankML,'pbankDL'=>$pbankDL,'pbankMC'=>$pbankMC,'pbankDC'=>$pbankDC,'invoice'=>$Invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $forma_pago_multiple = collect();

        $sucursal=$request->AD_Org_ID;
       
        $brink = Invoice::find($request->id);
        $brink->fecha_ingreso=$request->fecha_ingreso;
        $brink->fecha_pago=$request->fecha_pago;        
        $brink->proveedor=$request->proveedor;
        $brink->sucursal=$request->AD_Org_ID;
        $brink->monto_impuesto = number_format($request->monto_total * ($request->impuesto_select / 100), 2, '.', '');
        $brink->total_factura=$request->total_factura;
        $brink->foto=$request->foto;//revisar
        $brink->responsable_ingreso=$request->responsable_ingreso;
        $brink->responsable_pago=$request->responsable_ingreso;
        $brink->forma_pago="";
        //$brink->forma_pago=$forma_pago;
        $brink->chequeador=$request->check;
        $brink->observaciones=$request->observaciones;

        $index = 0;

        foreach ($request->forma_pago as $forma_pago) {

            $obj = new \stdClass();
            $obj->forma_pago = $forma_pago;

            if($forma_pago=="banco"){
                $pbankME = presupuestoBank::where('fecha',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->sum('monto');
                $pbankML = presupuestoBank::where('fecha',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->sum('monto_l');
                $pbankMC = presupuestoBank::where('fecha',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->sum('monto_c');
                $invoices = Invoice::where('fecha_pago',$request->fecha_pago)->where('sucursal', 'ilike', "%$sucursal%" )->get();
                $aPagar=0;

                foreach ($invoices as $invoice) {                
                        $pbankME-=$invoice->p_e;
                        $pbankML-=$invoice->p_l;
                        $pbankMC-=$invoice->p_c;
                }
                foreach ($request->banco_options as $options) {
                    if($options=="cheque"){
                        $aPagar=$request->cheque_banco[$index];
                        if($pbankMC-$aPagar<0){
                            return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                        'ya que el monto puesto($'.$aPagar.') es superior a lo que queda en caja ($'.($pbankMC).')');
                    
                        }
                    }
                    if($options=="loteria"){
                        $aPagar=$request->loteria_banco[$index];
                        if($pbankML-$aPagar<0){
                            return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                        'ya que el monto puesto($'.$aPagar.') es superior a lo que queda en caja ($'.($pbankML).')');
                        }
                    }
                    if($options=="efectivo"){
                        $aPagar=$request->presupuest_banco[$index];
                        if($pbankME-$aPagar<0){
                            return redirect()->back()->with('error', 'no se puede descontar valor del banco para el dia '.$request->fecha_pago.
                        'ya que el monto puesto($'.$aPagar.') es superior a lo que queda en caja ($'.($pbankME).')');
                        }
                    }
                }
                
            }

            if($forma_pago==='credito'){
                $brink->forma_pago= $forma_pago.' '.$request->credito_options[$index];
                $brink->banco=$request->banco_credito[$index];
                $brink->comprobante=$request->num_comprobante_credito[$index];

                $obj->descripcion_forma_pago = 'Crédito';
                $obj->credito_options = $request->credito_options[$index];
                $obj->banco = $request->banco_credito[$index];
                $obj->comprobante = $request->num_comprobante_credito[$index];
                $obj->valor = $request->valor_credito[$index];
            }
            
            if($forma_pago==='banco'){
                //$brink->forma_pago= $forma_pago.' '.$request->banco_options;
                $brink->forma_pago = "";
                $obj->descripcion_forma_pago = 'Banco';
                $bcheque = "";
                $befectivo = "";
                $bloteria = "";
                foreach ($request->banco_options as $options) {

                    $obj_banco_options = new \stdClass();
                    $obj_banco_options->option = $options;

                    if ($options === 'cheque') {
                        $brink->banco = $request->banco_banco[$index];
                        $brink->comprobante = $request->num_comprobante[$index];
                        $brink->p_c=$request->cheque_banco[$index];
                        $bcheque .= $forma_pago . ' ' . $options . ' $' . $request->cheque_banco[$index] . "\n";

                        $obj_banco_options->banco = $request->banco_banco[$index];
                        $obj_banco_options->comprobante = $request->num_comprobante[$index];
                        $obj_banco_options->valor = $request->cheque_banco[$index];
                    }
                
                    if ($options === 'efectivo') {
                        $brink->p_e=$request->presupuest_banco[$index];
                        $befectivo .= $forma_pago . ' ' . $options . ' $' . $request->presupuest_banco[$index] . "\n";

                        $obj_banco_options->valor = $request->presupuest_banco[$index];
                    }
                
                    if ($options === 'loteria') {
                        $brink->p_l=$request->loteria_banco[$index];
                        $bloteria .= $forma_pago . ' ' . $options . ' $' . $request->loteria_banco[$index] . "\n";

                        $obj_banco_options->valor = $request->loteria_banco[$index];
                    }

                    $obj->banco_options[] = $obj_banco_options;
                }
                
                $brink->forma_pago = $bcheque . $befectivo . $bloteria;
                
                
            }
            
            if($forma_pago==='tarjeta_credito'){
                $brink->tarjeta=$request->tarjeta[$index];
                $obj->descripcion_forma_pago = 'Tarjeta de crédito';
                $obj->tarjeta = $request->tarjeta[$index];
                $obj->valor = $request->valor_tarjeta[$index];
            }

            if($forma_pago==='caja'){
                $obj->descripcion_forma_pago = 'Caja';
                $obj->valor = $request->valor_caja[$index];
            }

            $forma_pago_multiple->push($obj);
            $index++;

        }

        $chequeador = Check::where('name', $request->check)->first();
        if (!$chequeador && !empty($request->check)) {
            //dump($nombre);
            $chequeador = new Check;
            $chequeador->name = $request->check;
            $chequeador->save();
        }
        $responsable = Responsable::where('name', $request->responsable_ingreso)->first();
        if (!$responsable && !empty($request->responsable_ingreso)) {
            //dump($nombre);
            $responsable = new Responsable;
            $responsable->name = $request->responsable_ingreso;
            $responsable->save();
        }
        $proveedor = Provider::where('name', $request->proveedor)->first();
        if (!$proveedor && !empty($request->proveedor)) {
            //dump($nombre);
            $proveedor = new Provider;
            $proveedor->name = $request->proveedor;
            $proveedor->save();
        }
        
        if($request->hasFile('pdf')){
            $pdfFile = $request->file('pdf');
            $pdfBase64 = base64_encode(file_get_contents($pdfFile->getRealPath()));

            $brink->nameFile = $request->file('pdf')->getClientOriginalName();

            $brink->pdf_data = $pdfBase64;
        }
    
        if(empty($request->forma_pago[0])){
            $brink->forma_pago_multiple="[]";
        }
        else{
            $brink->forma_pago_multiple=$forma_pago_multiple->toJson();
        }
             
        if(isset($request->devolucion)){
            $brink->devolucion=$request->devolucion;
        }
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
        $brink->fecha_pago=$request->fecha_pago;
        
        try {
            
            $brink->save();
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->back()->with('mensaje', 'Factura ha sido modificada exitosamente');
    }

    public function getExcel(Request $request) {
        $lista = json_decode($request->input('lista'), true);

        return Excel::download(new InvoiceExport($lista["data"]), 'facturas.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Invoice = Invoice::find($id);
        $Invoice->delete();
        return back()->with('mensaje', 'Registo ha sido eliminado exitosamente');

    }
    
}
