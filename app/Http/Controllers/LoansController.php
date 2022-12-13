<?php

namespace App\Http\Controllers;

use App\Models\loans;
use App\Models\loans_user;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        //dd($user);
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        //dd($response->records[0]->AD_Org_ID->id);
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;
        //dd($orgs);
        return view('loans', ['orgs' => $orgs]);
    }
    public function search(Request $request)
    {
        $user = auth()->user();
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;
        $usuario = loans_user::where('cedula',$request->cedula)->orwhere('nombre','%'. $request->nombre.'%')->get();
        //dd($usuario);
        return view('loans', ['usuario' => $usuario, 'orgs' => $orgs,'cedula' => $request->cedula,'nombre'=>$request->nombre]);
    }

    public function store(Request $request)
    {
        $todo = new loans;
        $todo->C_BPartner_ID = 0;
        $todo->AD_Org_ID = 0;
        $todo->LoanAmt = 0;
        $todo->CreatedBy = 0;
        $todo->FechaNuevoPrestamo = $request->FechaNuevoPrestamo;
        $todo->Monto = $request->Monto;
        $todo->Cuota = $request->Cuota;
        $todo->Frecuencia = $request->Frecuencia;
        $todo->Filecedula = $request->Filecedula;
        $todo->FirmaNuevoPrestamo = $request->FirmaNuevoPrestamo;
        $todo->save();
        return view('loans');
    }

    public function newuser(Request $request)
    {
        $todo = new loans_user;
        $todo->nombre = $request->nombre;
        $todo->cedula = $request->cedula;
        $todo->telefono = $request->telefono;
        $todo->solicitante = $request->solicitante;
        $todo->direccion = $request->direccion;
        $todo->fotocedula = $request->fotocedula;
        $todo->save();
        $user = auth()->user();
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;
        return view('loans', ['orgs' => $orgs]);
    }

    public function list()
    {
        return view('loans');
    }
}
