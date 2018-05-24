<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){
    $d =OWASP::RequestString('d');
    $m =OWASP::RequestString('m');
    $y =OWASP::RequestString('y');
    
    $texto = '';
    $lValor = CrmHomologacion::getListxFecha2($d,$m,$y);
    foreach ($lValor as $val) {
        $oUser = AdmUser::getItem($val->userID);
        $date = date("d/m/Y", strtotime($val->programDate)); 
        $hour = date("H", strtotime($val->programDate)); 
        $minute = date("i", strtotime($val->programDate));
        $texto .= '<tr><td>'.$val->homologacionID.'</td><td>'.$oUser->firstName.' '.$oUser->lastName.'</td><td>'.$val->programDate.' '.$val->hourDate.'</td><td>'.CrmHomologacion::getState($val->state).'</td></tr>';
    }

    if($texto != ''){
        Response($texto);
    }else{
        $texto .= '<tr><td valign="top" colspan="4" >No hay registros</td></tr>';
        RaiseError($texto);
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