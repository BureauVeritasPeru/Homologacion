<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegHomologacion = new eCrmHomologacion();

$oRegHomologacion->homologacionID         =OWASP::RequestString('homologacionID');


if($oRegHomologacion->homologacionID != NULL){
    RegisterForm($oRegHomologacion);
}

function RegisterForm($oRegHomologacion){

    if(CrmHomologacion::UpdateState($oRegHomologacion->homologacionID,8)){
        Response('Gracias por Anular.');
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