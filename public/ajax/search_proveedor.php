<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegProveedor = new eCrmProveedor();

$oRegProveedor->documentNumber = OWASP::RequestString('documentNumber');


if($oRegProveedor->documentNumber!=NULL){
  RegisterForm($oRegProveedor);
}

function RegisterForm($oRegProveedor){

  $oValor = CrmProveedor::getItembyDocument($oRegProveedor->documentNumber);

  if($oValor!=NULL){
    Response('Proveedor Seleccionado');
  }
  else 
  {
    RaiseError('Proveedor no registrado , Solicitelo al administrador');
    return;
  }

}

function Response($msg){
  echo json_encode(array('retval'=>'1','message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>


