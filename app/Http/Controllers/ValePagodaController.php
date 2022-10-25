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
    public function index(Request $request)
    {
        $user = auth()->user();
        //dd($user);
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        //dd($response->records[0]->AD_Org_ID->id);

        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);

        $orgs =  $response;
        return view('valepagoda', ['orgs' => $orgs]);
    }
    public function search(Request $request)
    {
        
        $validate = $request->validate([
            'value' => 'required|max:255'
        ]);

        $datas = ValesPagoda::where('value', '=', $request->value)->get();
        $range = ValesPagodaRange::where('valueFrom', '<=', $request->value)
            ->where('valueTo', '>=', $request->value)
            ->get();
        $user = auth()->user();
        //dd($user);
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');
        //dd($response->records[0]->AD_Org_ID->id);

        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);
        $orgs =  $response;

        return view('valepagoda', ['datas' => $datas, 'request' => $request, 'range' => $range, 'orgs' => $orgs]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'value' => 'required',
            'taxid' => 'required|max:255',
            'name' => 'required|max:255',
            
        ]);
        ValesPagoda::create([
            'value' => $request['value'] ?? 0,
            'taxid' => $request['taxid'] ?? 'NA',
            'name' => $request['name'] ?? 'NA',
            
            'CreatedBy' => $request['CreatedBy'] ?? 'NA',
            'AD_Org_ID' => $request['AD_Org_ID'] ?? 0,
        ]);
        $datas = ValesPagoda::where('value', '=', $request->value)->get();
        $user = auth()->user();
        $APIController = new APIController();
        $response = $APIController->getModel('AD_User', '', "Name eq '" . $user->name . "'", '', '', '', 'AD_User_OrgAccess');

        $response = $APIController->getModel('AD_Org', '', 'AD_Org_ID eq ' . $response->records[0]->AD_Org_ID->id);

        $orgs =  $response;
        return view('valepagoda', ['orgs' => $orgs]);
    }
    public function list(Request $request)
    {
        $list = ValesPagoda::all();
        return view('valepagoda', ['list' => $list, 'request' => $request]);
    }
}
