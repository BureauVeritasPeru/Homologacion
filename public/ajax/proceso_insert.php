<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegProceso = new eCrmProceso();
$oRegProceso->programDate                       =OWASP::RequestString('programDate');
$oRegProceso->hourDate                          =OWASP::RequestString('hourDate');
$oRegProceso->hourEndDate                       =OWASP::RequestString('hourEndDate');
$oRegProceso->userID                            =OWASP::RequestString('userID');
$oRegProceso->process                           =OWASP::RequestString('process');

RegisterForm($oRegProceso);

function RegisterForm($oRegProceso){

    if(CrmProceso::AddNew($oRegProceso)){
        Response('Gracias por Ingresar el proceso.');
    }
    else{
        RaiseError(CrmProceso::GetErrorMsg());
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