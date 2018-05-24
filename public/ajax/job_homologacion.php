<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oListHomologacion =  CrmHomologacion::getList();

foreach ($oListHomologacion as $oItem) {
	$datetime1 = new DateTime(date('Y-m-d'));
	$datetime2 = new DateTime($oItem->registerDate);
	$datetime3 = new DateTime($oItem->registerExpire);
	$interval = $datetime1->diff($datetime2);
	$var =  $interval->format('%a');
	if($oItem->state == 1){
		if($var == 3){
			if(Email::Send_Aprobacion_Requerimiento_Recordatorio($oItem->requerimientoID,3)){
				CrmHomologacion::Update3Day($oItem->homologacionID,'Notificado');
			}else{
				CrmHomologacion::Update3Day($oItem->homologacionID,'No se pudo Notificar');
			}
		}
		if($var == 9){
			if(Email::Send_Aprobacion_Requerimiento_Recordatorio($oItem->requerimientoID,9)){
				CrmHomologacion::Update9Day($oItem->homologacionID,'Notificado');
			}else{
				CrmHomologacion::Update9Day($oItem->homologacionID,'No se pudo Notificar');
			}
		}

		if($var == 14){
			if(Email::Send_Aprobacion_Requerimiento_Recordatorio($oItem->requerimientoID,14)){
				CrmHomologacion::Update14Day($oItem->homologacionID,'Notificado');
			}else{
				CrmHomologacion::Update14Day($oItem->homologacionID,'No se pudo Notificar');
			}
		}
		if($var > 15 && $datetime3 == $datetime1){
			CrmHomologacion::UpdateStateVencido($oItem->homologacionID,3);		
		}
	}
}

?>