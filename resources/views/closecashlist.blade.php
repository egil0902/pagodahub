@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="card">
      <div class="card-header">
        Lista de cierres de cuentas
      </div>
      <div class="card-body">
        @livewire('closecashsearch')
      </div>
    </div>
        
</div>
    

@endsection
