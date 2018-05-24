<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegPropxForm = new eCrmPropxForm();

$oRegPropxForm->propxformID        =OWASP::RequestString('propxformID');



if($oRegPropxForm->propxformID!=NULL){
    RegisterForm($oRegPropxForm);
}

function RegisterForm($oRegPropxForm){

    if(CrmPropxForm::Delete($oRegPropxForm)){
        Response('Registro eliminado correctamente.');
    }
    else{
        RaiseError(CrmPropxForm::GetErrorMsg());
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