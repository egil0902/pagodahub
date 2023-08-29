<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BrinkSend;

class BrinkSendSearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $banco;
    public $fecha;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        $brinksend = BrinkSend::when($this->banco, function ($query) {
            $query->where('banco', 'ilike', "%$this->banco%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->fecha, function ($query) {
            $query->where('fecha', $this->fecha);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('fecha', 'desc')->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.brinkenviosearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
