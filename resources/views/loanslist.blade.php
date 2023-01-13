@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
      <div class="card-header">
        Listado de prestamos
      </div>
      <div class="card-body">
        @livewire('loanssearchlist')
      </div>
    </div>

</div>


@endsection
