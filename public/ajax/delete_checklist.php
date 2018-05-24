<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegCheckList = new eCrmChecklist();

$oRegCheckList->checkID        =OWASP::RequestString('checkID');



if($oRegCheckList->checkID!=NULL){
    RegisterForm($oRegCheckList);
}

function RegisterForm($oRegCheckList){
    $oListCheck = CrmChecklist::getListByCheck($oRegCheckList->checkID);

    foreach ($oListCheck as $detail1) {
        $oListCheck1 = CrmChecklist::getListByCheck($detail1->checkID);
        foreach ($oListCheck1 as $detail2) {
            $oListCheck2 = CrmChecklist::getListByCheck($detail2->checkID);
            foreach ($oListCheck2 as $detail3) {
                CrmChecklist::Delete($detail3);
            }
            CrmChecklist::Delete($detail2);
        }
        CrmChecklist::Delete($detail1);
    }
    
    if(CrmChecklist::Delete($oRegCheckList)){
        Response('Registro eliminado correctamente.');
    }
    else{
        RaiseError(CrmChecklist::GetErrorMsg());
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
?>