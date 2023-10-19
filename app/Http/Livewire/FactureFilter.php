<?php

namespace App\Http\Livewire;
use App\Models\Facture;

use Livewire\Component;
use Livewire\WithPagination;

class FactureFilter extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_compra;
    public $fecha;
    public $proveedor;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public $orgsParent; // Propiedad para almacenar el valor de 'tipo' desde el primer return

    public function mount($orgs)
    {
        $this->orgsParent = $orgs; // Almacena el valor de 'tipo' desde el primer return
    }
    public function render()
    {
        
        $facturas = Facture::where('pagada',false)->when($this->proveedor, function ($query) {
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
        })->when($this->orgsParent, function ($query) {
            $query->where('sucursal', 'ilike', "%$this->orgsParent%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('fecha', 'desc')->paginate(25); // Obtener todos los facturas de la tabla
        return view('livewire.facture-filter', [
            'facturas' => $facturas,
            'orgs' => $this->orgsParent,

        ]);
    }
}
