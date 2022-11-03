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
    
    public function render()
    {
        $searchTerm = $this->searchTerm;
        $vales = ValesPagoda::select('*');
        if(!empty($searchTerm) && is_numeric($searchTerm))    
            $vales->where('value','=', $searchTerm);
        if(!empty($searchTerm))   { 
            $vales->Where('name','like', '%'.$searchTerm.'%');
        }
        return view('livewire.valepagodasearch',[
            'vales' => $vales->paginate(10)
        ]);
        



    }
}
