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

    public function render()
    {
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
        })->orderBy('datetrx', 'desc')->paginate(25);
        $this->gotoPage(1);
        return view('livewire.loanssearchlist', [
            'loans' => $loans,
        ]);
    }
}
