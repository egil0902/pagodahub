<?php
namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class InvoiceExport implements FromView
{
    protected $lista;

    public function __construct($lista)
    {
        $this->lista = $lista;
    }

    public function view(): View
    {
        //dd($this->lista);
        
        return view('exportInvoices', [
            'brinksend' => $this->lista
        ]);
    }
}
