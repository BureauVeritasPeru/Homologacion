<?php
if(isset($_POST['verificarConversacion'])){
	session_start();
	require_once("../../../config/main.php");
	require_once("../../../app/include/admin/header_ajax.php");

	$idUsuario=$_SESSION['id'];
	$idContacto=$_POST['idContacto'];
	$type = $_SESSION['type'];
	$oListMessage = CrmChat::getListCantMessage($idUsuario,$idContacto,$type);
	$conversacionActual=count($oListMessage);
	if($_SESSION['conversacionAnterior']<$conversacionActual){
		echo "true";
	}else{
		echo "false";
	}
}else{
	echo"error";
}
?>