<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegAdjunto = new eCrmAdjunto();

$oRegAdjunto->adjID               =OWASP::RequestString('adjID');
$oRegAdjunto->title               =OWASP::RequestString('title');
$oRegAdjunto->code                =OWASP::RequestString('code');
$oRegAdjunto->state               =OWASP::RequestString('state');


if($oRegAdjunto->adjID!=NULL){
    RegisterForm($oRegAdjunto);
}

function RegisterForm($oRegAdjunto){

    if(CrmAdjunto::Update($oRegAdjunto)){
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmAdjunto::GetErrorMsg());
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