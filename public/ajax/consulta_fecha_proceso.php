<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){
    $d =OWASP::RequestString('d');
    $m =OWASP::RequestString('m');
    $y =OWASP::RequestString('y');
    $userID = OWASP::RequestString('userID');
    
    $texto = '';
    $lValor = CrmProceso::getListxFecha($d,$m,$y,$userID);
    foreach ($lValor as $val) {
        $oUser = AdmUser::getItem($val->userID);
        $date = date("d/m/Y", strtotime($val->programDate)); 
        $hour = date("H", strtotime($val->programDate)); 
        $minute = date("i", strtotime($val->programDate));
        $texto .= '<tr><td>'.$val->procesoID.'</td><td>'.$val->process.'</td><td>'.$val->programDate.' '.$val->hourDate.' - '.$val->hourEndDate.'</td><td><a class="btn btn-primary" href="#" onClick="eliminarProceso('.$val->procesoID.')"><i class="fa fa-times"></i></a></td></tr>';
    }

    if($texto != ''){
        Response($texto);
    }else{
        $texto .= '<tr><td valign="top" colspan="5" >No hay registros</td></tr>';
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