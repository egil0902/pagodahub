<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\loans_statement_of_account;
use Illuminate\Http\Request;

class Loanssearchlist extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $tipo;
    public $fecha;
    public $nombre;

    public function updatingSearch()
    {
        $this->resetPage();
    }
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
        }
        if("Inversiones Fortuna Panama, S.A."==$this->orgsParent){
            $this->orgsParent="La doña";
        }
        $loans = loans_statement_of_account::when($this->tipo, function ($query) {
            $query->where('loan_type', $this->tipo);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->fecha, function ($query) {
            $query->where('datetrx', $this->fecha);
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->nombre, function ($query) {
            $query->where('nombre', 'ilike', "%$this->nombre%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->when($this->orgsParent, function ($query) {
            $query->where('sucursal','ilike', "%$this->orgsParent%");
        }, function ($query) {
            $query->where(function ($query) {
            });
        })->orderBy('datetrx', 'desc')->paginate(25);
        $this->gotoPage(1);
        return view('livewire.loanssearchlist', [
            'loans' => $loans,
        ]);
    }
}
