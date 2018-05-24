<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegVoucher = new eCrmVoucher();

$oRegVoucher->voucherID = OWASP::RequestString('voucherID');


if($oRegVoucher->voucherID!=NULL){
  RegisterForm($oRegVoucher);
}

function RegisterForm($oRegVoucher){

  $oValor = CrmVoucher::getItem($oRegVoucher->voucherID);

  if($oValor!=NULL){
    $date = new DateTime($oValor->dateVoucher);
    Response($oValor->voucherID,$oValor->fileVoucher,date_format($date, 'Y-m-d'),$oValor->amount,$oValor->observation,$oValor->state,'Voucher Seleccionado');
  }
  else 
  {
    RaiseError('Voucher no registrada , Solicitelo al administrador');
    return;
  }

}

function Response($voucherID,$fileVoucher,$dateVoucher,$amount,$observation,$state,$msg){
  echo json_encode(array('retval'=>'1','voucherID'=>$voucherID,'fileVoucher'=>$fileVoucher,'dateVoucher'=>$dateVoucher,'amount'=>$amount,'observation'=>$observation,'state'=>$state,'message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}

?>


