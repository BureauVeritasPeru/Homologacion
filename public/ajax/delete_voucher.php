<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegVoucher = new eCrmVoucher();

$oRegVoucher->voucherID        =OWASP::RequestString('voucherID');



if($oRegVoucher->voucherID!=NULL){
    RegisterForm($oRegVoucher);
}

function RegisterForm($oRegVoucher){

    if(CrmVoucher::Delete($oRegVoucher)){
        Response('Registro eliminado correctamente.');
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