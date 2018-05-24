<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oregNivelCliente = new eCrmNivelCliente();

$oregNivelCliente->nivelClienteID = OWASP::RequestString('nivelClienteID');


if($oregNivelCliente->nivelClienteID!=NULL){
  RegisterForm($oregNivelCliente);
}

function RegisterForm($oregNivelCliente){

  $oValor = CrmNivelCliente::getItem($oregNivelCliente->nivelClienteID);

  if($oValor!=NULL){
    Response($oValor->nivelClienteID,$oValor->nivel,$oValor->minimo,$oValor->maximo,$oValor->state,'Propuesta Seleccionada');
  }
  else 
  {
    RaiseError('Nivel no registrado , Solicitelo al administrador');
    return;
  }

}

function Response($nivelClienteID,$nivel,$minimo,$maximo,$state,$msg){
  echo json_encode(array('retval'=>'1','nivelClienteID'=>$nivelClienteID,'nivel'=>$nivel,'minimo'=>$minimo,'maximo'=>$maximo,'state'=>$state,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>