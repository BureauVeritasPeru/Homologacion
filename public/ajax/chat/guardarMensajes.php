<?php
session_start();
require_once("../../../config/main.php");
require_once("../../../app/include/admin/header_ajax.php");

$oRegChat = new eCrmChat();
$oRegChat->message=$_POST['mensaje'];
$oRegChat->userID=$_SESSION['id'];
$oRegChat->contactID=$_POST['idContacto'];
$oRegChat->fecha=date("Y/m/d");
$oRegChat->hora=date("H:i:s");
$oRegChat->type= $_SESSION['type'];
if($oRegChat->message!=''){
	CrmChat::AddNew($oRegChat);
}
?>