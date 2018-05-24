<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegPropxForm = new eCrmPropxForm();

$oRegPropxForm->propuestaID         =OWASP::RequestString('propuestaID');
$oRegPropxForm->typeForm		    =OWASP::RequestString('typeForm');
$oRegPropxForm->titleForm	        =OWASP::RequestString('titleForm');
$oRegPropxForm->amount  	        =OWASP::RequestString('amount');
$oRegPropxForm->fileProposal        =OWASP::RequestString('fileProposal');
$oRegPropxForm->stateForm	        =OWASP::RequestString('stateForm');


if($oRegPropxForm->propuestaID!=NULL){
    RegisterForm($oRegPropxForm);
}

function RegisterForm($oRegPropxForm){

    if(CrmPropxForm::AddNew($oRegPropxForm)){
        Response('Gracias por registrarse.');
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