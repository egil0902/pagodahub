@extends('layouts.app')

@section('content')

    <body class="p-3 m-0 border-0 bd-example">

        <div class="card">
            <div class="card-header">
                Lista de vales consumidos
            </div>
            <div class="card-body">
                @livewire('valepagodasearch')
            </div>
        </div>

    </body>
@endsection
