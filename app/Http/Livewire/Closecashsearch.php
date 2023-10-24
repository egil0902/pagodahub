<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\closecash;
use Livewire\Component;

class Closecashsearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $tipo = "";
    public $date = "";
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
        $org=session()->get('misDatos');
        if(isset($org->records)){
            $org=$org->records;
        }
        if(count($org)<2){
            $this->tipo=$org[0]->id;
        }else{
            $this->tipo="";
        }
    
        $closecash = closecash::when($this->tipo, function ($query) {
            $query->where('AD_Org_ID', $this->tipo);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->date, function ($query) {
            $query->where('DateTrx', $this->date);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('DateTrx', 'desc')->paginate(25);; // Obtener todos los brinksend de la tabla
        
                return view('livewire.closecashsearch', [
                    'closecash' => $closecash,
                    'orgsParent' => session()->get('misDatos'),
                ]);
    }
}
