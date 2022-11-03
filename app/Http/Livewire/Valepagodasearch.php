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
        $vales = ValesPagoda::select('*');
        if(!empty($searchTerm) && is_numeric($searchTerm))    
            $vales->where('value','=', $searchTerm);
        if(!empty($searchTerm))   { 
            $vales->orWhere('name','like', '%'.$searchTerm.'%');
        }
        return view('livewire.Valepagodasearch',[
            'vales' => $vales->paginate(10)
        ]);
        /*$searchTerm = '%'.$this->searchTerm.'%';
 
        return view('livewire.Valepagodasearch',[
            'vales' => ValesPagoda::where('name','like', $searchTerm)->paginate(10),
        ]);?*/



    }
}
