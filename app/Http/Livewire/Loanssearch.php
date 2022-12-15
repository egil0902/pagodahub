<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\loans_statement_of_account;
use Illuminate\Http\Request;

class Loanssearch extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render(Request $request)
    {
        
        $searchTerm = $this->searchTerm;
        //dd($request->cedula);
        //dd(loans::paginate(10));
        if($searchTerm=='')
            $searchTerm=0;
        return view('livewire.loanssearch',[
            'loans' => loans_statement_of_account::where('cedula','=',$request->cedula)->paginate(25),
        ]);
    }
    
}
