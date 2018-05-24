<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lPropuestas = CrmPropxForm::getListByPropuesta($_GET['propuestaID']);
foreach ($lPropuestas as $obj){
	echo "<tr class='fila'><td><a href='javascript:DeletePropxForm(".$obj->propxformID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:ViewPropxForm(".$obj->propxformID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".$obj->titleForm."</td><td>".$obj->amount."</td><td>".CrmPropxForm::getState($obj->stateForm)."</td></tr>";
}
?>