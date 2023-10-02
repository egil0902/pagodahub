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
    public $fecha_pago;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        
        $brinksend = Invoice::when($this->responsable_ingreso, function ($query) {
            $query->where('responsable_ingreso', 'ilike', "%$this->responsable_ingreso%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->responsable_pago, function ($query) {
            $query->where('responsable_pago', 'ilike', "%$this->responsable_pago%");
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
        })->orderBy('fecha_ingreso', 'desc')->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.invoicesearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
