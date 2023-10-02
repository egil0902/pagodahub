<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Card;

class CardSearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $numero;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        
        $brinksend = Card::when($this->numero, function ($query) {
            $query->where('numer', $this->numero);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.cardsearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
