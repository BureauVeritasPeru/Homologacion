<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegProveedor = new eCrmProveedor();

$oRegProveedor->proveedorID = OWASP::RequestString('proveedorID');


if($oRegProveedor->proveedorID!=NULL){
  RegisterForm($oRegProveedor);
}

function RegisterForm($oRegProveedor){

  $oValor = CrmProveedor::getItem($oRegProveedor->proveedorID);

  if($oValor->registration == ''){
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


