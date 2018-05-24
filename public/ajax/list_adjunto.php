<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lAdjunto = CrmAdjunto::getListByFormulario($_GET['formID']);
foreach ($lAdjunto as $obj){
	$date = new DateTime($obj->registerDate);
	echo "<tr class='fila'><td><a href='javascript:DeleteAdjunto(".$obj->adjID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;<a href='javascript:ViewAdjunto(".$obj->adjID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".htmlentities($obj->title, ENT_QUOTES, "UTF-8")."</td><td>".date_format($date, 'd/m/y')."</td><td>".CrmAdjunto::getState($obj->state)."</td><td style='text-align:center;'><a href='javascript:ModalAdjunto2(".$obj->adjID.");' ><i class='fa fa-plus'></i></a></td></tr>";
}
?>