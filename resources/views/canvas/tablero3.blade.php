<!-- creamos el camvas -->

    <canvas id='canvas3'  width="250" height="100" style='border: 1px solid #CCC;'>
        <p>Tu navegador no soporta canvas</p>
    </canvas>


<!-- creamos el form para el envio -->

@csrf
<input type='hidden' name='imagen3' id='imagen3' />
<br>
<button class="btn btn-primary mh-100" type='button' onclick='LimpiarTrazado3()'>Borrar</button>
<script src="js/paintfirma.js"></script>
