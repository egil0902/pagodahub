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
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        
        $searchTerm = $this->searchTerm;
        if($searchTerm=='')
            $searchTerm=0;
        return view('livewire.valepagodasearch',[
            //'vales' => ValesPagoda::where('value','=', $searchTerm)->paginate(10)
            'vales' => ValesPagoda::orderBy('value', 'asc')->orderBy('id', 'asc')->paginate(25),
        ]);


    }
}
