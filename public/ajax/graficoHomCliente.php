<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");;


$clienteID = OWASP::RequestString('clienteID');
RegisterForm($clienteID);

function RegisterForm($clienteID){
    $list=CrmHomologacion::getList_ClienteByGrafico($clienteID);
    $val1 = '';
    $val2 = '';
    $count=0;
    foreach ($list as $valor) {
        $count++;
        if($count==1){
            $val1 .= CrmHomologacion::getState($valor->state);
            $val2 .= $valor->homologacionID;
        }else
        {
            $val1 .= ','.CrmHomologacion::getState($valor->state);
            $val2 .= ','.$valor->homologacionID;
        }
    }

    Response($val1,$val2);


}

function Response($val1,$val2){
    echo json_encode(array('retval'=>'1','val1'=>$val1,'val2'=>$val2));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}

?>
