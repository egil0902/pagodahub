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
    public $tipo = "Sucursal";
    public $date = "";
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {


        if ($this->date != "") {
            return view('livewire.closecashsearch', [
                'closecash' => closecash::where('DateTrx', $this->date)->orderBy('DateTrx', 'desc')->paginate(25),
            ]);
        } else {
            if ($this->tipo != "Sucursal") {
                return view('livewire.closecashsearch', [
                    'closecash' => closecash::where('AD_Org_ID', $this->tipo)->orderBy('DateTrx', 'desc')->paginate(25),
                ]);
            } else {
                return view('livewire.closecashsearch', [
                    'closecash' => closecash::orderBy('DateTrx', 'desc')->paginate(25),
                ]);
            }
        }
    }
}
