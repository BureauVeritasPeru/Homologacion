<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegHomologacion = new eCrmHomologacion();

$oRegHomologacion->homologacionID         =OWASP::RequestString('homologacionID');
$oRegHomologacion->registerExpire          =OWASP::RequestString('registerExpire');


if($oRegHomologacion->homologacionID != NULL){
    RegisterForm($oRegHomologacion);
}

function RegisterForm($oRegHomologacion){

    if(CrmHomologacion::UpdateDateExpiration($oRegHomologacion->homologacionID,$oRegHomologacion->registerExpire)){
        UpdateStates();
        Response('Gracias por Actualizar.');
    }
    else{
        RaiseError(CrmHomologacion::GetErrorMsg());
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
    $oListHomologacion = CrmHomologacion::getListxVencimiento();
    foreach ($oListHomologacion as $value) {
        if(strtotime($value->registerExpire) < strtotime('now')){
            CrmHomologacion::UpdateState($value->homologacionID,6);
        }else{
            CrmHomologacion::UpdateState($value->homologacionID,1);
        }
    }
}


?>