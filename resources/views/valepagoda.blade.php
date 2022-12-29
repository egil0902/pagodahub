@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <body class="p-3 m-0 border-0 bd-example">
        <div class="card">
            <div class="card-header">
                Consultar Vale pagoda
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form name="valepagoda_search" id="valepagoda_search" method="GET"
                        action="{{ route('valepagoda.search') }}">
                        @csrf
                        <label for="cars">Sucursal</label>
                        <select class="form-control w-25" name="AD_Org_ID" id="AD_Org_ID">
                            @if (isset($orgs))
                                @if ($orgs->{'records-size'} > 0)
                                    @foreach ($orgs->records as $org)
                                        <option value="{{ $org->id }}"
                                            {{ isset($request) ? ($org->id == $request->AD_Org_ID ? __('selected') : __('')) : __('') }}>
                                            {{ $org->Name }}</option>
                                    @endforeach
                                @endif
                            @endif
                        </select>
                        <div class="row align-items-end">
                            <div class="col">
                                <br>
                                <label>Numero de vale</label>
                                <input name="value" value="{{ isset($request) ? $request->value : '' }}" type="number"
                                    class="form-control text-left   " placeholder="">
                            </div>
                            <div class="col">
                                <label>Numero de vale</label>
                                <input name="value2" value="{{ isset($request) ? $request->value2 : '' }}" type="number"
                                    class="form-control text-left   " placeholder="">
                            </div>
                            <div class="col">
                                <label>Numero de vale</label>
                                <input name="value3" value="{{ isset($request) ? $request->value3 : '' }}" type="number"
                                    class="form-control text-left   " placeholder="">
                            </div>
                            <div class="col">
                                <label>Numero de vale</label>
                                <input name="value4" value="{{ isset($request) ? $request->value4 : '' }}" type="number"
                                    class="form-control text-left   " placeholder="">
                            </div>
                            <div class="col">
                                <label>Numero de vale</label>
                                <input name="value5" value="{{ isset($request) ? $request->value5 : '' }}" type="number"
                                    class="form-control text-left   " placeholder="">
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col">
                                @if (isset($datas))
                                    @if ($datas->isEmpty() && !$range->isEmpty())
                                        <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                    @endif
                                @endif
                                @if (isset($range))
                                    @if ($range->isEmpty())
                                        <h3 class=" text-danger">El vale no es valido</h3>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas2))
                                    @if ($datas2->isEmpty() && !$range2->isEmpty())
                                        <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                    @endif
                                @endif
                                @if (isset($range2))
                                    @if ($range2->isEmpty())
                                        <h3 class=" text-danger">El vale no es valido</h3>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas3))
                                    @if ($datas3->isEmpty() && !$range3->isEmpty())
                                        <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                    @endif
                                @endif
                                @if (isset($range3))
                                    @if ($range3->isEmpty())
                                        <h3 class=" text-danger">El vale no es valido</h3>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas4))
                                    @if ($datas4->isEmpty() && !$range4->isEmpty())
                                        <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                    @endif
                                @endif
                                @if (isset($range4))
                                    @if ($range4->isEmpty())
                                        <h3 class=" text-danger">El vale no es valido</h3>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas5))
                                    @if ($datas5->isEmpty() && !$range5->isEmpty())
                                        <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                    @endif
                                @endif
                                @if (isset($range5))
                                    @if ($range5->isEmpty())
                                        <h3 class=" text-danger">El vale no es valido</h3>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            @if ((!isset($datas) || !$datas->isEmpty() || $range->isEmpty()) &&
                                (!isset($datas2) || !$datas2->isEmpty() || $range2->isEmpty()) &&
                                (!isset($datas3) || !$datas3->isEmpty() || $range3->isEmpty()) &&
                                (!isset($datas4) || !$datas4->isEmpty() || $range4->isEmpty()) &&
                                (!isset($datas5) || !$datas5->isEmpty() || $range5->isEmpty()))
                                <br>
                                <button type="submit" class="btn btn-primary w-100">Buscar</button>
                            @endif
                        </div>
                    </form>
                    <br>

                    <div class="row align-items-end">
                        <div class="col">
                            @if (isset($datas) || isset($datas2) || isset($datas3) || isset($datas4) || isset($datas5))
                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($datas as $data)
                                            <p class="fw-bold"><span class="fw-light">Cédula:
                                                </span>{{ $data->taxid }}<span class="fw-light"> Nombre:
                                                </span>{{ $data->name }}</p>
                                            <p class="fw-bold"><span class="fw-light">Validado por: </span>
                                                {{ $data->CreatedBy }}
                                                <span class="fw-light">En Fecha: </span>
                                                {{ date('d-m-Y', strtotime($data->created_at)) }}
                                            </p>
                                            <p class="fw-bold"><span class="fw-light">Sucursal: </span>
                                                {{ $data->AD_Org_ID }}
                                            </p>
                                        @endforeach
                                        @foreach ($datas as $data)
                                            <p>Vale consumido:</p>
                                            <p># {{ $data->value }}</p>
                                        @endforeach
                                        @foreach ($datas2 as $data2)
                                            <p>Vale consumido:</p>
                                            <p># {{ $data2->value }}</p>
                                        @endforeach
                                        @foreach ($datas3 as $data3)
                                            <p>Vale consumido:</p>
                                            <p># {{ $data3->value }}</p>
                                        @endforeach
                                        @foreach ($datas4 as $data4)
                                            <p>Vale consumido:</p>
                                            <p># {{ $data4->value }}</p>
                                        @endforeach
                                        @foreach ($datas5 as $data5)
                                            <p>Vale consumido:</p>
                                            <p>#{{ $data5->value }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (isset($datas) || isset($datas2) || isset($datas3) || isset($datas4) || isset($datas5))
                        @if (($datas->isEmpty() && !$range->isEmpty()) ||
                            ($datas2->isEmpty() && !$range2->isEmpty()) ||
                            ($datas3->isEmpty() && !$range3->isEmpty()) ||
                            ($datas4->isEmpty() && !$range4->isEmpty()) ||
                            ($datas5->isEmpty() && !$range5->isEmpty()))
                            <form name="valepagoda_store" id="valepagoda_store" method="GET"
                                action="{{ route('valepagoda.store') }}">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col">
                                        @if ($datas->isEmpty())
                                            @foreach ($range as $data)
                                                <input id="01" name="" value="{{ $data->amount }}"
                                                    type="hidden" class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                            @endforeach
                                        @endif

                                        @if ($datas2->isEmpty())
                                            @foreach ($range2 as $data)
                                                <input id="02" name="" value="{{ $data->amount }}"
                                                    type="hidden" class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                            @endforeach
                                        @endif

                                        @if ($datas3->isEmpty())
                                            @foreach ($range3 as $data)
                                                <input id="03" name="" value="{{ $data->amount }}"
                                                    type="hidden" class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                            @endforeach
                                        @endif

                                        @if ($datas4->isEmpty())
                                            @foreach ($range4 as $data)
                                                <input id="04" name="" value="{{ $data->amount }}"
                                                    type="hidden" class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                            @endforeach
                                        @endif

                                        @if ($datas5->isEmpty())
                                            @foreach ($range5 as $data)
                                                <input id="05" name="" value="{{ $data->amount }}"
                                                    type="hidden" class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                            @endforeach
                                        @endif

                                        <br>
                                        <p>Total de vales a cambiar:</p>
                                        <p id="sum"></p>
                                        <label>Cédula</label>
                                        <input id="c_taxid" name="" value="" type="text"
                                            class="form-control" placeholder="" onchange="clon()" onkeyup="clon()"
                                            required>
                                        <label>Nombre</label>
                                        <input id="c_name" name="" value="" type="text"
                                            class="form-control" placeholder="" onchange="clon()" onkeyup="clon()"
                                            required>
                                        <script>
                                            let n1 = 0;
                                            let n2 = 0;
                                            let n3 = 0;
                                            let n4 = 0;
                                            let n5 = 0;
                                            if (document.getElementById("01")) {
                                                n1 = document.getElementById("01").value;
                                            } else {
                                                n1 = 0;
                                            }
                                            if (document.getElementById("02")) {
                                                n2 = document.getElementById("02").value;
                                            } else {
                                                n2 = 0;
                                            }
                                            if (document.getElementById("03")) {
                                                n3 = document.getElementById("03").value;
                                            } else {
                                                n3 = 0;
                                            }
                                            if (document.getElementById("04")) {
                                                n4 = document.getElementById("04").value;
                                            } else {
                                                n4 = 0;
                                            }
                                            if (document.getElementById("05")) {
                                                n5 = document.getElementById("05").value;
                                            } else {
                                                n5 = 0;
                                            }
                                            document.getElementById("sum").innerHTML = parseFloat(n1) + parseFloat(n2) + parseFloat(n3) + parseFloat(n4) +
                                                parseFloat(n5);

                                            function clon() {

                                                if (document.getElementById("name1") !== null || document.getElementById("taxid1") !== null) {
                                                    document.getElementById("name1").value = document.getElementById("c_name").value;
                                                    document.getElementById("taxid1").value = document.getElementById("c_taxid").value;
                                                }
                                                if (document.getElementById("name2") !== null || document.getElementById("taxid2") !== null) {
                                                    document.getElementById("name2").value = document.getElementById("c_name").value;
                                                    document.getElementById("taxid2").value = document.getElementById("c_taxid").value;
                                                }
                                                if (document.getElementById("name3") !== null || document.getElementById("taxid3") !== null) {
                                                    document.getElementById("name3").value = document.getElementById("c_name").value;
                                                    document.getElementById("taxid3").value = document.getElementById("c_taxid").value;
                                                }
                                                if (document.getElementById("name4") !== null || document.getElementById("taxid4") !== null) {
                                                    document.getElementById("name4").value = document.getElementById("c_name").value;
                                                    document.getElementById("taxid4").value = document.getElementById("c_taxid").value;
                                                }
                                                if (document.getElementById("name5") !== null || document.getElementById("taxid5") !== null) {
                                                    document.getElementById("name5").value = document.getElementById("c_name").value;
                                                    document.getElementById("taxid5").value = document.getElementById("c_taxid").value;
                                                }

                                            }
                                        </script>
                                    </div>
                                    <br>
                                    @if (isset($datas))
                                        @if ($datas->isEmpty() && !$range->isEmpty())
                                            <input name="AD_Org_ID"
                                                value="{{ isset($request) ? $request->AD_Org_ID : '' }}" type="hidden"
                                                class="form-control" placeholder="">
                                            <input name="value" value="{{ isset($request) ? $request->value : '' }}"
                                                type="hidden" class="form-control" placeholder="">
                                            <input name="CreatedBy" value="{{ auth()->user()->name }}" type="hidden"
                                                class="form-control">

                                            <input id="taxid1" name="taxid" value="" type="hidden"
                                                class=" form-control text-left  w-100 " placeholder="" required>

                                            <input id="name1" name="name" value="" type="hidden"
                                                class="form-control text-left" placeholder="" required>
                                        @endif
                                    @endif
                                    @if (isset($datas2))
                                        @if ($datas2->isEmpty() && !$range2->isEmpty())
                                            <input name="AD_Org_ID2"
                                                value="{{ isset($request) ? $request->AD_Org_ID : '' }}" type="hidden"
                                                class="form-control" placeholder="">
                                            <input name="value2" value="{{ isset($request) ? $request->value2 : '' }}"
                                                type="hidden" class="form-control" placeholder="">
                                            <input name="CreatedBy2" value="{{ auth()->user()->name }}" type="hidden"
                                                class="form-control">

                                            <input id="taxid2" name="taxid2" value="" type="hidden"
                                                class=" form-control text-left  w-100 " placeholder="" required>

                                            <input id="name2" name="name2" value="" type="hidden"
                                                class="form-control text-left" placeholder="" required>
                                        @endif
                                    @endif

                                    @if (isset($datas3))
                                        @if ($datas3->isEmpty() && !$range3->isEmpty())
                                            <input name="AD_Org_ID3"
                                                value="{{ isset($request) ? $request->AD_Org_ID : '' }}" type="hidden"
                                                class="form-control" placeholder="">
                                            <input name="value3" value="{{ isset($request) ? $request->value3 : '' }}"
                                                type="hidden" class="form-control" placeholder="">
                                            <input name="CreatedBy3" value="{{ auth()->user()->name }}" type="hidden"
                                                class="form-control">

                                            <input id="taxid3" name="taxid3" value="" type="hidden"
                                                class=" form-control text-left  w-100 " placeholder="" required>

                                            <input id="name3" name="name3" value="" type="hidden"
                                                class="form-control text-left" placeholder="" required>
                                        @endif
                                    @endif

                                    @if (isset($datas4))
                                        @if ($datas4->isEmpty() && !$range4->isEmpty())
                                            <input name="AD_Org_ID4"
                                                value="{{ isset($request) ? $request->AD_Org_ID : '' }}" type="hidden"
                                                class="form-control" placeholder="">
                                            <input name="value4" value="{{ isset($request) ? $request->value4 : '' }}"
                                                type="hidden" class="form-control" placeholder="">
                                            <input name="CreatedBy4" value="{{ auth()->user()->name }}" type="hidden"
                                                class="form-control">

                                            <input id="taxid4" name="taxid4" value="" type="hidden"
                                                class=" form-control text-left  w-100 " placeholder="" required>

                                            <input id="name4" name="name4" value="" type="hidden"
                                                class="form-control text-left" placeholder="" required>
                                        @endif
                                    @endif

                                    @if (isset($datas5))
                                        @if ($datas5->isEmpty() && !$range5->isEmpty())
                                            <input name="AD_Org_ID5"
                                                value="{{ isset($request) ? $request->AD_Org_ID : '' }}" type="hidden"
                                                class="form-control" placeholder="">
                                            <input name="value5" value="{{ isset($request) ? $request->value5 : '' }}"
                                                type="hidden" class="form-control" placeholder="">
                                            <input name="CreatedBy5" value="{{ auth()->user()->name }}" type="hidden"
                                                class="form-control">

                                            <input id="taxid5" name="taxid5" value="" type="hidden"
                                                class=" form-control text-left  w-100 " placeholder="" required>

                                            <input id="name5" name="name5" value="" type="hidden"
                                                class="form-control text-left" placeholder="" required>
                                        @endif
                                    @endif


                                    <button type="submit" class="btn btn-primary w-100">Guardar</button>
                                    <br>
                                    <a href="{{ url('valepagodacancel') }}" class="btn btn-secondary w-100"
                                        role="button" aria-pressed="true">Cancelar</a>
                                </div>
                            </form>
                        @endif
                    @else
                    @endif
                </div>
            </div>
        </div>
    </body>
@endsection
