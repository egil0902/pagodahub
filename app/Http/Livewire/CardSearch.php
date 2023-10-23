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
        
        $brinksend = Card::when($this->numero, function ($query) {
            $query->where('numero', $this->numero);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->orgsParent, function ($query) {
            $query->where('sucursal', 'ilike', "%$this->orgsParent%" );
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.cardsearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
