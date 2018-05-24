<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegRequerimiento = new eCrmRequerimiento();

$oRegRequerimiento->requerimientoID         =OWASP::RequestString('requerimientoID');
$oRegRequerimiento->registerExpire          =OWASP::RequestString('registerExpire');


if($oRegRequerimiento->requerimientoID != NULL){
    RegisterForm($oRegRequerimiento);
}

function RegisterForm($oRegRequerimiento){

    if(CrmRequerimiento::UpdateDateExpiration($oRegRequerimiento->requerimientoID,$oRegRequerimiento->registerExpire)){
        UpdateStates();
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmRequerimiento::GetErrorMsg());
    }

}

function Response($msg){
    echo json_encode(array('retval'=>'1', 'message'=>$msg));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}

function UpdateStates(){
    $oListRequerimiento = CrmRequerimiento::getListSinAprobar();
    foreach ($oListRequerimiento as $value) {
        if(strtotime($value->registerExpire) < strtotime('now')){
            CrmRequerimiento::UpdateStateVencido($value->requerimientoID,3);
        }else{
            CrmRequerimiento::UpdateStateVencido($value->requerimientoID,1);
        }
    }
}


?>