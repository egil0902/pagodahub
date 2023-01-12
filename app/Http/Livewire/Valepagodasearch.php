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
    public $valenum;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {

        if ($this->valenum != null) {
            return view('livewire.valepagodasearch',[
                //'vales' => ValesPagoda::where('value','=', $searchTerm)->paginate(10)
                'vales' => ValesPagoda::where('value', 'ilike', '%' . $this->valenum . '%')->orderBy('value', 'asc')->orderBy('id', 'asc')->paginate(25),
            ]);
        } else {
            return view('livewire.valepagodasearch',[
                //'vales' => ValesPagoda::where('value','=', $searchTerm)->paginate(10)
                'vales' => ValesPagoda::orderBy('value', 'asc')->orderBy('id', 'asc')->paginate(25),
            ]);
        }
    }

}
