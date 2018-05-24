// JavaScript Document
$(function(){
	$( "#mensaje" ).keypress(function(e) {
		var conn = document.getElementById('Conexion').value;
		if (e.keyCode == 13) {
			var mensaje=document.getElementById('mensaje').value;
			var idContacto=document.getElementById('contactID').value;
			var datos='mensaje='+encodeURIComponent(mensaje)+'&idContacto='+encodeURIComponent(idContacto);
			var accion='guardar';
			var url=conn+'ajax/chat/guardarMensajes.php';
			crearConexionPost(datos,accion,url);
		}
	});
});


agregarEvento(window,'load',iniciarChat,false);
function iniciarChat(){
	var mensaje=document.getElementById('mensaje');
	mensajesAjax=document.getElementById('mensajesAjax');
	mensajesAjax2=document.getElementById('mensajesAjax2');
	conversacion=document.getElementById('messages-wrapper');
	// agregarEvento(mensaje,'keypress',recogerValores,false);
	t=setInterval('crearConexion3()',1000);
	recogerValores();
}
function recogerValores(e,peticion){
	var conn = document.getElementById('Conexion').value;
	if(e){
		e.preventDefault();
		id=e.target.id;
	}else if(window.event){
		window.event.returnValue=false;
		id=window.event.srcElement.id;
	}
	var idContacto=document.getElementById('contactID').value;
	var datos='chat='+encodeURIComponent(true)+'&idContacto='+encodeURIComponent(idContacto);
	var accion='mostrar';
	var url=conn+'ajax/chat/mostrarConversacion.php';
	crearConexionPost(datos,accion,url);
	// }
	
}
function crearConexionPost(datos,accion,url){
	conexion=crearXMLHttpRequest();
	if(accion=='guardar'){
		conexion.onreadystatechange=guardarMensaje;
	}else if(accion=='mostrar'){
		conexion.onreadystatechange=mostrarMensajes;
	}else{
		alert('Sin accion');
	}
	conexion.open('POST',url,true);
	conexion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	conexion.send(datos);
}
function guardarMensaje(){
	if(conexion.readyState==4){
		mensajesAjax2.innerHTML=conexion.responseText;
		var mensaje=document.getElementById('mensaje').value='';
		recogerValores();
	}else{
		mensajesAjax2.innerHTML='<div class="mensajeAviso letraNegrita">Enviando...</div>';
	}
}
function mostrarMensajes(){
	if(conexion.readyState==4){
		mensajesAjax.innerHTML='';
		if(conexion.responseText=='error'){
			mensajesAjax.innerHTML='<div class="error">El contacto no existe</div>';	
		}else{
			conversacion.innerHTML=conexion.responseText;
			var src=document.getElementById('messages-wrapper').scrollIntoView(true);//mandar el scroll hacia abajo
		}	
	}else{
		mensajesAjax.innerHTML='<div class="mensajeAviso letraNegrita borde-5">Cargando conversacion...</div>';
	}
}
