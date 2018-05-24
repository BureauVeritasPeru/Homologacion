<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lAdjunto = CrmAdjunto::getListByAdj($_GET['adjID']);
foreach ($lAdjunto as $obj){
	$date = new DateTime($obj->registerDate);
	echo "<tr class='fila'><td><a href='javascript:DeleteAdjunto2(".$obj->adjID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;<a href='javascript:ViewAdjunto2(".$obj->adjID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".htmlentities($obj->title, ENT_QUOTES, "UTF-8")."</td><td>".htmlentities($obj->code, ENT_QUOTES, "UTF-8")."</td><td>".date_format($date, 'd/m/y')."</td><td>".CrmAdjunto::getState($obj->state)."</td></tr>";
}
?>