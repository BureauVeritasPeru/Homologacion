<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegPropxForm = new eCrmPropxForm();

$oRegPropxForm->propxformID = OWASP::RequestString('propxformID');


if($oRegPropxForm->propxformID!=NULL){
  RegisterForm($oRegPropxForm);
}

function RegisterForm($oRegPropxForm){

  $oValor = CrmPropxForm::getItem($oRegPropxForm->propxformID);

  if($oValor!=NULL){
    Response($oValor->propxformID,$oValor->typeForm,$oValor->titleForm,$oValor->amount,$oValor->fileProposal,$oValor->stateForm,$oValor->tagImport,'Propuesta Seleccionada');
    return;
  }
  else 
  {
    RaiseError('Propuesta no registrada , Solicitelo al administrador');
    return;
  }

}

function Response($propxformID,$typeForm,$titleForm,$amount,$fileProposal,$stateForm,$tagImport,$msg){
  echo json_encode(array('retval'=>'1','propxformID'=>$propxformID,'typeForm'=>$typeForm,'titleForm'=>$titleForm,'amount'=>$amount,'fileProposal'=>$fileProposal,'tagImport'=>$tagImport,'stateForm'=>$stateForm,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>