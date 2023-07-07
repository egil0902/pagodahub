<?php

namespace App\Http\Livewire;
use App\Models\Facture;

use Livewire\Component;
use Livewire\WithPagination;

class FactureList extends Component
{
    public function render()
    {
        $facturas = Facture::orderBy('fecha', 'desc')->get(); // Obtener todos los facturas de la tabla
        return view('livewire.facture', [
            'facturas' => $facturas,
        ]);
    }
}
