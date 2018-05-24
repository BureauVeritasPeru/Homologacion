<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegRequerimiento = new eCrmRequerimiento();

$oRegRequerimiento->requerimientoID       =OWASP::RequestString('requerimientoID');

if($oRegRequerimiento->requerimientoID!=NULL){
    RegisterForm($oRegRequerimiento);
}

function RegisterForm($oRegRequerimiento){
    if(Email::Send_Requerimiento_Recordatorio($oRegRequerimiento->requerimientoID)){
        CrmRequerimiento::UpdateAlerta($oRegRequerimiento->requerimientoID,'Se envio un recordatorio de Auditoria el dia :'.date("Y/m/d"));
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmRequerimiento::GetErrorMsg());
    }

}

function Response($msg){
    echo json_encode(array('retval'=>'1', 'message'=>$msg));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}

?>