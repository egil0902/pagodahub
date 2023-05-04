@extends('layouts.app')

@section('content')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript de Bootstrap -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script> --}}


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="card w-auto">
            <div class="card-header">
                Compra
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="card-body">
                        {{-- @if (session('mensaje'))
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif --}}
                        <!-- Modal para mostrar el mensaje -->
                        <div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog"
                            aria-labelledby="mensajeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mensajeModalLabel">Mensaje de éxito</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Cerrar">
                                            <span aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ session('mensaje') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sección de scripts -->
                        @if (session('mensaje'))
                            <script>
                                $(document).ready(function() {
                                    $('#mensajeModal').modal('show');
                                });
                            </script>
                        @endif
                        <form name="market" id="market" method="post" action="{{ route('market.store') }}">
                            <br>
                            @csrf
                            <div id="formContainer">
                                <br>
                                {{-- <label for="unidad">Unidad de medida:</label>
                                <input type="text" name="unidad" list="opciones">
                                <datalist id="opciones">
                                    @foreach ($opciones as $unidad)
                                        <option value="{{ $unidad->name }}">
                                    @endforeach
                                </datalist> --}}
                                <div class="container text-center">
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3">
                                        <div class="col"><label for="" class="form-label">Fecha</label>
                                            <input class="form-control" type="date" name="date-day" id=""
                                                required>
                                        </div>
                                        <div class="col"><label for=""
                                                class="form-label">{{-- Comprador --}}</label>
                                            <input class="form-control" type="text" name="comprador" id=""
                                                value="{{ Auth::user()->name }}" readonly style="display:none">
                                        </div>
                                        <div class="col"><label for="" class="form-label">Presupuesto</label>
                                            <input class="form-control" type="number" name="Presupuesto" id=""
                                                step="0.01" required>
                                        </div>
                                        {{-- <div class="col">Column</div> --}}
                                    </div>
                                </div>


                                <br>
                                <div class="form-group" style="" id="formGroup0">
                                    <label for="exampleDataList" class="form-label">Productos</label>
                                    <input class="form-control product" list="datalistOptions" name="product[]"
                                        placeholder="Escribe para buscar...">
                                    <datalist id="datalistOptions">
                                        @foreach ($opciones2 as $producto)
                                            <option value="{{ $producto->name }}"></option>
                                        @endforeach
                                    </datalist>
                                    <br>
                                    <label for="formGroupExampleInput" class="form-label">Unidad de Medida</label>
                                    <!---<input class="form-control unit" list="opciones" name="unit[]"
                                        placeholder="Escribe para buscar...">
                                    <datalist id="opciones">
                                        @foreach ($opciones as $unidad_de_medida)
                                            <option value="{{ $unidad_de_medida->name }}"></option>
                                        @endforeach
                                    </datalist>--->
                                    <select class="form-control unit" list="opciones"  name="unit[]">
                                        <option value="Sacos">Sacos</option>
                                        <option value="Libras">Libras</option>
                                        <option value="Kilos">Kilos</option>
                                        <option value="Unidades">Unidades</option>
                                        <option value="Galones">Galones</option>
                                    </select>
                                    <br>
                                    <label for="formGroupExampleInput" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control quantity" name="quantity[]"
                                        placeholder="Cantidad #">
                                </div>
                            </div>
                            <br>
                            <br>
                            <center>
                                <button type="button" id="addBtn" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z">
                                        </path>
                                        <path
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                                        </path>
                                    </svg>
                                    Añadir Producto
                                </button>

                            </center>

                            <br>
                            <p id="counter"><b>Registros de productos: <span>0</span> </b></p>
                            <table style="width:100%; border:1px solid black;" id="productList">
                            </table>
                            <br>
                            <button type="submit" class="btn btn-outline-success w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z">
                                    </path>
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z">
                                    </path>
                                </svg>
                                Guardar
                            </button>

                        </form>
                    </div>
                </div>

                <script>
                    const formContainer = document.getElementById("formContainer");
                    const addBtn = document.getElementById("addBtn");
                    const productList = document.getElementById("productList");
                    const counter = document.getElementById("counter");
                    let count = 0;
                    let n = 0;
                    addBtn.addEventListener("click", function() {
                        if (formContainer.getElementsByClassName("form-group")[n].getElementsByClassName("product")[0].value != '' &&
                        formContainer.getElementsByClassName("form-group")[n].getElementsByClassName("unit")[0].value != '' &&
                        formContainer.getElementsByClassName("form-group")[n].getElementsByClassName("quantity")[0].value != ''
                    ) {
                        count++;
                        n = count;
                        const formGroup = formContainer.getElementsByClassName("form-group")[n - 1];
                        const newFormGroup = formGroup.cloneNode(true);
                        formContainer.getElementsByClassName("form-group")[n - 1].setAttribute('style', 'display:none');
                        newFormGroup.id = "formGroup" + count;
                        formContainer.appendChild(newFormGroup);
                        counter.getElementsByTagName("span")[0].innerHTML = count;
                        formContainer.getElementsByClassName("form-group")[n].getElementsByClassName("product")[0].value = "";
                        formContainer.getElementsByClassName("form-group")[n].getElementsByClassName("unit")[0].value = "";
                        formContainer.getElementsByClassName("form-group")[n].getElementsByClassName("quantity")[0].value = "";
                        window.alert("Producto añadido");
                    } else {}
                    });

                    function updateProductList() {
                    productList.innerHTML = "<thead><tr><th>#</th><th>Producto</th><th>Unidad</th><th>Cantidad</th><th></th></tr></thead>";
                    const products = document.getElementsByClassName("product");
                    const units = document.getElementsByName("unit[]");
                    const quantities = document.getElementsByClassName("quantity");
                    for (let i = 0; i < products.length; i++) {
                        const product = products[i].value;
                        const unit = units[i].value;
                        const quantity = quantities[i].value;
                        const num = i + 1;
                        if (product && unit && quantity) {
                        const row = document.createElement("tr");
                        const productCell = document.createElement("td");
                        const unitCell = document.createElement("td");
                        const quantityCell = document.createElement("td");
                        const numCell = document.createElement("td");
                        const deleteCell = document.createElement("td");
                        const deleteButton = document.createElement("button");
                         deleteButton.innerText = "Borrar";
                        deleteButton.classList.add("btn", "btn-danger");
                        deleteButton.id = "deleteButton" + i;
                        deleteButton.addEventListener("click", function() {
                            const rowToRemove = document.getElementById("row" + i);
                            rowToRemove.parentNode.removeChild(rowToRemove);
                        });
                        numCell.textContent = num;
                        productCell.textContent = product;
                        unitCell.textContent = unit;
                        quantityCell.textContent = quantity;
                        deleteCell.appendChild(deleteButton);
                        row.id = "row" + i;
                        row.appendChild(numCell);
                        row.appendChild(productCell);
                        row.appendChild(unitCell);
                        row.appendChild(quantityCell);
                        row.appendChild(deleteCell);
                        productList.appendChild(row);
                        }
                    }
                    }

                    document.addEventListener("input", updateProductList);
                </script>

                <style>
                    table {
                        font-family: arial, sans-serif;
                        background-color: white;
                        text-align: left;
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th,
                    td {
                        padding: 1px;

                    }

                    thead {
                        background-color: #246355;
                        border-bottom: solid 5px #0F362D;
                        color: white;
                    }

                    #theadtotal {
                        background-color: #1b6453;
                        border-bottom: solid 2.5px #268c74;
                        border-top: solid 2.5px #268c74;
                        color: white;
                    }

                    tr:nth-child(even) {
                        background-color: #ddd;
                    }

                    tr:hover td {
                        background-color: #369681;
                        color: white;
                    }
                </style>

            </div>
        </div>
    </div>
@endsection
