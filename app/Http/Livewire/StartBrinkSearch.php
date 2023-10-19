<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StartBrink;

class StartBrinkSearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $fecha;
    public $responsable_entrega;
    public $responsable_recibe;
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
        $brinksend = StartBrink::when($this->fecha, function ($query) {
            $query->where('fecha', $this->fecha);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->responsable_entrega, function ($query) {
            $query->where('responsable_entrega', 'ilike', "%$this->responsable_entrega%" );
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->orgsParent, function ($query) {
            $query->where('sucursal', 'ilike', "%$this->orgsParent%" );
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->responsable_recibe, function ($query) {
            $query->where('responsable_recibe', 'ilike', "%$this->responsable_recibe%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('fecha', 'desc')->paginate(25);; // Obtener todos los brinksend de la tabla
        return view('livewire.startbrinksearch', [
            'brinksend' => $brinksend,
        ]);
    }

}
