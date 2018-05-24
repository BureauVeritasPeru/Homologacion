<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegHomologacion = new eCrmHomologacion();

$oRegHomologacion->homologacionID                    =OWASP::RequestString('homologacionID');


if($oRegHomologacion->homologacionID!=NULL){
    RegisterForm($oRegHomologacion);
}

function RegisterForm($oRegHomologacion){
    
    if(CrmHomologacion::Update2($oRegHomologacion)){
        Email::Send_programacion_proveedor($oRegHomologacion->homologacionID);
        Email::Send_programacion_auditor($oRegHomologacion->homologacionID,$oRegHomologacion->userID);
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