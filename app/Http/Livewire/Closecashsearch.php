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
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        $searchTerm = $this->searchTerm;
        if($searchTerm=='')
            $searchTerm=0;
        return view('livewire.closecashsearch',[
            //'closecash' => closecash::where('datetrx','=', $searchTerm)->paginate(10)
            'closecash' => closecash::paginate(25),
        ]);


    }
}
