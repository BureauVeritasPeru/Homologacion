<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../../config/main.php");

$oRegForm = new eCrmHomologacion();


$oRegForm->homoID		    =OWASP::RequestInt('homoID');
$oRegForm->certification    =OWASP::RequestString('fileCert');


RegisterForm($oRegForm);

function RegisterForm($oRegForm){

    if(CrmHomologacion::UpdateCertification($oRegForm->homoID,$oRegForm->certification)){
        $oHomologacion = CrmHomologacion::getItem($oRegForm->homoID);
        $oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
        $oPropxform     = CrmPropxForm::getItem($oRequerimiento->propxformID); 
        $oPropuesta     = CrmPropuesta::getItem($oPropxform->propuestaID); 
        $oNivelCliente = CrmNivelCliente::getItemByCliente($oPropuesta->clienteID,$oHomologacion->nivel);
        if($oNivelCliente->state == 1){
            Email::Send_Aprobacion_Homologacion($oRegForm->homoID);
        }else{
            Email::Send_Desaprobacion_Homologacion($oRegForm->homoID);
        }
        Response('Gracias por registrarse.');
    }else{
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
