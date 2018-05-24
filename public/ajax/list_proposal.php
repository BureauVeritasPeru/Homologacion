<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lPropuestas = CrmPropuesta::getListByCliente($_GET['clienteID']);
foreach ($lPropuestas as $obj){
	$date = new DateTime($obj->proposalDate);
	echo "<tr class='fila'><td><a href='javascript:DeleteProposal(".$obj->propuestaID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:ViewProposal(".$obj->propuestaID.");' ><i class='fa fa-eye'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:ModalDetProposal(".$obj->propuestaID.");' ><i class='fa fa-edit'></i></a></td>
	<td>".$obj->proposalNumber."</td><td>".date_format($date, 'd/m/y')."</td><td>".CrmPropuesta::getState($obj->state)."</td></tr>";
}
?>