<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegHomologacion = new eCrmHomologacion();

$oRegHomologacion->homologacionID = OWASP::RequestString('homologacionID');


if($oRegHomologacion->homologacionID!=NULL){
  RegisterForm($oRegHomologacion);
}

function RegisterForm($oRegHomologacion){


  $oForm = CrmHomologacion::getItemFormulario($oRegHomologacion->homologacionID);

  $oListAdjunto = CrmAdjunto::getListByFormulario($oForm->typeForm);

  foreach ($oListAdjunto as $oItem) {
    $oListDetailAdj = CrmAdjunto::getListByAdj($oItem->adjID);
    foreach ($oListDetailAdj as $oDetail) {
      $oFile = CrmAdjHomo::getItemxAdjHomo($oDetail->adjID,$oRegHomologacion->homologacionID);
      if(!isset($oFile)){ 
        Response('Falta Adjuntos');
        return;
      }
    }
  }
  RaiseError('Adjuntos completos');
  return;
  

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


