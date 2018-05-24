<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegRequerimiento = new eCrmRequerimiento();

$oRegRequerimiento->requerimientoID = OWASP::RequestString('nro_requerimiento');
$oRegRequerimiento->ruc = OWASP::RequestString('ruc');


if($oRegRequerimiento->requerimientoID!=NULL){
  RegisterForm($oRegRequerimiento);
}

function RegisterForm($oRegRequerimiento){

  $oValor = CrmRequerimiento::getItemRequerimiento($oRegRequerimiento);

  if($oValor!=NULL){
    Response($oValor->requerimientoID,$oValor->businessName,$oValor->businessCliente,$oValor->state,'Requerimiento Seleccionado');
  }
  else 
  {
    RaiseError('Requerimiento no registrado , Solicitelo al administrador');
    return;
  }

}

function Response($requerimientoID,$businessName,$businessCliente,$state,$msg){
  echo json_encode(array('retval'=>'1','requerimientoID'=>$requerimientoID,'businessName'=>$businessName,'businessCliente'=>$businessCliente,'state'=>$state,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>


