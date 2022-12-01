/* Variables de Configuracion */
var idcanvas5='canvas5';
var idForm='formcanvas5';
var inputimagen5='imagen5';
var estiloDelCursor='crosshair';
var colorDelTrazo5='black';
var colorDeFondo='#fff';
var grosorDelTrazo5=2;

/* Variables necesarias */
var contexto5=null;
var valX5=0;
var valY5=0;
var flag5=false;
var imagen5=document.getElementById(inputimagen5); 
var anchocanvas5=document.getElementById(idcanvas5).offsetWidth;
var altocanvas5=document.getElementById(idcanvas5).offsetHeight;
var pizarracanvas5=document.getElementById(idcanvas5);
var imgreal=""
/* Esperamos el evento load */
window.addEventListener('load',IniciarDibujo5,false);
window.addEventListener('load',LimpiarTrazado5,false);


function IniciarDibujo5(){
  /* Creamos la pizarra */
  pizarracanvas5.style.cursor=estiloDelCursor;
  contexto5=pizarracanvas5.getContext('2d');
  contexto5.fillStyle=colorDeFondo;
  contexto5.fillRect(0,0,anchocanvas5,altocanvas5);
  contexto5.strokeStyle=colorDelTrazo5;
  contexto5.lineWidth=grosorDelTrazo5;
  contexto5.lineJoin='round';
  contexto5.lineCap='round';
  /* Capturamos los diferentes eventos */
  pizarracanvas5.addEventListener('mousedown',MouseDown5,false);// Click pc
  pizarracanvas5.addEventListener('mouseup',MouseUp5,false);// fin click pc
  pizarracanvas5.addEventListener('mousemove',MouseMove5,false);// arrastrar pc

  pizarracanvas5.addEventListener('touchstart',TouchStart5,false);// tocar pantalla tactil
  pizarracanvas5.addEventListener('touchmove',TouchMove5,false);// arrastras pantalla tactil
  pizarracanvas5.addEventListener('touchend',TouchEnd5,false);// fin tocar pantalla dentro de la pizarra
  pizarracanvas5.addEventListener('touchleave',TouchEnd5,false);// fin tocar pantalla fuera de la pizarra
}

function MouseDown5(e){
  flag5=true;
  contexto5.beginPath();
  valX5=e.pageX-posicionX(pizarracanvas5); valY5=e.pageY-posicionY(pizarracanvas5);
  contexto5.moveTo(valX5,valY5);
}

function MouseUp5(e){
  contexto5.closePath();
  flag5=false;
}

function MouseMove5(e){
  if(flag5){
    contexto5.beginPath();
    contexto5.moveTo(valX5,valY5);
    valX5=e.pageX-posicionX(pizarracanvas5); valY5=e.pageY-posicionY(pizarracanvas5);
    contexto5.lineTo(valX5,valY5);
    contexto5.closePath();
    contexto5.stroke();
  }
}

function TouchMove5(e){
  e.preventDefault();
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseMove5(touch);
  }
}

function TouchStart5(e){
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseDown5(touch);
  }
}

function TouchEnd5(e){
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseUp5(touch);
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
function LimpiarTrazado5(){   
  contexto5=document.getElementById(idcanvas5).getContext('2d');
  contexto5.fillStyle=colorDeFondo;
  contexto5.fillRect(0,0,anchocanvas5,altocanvas5);
  contexto5.drawImage(colorDeFondo, 0, 0);
}
function imp5(){   
 return document.getElementById(idcanvas5).toDataURL('image/png');
}
function b64img5() 
{
  document.getElementById("myText5").value = imp5();
}