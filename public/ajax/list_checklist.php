<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lChecklist = CrmChecklist::getListByFormulario($_GET['formID']);
foreach ($lChecklist as $obj){
	$date = new DateTime($obj->registerDate);
	echo "<tr class='fila'><td><a href='javascript:DeleteChecklist(".$obj->checkID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;<a href='javascript:ViewChecklist(".$obj->checkID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".htmlentities($obj->title, ENT_QUOTES, "UTF-8")."</td><td>".date_format($date, 'd/m/y')."</td><td>".CrmPropuesta::getState($obj->state)."</td><td style='text-align:center;'><a href='javascript:ModalCheckList2(".$obj->checkID.");' ><i class='fa fa-plus'></i></a></td></tr>";
}
?>