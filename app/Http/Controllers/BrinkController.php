<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\closecash;
use App\Models\Brink;
use App\Models\BrinkSend;

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
        $misDatos = session()->get('misDatos');
        $orgs = $misDatos;
        $APIController = new APIController();
        ////////////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        foreach ($user->records  as $usuario) {
            foreach ($usuario->PAGODAHUB_closecash as $acceso) {
                if ($acceso->Name == 'closecash') {
                    return view('brinks', ['orgs' => $orgs, 'request' => '', 'permisos' => $user]);
                    break;
                }
            }
            return redirect()->route('home');
        }
        return view('brinks');
    }
    public function import(Request $request)
    {
        $APIController = new APIController();
        $misDatos = session()->get('misDatos');
        $orgs = $misDatos;

        

        $response = $APIController->getModel(
            'RV_GH_CloseCash_Sum',
            '',
            'datetrx ge ' . $request->startDate . ' and datetrx le ' . $request->endDate
        );
        
        $docstatus = 'CO';
        $closecashlist = $APIController->getModel(
            'RV_GH_CloseCash',
            '',
            "datetrx ge '" . $request->startDate . "' and datetrx le '" . $request->endDate . "' and docstatus eq '" . $docstatus . "'",
            'ba_name asc'
        );
        /*$list = closecash::whereBetween('DateTrx', [$request->startDate, $request->endDate])
                  ->where('AD_Org_ID', $request->AD_Org_ID)
                  ->get();*/
        
        $dia = $request->startDate;
        $organizacion = $request->AD_Org_ID;
        session()->put('dia', $dia);
        session()->put('organizacion', $organizacion);


        //////
        $name_user = auth()->user()->name;
        $email_user = auth()->user()->email;
        $user = $APIController->getModel('AD_User', '', "Name eq '$name_user' and EMail eq '$email_user'", '', '', '', 'PAGODAHUB_closecash');
        //dd($closecashlist->records); //el chiste se hace con ba_value
        //NetTotal=montoContado
        /*$panaderia = (object) [
            'ba_name'=>'Total panaderia',
            'u_name'=>'------------',
            'BeginningBalance' => 0,
            'SubTotal' => 0,
            'NetTotal' => 0,
            'XAmt' => 0,
            'DifferenceAmt' => 0
        ];
        
        $caja = (object) [
            'ba_name'=>'Total cajas',
            'u_name'=>'------------',
            'BeginningBalance' => 0,
            'SubTotal' => 0,
            'NetTotal' => 0,
            'XAmt' => 0,
            'DifferenceAmt' => 0
        ];
        
        $pagaTodo = (object) [
            'ba_name'=>'Total pagatodo',
            'u_name'=>'------------',
            'BeginningBalance' => 0,
            'SubTotal' => 0,
            'NetTotal' => 0,
            'XAmt' => 0,
            'DifferenceAmt' => 0
        ];
        $lastIndex=null;
        foreach ($closecashlist->records as $index =>$cajas) {
            switch ($cajas->ba_value) {
                case 'panaderia':
                    $panaderia->BeginningBalance += $cajas->BeginningBalance;
                    $panaderia->SubTotal += $cajas->SubTotal;
                    $panaderia->NetTotal += $cajas->NetTotal;
                    $panaderia->XAmt += $cajas->XAmt;
                    $panaderia->DifferenceAmt += $cajas->DifferenceAmt;
                    break;
                    
                case '1000004':
                    $pagaTodo->BeginningBalance += $cajas->BeginningBalance;
                    $pagaTodo->SubTotal += $cajas->SubTotal;
                    $pagaTodo->NetTotal += $cajas->NetTotal;
                    $pagaTodo->XAmt += $cajas->XAmt;
                    $pagaTodo->DifferenceAmt += $cajas->DifferenceAmt;
                    $lastIndex=$index;
                    break;
                case 'Caja 5_Panaderia':
                    $panaderia->BeginningBalance += $cajas->BeginningBalance;
                    $panaderia->SubTotal += $cajas->SubTotal;
                    $panaderia->NetTotal += $cajas->NetTotal;
                    $panaderia->XAmt += $cajas->XAmt;
                    $panaderia->DifferenceAmt += $cajas->DifferenceAmt;
                    break;
                case 'Caja 10':
                    $panaderia->BeginningBalance += $cajas->BeginningBalance;
                    $panaderia->SubTotal += $cajas->SubTotal;
                    $panaderia->NetTotal += $cajas->NetTotal;
                    $panaderia->XAmt += $cajas->XAmt;
                    $panaderia->DifferenceAmt += $cajas->DifferenceAmt;
                    break;
                case 'Principal Panaderia Susy':
                    $panaderia->BeginningBalance += $cajas->BeginningBalance;
                    $panaderia->SubTotal += $cajas->SubTotal;
                    $panaderia->NetTotal += $cajas->NetTotal;
                    $panaderia->XAmt += $cajas->XAmt;
                    $panaderia->DifferenceAmt += $cajas->DifferenceAmt;
                    break;
                case 'Caja Panaderia':
                    $panaderia->BeginningBalance += $cajas->BeginningBalance;
                    $panaderia->SubTotal += $cajas->SubTotal;
                    $panaderia->NetTotal += $cajas->NetTotal;
                    $panaderia->XAmt += $cajas->XAmt;
                    $panaderia->DifferenceAmt += $cajas->DifferenceAmt;
                    break;
                case 'Dulceria Susy Fortuna P':
                    $panaderia->BeginningBalance += $cajas->BeginningBalance;
                    $panaderia->SubTotal += $cajas->SubTotal;
                    $panaderia->NetTotal += $cajas->NetTotal;
                    $panaderia->XAmt += $cajas->XAmt;
                    $panaderia->DifferenceAmt += $cajas->DifferenceAmt;
                    break;
                default:
                    if ($cajas->ba_value !== '1000004') {
                        $caja->BeginningBalance += $cajas->BeginningBalance;
                        $caja->SubTotal += $cajas->SubTotal;
                        $caja->NetTotal += $cajas->NetTotal;
                        $caja->XAmt += $cajas->XAmt;
                        $caja->DifferenceAmt += $cajas->DifferenceAmt;
                    }
                    break;
            }
        }
        $tDia = (object) [
            'ba_name'=>'Total del día',
            'u_name'=>'------------',
            'BeginningBalance' => $panaderia->BeginningBalance+$caja->BeginningBalance+$pagaTodo->BeginningBalance,
            'SubTotal' => $panaderia->SubTotal+$caja->SubTotal+$pagaTodo->SubTotal,
            'NetTotal' => $panaderia->NetTotal+$caja->NetTotal+$pagaTodo->NetTotal,
            'XAmt' => $panaderia->XAmt+$caja->XAmt+$pagaTodo->XAmt,
            'DifferenceAmt' => $panaderia->DifferenceAmt+$caja->DifferenceAmt+$pagaTodo->DifferenceAmt
        ];
        $total=[$caja,$pagaTodo,$panaderia,$tDia];
        $closecashlist->records[] = $panaderia;
        $closecashlist->records[] = $tDia;
        //dd($closecashlist->records,$posicion);
        if($lastIndex===null){
           $lastIndex = count($closecashlist->records)-2;
        }

        $closecashlist->records = array_merge(
            array_slice($closecashlist->records, 0, $lastIndex + 1),
            [$pagaTodo],
            array_slice($closecashlist->records, $lastIndex + 1)
        );
        $closecashlist->records = array_merge(
            array_slice($closecashlist->records, 0, $lastIndex),
            [$caja],
            array_slice($closecashlist->records, $lastIndex)
        );
        */$day = $request->DateTrx;
        
        $presupuesto=0;
        $sucursal="";
        if (isset($orgs)){
            if ($orgs->{'records-size'} > 0){
                foreach ($orgs->records as $org){
                    if($org->id==$request->AD_Org_ID){ 
                        $sucursal=$org->Name;
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
        if($brink){
            /*foreach ($user->records  as $usuario) {                
                foreach ($usuario->PAGODAHUB_closecash as $acceso) {
                    if ($acceso->Name == 'closecash') {
                        return view('brinks', ['orgs' => $orgs, 
                                                'closecashsumlist' => $response, 
                                                'request' => $request, 
                                                'closecashlist' => $closecashlist, 
                                                'list' => $list, 
                                                'permisos' => $user,
                                                'totales'=> $total,
                                                'fecha_dia'=>$request->startDate,
                                                'fecha_cierre'=>$request->endDate,
                                                'sucursal'=>$sucursal,
                                                'caja'=>$caja,
                                                'brink'=>$brink
                                                ]);
                        break;
                    }
                }
                return redirect()->route('home');
            }*/
            return view('brinks', ['orgs' => $orgs, 
                                    'request' => $request,
                                    'permisos' => $user,
                                    'fecha_dia'=>$request->startDate,
                                    'fecha_cierre'=>$request->endDate,
                                    'sucursal'=>$sucursal,
                                    'brink'=>$brink
                                    ]);
        }else{
            /*foreach ($user->records  as $usuario) {
                foreach ($usuario->PAGODAHUB_closecash as $acceso) {
                    if ($acceso->Name == 'closecash') {
                        return view('brinks', ['orgs' => $orgs, 
                                                'closecashsumlist' => $response, 
                                                'request' => $request, 
                                                'closecashlist' => $closecashlist, 
                                                'list' => $list, 
                                                'permisos' => $user,
                                                'totales'=> $total,
                                                'fecha_dia'=>$request->startDate,
                                                'fecha_cierre'=>$request->endDate,
                                                'sucursal'=>$sucursal,
                                                'caja'=>$caja
                                                ]);
                        break;
                    }
                }
                return redirect()->route('home');
            }*/
            return view('brinks', ['orgs' => $orgs, 
                                    'request' => $request, 
                                    'permisos' => $user,
                                    'fecha_dia'=>$request->startDate,
                                    'fecha_cierre'=>$request->endDate,
                                    'sucursal'=>$sucursal,
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
        $brink->rollos=$request->x_sistema5;
        
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
        $brink->foto=$request->foto;
        $brink->save();
        return redirect()->back()->with('mensaje', 'Brink ha sido guardado exitosamente');
    }

    public function brinkStore(Request $request){
        $brink= new BrinkSend;
        $brink->fecha=$request->date;
        $brink->monto=$request->Monto;
        $brink->banco=$request->Banco;
        $brink->foto=$request->foto;
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
        $brink->rollos=$request->x_sistema5;        
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
        $brink->foto=$request->foto;
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
