<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){

    $oRegProceso = new eCrmProceso();
    $oRegProceso->procesoID =OWASP::RequestString('procesoID');

    if(CrmProceso::Delete($oRegProceso)){
        Response('Se elimino Correctamente');
    }else{
        RaiseError(CrmProceso::getErrorMessage());
    }


}

function Response($msg){
    echo json_encode(array('retval'=>'1', 'msg'=>$msg));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'msg'=>$msg));
    exit;
    return;
}
?>