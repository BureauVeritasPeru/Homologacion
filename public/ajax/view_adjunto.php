<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oregAdjunto = new eCrmAdjunto();

$oregAdjunto->adjID = OWASP::RequestString('adjID');


if($oregAdjunto->adjID!=NULL){
  RegisterForm($oregAdjunto);
}

function RegisterForm($oregAdjunto){

  $oValor = CrmAdjunto::getItem($oregAdjunto->adjID);

  if($oValor!=NULL){
    $date = new DateTime($oValor->registerDate);
    Response($oValor->adjID,$oValor->title,date_format($date, 'Y-m-d'),$oValor->code,$oValor->state,'Adjunto Seleccionado');
  }
  else 
  {
    RaiseError('Adjunto no registrada , Solicitelo al administrador');
    return;
  }

}

function Response($adjID,$title,$registerDate,$code,$state,$msg){
  echo json_encode(array('retval'=>'1','adjID'=>$adjID,'title'=>$title,'registerDate'=>$registerDate,'code'=>$code,'state'=>$state,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>