<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oListRequerimiento =  CrmRequerimiento::getList();

foreach ($oListRequerimiento as $oItem) {
	$datetime1 = new DateTime(date('Y-m-d'));
	$datetime2 = new DateTime($oItem->registerDate);
	$datetime3 = new DateTime($oItem->registerExpire);
	$interval = $datetime1->diff($datetime2);
	$var =  $interval->format('%a');
	if($oItem->state == 1){
		if($var == 3){
			if(Email::Send_Requerimiento_Recordatorio($oItem->requerimientoID,3)){
				CrmRequerimiento::Update3Day($oItem->requerimientoID,'Notificado');
			}else{
				CrmRequerimiento::Update3Day($oItem->requerimientoID,'No se pudo Notificar');
			}
		}
		if($var == 9){
			if(Email::Send_Requerimiento_Recordatorio($oItem->requerimientoID,9)){
				CrmRequerimiento::Update9Day($oItem->requerimientoID,'Notificado');
			}else{
				CrmRequerimiento::Update9Day($oItem->requerimientoID,'No se pudo Notificar');
			}
		}

		if($var == 14){
			if(Email::Send_Requerimiento_Recordatorio($oItem->requerimientoID,14)){
				CrmRequerimiento::Update14Day($oItem->requerimientoID,'Notificado');
			}else{
				CrmRequerimiento::Update14Day($oItem->requerimientoID,'No se pudo Notificar');
			}
		}
		if($var > 15 && $datetime3 == $datetime1){
			CrmRequerimiento::UpdateStateVencido($oItem->requerimientoID,3);		
		}
	}
}

?>