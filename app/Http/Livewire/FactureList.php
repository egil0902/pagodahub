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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

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
        })->orderBy('fecha', 'desc')->paginate(25);; // Obtener todos los facturas de la tabla
        return view('livewire.facture', [
            'facturas' => $facturas,
        ]);
    }
}
