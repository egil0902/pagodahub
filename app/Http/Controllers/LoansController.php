<?php

namespace App\Http\Controllers;

use App\Models\loans;
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
        $validate = $request->validate([
            'TaxID' => 'required|max:255'
        ]);
        //$datas = ValesPagoda::where('value', '=', $request->value)->get();
        //$range = ValesPagodaRange::where('valueFrom', '<=', $request->value)
        //    ->where('valueTo', '>=', $request->value)
        //    ->get();
        $user = auth()->user();
        $APIController = new APIController();
        $datas = $APIController->getModel('C_BPartner', '', "TaxID eq '" . $request->TaxID . "'", '', '', '', '');
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        //dd($APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess'));
        //dd($response->records[0]->AD_Org_ID->id);
        //$list = loans::where('FechaNuevoPrestamo', )->where('TaxID', $request->TaxID)->get();
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;

        //dd($datas, $request, $orgs);
        return view('loans', ['datas' => $datas, 'request' => $request, 'orgs' => $orgs]);
    }

    public function store(Request $request)
    {
        $todo = new loans;
        $todo->C_BPartner_ID = 0;
        $todo->AD_Org_ID = 0;
        $todo->LoanAmt= 0;
        $todo->CreatedBy= 0;
        $todo->FechaNuevoPrestamo = $request->FechaNuevoPrestamo;
        $todo->Monto = $request->Monto;
        $todo->Cuota = $request->Cuota;
        $todo->Frecuencia = $request->Frecuencia;
        $todo->Filecedula = $request->Filecedula;
        $todo->FirmaNuevoPrestamo = $request->FirmaNuevoPrestamo;
        $todo->save();
        return view('loans');
    }
    public function list()
    {
        return view('loans');
    }
}
