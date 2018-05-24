<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegAdjunto = new eCrmAdjunto();

$oRegAdjunto->formID               =OWASP::RequestString('formID');
$oRegAdjunto->preadjID             =OWASP::RequestString('preadjID');
$oRegAdjunto->title		           =OWASP::RequestString('title');
$oRegAdjunto->code                 =OWASP::RequestString('code');
$oRegAdjunto->state                =OWASP::RequestString('state');



if($oRegAdjunto->formID!=NULL){
    RegisterForm($oRegAdjunto);
}

function RegisterForm($oRegAdjunto){

    if(CrmAdjunto::AddNew($oRegAdjunto)){
        Response('Gracias por registrarse.');
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