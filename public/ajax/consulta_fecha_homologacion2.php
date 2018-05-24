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
    $lValor = CrmHomologacion::getListxFecha($d,$m,$y,$userID);
    foreach ($lValor as $val) {
        $oUser = AdmUser::getItem($val->userID);
        $date = date("d/m/Y", strtotime($val->programDate)); 
        $hour = date("H", strtotime($val->programDate)); 
        $minute = date("i", strtotime($val->programDate));
        if($val->state != 3){
            $texto .= '<tr><td>'.$val->homologacionID.'</td><td>'.$oUser->firstName.' '.$oUser->lastName.'</td><td>'.$val->programDate.' '.$val->hourDate.' - '.$val->hourEndDate.'</td><td><a class="btn btn-primary" href="#" onClick="Reprogramacion('.$val->homologacionID.')">Reprogramar Auditoria</a>&nbsp;&nbsp;<a class="btn btn-primary" href="#" onClick="Finalizacion('.$val->homologacionID.')">Programacion Finalizada</a></td></tr>';
        }else{
            $texto .= '<tr><td>'.$val->homologacionID.'</td><td>'.$oUser->firstName.' '.$oUser->lastName.'</td><td>'.$val->programDate.' '.$val->hourDate.' - '.$val->hourEndDate.'</td><td>Programacion de Auditoria Completa</td></tr>';
        }
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