<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegRequerimiento = new eCrmRequerimiento();
$oRegRequerimiento->requerimientoID                     =OWASP::RequestString('requerimientoID');


if($oRegRequerimiento->requerimientoID!=NULL){
    RegisterForm($oRegRequerimiento);
}

function RegisterForm($oRegRequerimiento){
    Email::Send_Aprobacion_Requerimiento($oRegRequerimiento->requerimientoID);
    if(CrmRequerimiento::UpdateStateVencido($oRegRequerimiento->requerimientoID,2)){
        $oRegHomologacion = new eCrmHomologacion();
        $oRegHomologacion->requerimientoID = $oRegRequerimiento->requerimientoID;
        $oRegHomologacion->state = 1;
        Email::Send_Facturacion_Requerimiento($oRegRequerimiento->requerimientoID);
        CrmHomologacion::AddNew($oRegHomologacion);
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