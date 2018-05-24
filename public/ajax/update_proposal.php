<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegPropuesta = new eCrmPropuesta();

$oRegPropuesta->propuestaID         =OWASP::RequestString('propuestaID');
$oRegPropuesta->proposalNumber		=OWASP::RequestString('proposalNumber');
$oRegPropuesta->proposalDate	    =OWASP::RequestString('proposalDate');
$oRegPropuesta->description	        =OWASP::RequestString('description');
$oRegPropuesta->sectorist           =OWASP::RequestString('sectorist');
$oRegPropuesta->state	            =OWASP::RequestString('state');


if($oRegPropuesta->propuestaID!=NULL){
    RegisterForm($oRegPropuesta);
}

function RegisterForm($oRegPropuesta){

    if(CrmPropuesta::Update($oRegPropuesta)){
        Response('Gracias por Actualizar.');
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