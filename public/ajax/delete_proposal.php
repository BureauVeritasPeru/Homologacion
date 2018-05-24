<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegPropuesta = new eCrmPropuesta();

$oRegPropuesta->propuestaID        =OWASP::RequestString('propuestaID');



if($oRegPropuesta->propuestaID!=NULL){
    RegisterForm($oRegPropuesta);
}

function RegisterForm($oRegPropuesta){

    if(CrmPropuesta::Delete($oRegPropuesta)){
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