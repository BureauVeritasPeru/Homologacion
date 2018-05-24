<?php
session_start();
require_once("../../../config/main.php");
require_once("../../../app/include/admin/header_ajax.php");
$idUsuario=$_SESSION['id'];
$type = $_SESSION['type'];
$idContacto=$_POST['idContacto'];
$oListMessage = CrmChat::getListCantMessage($idUsuario,$idContacto,$type);
$conversacionActual=count($oListMessage);
if($conversacionActual==0){
	echo"error";
}else{
	$_SESSION['conversacionAnterior']=$conversacionActual;
	$message = '';
	if($conversacionActual>0){
		foreach ($oListMessage as $value) {
			if($value->userID == 1){
				$message .= '<div class="chat-message"><div class="chat-gravatar-wrapper"><img class="profile-picture" src="http://www.gravatar.com/avatar/4ec6b20c5fed48b6b01e88161c0a3e20.jpg"></div><div class="chat-text-wrapper"><p class=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$value->message.'</font></font></p></div></div>';
			}else{
				$message .= '<div class="chat-message"><div class="chat-gravatar-wrapper"><img class="profile-picture" src="http://www.gravatar.com/avatar/574700aef74b21d386ba1250b77d20c6.jpg"></div><div class="chat-text-wrapper"><p class=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$value->message.'</font></font></p></div></div>';
			}
			
		}
	}else{
		$message .= '<div class="chat-message"><div class="chat-gravatar-wrapper"><img class="profile-picture" src="http://www.gravatar.com/avatar/574700aef74b21d386ba1250b77d20c6.jpg"></div><div class="chat-text-wrapper"><p class=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Aun no hay conversacion</font></font></p></div></div>';
	}

	echo $message;
}
?>