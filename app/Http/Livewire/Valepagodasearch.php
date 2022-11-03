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
        return view('livewire.valepagodasearch',[
            'vales' => ValesPagoda::where('value','=', $searchTerm)->paginate(10)
        ]);


    }
}
