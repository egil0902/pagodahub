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
    private $apiController;
    public function __construct()
    {
        $this->middleware('auth');
        $this->apiController = new APIController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function obtenerInformacion()
    {
        $user = auth()->user();
        $response = $this->apiController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        $response = $this->apiController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        return $response;
    }

    public function index()
    {
        $orgs = $this->obtenerInformacion();
        return view('loans', ['orgs' => $orgs]);
    }

    public function search(Request $request)
    {
        //Obtenemos la informacion de las organizaciones
        $orgs = $this->obtenerInformacion();
        if ($request->cedula == null) {
            //Si es nulo, buscamos los usuarios con nombre similar al campo nombre
            $usuario = loans_user::orwhere('nombre', 'ilike', '%' . $request->nombre . '%')->get();
        }
        if ($request->nombre == null) {
            // Si es nulo, buscamos los usuarios con cedula igual al campo cedula
            $usuario = loans_user::orwhere('cedula', '=', $request->cedula)->get();
        }
        // Verificamos si la variable usuario tiene al menos un elemento
        if (isset($usuario[0]->id)) {
            //Si tiene al menos un elemento, buscamos informacion relacionada con ese usuario en las tablas loans y loans_payments
            $usuario_loans = loans::orwhere('loans_users_id', '=', $usuario[0]->id)->get();
            $usuario_monto = loans::select(loans_new::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $usuario_payment = loans_payments::select(loans_payments::raw("SUM(COALESCE(amount,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $loan_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Prestamo')->get();
            $payment_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Pago')->get();
        } else {
            // Si no tiene elementos, establecemos todas las variables en 0
            $usuario_loans = 0;
            $usuario_payment = 0;
            $usuario_monto = 0;
            $loan_view = 0;
            $payment_view = 0;
        }
        //devolvemos la vista loans y pasamos las variables como parametros
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
        $orgs = $this->obtenerInformacion();
        $usuario = loans_user::orwhere('cedula', '=', $request->cedula_user)->get();
        if (isset($usuario[0]->id)) {
            $usuario_loans = loans::orwhere('loans_users_id', '=', $usuario[0]->id)->get();
            $usuario_monto = loans::select(loans_new::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $usuario_payment = loans_payments::select(loans_payments::raw("SUM(COALESCE(amount,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $loan_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Prestamo')->get();
            $payment_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Pago')->get();
        } else {
            $usuario_loans = 0;
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
                'cedula' => $request->cedula_user,
                'nombre' => $request->nombre_user
            ]
        );
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
        $orgs = $this->obtenerInformacion();
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
        /* dd($request->cedula_user,$request->nombre_user); */
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $orgs = $this->obtenerInformacion();
        $usuario = loans_user::orwhere('cedula', '=', $request->cedula_user)->get();
        if (isset($usuario[0]->id)) {
            $usuario_loans = loans::orwhere('loans_users_id', '=', $usuario[0]->id)->get();
            $usuario_monto = loans::select(loans_new::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $usuario_payment = loans_payments::select(loans_payments::raw("SUM(COALESCE(amount,0))"))->where('loans_users_id', $usuario[0]->id)->get();
            $loan_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Prestamo')->get();
            $payment_view = loans_statement_of_account::select(loans_payments::raw("SUM(COALESCE(monto,0))"))->where('loans_users_id', $usuario[0]->id)->where('loan_type', 'Pago')->get();
        } else {
            $usuario_loans = 0;
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
                'cedula' => $request->cedula_user,
                'nombre' => $request->nombre_user
            ]
        );
    }

    public function list()
    {
        $APIController = new APIController();
        $permisos = $APIController->getModel('PAGODAHUB_closecash', 'Name,AD_User_ID', '', '', '', '', '');
        foreach ($permisos->records as $record) {
            $nombreventana = $record->Name;
            $nombreusario = $record->AD_User_ID->identifier;
            $id_name = auth()->user()->name;
            if ($record->Name == "loans" && $record->AD_User_ID->identifier == $id_name) {
                return view('loanslist');
                break;
            }
        }
        return redirect()->route('home');
    }


    public function destroy(Request $request)
    {
        $vale = loans_statement_of_account::find($request->valeid);
        $vale->delete();
        $list = loans_statement_of_account::all();
        return view('loans_search', ['list' => $list, 'request' => $request]);
    }
}
