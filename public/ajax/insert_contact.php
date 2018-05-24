<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegContacto = new eCrmContacto();

$oRegContacto->clienteID        =OWASP::RequestString('clienteID');
$oRegContacto->nameContact		=OWASP::RequestString('nameContact');
$oRegContacto->positionContact	=OWASP::RequestString('positionContact');
$oRegContacto->phoneContact	    =OWASP::RequestString('phoneContact');
$oRegContacto->emailContact	    =OWASP::RequestString('emailContact');


if($oRegContacto->clienteID!=NULL){
    RegisterForm($oRegContacto);
}

function RegisterForm($oRegContacto){

    if(CrmContacto::AddNew($oRegContacto)){
        Response('Gracias por registrarse.');
    }
    else{
        RaiseError(CrmRegisterForm::GetErrorMsg());
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