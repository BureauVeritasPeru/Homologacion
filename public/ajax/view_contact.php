<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oregContacto = new eCrmContacto();

$oregContacto->contactoID = OWASP::RequestString('contactoID');


if($oregContacto->contactoID!=NULL){
  RegisterForm($oregContacto);
}

function RegisterForm($oregContacto){

  $oValor = CrmContacto::getItem($oregContacto->contactoID);

  if($oValor!=NULL){
    Response($oValor->contactoID,$oValor->nameContact,$oValor->positionContact,$oValor->phoneContact,$oValor->emailContact,'Propuesta Seleccionada');
  }
  else 
  {
    RaiseError('Propuesta no registrada , Solicitelo al administrador');
    return;
  }

}

function Response($contactoID,$nameContact,$positionContact,$phoneContact,$emailContact,$msg){
  echo json_encode(array('retval'=>'1','contactoID'=>$contactoID,'nameContact'=>$nameContact,'positionContact'=>$positionContact,'phoneContact'=>$phoneContact,'emailContact'=>$emailContact,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>