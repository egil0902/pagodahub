<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\loans;

class Loanssearch extends Component
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
        //dd(loans::paginate(10));
        if($searchTerm=='')
            $searchTerm=0;
        return view('livewire.loanssearch',[
            'loans' => loans::paginate(25),
        ]);
    }
    
}
