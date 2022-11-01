<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class CloseCashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Request $request)
    {
        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;
        return view('closecash', ['orgs' => $orgs]);
        
    }
    public function store(Request $request)
    {
        $AD_Org_ID = $request->AD_Org_ID;
        //dd($AD_Org_ID);
        return view('closecash', ['orgs' => $orgs]);
    }
    public function import(Request $request){
        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;

        $response = $APIController->getModel('RV_GH_CloseCash_Sum', ''
                            , 'datetrx eq '.$request->DateTrx.' and parent_id eq '.$request->AD_Org_ID);

        if (isset($response)) {
            return view('closecash', ['orgs' => $orgs,'closecashsumlist' => $response]);
        }
    }

}
