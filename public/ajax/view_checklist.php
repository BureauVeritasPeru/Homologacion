<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oregChecklist = new eCrmChecklist();

$oregChecklist->checkID = OWASP::RequestString('checkID');


if($oregChecklist->checkID!=NULL){
  RegisterForm($oregChecklist);
}

function RegisterForm($oregChecklist){

  $oValor = CrmChecklist::getItem($oregChecklist->checkID);

  if($oValor!=NULL){
    $date = new DateTime($oValor->registerDate);
    Response($oValor->checkID,$oValor->title,date_format($date, 'Y-m-d'),$oValor->typeCheck,$oValor->question1,$oValor->question2,$oValor->question3,$oValor->question4,$oValor->question5,$oValor->score,$oValor->numScore,$oValor->state,$oValor->information,'Propuesta Seleccionada');
  }
  else 
  {
    RaiseError('Propuesta no registrada , Solicitelo al administrador');
    return;
  }

}

function Response($checkID,$title,$registerDate,$type_check,$question1,$question2,$question3,$question4,$question5,$score,$numScore,$state,$information,$msg){
  echo json_encode(array('retval'=>'1','checkID'=>$checkID,'title'=>$title,'registerDate'=>$registerDate,'type_check'=>$type_check,'question1'=>$question1,'question2'=>$question2,'question3'=>$question3,'question4'=>$question4,'question5'=>$question5,'score'=>$score,'numScore'=>$numScore,'state'=>$state,'information'=>$information,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>