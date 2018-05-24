<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegVoucher = new eCrmVoucher();
$oRegVoucher->voucherID     =OWASP::RequestString('voucherID');
$oRegVoucher->observation   =OWASP::RequestString('observation');



if($oRegVoucher->voucherID!=NULL){
    RegisterForm($oRegVoucher);
}

function RegisterForm($oRegVoucher){
    //Email::Send_Aprobacion_Requerimiento($oRegVoucher->requerimientoID);
    $oRegVoucher->state = 2;
    if(CrmVoucher::UpdateStateObservation($oRegVoucher)){
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