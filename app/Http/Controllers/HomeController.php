<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

class HomeController extends Controller
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
        //$user = auth()->user();
        //dd($user);

        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org','','issummary eq true');
        $permisos = $APIController->getModel('PAGODAHUB_closecash', 'Name,AD_User_ID', '', '', '', '', '');
        if (isset($response)) {
            //dd($response);
            $orgs =  $response;
            return view('home', ['orgs' => $orgs,'permisos' => $permisos]);
        }
        return view('home');
    }
}
