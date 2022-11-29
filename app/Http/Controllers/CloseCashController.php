<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\closecash;
use Laravel\Ui\Presets\React;

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
        return view('closecash', ['orgs' => $orgs, 'request' => $request]);
    }
    public function store(Request $request)
    {
        $todo = new closecash;

        $todo->x_oneamtSistema                =    $request->x_oneamtSistema;
        $todo->x_fiveamtSistema              =    $request->x_fiveamtSistema;
        $todo->x_tenamtSistema                =    $request->x_tenamtSistema;
        $todo->x_twentyamtSistema             =    $request->x_twentyamtSistema;
        $todo->x_fiftyamtSistema             =    $request->x_fiftyamtSistema;
        $todo->x_hundredamtSistema            =    $request->x_hundredamtSistema;
        $todo->yappySistema                    =    $request->yappySistema;
        $todo->otrosSistema                  =    $request->otrosSistema;
        $todo->valespagodaSistema            =    $request->valespagodaSistema;
        $todo->CheckAmtSistema                =    $request->CheckAmtSistema;
        $todo->LotoAmtSistema                =    $request->LotoAmtSistema;
        $todo->CardAmtSistema                =    $request->CardAmtSistema;
        $todo->CashAmtSistema                =    $request->CashAmtSistema;
        $todo->CoinRollSistema                =    $request->CoinRollSistema;
        $todo->InvoiceAmtSistema                =    $request->InvoiceAmtSistema;
        $todo->VoucherAmtSistema                =    $request->VoucherAmtSistema;
        $todo->GrantAmtSistema                =    $request->GrantAmtSistema;
        $todo->x_oneamtFiscalizadora         =    $request->x_oneamtFiscalizadora;
        $todo->x_fiveamtFiscalizadora        =    $request->x_fiveamtFiscalizadora;
        $todo->x_tenamtFiscalizadora            =    $request->x_tenamtFiscalizadora;
        $todo->x_twentyamtFiscalizadora        =    $request->x_twentyamtFiscalizadora;
        $todo->x_fiftyamtFiscalizadora        =    $request->x_fiftyamtFiscalizadora;
        $todo->x_hundredamtFiscalizadora        =    $request->x_hundredamtFiscalizadora;
        $todo->yappyFiscalizadora            =    $request->yappyFiscalizadora;
        $todo->otrosFiscalizadora            =    $request->otrosFiscalizadora;
        $todo->valespagodaFiscalizadora        =    $request->valespagodaFiscalizadora;
        $todo->CheckAmtFiscalizadora            =    $request->CheckAmtFiscalizadora;
        $todo->LotoAmtFiscalizadora            =    $request->LotoAmtFiscalizadora;
        $todo->CardValeFiscalizadora            =    $request->CardValeFiscalizadora;
        $todo->CardVisaFiscalizadora            =    $request->CardVisaFiscalizadora;
        $todo->CardMasterFiscalizadora        =    $request->CardMasterFiscalizadora;
        $todo->CardAEFiscalizadora            =    $request->CardAEFiscalizadora;
        $todo->CashAmtFiscalizadora            =    $request->CashAmtFiscalizadora;
        $todo->CoinRollFiscalizadora            =    $request->CoinRollFiscalizadora;
        $todo->InvoiceAmtFiscalizadora        =    $request->InvoiceAmtFiscalizadora;
        $todo->VoucherAmtFiscalizadora        =    $request->VoucherAmtFiscalizadora;
        $todo->GrantAmtFiscalizadora            =    $request->GrantAmtFiscalizadora;
        $todo->totalPanaderiaFiscalizadora   =    $request->totalPanaderiaFiscalizadora;
        $todo->totalPagatodoFiscalizadora    =    $request->totalPagatodoFiscalizadora;
        $todo->totalsuperFiscalizadora        =    $request->totalsuperFiscalizadora;
        $todo->dineroTaxiFiscalizadora        =    $request->dineroTaxiFiscalizadora;
        $todo->vueltoMercadoFiscalizadora    =    $request->vueltoMercadoFiscalizadora;
        $todo->comentariosFiscalizadora        =    $request->comentariosFiscalizadora;
        $todo->x_oneamtGerente                 =    $request->x_oneamtGerente;
        $todo->x_fiveamtGerente                 =    $request->x_fiveamtGerente;
        $todo->x_tenamtGerente                =    $request->x_tenamtGerente;
        $todo->x_twentyamtGerente             =    $request->x_twentyamtGerente;
        $todo->x_fiftyamtGerente             =    $request->x_fiftyamtGerente;
        $todo->x_hundredamtGerente            =    $request->x_hundredamtGerente;
        $todo->yappyGerente                    =    $request->yappyGerente;
        $todo->otrosGerente                  =    $request->otrosGerente;
        $todo->valespagodaGerente             =    $request->valespagodaGerente;
        $todo->CheckAmtGerente               =    $request->CheckAmtGerente;
        $todo->LotoAmtGerente                 =    $request->LotoAmtGerente;
        $todo->CardValeGerente                 =    $request->CardValeGerente;
        $todo->CardVisaGerente                =    $request->CardVisaGerente;
        $todo->CardMasterGerente                =    $request->CardMasterGerente;
        $todo->CardAEGerente                 =    $request->CardAEGerente;
        $todo->CashAmtGerente                =    $request->CashAmtGerente;
        $todo->CoinRollGerente                =    $request->CoinRollGerente;
        $todo->InvoiceAmtGerente                =    $request->InvoiceAmtGerente;
        $todo->VoucherAmtGerente                =    $request->VoucherAmtGerente;
        $todo->GrantAmtGerente                =    $request->GrantAmtGerente;
        $todo->totalPanaderiaGerente            =    $request->totalPanaderiaGerente;
        $todo->totalPagatodoGerente             =    $request->totalPagatodoGerente;
        $todo->totalsuperGerente                =    $request->totalsuperGerente;
        $todo->dineroTaxiGerente                =    $request->dineroTaxiGerente;
        $todo->vueltoMercadoGerente            =    $request->vueltoMercadoGerente;
        $todo->comentariosGerente            =    $request->comentariosGerente;
        $todo->DateTrx                        =    $request->DateTrx;
        $todo->AD_Org_ID                        =    $request->AD_Org_ID;
        $todo->Fileclosecash                    =    $request->Fileclosecash;
        $todo->CardClaveFiscalizadora        =    $request->CardClaveFiscalizadora;
        $todo->CardClaveGerente                 =    $request->CardClaveGerente;
        $todo->valeAmt                         =    $request->valeAmt;
        $todo->valeAmtFiscalizadora             = $request->valeAmtFiscalizadora;
        $todo->valeAmtGerente                   = $request->valeAmtGerente;
        $todo->CardBACFiscalizadora             = $request->CardBACFiscalizadora;
        $todo->CardBACGerente                   = $request->CardBACGerente;
        $todo->InvoiceAmtPropiasFiscalizadora   = $request->InvoiceAmtPropiasFiscalizadora;
        $todo->InvoiceAmtPropiasGerente         = $request->InvoiceAmtPropiasGerente;

        $filename = $request->Fileclosecash;    //$request->file('Fileclosecash');//->store('public/Fileclosecash');

        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;
        if ($filename == null) {
            //dd($todo);
            $todo->save();
            return view('closecash', ['orgs' => $orgs]);
        } else {
            //dd($todo);
            $filename = $request->file('Fileclosecash')->store('public/Fileclosecash');
            $todo->Fileclosecash = $filename;
            $todo->save();
            return view('closecash', ['orgs' => $orgs]);
        }
    }
    public function import(Request $request)
    {

        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;
        $response = $APIController->getModel(
            'RV_GH_CloseCash_Sum',
            '',
            'datetrx eq ' . $request->DateTrx . ' and parent_id eq ' . $request->AD_Org_ID
        );
        $docstatus = 'CO';
        //dd("datetrx eq '" . $request->DateTrx . "' and parent_id eq " . $request->AD_Org_ID . " and  docstatus eq '".$docstatus."'");
        $closecashlist = $APIController->getModel(
            'RV_GH_CloseCash',
            '',
            "datetrx eq '" . $request->DateTrx . "' and parent_id eq " . $request->AD_Org_ID . " and  docstatus eq '" . $docstatus . "'"
        );
        //dd($closecashlist);
        $list = closecash::where('DateTrx', $request->DateTrx)->where('AD_Org_ID', $request->AD_Org_ID)->get();
        //dd($list);
        if (isset($response)) {
            return view('closecash', ['orgs' => $orgs, 'closecashsumlist' => $response, 'request' => $request, 'closecashlist' => $closecashlist, 'list' => $list]);
        }
    }
    public function list(Request $request)
    {
        $list = closecash::all();

        return view('closecashlist', ['list' => $list, 'request' => $request]);
    }
    public function destroy(Request $request)
    {

        $vale = closecash::find($request->valeid);
        $vale->delete();
        $list = closecash::all();
        return view('closecashlist', ['list' => $list, 'request' => $request]);
    }

    public function edit(Request $request)
    {
        $todo = new closecash;
        $todo->id = $request->id;
        $todo = closecash::find($todo->id);
        $todo->x_oneamtSistema                =    $request->x_oneamtSistema;
        $todo->x_fiveamtSistema              =    $request->x_fiveamtSistema;
        $todo->x_tenamtSistema                =    $request->x_tenamtSistema;
        $todo->x_twentyamtSistema             =    $request->x_twentyamtSistema;
        $todo->x_fiftyamtSistema             =    $request->x_fiftyamtSistema;
        $todo->x_hundredamtSistema            =    $request->x_hundredamtSistema;
        $todo->yappySistema                    =    $request->yappySistema;
        $todo->otrosSistema                  =    $request->otrosSistema;
        $todo->valespagodaSistema            =    $request->valespagodaSistema;
        $todo->CheckAmtSistema                =    $request->CheckAmtSistema;
        $todo->LotoAmtSistema                =    $request->LotoAmtSistema;
        $todo->CardAmtSistema                =    $request->CardAmtSistema;
        $todo->CashAmtSistema                =    $request->CashAmtSistema;
        $todo->CoinRollSistema                =    $request->CoinRollSistema;
        $todo->InvoiceAmtSistema                =    $request->InvoiceAmtSistema;
        $todo->VoucherAmtSistema                =    $request->VoucherAmtSistema;
        $todo->GrantAmtSistema                =    $request->GrantAmtSistema;
        $todo->x_oneamtFiscalizadora         =    $request->x_oneamtFiscalizadora;
        $todo->x_fiveamtFiscalizadora        =    $request->x_fiveamtFiscalizadora;
        $todo->x_tenamtFiscalizadora            =    $request->x_tenamtFiscalizadora;
        $todo->x_twentyamtFiscalizadora        =    $request->x_twentyamtFiscalizadora;
        $todo->x_fiftyamtFiscalizadora        =    $request->x_fiftyamtFiscalizadora;
        $todo->x_hundredamtFiscalizadora        =    $request->x_hundredamtFiscalizadora;
        $todo->yappyFiscalizadora            =    $request->yappyFiscalizadora;
        $todo->otrosFiscalizadora            =    $request->otrosFiscalizadora;
        $todo->valespagodaFiscalizadora        =    $request->valespagodaFiscalizadora;
        $todo->CheckAmtFiscalizadora            =    $request->CheckAmtFiscalizadora;
        $todo->LotoAmtFiscalizadora            =    $request->LotoAmtFiscalizadora;
        $todo->CardValeFiscalizadora            =    $request->CardValeFiscalizadora;
        $todo->CardVisaFiscalizadora            =    $request->CardVisaFiscalizadora;
        $todo->CardMasterFiscalizadora        =    $request->CardMasterFiscalizadora;
        $todo->CardAEFiscalizadora            =    $request->CardAEFiscalizadora;
        $todo->CashAmtFiscalizadora            =    $request->CashAmtFiscalizadora;
        $todo->CoinRollFiscalizadora            =    $request->CoinRollFiscalizadora;
        $todo->InvoiceAmtFiscalizadora        =    $request->InvoiceAmtFiscalizadora;
        $todo->VoucherAmtFiscalizadora        =    $request->VoucherAmtFiscalizadora;
        $todo->GrantAmtFiscalizadora            =    $request->GrantAmtFiscalizadora;
        $todo->totalPanaderiaFiscalizadora   =    $request->totalPanaderiaFiscalizadora;
        $todo->totalPagatodoFiscalizadora    =    $request->totalPagatodoFiscalizadora;
        $todo->totalsuperFiscalizadora        =    $request->totalsuperFiscalizadora;
        $todo->dineroTaxiFiscalizadora        =    $request->dineroTaxiFiscalizadora;
        $todo->vueltoMercadoFiscalizadora    =    $request->vueltoMercadoFiscalizadora;
        $todo->comentariosFiscalizadora        =    $request->comentariosFiscalizadora;
        $todo->x_oneamtGerente                 =    $request->x_oneamtGerente;
        $todo->x_fiveamtGerente                 =    $request->x_fiveamtGerente;
        $todo->x_tenamtGerente                =    $request->x_tenamtGerente;
        $todo->x_twentyamtGerente             =    $request->x_twentyamtGerente;
        $todo->x_fiftyamtGerente             =    $request->x_fiftyamtGerente;
        $todo->x_hundredamtGerente            =    $request->x_hundredamtGerente;
        $todo->yappyGerente                    =    $request->yappyGerente;
        $todo->otrosGerente                  =    $request->otrosGerente;
        $todo->valespagodaGerente             =    $request->valespagodaGerente;
        $todo->CheckAmtGerente               =    $request->CheckAmtGerente;
        $todo->LotoAmtGerente                 =    $request->LotoAmtGerente;
        $todo->CardValeGerente                 =    $request->CardValeGerente;
        $todo->CardVisaGerente                =    $request->CardVisaGerente;
        $todo->CardMasterGerente                =    $request->CardMasterGerente;
        $todo->CardAEGerente                 =    $request->CardAEGerente;
        $todo->CashAmtGerente                =    $request->CashAmtGerente;
        $todo->CoinRollGerente                =    $request->CoinRollGerente;
        $todo->InvoiceAmtGerente                =    $request->InvoiceAmtGerente;
        $todo->VoucherAmtGerente                =    $request->VoucherAmtGerente;
        $todo->GrantAmtGerente                =    $request->GrantAmtGerente;
        $todo->totalPanaderiaGerente            =    $request->totalPanaderiaGerente;
        $todo->totalPagatodoGerente             =    $request->totalPagatodoGerente;
        $todo->totalsuperGerente                =    $request->totalsuperGerente;
        $todo->dineroTaxiGerente                =    $request->dineroTaxiGerente;
        $todo->vueltoMercadoGerente            =    $request->vueltoMercadoGerente;
        $todo->comentariosGerente            =    $request->comentariosGerente;
        $todo->DateTrx                        =    $request->DateTrx;
        $todo->AD_Org_ID                        =    $request->AD_Org_ID;
        $todo->Fileclosecash                    =    $request->Fileclosecash;
        $todo->CardClaveFiscalizadora        =    $request->CardClaveFiscalizadora;
        $todo->CardClaveGerente                 =    $request->CardClaveGerente;
        $todo->valeAmt                         =    $request->valeAmt;
        $todo->valeAmtFiscalizadora             =    $request->valeAmtFiscalizadora;
        $todo->valeAmtGerente                 =    $request->valeAmtGerente;
        $todo->CardBACFiscalizadora             = $request->CardBACFiscalizadora;
        $todo->CardBACGerente                   = $request->CardBACGerente;
        $todo->InvoiceAmtPropiasFiscalizadora   = $request->InvoiceAmtPropiasFiscalizadora;
        $todo->InvoiceAmtPropiasGerente         = $request->InvoiceAmtPropiasGerente;
        $filename = $request->Fileclosecash;    //$request->file('Fileclosecash');//->store('public/Fileclosecash');

        $APIController = new APIController();
        $response = $APIController->getModel('AD_Org', '', 'issummary eq true');
        $orgs =  $response;
        if ($filename == null) {
            //dd($todo);
            $todo->save();
            return view('closecash', ['orgs' => $orgs]);
        } else {
            //dd($todo);
            $filename = $request->file('Fileclosecash')->store('public/Fileclosecash');
            $todo->Fileclosecash = $filename;
            $todo->save();
            return view('closecash', ['orgs' => $orgs]);
        }
    }
}
