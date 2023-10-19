<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestBrink;

class RequestBrinkController extends Controller
{
    public function index()
    {
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
        return view('requestBrink',['orgs' => $orgs,  'permisos' => $user]);
    }

    public function store(Request $request)
    {
        $brink= new RequestBrink;
        $brink->fecha =$request->date;
        $brink->billete_1=$request->x_sistema1;
        $brink->billete_5=$request->x_sistema2;
        $brink->billete_10=$request->x_sistema3;
        $brink->billete_20=$request->x_sistema4;
        //rollos hace referencia a los rollos de 0.50        
        $brink->rollos_01=$request->x_sistema5;
        $brink->rollos_05=$request->x_sistema6;        
        $brink->rollos_10=$request->x_sistema7;
        $brink->rollos_25=$request->x_sistema8;
        $brink->rollos_50=$request->x_sistema9;
        $brink->total=$request->BrinkresultColumn;
        $brink->observaciones=$request->observaciones;
        $brink->sucursal=$request->AD_Org_ID;
        $brink->foto=$request->foto;
        

        $brink->save();
        return redirect()->back()->with('mensaje', 'Solicitud Brink ha sido guardado exitosamente');
    }
    public function edit(Request $request){
        
        $brink= RequestBrink::where('id',$request->id)->first();
        return view(('requestBrinkEdit'),compact('brink'));
    }
    public function update(Request $request){
        
        $brink= RequestBrink::where('id',$request->id)->first();
        $brink->fecha =$request->date;
        $brink->billete_1=$request->x_sistema1;
        $brink->billete_5=$request->x_sistema2;
        $brink->billete_10=$request->x_sistema3;
        $brink->billete_20=$request->x_sistema4;
        //rollos hace referencia a los rollos de 0.50        
        $brink->rollos_01=$request->x_sistema5;
        $brink->rollos_05=$request->x_sistema6;        
        $brink->rollos_10=$request->x_sistema7;
        $brink->rollos_25=$request->x_sistema8;
        $brink->rollos_50=$request->x_sistema9;
        $brink->total=$request->BrinkresultColumn;
        $brink->observaciones=$request->observaciones;
        $brink->foto=$request->foto;
        $brink->save();
        return view('requestBrink')->with('mensaje', 'Brink ha sido actualizado exitosamente');
    }
}
