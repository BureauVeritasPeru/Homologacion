<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegChecklist = new eCrmChecklist();

$oRegChecklist->checkID = OWASP::RequestString('id');


if($oRegChecklist->checkID!=NULL){
  RegisterForm($oRegChecklist);
}

function RegisterForm($oRegChecklist){

  $oValor = CrmChecklist::getItem($oRegChecklist->checkID);

  if($oValor!=NULL){
    Response('CheckList Seleccionado',$oValor->numScore);
  }
  else 
  {
    RaiseError('CheckList no registrado , Solicitelo al administrador');
    return;
  }

}

function Response($msg,$point){
  echo json_encode(array('retval'=>'1','message'=>$msg,'point'=>$point));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>


