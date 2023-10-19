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
    public $sucursal;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount($sucursal)
    {
        $this->sucursal = $sucursal; // Almacena el valor de 'tipo' desde el primer return
        if($sucursal=="*"){
            $this->sucursal="";
        }
    }
    public function render(Request $request)
    {

        $searchTerm = $this->searchTerm;
        //dd($request->cedula);
        //dd(loans::paginate(10));
        if ($searchTerm == '') {
            $searchTerm = 0;
        }
        $cedula = $request->cedula;
        $nombre = $request->nombre;
        if ($request->cedula_user != null || $request->nombre_user != null) {
            $cedula = $request->cedula_user;
            $nombre = $request->nombre_user;
        }
        //dump(loans_statement_of_account::orwhere('cedula', '=', $cedula)->paginate(25));
        if ($nombre == null) {
            return view('livewire.loanssearch', [
                'loans' => loans_statement_of_account::orwhere('cedula', '=', $cedula)->where('sucursal',$this->sucursal)->orderBy('datetrx', 'desc')->paginate(999),
            ]);
        } else {
            return view('livewire.loanssearch', [
                'loans' => loans_statement_of_account::orwhere('nombre', 'ilike', '%' . $nombre . '%')->where('sucursal',$this->sucursal)->orderBy('datetrx', 'desc')->paginate(999),
            ]);
        }
        //dump($cedula, $nombre);
    }
}
