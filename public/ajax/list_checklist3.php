<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lChecklist = CrmChecklist::getListByCheck($_GET['checkID']);
foreach ($lChecklist as $obj){
	$date = new DateTime($obj->registerDate);
	echo "<tr class='fila'><td><a href='javascript:DeleteChecklist3(".$obj->checkID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;<a href='javascript:ViewChecklist3(".$obj->checkID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".htmlentities($obj->title, ENT_QUOTES, "UTF-8")."</td><td>".date_format($date, 'd/m/y')."</td><td>".CrmPropuesta::getState($obj->state)."</td><td><a href='javascript:ModalCheckList4(".$obj->checkID.");' ><i class='fa fa-plus'></i></a></td></tr>";
}
?>