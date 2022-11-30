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
        if($searchTerm=='')
            $searchTerm=0;
        return view('livewire.loanssearch',[
            'loans' => loans::paginate(10),
        ]);


    }
    
}
