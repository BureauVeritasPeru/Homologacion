<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lContactos = CrmContacto::getListByCliente($_GET['clienteID']);
foreach ($lContactos as $obj){
	echo "<tr class='fila'><td><a href='javascript:DeleteContact(".$obj->contactoID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;<a href='javascript:ViewContact(".$obj->contactoID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".$obj->nameContact."</td><td>".$obj->positionContact."</td><td>".$obj->phoneContact."</td><td>".$obj->emailContact."</td></tr>";
}
?>