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
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($datas as $data)
                                        @if (!$datas->isEmpty() || $range->isEmpty())
                                            <div class="row row-cols-1 text-center">
                                                <div class="col">
                                                    <h3 class="display-5 text-danger my-auto">x</h3>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row row-cols-1 row-cols-sm-2">
                                            <div class="col">Cédula:</div>
                                            <div class="col"><b>{{ $data->taxid }}</b></div>
                                            <div class="col">Nombre:</div>
                                            <div class="col"><b>{{ $data->name }}</b></div>
                                            <div class="col">Validado por:</div>
                                            <div class="col"><b>{{ $data->CreatedBy }}</b></div>
                                            <div class="col">En Fecha:</div>
                                            <div class="col"><b>{{ date('d-m-Y', strtotime($data->created_at)) }}</b>
                                            </div>
                                            <div class="col">Sucursal:</div>
                                            <div class="col"><b>{{ $data->AD_Org_ID }}</b></div>
                                            <div class="col">Vale consumido:</div>
                                            <div class="col"><b># {{ $data->value }}</b></div>
                                        </div>
                                    @endforeach
                                @endif
                                @if (isset($range))
                                    @if ($range->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h3 class=" text-danger">El vale no es valido</h3>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="col">
                                @if (isset($datas2))
                                    @if ($datas2->isEmpty() && !$range2->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($datas2 as $data)
                                        @if (!$datas->isEmpty() || $range->isEmpty())
                                            <div class="row row-cols-1 text-center">
                                                <div class="col">
                                                    <h3 class="display-5 text-danger my-auto">x</h3>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row row-cols-1 row-cols-sm-2">
                                            <div class="col">Cédula:</div>
                                            <div class="col"><b>{{ $data->taxid }}</b></div>
                                            <div class="col">Nombre:</div>
                                            <div class="col"><b>{{ $data->name }}</b></div>
                                            <div class="col">Validado por:</div>
                                            <div class="col"><b>{{ $data->CreatedBy }}</b></div>
                                            <div class="col">En Fecha:</div>
                                            <div class="col"><b>{{ date('d-m-Y', strtotime($data->created_at)) }}</b>
                                            </div>
                                            <div class="col">Sucursal:</div>
                                            <div class="col"><b>{{ $data->AD_Org_ID }}</b></div>
                                            <div class="col">Vale consumido:</div>
                                            <div class="col"><b># {{ $data->value }}</b></div>
                                        </div>
                                    @endforeach
                                @endif
                                @if (isset($range2))
                                    @if ($range2->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h3 class=" text-danger">El vale no es valido</h3>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas3))
                                    @if ($datas3->isEmpty() && !$range3->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($datas3 as $data)
                                        @if (!$datas3->isEmpty() || $range3->isEmpty())
                                            <div class="row row-cols-1 text-center">
                                                <div class="col">
                                                    <h3 class="display-5 text-danger my-auto">x</h3>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row row-cols-1 row-cols-sm-2">
                                            <div class="col">Cédula:</div>
                                            <div class="col"><b>{{ $data->taxid }}</b></div>
                                            <div class="col">Nombre:</div>
                                            <div class="col"><b>{{ $data->name }}</b></div>
                                            <div class="col">Validado por:</div>
                                            <div class="col"><b>{{ $data->CreatedBy }}</b></div>
                                            <div class="col">En Fecha:</div>
                                            <div class="col"><b>{{ date('d-m-Y', strtotime($data->created_at)) }}</b>
                                            </div>
                                            <div class="col">Sucursal:</div>
                                            <div class="col"><b>{{ $data->AD_Org_ID }}</b></div>
                                            <div class="col">Vale consumido:</div>
                                            <div class="col"><b># {{ $data->value }}</b></div>
                                        </div>
                                    @endforeach
                                @endif
                                @if (isset($range3))
                                    @if ($range3->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h3 class=" text-danger">El vale no es valido</h3>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas4))
                                    @if ($datas4->isEmpty() && !$range4->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($datas4 as $data)
                                        @if (!$datas4->isEmpty() || $range4->isEmpty())
                                            <div class="row row-cols-1 text-center">
                                                <div class="col">
                                                    <h3 class="display-5 text-danger my-auto">x</h3>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row row-cols-1 row-cols-sm-2">
                                            <div class="col">Cédula:</div>
                                            <div class="col"><b>{{ $data->taxid }}</b></div>
                                            <div class="col">Nombre:</div>
                                            <div class="col"><b>{{ $data->name }}</b></div>
                                            <div class="col">Validado por:</div>
                                            <div class="col"><b>{{ $data->CreatedBy }}</b></div>
                                            <div class="col">En Fecha:</div>
                                            <div class="col"><b>{{ date('d-m-Y', strtotime($data->created_at)) }}</b>
                                            </div>
                                            <div class="col">Sucursal:</div>
                                            <div class="col"><b>{{ $data->AD_Org_ID }}</b></div>
                                            <div class="col">Vale consumido:</div>
                                            <div class="col"><b># {{ $data->value }}</b></div>
                                        </div>
                                    @endforeach
                                @endif
                                @if (isset($range4))
                                    @if ($range4->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h3 class=" text-danger">El vale no es valido</h3>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="col">
                                @if (isset($datas5))
                                    @if ($datas5->isEmpty() && !$range5->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h2 class="display-5 text-success my-auto">&#10004;</h2>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($datas5 as $data)
                                        @if (!$datas5->isEmpty() || $range5->isEmpty())
                                            <div class="row row-cols-1 text-center">
                                                <div class="col">
                                                    <h3 class="display-5 text-danger my-auto">x</h3>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row row-cols-1 row-cols-sm-2">
                                            <div class="col">Cédula:</div>
                                            <div class="col"><b>{{ $data->taxid }}</b></div>
                                            <div class="col">Nombre:</div>
                                            <div class="col"><b>{{ $data->name }}</b></div>
                                            <div class="col">Validado por:</div>
                                            <div class="col"><b>{{ $data->CreatedBy }}</b></div>
                                            <div class="col">En Fecha:</div>
                                            <div class="col"><b>{{ date('d-m-Y', strtotime($data->created_at)) }}</b>
                                            </div>
                                            <div class="col">Sucursal:</div>
                                            <div class="col"><b>{{ $data->AD_Org_ID }}</b></div>
                                            <div class="col">Vale consumido:</div>
                                            <div class="col"><b># {{ $data->value }}</b></div>
                                        </div>
                                    @endforeach
                                @endif
                                @if (isset($range5))
                                    @if ($range5->isEmpty())
                                        <div class="row row-cols-1 text-center">
                                            <div class="col">
                                                <h3 class=" text-danger">El vale no es valido</h3>
                                            </div>
                                        </div>
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
                                        <div class="card text-center bg-primary text-dark bg-opacity-10">
                                            <div class="card-header">
                                                <h5 class="card-title">Total de vales a cambiar: <b>$</b><b
                                                        id="sum"></b> </h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-start">Cédula</p>
                                                <input id="c_taxid" name="" value="" type="text"
                                                    class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                                <br>
                                                <p class="text-start">Nombre</p>
                                                <input id="c_name" name="" value="" type="text"
                                                    class="form-control" placeholder="" onchange="clon()"
                                                    onkeyup="clon()" required>
                                                <br>
                                                <button type="submit" class="btn btn-primary w-100">Guardar</button>
                                                <br><br>
                                                <a href="{{ url('valepagodacancel') }}" class="btn btn-secondary w-100"
                                                    role="button" aria-pressed="true">Cancelar</a>
                                            </div>
                                        </div>



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
