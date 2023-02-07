<?php

namespace App\Http\Controllers;

use App\Models\ValesPagodaRange;

use Illuminate\Http\Request;

class ValesPagodaRangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('valespagodarange');
    }
    public function search(Request $request)
    {
        $APIController = new APIController();
        $permisos = $APIController->getModel('PAGODAHUB_closecash', 'Name,AD_User_ID', '', '', '', '', '');
        foreach ($permisos->records as $record) {
            $nombreventana = $record->Name;
            $nombreusario = $record->AD_User_ID->identifier;
            $id_name = auth()->user()->name;
            if ($record->Name == "vale" && $record->AD_User_ID->identifier == $id_name) {
                $datas = ValesPagodaRange::where('valueFrom', '=', $request->value)->get();
                return view('valespagodarange', ['datas' => $datas, 'request' => $request]);
                break;
            }
        }
        return redirect()->route('home');
    }
    public function store(Request $request)
    {
        $range = ValesPagodaRange::where('valueFrom', '<=', $request->valueFrom)
            ->where('valueTo', '>=', $request->valueFrom)
            ->orwhere('valueFrom', '<=', $request->valueTo)
            ->where('valueTo', '>=', $request->valueTo)
            ->get();
        if (!$range->isEmpty()) {
            return view('valespagodarange', ['error' => 'El rango introducido ya ha sido usado']);
        }
        ValesPagodaRange::create([
            'valueFrom' => $request['valueFrom'] ?? 0,
            'valueTo' => $request['valueTo'] ?? 0,
            'amount' => $request['amount'] ?? 0.00,
            'CreatedBy' => $request['CreatedBy'] ?? 'NA',
        ]);
        //$datas = ValesPagodaRange::where('valueFrom', '=', $request->value)->get();
        return view('valespagodarange');
    }
    public function list(Request $request)
    {
        $list = ValesPagodaRange::all();
        return view('valespagodarange', ['list' => $list, 'request' => $request]);
    }
}
