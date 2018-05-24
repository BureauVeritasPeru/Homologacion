<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegVoucher = new eCrmVoucher();

$oRegVoucher->voucherID                         =OWASP::RequestString('voucherID');
$oRegVoucher->dateVoucher                       =OWASP::RequestString('dateVoucher');
$oRegVoucher->fileVoucher                       =OWASP::RequestString('fileVoucher');
$oRegVoucher->amount                            =OWASP::RequestString('amount');
$oRegVoucher->observation                       =OWASP::RequestString('observation');
$oRegVoucher->state                             =OWASP::RequestString('state');


if($oRegVoucher->voucherID!=NULL){
    RegisterForm($oRegVoucher);
}

function RegisterForm($oRegVoucher){
    if(CrmVoucher::Update($oRegVoucher)){
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmVoucher::GetErrorMsg());
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