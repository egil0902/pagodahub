<?php

namespace App\Http\Controllers;

use App\Models\loans;
use App\Models\loans_user;
use App\Models\loans_new;
use App\Models\loans_statement_of_account;
use App\Models\loans_payments;
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
        if ($request->cedula == null) {
            $usuario = loans_user::orwhere('nombre', 'ilike', '%' . $request->nombre . '%')->get();
        }
        if ($request->nombre == null) {
            $usuario = loans_user::orwhere('cedula', '=', $request->cedula)->get();
        }
        $usuario_loans = loans::where('cedula_user', $request->cedula)->get();
        if (isset($usuario[0]->id)) {
            $usuario_monto = loans::select(loans_new::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $usuario_payment = loans_payments::select(loans_payments::raw("SUM(COALESCE(amount,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $loan_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Prestamo')->get();
            $payment_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Pago')->get();
            //dd($payment_view);
        } else {
            $usuario_payment = 0;
            $usuario_monto = 0;
            $loan_view = 0;
            $payment_view = 0;
        }

        return view(
            'loans',
            [
                'usuario' => $usuario,
                'usuario_monto' => $usuario_monto,
                'usuario_payment' => $usuario_payment,
                'usuario_loans' => $usuario_loans,
                'loan_view' => $loan_view,
                'payment_view' => $payment_view,
                'orgs' => $orgs,
                'cedula' => $request->cedula,
                'nombre' => $request->nombre
            ]
        );
    }

    public function store(Request $request)
    {
        return view('loans');
    }

    public function store_new(Request $request)
    {
        $todo = new loans;
        $todo->fechanuevoprestamo   = $request->fechanuevoprestamo;
        $todo->monto                = $request->monto;
        $todo->cuota                = $request->cuota;
        $todo->frecuencia           = $request->frecuencia;
        $todo->filecedula           = $request->filecedula;
        $todo->firmanuevoprestamo   = $request->firmanuevoprestamo;
        $todo->estado =               "Nuevo";
        $todo->cedula_user          = $request->cedula_user;
        $todo->nombre_user          = $request->nombre_user;
        $todo->loans_users_id       = $request->loans_users_id;
        //dd($todo);
        $todo->save();
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $user = auth()->user();
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;
        return view('loans', ['orgs' => $orgs]);
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
        $todo->montototal = 0;
        $todo->save();
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $user = auth()->user();
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;
        $usuario = loans_user::where('cedula', $request->cedula)->orwhere('nombre', $request->nombre)->get();
        $usuario_loans = loans::where('cedula_user', $request->cedula)->get();
        $usuario_monto = loans::select(loans_new::raw("SUM(monto)"))->where('cedula_user', $request->cedula)->get();
        //dd($usuario_loans);
        return view(
            'loans',
            [
                'usuario' => $usuario,
                'usuario_monto' => $usuario_monto,
                'usuario_loans' => $usuario_loans,
                'orgs' => $orgs,
                'cedula' => $request->cedula,
                'nombre' => $request->nombre
            ]
        );
    }

    public function update(Request $request)
    {
        $todo       =   new loans_payments;
        $todo->datepayment  = $request->datepayment;
        $todo->amount       = $request->amount;
        $todo->loans_users_id = $request->loans_users_id;
        $todo->loans_id     = $request->loans_id;
        $todo->file         = $request->file;
        $todo->signature     = $request->signature;
        //dd($request->loans_id);
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
