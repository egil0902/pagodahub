/* Variables de Configuracion */
var idcanvas3='canvas3';
var idForm='formcanvas3';
var inputimagen3='imagen3';
var estiloDelCursor='crosshair';
var colorDelTrazo3='black';
var colorDeFondo='#fff';
var grosorDelTrazo3=2;

/* Variables necesarias */
var contexto3=null;
var valX3=0;
var valY3=0;
var flag3=false;
var imagen3=document.getElementById(inputimagen3); 
var anchocanvas3=document.getElementById(idcanvas3).offsetWidth;
var altocanvas3=document.getElementById(idcanvas3).offsetHeight;
var pizarracanvas3=document.getElementById(idcanvas3);
var imgreal=""
/* Esperamos el evento load */
window.addEventListener('load',IniciarDibujo3,false);
window.addEventListener('load',LimpiarTrazado3,false);


function IniciarDibujo3(){
  /* Creamos la pizarra */
  pizarracanvas3.style.cursor=estiloDelCursor;
  contexto3=pizarracanvas3.getContext('2d');
  contexto3.fillStyle=colorDeFondo;
  contexto3.fillRect(0,0,anchocanvas3,altocanvas3);
  contexto3.strokeStyle=colorDelTrazo3;
  contexto3.lineWidth=grosorDelTrazo3;
  contexto3.lineJoin='round';
  contexto3.lineCap='round';
  /* Capturamos los diferentes eventos */
  pizarracanvas3.addEventListener('mousedown',MouseDown3,false);// Click pc
  pizarracanvas3.addEventListener('mouseup',MouseUp3,false);// fin click pc
  pizarracanvas3.addEventListener('mousemove',MouseMove3,false);// arrastrar pc

  pizarracanvas3.addEventListener('touchstart',TouchStart3,false);// tocar pantalla tactil
  pizarracanvas3.addEventListener('touchmove',TouchMove3,false);// arrastras pantalla tactil
  pizarracanvas3.addEventListener('touchend',TouchEnd3,false);// fin tocar pantalla dentro de la pizarra
  pizarracanvas3.addEventListener('touchleave',TouchEnd3,false);// fin tocar pantalla fuera de la pizarra
}

function MouseDown3(e){
  flag3=true;
  contexto3.beginPath();
  valX3=e.pageX-posicionX(pizarracanvas3); valY3=e.pageY-posicionY(pizarracanvas3);
  contexto3.moveTo(valX3,valY3);
}

function MouseUp3(e){
  contexto3.closePath();
  flag3=false;
}

function MouseMove3(e){
  if(flag3){
    contexto3.beginPath();
    contexto3.moveTo(valX3,valY3);
    valX3=e.pageX-posicionX(pizarracanvas3); valY3=e.pageY-posicionY(pizarracanvas3);
    contexto3.lineTo(valX3,valY3);
    contexto3.closePath();
    contexto3.stroke();
  }
}

function TouchMove3(e){
  e.preventDefault();
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseMove3(touch);
  }
}

function TouchStart3(e){
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseDown3(touch);
  }
}

function TouchEnd3(e){
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseUp3(touch);
  }
}
function posicionY(obj) {
  var valor = obj.offsetTop;
  if (obj.offsetParent) valor += posicionY(obj.offsetParent);
  return valor;
}
function posicionX(obj) {
  var valor = obj.offsetLeft;
  if (obj.offsetParent) valor += posicionX(obj.offsetParent);
  return valor;
}
/* Limpiar pizarra */
function LimpiarTrazado3(){   
  contexto3=document.getElementById(idcanvas3).getContext('2d');
  contexto3.fillStyle=colorDeFondo;
  contexto3.fillRect(0,0,anchocanvas3,altocanvas3);
  contexto3.drawImage(colorDeFondo, 0, 0);
}
function imp3(){   
 return document.getElementById(idcanvas3).toDataURL('image/png');
}
function b64img3() 
{
  document.getElementById("myText3").value = imp3();
}