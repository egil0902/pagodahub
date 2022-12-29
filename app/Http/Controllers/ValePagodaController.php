<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ValesPagoda;
use App\Models\ValesPagodaRange;

class ValePagodaController extends Controller
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

    public function organizacion()
    {
        $user = auth()->user();
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;
        return $orgs;
    }

    public function index(Request $request)
    {
        $orgs = $this->organizacion();
        return view('valepagoda', ['orgs' => $orgs]);
    }
    public function search(Request $request)
    {

        /* $validate = $request->validate([
            'value' => 'required|max:255'
        ]); */

        if ($request->value == null) {
            $request->value = "0";
        }
        if ($request->value2 == null) {
            $request->value2 = "0";
        }
        if ($request->value3 == null) {
            $request->value3 = "0";
        }
        if ($request->value4 == null) {
            $request->value4 = "0";
        }
        if ($request->value5 == null) {
            $request->value5 = "0";
        }
        $datas = ValesPagoda::orwhere('value', '=', $request->value)->get();
        $datas2 = ValesPagoda::orwhere('value', '=', $request->value2)->get();
        $datas3 = ValesPagoda::orwhere('value', '=', $request->value3)->get();
        $datas4 = ValesPagoda::orwhere('value', '=', $request->value4)->get();
        $datas5 = ValesPagoda::orwhere('value', '=', $request->value5)->get();
        $range = ValesPagodaRange::where('valueFrom', '<=', $request->value)->where('valueTo', '>=', $request->value)->get();
        $range2 = ValesPagodaRange::where('valueFrom', '<=', $request->value2)->where('valueTo', '>=', $request->value2)->get();
        $range3 = ValesPagodaRange::where('valueFrom', '<=', $request->value3)->where('valueTo', '>=', $request->value3)->get();
        $range4 = ValesPagodaRange::where('valueFrom', '<=', $request->value4)->where('valueTo', '>=', $request->value4)->get();
        $range5 = ValesPagodaRange::where('valueFrom', '<=', $request->value5)->where('valueTo', '>=', $request->value5)->get();

        $orgs = $this->organizacion();
        return view('valepagoda', [
            'datas' => $datas,
            'datas2' => $datas2,
            'datas3' => $datas3,
            'datas4' => $datas4,
            'datas5' => $datas5,
            'range' => $range,
            'range2' => $range2,
            'range3' => $range3,
            'range4' => $range4,
            'range5' => $range5,
            'request' => $request,
            'orgs' => $orgs,
        ]);
    }
    public function store(Request $request)
    {
        /* $validate = $request->validate([
            'value' => 'required',
            'taxid' => 'required|max:255',
            'name' => 'required|max:255',

        ]); */
        if ($request['value'] != 0) {
            ValesPagoda::create([
                'value' => $request['value'] ?? 0,
                'taxid' => $request['taxid'] ?? 'NA',
                'name' => $request['name'] ?? 'NA',
                'CreatedBy' => $request['CreatedBy'] ?? 'NA',
                'AD_Org_ID' => $request['AD_Org_ID'] ?? 0,
            ]);
        }
        if ($request['value2'] != 0) {
            ValesPagoda::create([
                'value' => $request['value2'] ?? 0,
                'taxid' => $request['taxid2'] ?? 'NA',
                'name' => $request['name2'] ?? 'NA',
                'CreatedBy' => $request['CreatedBy2'] ?? 'NA',
                'AD_Org_ID' => $request['AD_Org_ID2'] ?? 0,
            ]);
        }
        if ($request['value3'] != 0) {
            ValesPagoda::create([
                'value' => $request['value3'] ?? 0,
                'taxid' => $request['taxid3'] ?? 'NA',
                'name' => $request['name3'] ?? 'NA',
                'CreatedBy' => $request['CreatedBy3'] ?? 'NA',
                'AD_Org_ID' => $request['AD_Org_ID3'] ?? 0,
            ]);
        }
        if ($request['value4'] != 0) {
            ValesPagoda::create([
                'value' => $request['value4'] ?? 0,
                'taxid' => $request['taxid4'] ?? 'NA',
                'name' => $request['name4'] ?? 'NA',
                'CreatedBy' => $request['CreatedBy4'] ?? 'NA',
                'AD_Org_ID' => $request['AD_Org_ID4'] ?? 0,
            ]);
        }
        if ($request['value5'] != 0) {
            ValesPagoda::create([
                'value' => $request['value5'] ?? 0,
                'taxid' => $request['taxid5'] ?? 'NA',
                'name' => $request['name5'] ?? 'NA',
                'CreatedBy' => $request['CreatedBy5'] ?? 'NA',
                'AD_Org_ID' => $request['AD_Org_ID5'] ?? 0,
            ]);
        }
        $datas = ValesPagoda::where('value', '=', $request->value)->get();
        $orgs = $this->organizacion();
        return view('valepagoda', ['orgs' => $orgs]);
    }
    public function list(Request $request)
    {
        $list = ValesPagoda::all();
        return view('valepagodalist', ['list' => $list, 'request' => $request]);
    }
    public function destroy(Request $request)
    {
        $vale = ValesPagoda::find($request->valeid);
        $vale->delete();
        $list = ValesPagoda::all();
        return view('valepagodalist', ['list' => $list, 'request' => $request]);
    }
}
