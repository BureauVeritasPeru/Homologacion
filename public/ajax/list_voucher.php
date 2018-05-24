<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$objID = $_GET['requerimientoID'];

$lVouchers = CrmVoucher::getListByRequerimiento($objID);
$monto= 0.00;
foreach ($lVouchers as $obj){
	$dateVoucher = new DateTime($obj->dateVoucher);
	$monto += floatval($obj->amount);
	echo "<tr class='fila'><td><a href='javascript:DeleteVoucher(".$obj->voucherID.");' ><i class='fa fa-remove'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:ViewVoucher(".$obj->voucherID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".date_format($dateVoucher, 'd/m/Y')."</td><td><a target='_blank' href=".SEO::get_URLRoot().'userfiles/cms/voucher/documento/'.$obj->fileVoucher.">".str_replace('cms/voucher/documento/', '',$obj->fileVoucher)."</a></td><td>".$obj->amount."</td><td>".$obj->observation."</td><td>".CrmVoucher::getState($obj->state)."</td></tr>";
}
CrmRequerimiento::UpdateMonto($objID,$monto);

?>