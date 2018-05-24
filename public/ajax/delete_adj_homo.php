<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegAdjHomo = new eCrmAdjHomo();

$oRegAdjHomo->adjID                 =OWASP::RequestString('adjID');
$oRegAdjHomo->homologacionID        =OWASP::RequestString('homologacionID');



if($oRegAdjHomo->adjID!=NULL){
    RegisterForm($oRegAdjHomo);
}

function RegisterForm($oRegAdjHomo){

    if(CrmAdjHomo::Delete($oRegAdjHomo)){
        Response('Registro eliminado correctamente.');
    }
    else{
        RaiseError(CrmAdjHomo::GetErrorMsg());
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