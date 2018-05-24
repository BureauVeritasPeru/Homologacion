<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lNivelClientes = CrmNivelCliente::getListByCliente($_GET['clienteID']);
foreach ($lNivelClientes as $obj){
	echo "<tr class='fila'><td><a href='javascript:DeleteNivel(".$obj->nivelClienteID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;<a href='javascript:ViewNivel(".$obj->nivelClienteID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".$obj->nivel."</td><td>".$obj->minimo."</td><td>".$obj->maximo."</td><td>".CrmNivelCliente::getState($obj->state)."</td></tr>";
}
?>