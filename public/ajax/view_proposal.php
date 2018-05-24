<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegPropuesta = new eCrmPropuesta();

$oRegPropuesta->propuestaID = OWASP::RequestString('propuestaID');


if($oRegPropuesta->propuestaID!=NULL){
  RegisterForm($oRegPropuesta);
}

function RegisterForm($oRegPropuesta){

  $oValor = CrmPropuesta::getItem($oRegPropuesta->propuestaID);

  if($oValor!=NULL){
    $date = new DateTime($oValor->proposalDate);
    Response($oValor->propuestaID,$oValor->proposalNumber,date_format($date, 'Y-m-d'),$oValor->description,$oValor->sectorist,$oValor->state,'Propuesta Seleccionada');
  }
  else 
  {
    RaiseError('Propuesta no registrada , Solicitelo al administrador');
    return;
  }

}

function Response($propuestaID,$proposalNumber,$proposalDate,$description,$sectorist,$state,$msg){
  echo json_encode(array('retval'=>'1','propuestaID'=>$propuestaID,'proposalNumber'=>$proposalNumber,'proposalDate'=>$proposalDate,'description'=>$description,'sectorist'=>$sectorist,'state'=>$state,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>