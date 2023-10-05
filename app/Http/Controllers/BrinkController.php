<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\closecash;
use App\Models\Brink;
use App\Models\BrinkSend;
use App\Models\RequestGerency;
use App\Models\RequestBrink;
use App\Models\StartBrink;
use App\Models\DevolucionGerency;

class BrinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;
        session()->put('misDatos', $orgs);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Inicializa un array para almacenar los AD_Org_ID
        $orgs = []; // Inicializa un array para almacenar los registros de AD_Org
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        $APIController = new APIController();
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');

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
        return view('brinks', ['orgs' => $orgs, 'request' => '', 'permisos' => $user]);
    }
    public function import(Request $request)
    {
        $APIController = new APIController();
        $misDatos = session()->get('misDatos');
        $orgs = $misDatos;

        $sumatoriaMonto = RequestGerency::whereBetween('fecha', [$request->startDate, $request->endDate])->sum('monto');
        $requestBrink = RequestBrink::whereBetween('fecha', [$request->startDate, $request->endDate])->get();
        

        $response = $APIController->getModel(
            'RV_GH_CloseCash_Sum',
            '',
            'datetrx ge ' . $request->startDate . ' and datetrx le ' . $request->endDate
        );
        
        $docstatus = 'CO';
        /*$closecashlist = $APIController->getModel(
            'RV_GH_CloseCash',
            '',
            "datetrx ge '" . $request->startDate . "' and datetrx le '" . $request->endDate . "' and docstatus eq '" . $docstatus . "'",
            'ba_name asc',
            100  // Tamaño alto de página (ajusta según lo permitido por la API)
        );*/
        $sumaBeginningBalance = 0;
        $contador=0;
        $page = 1;
        $pageSize = 100;
        $totalRecords = 100;

        $startTime = microtime(true);
        while ($totalRecords===100) {
            // Realiza la solicitud con paginación
            $closecashlist = $APIController->getModel(
                'RV_GH_CloseCash',
                '',
                "datetrx ge '" . $request->startDate . "' and datetrx le '" . $request->endDate ."' and parent_id eq " . $request->AD_Org_ID .  " and docstatus eq '" . $docstatus . "'",
                'ba_name asc',
                $pageSize,
                ($page - 1) * $pageSize
            );
            dump(count($closecashlist->records));
            foreach ($closecashlist->records as $record) {
                // Verificar si el registro tiene la propiedad BeginningBalance y es numérica
                $contador++;
                if (isset($record->BeginningBalance) && is_numeric($record->BeginningBalance)) {
                    $sumaBeginningBalance += $record->BeginningBalance;
                }
            }
            $page++;
            $totalRecords= count($closecashlist->records);
            $endTime = microtime(true);  // Tiempo de finalización
            $executionTime = $endTime - $startTime; 
        }
        $list = closecash::whereBetween('DateTrx', [$request->startDate, $request->endDate])
                  ->where('AD_Org_ID', $request->AD_Org_ID)
                  ->sum('SencilloSupervisoraFiscalizadora');
        
        $dia = $request->startDate;
        $organizacion = $request->AD_Org_ID;
        session()->put('dia', $dia);
        session()->put('organizacion', $organizacion);


        //////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        //dd($closecashlist->records); //el chiste se hace con ba_value
        $day = $request->DateTrx;
        
        $presupuesto=0;
        $sucursal="";
        if (isset($orgs)){
            if (isset($orgs->{'records-size'})){
                foreach ($orgs->records as $org){
                    if($org->id==$request->AD_Org_ID){ 
                        $sucursal=$org->Name;
                    } 
                }
            }
            else{
                if ($orgs){
                    foreach ($orgs as $org){
                        if($org->id==$request->AD_Org_ID){ 
                            $sucursal=$org->Name;
                        } 
                    }
                }
            }
        }
        $brink = Brink::where('fecha_inicio',$request->startDate)->where('fecha_cierre',$request->endDate)->where('sucursal',$sucursal)->first();
        if($brink==null){
            $exist = Brink::where(function ($query) use ($request, $sucursal) {
            $query->where('fecha_cierre', '>=', $request->startDate)
                  ->where('fecha_cierre', '<=', $request->endDate)
                  ->where('sucursal', $sucursal)
                  ->orWhere(function ($query) use ($request, $sucursal) {
                      $query->where('fecha_inicio', '>=', $request->startDate)
                            ->where('fecha_inicio', '<=', $request->endDate)
                            ->where('sucursal', $sucursal);
                  });
            })->first();
            if($exist){
                return redirect()->back()->with('mensaje', 'Existe un registro con las fecha de inicio '. $exist->fecha_inicio.' y fecha de cierre '.$exist->fecha_cierre );;
            }
        }
        //$devgerencia=DevolucionGerency::whereBetween('fecha', [$request->startDate, $request->endDate])->sum('devolucion');
        $start= StartBrink::whereBetween('fecha', [$request->startDate, $request->endDate])->sum('presupuesto');


        if($brink){
            return view('brinks', ['orgs' => $orgs, 
                                    'request' => $request,
                                    'permisos' => $user,
                                    'fecha_dia'=>$request->startDate,
                                    'fecha_cierre'=>$request->endDate,
                                    'sucursal'=>$sucursal,
                                    'brink'=>$brink,
                                    'gerencia'=>$sumatoriaMonto,
                                    'requestBrink'=>$requestBrink,
                                    'cajas'=>$sumaBeginningBalance,
                                    //'devgerencia'=>$devgerencia,
                                    'start'=>$start,
                                    'sencillo'=>$list
                                    ]);
        }else{
            return view('brinks', ['orgs' => $orgs, 
                                    'request' => $request, 
                                    'permisos' => $user,
                                    'fecha_dia'=>$request->startDate,
                                    'fecha_cierre'=>$request->endDate,
                                    'sucursal'=>$sucursal,
                                    'gerencia'=>$sumatoriaMonto,
                                    'requestBrink'=>$requestBrink,
                                    'cajas'=>$sumaBeginningBalance,  
                                    //'devgerencia'=>$devgerencia,
                                    'start'=>$start,                                  
                                    'sencillo'=>$list
                                ]);
        }
        ////////////

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSend()
    {
        return view('brinksEnvio');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brink = new Brink;
        $brink->fecha_inicio=$request->fecha_dia;
        $brink->fecha_dia=date('Y-m-d');        
        $brink->fecha_cierre=$request->fecha_cierre;
        $brink->billete_1=$request->x_sistema1;
        $brink->billete_5=$request->x_sistema2;
        $brink->billete_10=$request->x_sistema3;
        $brink->billete_20=$request->x_sistema4;
        //rollos hace referencia a los rollos de 0.50
        $brink->rollos_50=$request->x_sistema9;
        
        $brink->rollos_10=$request->x_sistema7;
        $brink->rollos_25=$request->x_sistema8;
        $brink->rollos_01=$request->x_sistema5;
        $brink->rollos_05=$request->x_sistema6;

        $brink->sencillo=$request->x_sistema10;
        $brink->dinero_gerencia=$request->x_sistema11;
        $brink->total_caja=$request->x_sistema12;
        $brink->devolucion=$request->x_sistema13;
        $brink->presupuesto=$request->x_sistema14;
        $brink->total_brink=$request->BrinkresultColumn;

        $brink->sucursal=$request->sucursal;        
        $brink->observaciones=$request->observaciones;
        if($request->observaciones===null){
            $request->observaciones="";
        }
        
        $brink->foto=$request->foto;
        if($request->foto===null){
            $request->foto="no";
        }

        $brink->save();
        return redirect()->back()->with('mensaje', 'Brink ha sido guardado exitosamente');
    }

    public function brinkStore(Request $request){
        $brink= new BrinkSend;
        $brink->fecha=$request->date;
        $brink->monto=$request->Monto;
        $brink->banco=$request->Banco;
        $brink->foto="";
        if ($request->foto!=null) {
            $brink->foto=$request->foto;
        }
        
        $brink->save();
        return redirect()->back()->with('mensaje', 'Registro ha sido guardado exitosamente');
    }

    public function brinkdestroy(Request $request){
        $brink = BrinkSend::where('id', $request->id)->first();
        if ($brink) {
            $brink->delete();              
            return redirect()->back()->with('mensaje', 'Registro ha sido eliminado exitosamente');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imprimir(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $brink = Brink::where('fecha_cierre',$request->fecha_cierre)->first();
        $brink->billete_1=$request->x_sistema1;
        $brink->billete_5=$request->x_sistema2;
        $brink->billete_10=$request->x_sistema3;
        $brink->billete_20=$request->x_sistema4;
        $brink->rollos_50=$request->x_sistema5;        
        $brink->rollos_10=$request->x_sistema9;
        $brink->rollos_25=$request->x_sistema10;
        $brink->rollos_01=$request->x_sistema11;
        $brink->rollos_05=$request->x_sistema12;
        $brink->sencillo=$request->x_sistema6;
        $brink->dinero_gerencia=$request->x_sistema7;
        $brink->total_caja=$request->x_sistema8;
        $brink->total_brink=$request->BrinkresultColumn;
        $brink->total_quantity=$request->QuantityresultColumn;
        $brink->total=$request->TotalresultColumn;
        $brink->sucursal=$request->sucursal;
        if($request->observaciones!==null){
            $brink->observaciones=$request->observaciones;
        }
        if($request->foto!==null){
            $brink->foto=$request->foto;
        }
        $brink->save();
        return redirect()->back()->with('mensaje', 'Brink ha sido actualizado exitosamente');
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
