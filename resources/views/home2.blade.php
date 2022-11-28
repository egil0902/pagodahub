<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>

<body>
  <x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Home') }}
      </h2>
    </x-slot>


    <div class="py-5 text-center text-white align-items-center d-flex h-50" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url(https://static.pingendo.com/cover-bubble-dark.svg);  background-position: center center, center center;  background-size: cover, cover;  background-repeat: repeat, repeat;">
      <div class="container py-5">
        <div class="row">
          <div class="mx-auto col-lg-8 col-md-10">
            <h3 class="display-3">Pagoda Hub</h3>
            <h3>Sistema web integrado de control y seguimiento gerencial de las empresas del Grupo la Pagoda</h3>
          </div>
        </div>
      </div>
    </div>
    <form name="close_cash" id="close_cash" method="post" action="{{ route('close.cash') }}">
      @csrf
      <div class="text-center py-1 align-items-center ">
        <div class="container ">
          <div class="row">
            <div class="mx-auto col-lg-8 col-md-10">
              <label for="cars">Seleccione una sucursal</label>

              <select name="AD_Org_ID" id="AD_Org_ID">
                <option value="Mañanitas">Mañanitas</option>
                <option value="La dona">La dona</option>
                <option value="Pacora">Pacora</option>
                <option value="Cerro azul">Cerro azul</option>
              </select>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="mx-auto col-lg-8 col-md-10">
          <div class="py-5">
            <div class="container">
              <div class="row h-75">
                <div class="col-md-4" style="">
                  <button type="submit" class="btn ">
                    <div class="card h-100">
                      <div class="card-header"> 1. Cuentas</div>
                      <div class="card-body">
                        <h4>Cierre diario de cuentas</h4>
                        <p>Permite el cierre diario de las cuentas para auditoría</p>

                      </div>
                    </div>
                  </button>
                </div>
    </form>
    <div class="col-md-4" style="">
      <a href="#">
        <div class="card">
          <div class="card-header"> 2. Facturas</div>
          <div class="card-body">
            <h4>Control de la facturas a crédito, efectivo...</h4>
            <p>Permite el control de todas las facturas de compra que se reciben en el dia con adjuntos</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-4" style="">
      <a href="#">
        <div class="card">
          <div class="card-header"> 3. Mercados</div>
          <div class="card-body">
            <h4>Gestión operativa de compras en efectivo</h4>
            <p>Manejo de las compras en efectivo, confirmacion de la recepcion de la compra, manejo de las cuentas por pagar relacionadas con esa compra</p>
          </div>
        </div>
      </a>
    </div>
    </div>
    </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header"> 4. Banco</div>
                <div class="card-body">
                  <h4>Registros de depósitos bancarios</h4>
                  <p>Resgitro de comprobantes (voucher) para el manejo de los depositos con la validacion del mismo</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header"> 5. Créditos</div>
                <div class="card-body">
                  <h4>Registro y control de créditos otorgados</h4>
                  <p>Creacion y administración de créditos otorgados (JC Mañanitas)</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#">
              <div class="card">
                <div class="card-header"> 6. Paisanos</div>
                <div class="card-body">
                  <h4>Control de pagos a paisanos</h4>
                  <p>Gestion de los gagos, fechas y notas de los pagos con firma digital</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header"> 7. Empleados Extra</div>
                <div class="card-body">
                  <h4>Gestión de empleados eventuales</h4>
                  <p>Gestiona los pagos realizados a los trabajadores eventuales de la empresa</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header"> 8. Conciliación de cuentas</div>
                <div class="card-body">
                  <h4>Conciliación automática de las cuentas bancarias</h4>
                  <p>Importación de archivos automáticos para el manejo de la conciliación de los movimientos en las cuentas bancarias</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#">
              <div class="card">
                <div class="card-header"> 9. Pesaje de Carnicería</div>
                <div class="card-body">
                  <h4>Pesaje de los productos por proveedor</h4>
                  <p>Control de la recepción de los pesos en la carniceria del supermercado</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header"> 10. Pago de Espacios</div>
                <div class="card-body">
                  <h4>Control del contrato de espacios publicitarios</h4>
                  <p>Creación del contrato definicion del tiempo monto y descripciones generales del contrato. Emision automática</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header">11. Bancos Supervisor</div>
                <div class="card-body">
                  <h4>Cierre de caja de supervisor</h4>
                  <p>Gestión del dinero entregado como caja a cada supervisor para la gestión operativa del dia</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#">
              <div class="card">
                <div class="card-header"> 12. Producción Panadería</div>
                <div class="card-body">
                  <h4>Informes de producción de la panadería</h4>
                  <p contenteditable="true">Gestión de la información relacionada con la panadería</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <a href="#">
              <div class="card">
                <div class="card-header">13. Abonos de productos</div>
                <div class="card-body">
                  <h4>Control de abonos</h4>
                  <p>Registro y control de abonos con adjuntos</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4" style="">
            <form name="valepagoda" id="valepagoda" method="post" action="{{ route('valepagoda') }}">
              @csrf

              <button type="submit" class="btn ">
                <div class="card">
                  <div class="card-header"> 14. Vale pagoda</div>
                  <div class="card-body">
                    <h4>Control de los Vales de la Pagoda</h4>
                    <p>Administración de la numeración de los vales, registro y adjunto</p>
                  </div>
                </div>
              </button>
            </form>
          </div>
          <div class="col-md-4" style="">
            <a href="#">
              <div class="card">
                <div class="card-header"> 15. Ordenes de compra</div>
                <div class="card-body">
                  <h4>Gestión de las ordenes de comrpa</h4>
                  <p>Administración de ordenes de compra a los proveedores</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </x-app-layout>
</body>

</html>