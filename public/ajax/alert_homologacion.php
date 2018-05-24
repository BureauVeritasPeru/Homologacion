<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegHomologacion = new eCrmHomologacion();

$oRegHomologacion->homologacionID       =OWASP::RequestString('homologacionID');

if($oRegHomologacion->homologacionID!=NULL){
    RegisterForm($oRegHomologacion);
}

function RegisterForm($oRegHomologacion){
    if(Email::Send_Aprobacion_Requerimiento_Recordatorio($oRegHomologacion->homologacionID)){
        CrmHomologacion::UpdateAlerta($oRegHomologacion->homologacionID,'Se envio un recordatorio de Auditoria el dia :'.date("Y/m/d"));
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmHomologacion::GetErrorMsg());
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