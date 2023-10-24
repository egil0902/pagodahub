<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Invoice;

class InvoiceSearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $responsable_ingreso;
    public $responsable_pago;
    public $fecha_ingreso;
    public $proveedor;
    public $chequeador;
    public $fecha_pago;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public $orgsParent; // Propiedad para almacenar el valor de 'tipo' desde el primer return

    public function mount($orgs)
    {
        $org=session()->put('misDatos',$orgs);
        $this->orgsParent = $orgs; // Almacena el valor de 'tipo' desde el primer return
    }
    public function render()
    {
        $org=session()->get('misDatos');
        if(isset($org->records)){
            $org=$org->records;
        }
        if(count($org)<2){
            $this->orgsParent=$org[0]->Name;
        }else{
            $this->orgsParent="";
        }
        
        $brinksend = Invoice::when($this->responsable_ingreso, function ($query) {
            $query->where('responsable_ingreso', 'ilike', "%$this->responsable_ingreso%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->proveedor, function ($query) {
            $query->where('proveedor', 'ilike', "%$this->proveedor%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->chequeador, function ($query) {
            $query->where('chequeador', 'ilike', "%$this->chequeador%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->fecha_ingreso, function ($query) {
            $query->where('fecha_ingreso', $this->fecha_ingreso);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->fecha_pago, function ($query) {
            $query->where('fecha_pago', $this->fecha_pago);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->orgsParent, function ($query) {
            $query->where('sucursal', $this->orgsParent);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('fecha_ingreso', 'desc')->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.invoicesearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
