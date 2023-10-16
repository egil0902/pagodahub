<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ValesPagoda;

class Valepagodasearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $valenum;
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
            $this->orgsParent=$org[0]->id;
        }
        $vales=ValesPagoda::when($this->valenum, function ($query) {
            $query->where('value','ilike', '%' . $this->valenum);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->orgsParent, function ($query) {
            $query->where('AD_Org_ID','ilike', '%' . $this->orgsParent);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('id', 'desc')->paginate(25);
        
        return view('livewire.valepagodasearch', [
            'vales' => $vales,
            'orgsParent' => session()->get('misDatos'),
        ]);
    }

}
