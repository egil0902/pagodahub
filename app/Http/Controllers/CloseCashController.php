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
        $AD_Org_ID = $request->AD_Org_ID;
        //dd($AD_Org_ID);
        return view('close_cash', ['AD_Org_ID' => $AD_Org_ID]);
    }
    public function store(Request $request)
    {
        $AD_Org_ID = $request->AD_Org_ID;
        //dd($AD_Org_ID);
        return view('close_cash', ['AD_Org_ID' => $AD_Org_ID]);
    }
}
