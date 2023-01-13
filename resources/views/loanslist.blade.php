@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">
      <div class="card-header">
        Listado de prestamos
      </div>
      <div class="card-body">
        @livewire('loanssearchlist')
      </div>
    </div>

</div>


@endsection
