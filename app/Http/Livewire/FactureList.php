<?php

namespace App\Http\Livewire;
use App\Models\Facture;

use Livewire\Component;
use Livewire\WithPagination;

class FactureList extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_compra;
    public $fecha;
    public $proveedor;
    public $pagada;
    public $medio;
    public $descripcion;

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

        $facturas = Facture::when($this->proveedor, function ($query) {
            $query->where('proveedor', 'ilike', "%$this->proveedor%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->id_compra, function ($query) {
            $query->where('id_compra', $this->id_compra);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->fecha, function ($query) {
            $query->where('fecha', $this->fecha);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->pagada, function ($query) {
            $query->where('pagada', $this->pagada);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->medio, function ($query) {
            $query->where('medio_de_pago', $this->medio);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->descripcion, function ($query) {
            $query->where('descripcion', 'ilike', "%$this->descripcion%");
        })->when($this->orgsParent, function ($query) {
            $query->where('sucursal', 'ilike', "%$this->orgsParent%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('fecha', 'desc')->paginate(25);; // Obtener todos los facturas de la tabla
        return view('livewire.facture', [
            'facturas' => $facturas,
        ]);
    }
}
