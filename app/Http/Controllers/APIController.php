<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class APIController extends Controller
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
    public function getToken()
    {
        //$user = auth()->user();
        //dd($user);

        $client_token_post = new Client(['base_uri' => 'https://erp.superlapagoda.com:444/']);
        $http_token_post   = $client_token_post->request('POST', 'api/v1/auth/tokens', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'        => 'application/json',
            ],
            'body' => '{

                "userName" : "PagodaAdmin",
                "password" : "p4g0d44dm1n"
            }'
        ]);

        $response_token_post = json_decode($http_token_post->getBody()->getContents());
        //dd($response_token_post->clients);
        $client_token_put = new Client(['base_uri' => 'https://erp.superlapagoda.com:444/']);
        $http_token_put   = $client_token_put->request('PUT', 'api/v1/auth/tokens', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $response_token_post->token,
            ],
            'body' => '{

                "roleId": "1000018",
                "language": "es_PA",
                "clientId": "1000000",
                "organizationId": "0",
                "warehouseId": "0"
            }'
        ]);

        $response_token_put = json_decode($http_token_put->getBody()->getContents());
        //dd($response_token_put);

        return $response_token_put;

    }
    /*
$select -> used to define the columns that we want in the returned query
$filter -> used to filter the query
$orderby -> to define the columns used to order by the records
$top -> obtain just this number of records (a value of zero means to use the default defined in SysConfig REST_MAX_RECORDS_SIZE)
$skip -> skip this number of records, in combination with top this is used for pagination
$expand -> to get PO records from detail tables
$valrule -> to get PO records using a validation rule - AD_ValRule_ID or AD_ValRule_UU
$context -> to put variables in context to be parsed by the validation rule
    */
    public function getModel(String $model_name,String $select='', String $filter='',String $orderby='',String $top='',String $skip='',String $expand=''){
        $client = new Client(['base_uri' => 'https://erp.superlapagoda.com:444/']);
        $http   = $client->request('GET', 'api/v1/models/'.$model_name, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken()->token,
            ],

            'query' => [
                '$select' => $select,
                '$filter' => $filter,
                '$orderby' => $orderby,
                '$top' => $top,
                '$skip' => $skip,
                '$expand' => $expand,
            ]
        ]);

        $response = json_decode($http->getBody()->getContents());
        return $response;
        
        
    }
}
