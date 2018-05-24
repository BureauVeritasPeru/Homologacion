<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$objID = $_GET['requerimientoID'];

$lVouchers = CrmVoucher::getListByRequerimiento($objID);
$oRequerimiento = CrmRequerimiento::getItem($objID);
$oProveedor = CrmProveedor::GetItem($oRequerimiento->proveedorID); 
$oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); 
$oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); 

$monto= 0.00;
foreach ($lVouchers as $obj){
	$dateVoucher = new DateTime($obj->dateVoucher);
	if($obj->state == 2){
		$dateAprobacion = new DateTime($obj->registerUpdate);
		$dateAprobacion = date_format($dateAprobacion, 'd/m/Y');
	}else{
		$dateAprobacion = 'Sin Fecha';
	}
	$monto += floatval($obj->amount);
	echo "<tr class='fila'><td><a href='javascript:ViewVoucher(".$obj->voucherID.");' ><i class='fa fa-eye'></i></a></td>
	<td>".date_format($dateVoucher, 'd/m/Y')."</td><td><a target='_blank' href=".SEO::get_URLRoot().'userfiles/cms/voucher/documento/'.$obj->fileVoucher.">".str_replace('cms/voucher/documento/', '',$obj->fileVoucher)."</a></td><td>".$obj->observation."</td><td>".$dateAprobacion."</td><td>".$oPropuesta->proposalNumber."</td><td>".$obj->amount."</td><td>".CrmVoucher::getState($obj->state)."</td></tr>";
}
CrmRequerimiento::UpdateMonto($objID,$monto);

?>