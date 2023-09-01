<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RequestBrink;

class RequestBrinkSearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $fecha;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $brinksend = RequestBrink::when($this->fecha, function ($query) {
            $query->where('fecha', $this->fecha);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('fecha', 'desc')->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.requestbrinksearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
