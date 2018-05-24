// JavaScript Document
function crearConexion3(){
	var conn = document.getElementById('Conexion').value;
	var idContacto=document.getElementById('contactID').value;
	var datos='verificarConversacion='+encodeURIComponent(true)+'&idContacto='+encodeURIComponent(idContacto);
	conexion3=crearXMLHttpRequest();
	conexion3.onreadystatechange=mostrarEstadoConversacion;
	conexion3.open('POST',conn+'ajax/chat/estadoConversacion.php',true);
	conexion3.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	console.log(datos);
	conexion3.send(datos);
}
function mostrarEstadoConversacion(){
	if(conexion3.readyState==4){
		var trimmedResponse = conexion3.responseText.replace(/^\s*/,'').replace(/\s*$/,'').toLowerCase();
		if(trimmedResponse == 'true'){
			recogerValores();
		}
	}
}
