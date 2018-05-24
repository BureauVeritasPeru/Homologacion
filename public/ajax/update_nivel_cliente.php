<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegNivelCliente = new eCrmNivelCliente();

$oRegNivelCliente->nivelClienteID               =OWASP::RequestString('nivelClienteID');
$oRegNivelCliente->nivel                        =OWASP::RequestString('nivel');
$oRegNivelCliente->minimo                       =OWASP::RequestString('minimo');
$oRegNivelCliente->maximo                       =OWASP::RequestString('maximo');
$oRegNivelCliente->state                        =OWASP::RequestString('state');

if($oRegNivelCliente->nivelClienteID != NULL){
    RegisterForm($oRegNivelCliente);
}

function RegisterForm($oRegNivelCliente){

    if(CrmNivelCliente::Update($oRegNivelCliente)){
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmNivelCliente::GetErrorMsg());
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