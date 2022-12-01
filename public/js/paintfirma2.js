/* Variables de Configuracion */
var idcanvas4='canvas4';
var idForm='formcanvas4';
var inputimagen4='imagen4';
var estiloDelCursor='crosshair';
var colorDelTrazo4='black';
var colorDeFondo='#fff';
var grosorDelTrazo4=2;

/* Variables necesarias */
var contexto4=null;
var valX4=0;
var valY4=0;
var flag4=false;
var imagen4=document.getElementById(inputimagen4); 
var anchocanvas4=document.getElementById(idcanvas4).offsetWidth;
var altocanvas4=document.getElementById(idcanvas4).offsetHeight;
var pizarracanvas4=document.getElementById(idcanvas4);
var imgreal=""
/* Esperamos el evento load */
window.addEventListener('load',IniciarDibujo4,false);
window.addEventListener('load',LimpiarTrazado4,false);


function IniciarDibujo4(){
  /* Creamos la pizarra */
  pizarracanvas4.style.cursor=estiloDelCursor;
  contexto4=pizarracanvas4.getContext('2d');
  contexto4.fillStyle=colorDeFondo;
  contexto4.fillRect(0,0,anchocanvas4,altocanvas4);
  contexto4.strokeStyle=colorDelTrazo4;
  contexto4.lineWidth=grosorDelTrazo4;
  contexto4.lineJoin='round';
  contexto4.lineCap='round';
  /* Capturamos los diferentes eventos */
  pizarracanvas4.addEventListener('mousedown',MouseDown4,false);// Click pc
  pizarracanvas4.addEventListener('mouseup',MouseUp4,false);// fin click pc
  pizarracanvas4.addEventListener('mousemove',MouseMove4,false);// arrastrar pc

  pizarracanvas4.addEventListener('touchstart',TouchStart4,false);// tocar pantalla tactil
  pizarracanvas4.addEventListener('touchmove',TouchMove4,false);// arrastras pantalla tactil
  pizarracanvas4.addEventListener('touchend',TouchEnd4,false);// fin tocar pantalla dentro de la pizarra
  pizarracanvas4.addEventListener('touchleave',TouchEnd4,false);// fin tocar pantalla fuera de la pizarra
}

function MouseDown4(e){
  flag4=true;
  contexto4.beginPath();
  valX4=e.pageX-posicionX(pizarracanvas4); valY4=e.pageY-posicionY(pizarracanvas4);
  contexto4.moveTo(valX4,valY4);
}

function MouseUp4(e){
  contexto4.closePath();
  flag4=false;
}

function MouseMove4(e){
  if(flag4){
    contexto4.beginPath();
    contexto4.moveTo(valX4,valY4);
    valX4=e.pageX-posicionX(pizarracanvas4); valY4=e.pageY-posicionY(pizarracanvas4);
    contexto4.lineTo(valX4,valY4);
    contexto4.closePath();
    contexto4.stroke();
  }
}

function TouchMove4(e){
  e.preventDefault();
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseMove4(touch);
  }
}

function TouchStart4(e){
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseDown4(touch);
  }
}

function TouchEnd4(e){
  if (e.targetTouches.length == 1) { 
    var touch = e.targetTouches[0]; 
    MouseUp4(touch);
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
function LimpiarTrazado4(){   
  contexto4=document.getElementById(idcanvas4).getContext('2d');
  contexto4.fillStyle=colorDeFondo;
  contexto4.fillRect(0,0,anchocanvas4,altocanvas4);
  contexto4.drawImage(colorDeFondo, 0, 0);
}
function imp4(){   
 return document.getElementById(idcanvas4).toDataURL('image/png');
}
function b64img4() 
{
  document.getElementById("myText4").value = imp4();
}