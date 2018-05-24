<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegContacto = new eCrmContacto();

$oRegContacto->contactoID        =OWASP::RequestString('contactoID');



if($oRegContacto->contactoID!=NULL){
    RegisterForm($oRegContacto);
}

function RegisterForm($oRegContacto){

    if(CrmContacto::Delete($oRegContacto)){
        Response('Registro eliminado correctamente.');
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