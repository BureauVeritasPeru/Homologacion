<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegNivelCliente = new eCrmNivelCliente();

$oRegNivelCliente->clienteID          =OWASP::RequestString('clienteID');
$oRegNivelCliente->nivel		      =OWASP::RequestString('nivel');
$oRegNivelCliente->minimo	          =OWASP::RequestString('minimo');
$oRegNivelCliente->maximo	          =OWASP::RequestString('maximo');
$oRegNivelCliente->state	          =OWASP::RequestString('state');


if($oRegNivelCliente->clienteID!=NULL){
    RegisterForm($oRegNivelCliente);
}

function RegisterForm($oRegNivelCliente){

    if(CrmNivelCliente::AddNew($oRegNivelCliente)){
        Response('Gracias por registrarse.');
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