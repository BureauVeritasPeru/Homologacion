// JavaScript Document
agregarEvento(window,'load',crearConexion2,false);
function crearConexion2(){
	var conn = document.getElementById('Conexion').value;
	conexion2=crearXMLHttpRequest();
	conexion2.onreadystatechange=mostrarEstado;
	conexion2.open('POST',conn+'ajax/chat/estadoUsuario.php',true);
	conexion2.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	conexion2.send(null);
}
function mostrarEstado(){
	if(conexion2.readyState==4){
		var actividad=document.getElementById('profile-status');	
		var trimmedResponse = conexion2.responseText.replace(/^\s*/,'').replace(/\s*$/,'').toLowerCase();
		if(trimmedResponse =='true'){
			//actividad.className='actividad alinear-horizontal fondoVerde-1';
			actividad.className += ' online';
		}else if(trimmedResponse=='false'){
			//actividad.className='actvidad alinear-horizontal fondo-rojo';
			actividad.className += ' offline';
		}
	}
}