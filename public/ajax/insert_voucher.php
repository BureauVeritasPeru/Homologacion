<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegVoucher = new eCrmVoucher();

$oRegVoucher->requerimientoID                   =OWASP::RequestString('requerimientoID');
$oRegVoucher->dateVoucher		                =OWASP::RequestString('dateVoucher');
$oRegVoucher->fileVoucher	                    =OWASP::RequestString('fileVoucher');
$oRegVoucher->amount	                        =OWASP::RequestString('amount');
$oRegVoucher->observation                       =OWASP::RequestString('observation');
$oRegVoucher->state	                            =OWASP::RequestString('state');


if($oRegVoucher->requerimientoID!=NULL){
    RegisterForm($oRegVoucher);
}

function RegisterForm($oRegVoucher){

    if(CrmVoucher::AddNew($oRegVoucher)){
        Response('Gracias por registrarse.');
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