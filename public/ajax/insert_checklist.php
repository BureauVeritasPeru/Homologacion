<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegCheckList = new eCrmChecklist();

$oRegCheckList->formID               =OWASP::RequestString('formID');
$oRegCheckList->precheckID           =OWASP::RequestString('precheckID');
$oRegCheckList->title		         =OWASP::RequestString('title');
$oRegCheckList->typeCheck	         =OWASP::RequestString('type_check');
$oRegCheckList->question1	         =OWASP::RequestString('question1');
$oRegCheckList->question2            =OWASP::RequestString('question2');
$oRegCheckList->question3	         =OWASP::RequestString('question3');
$oRegCheckList->question4            =OWASP::RequestString('question4');
$oRegCheckList->question5            =OWASP::RequestString('question5');
$oRegCheckList->score                =OWASP::RequestString('score');
$oRegCheckList->numScore             =OWASP::RequestString('numScore');
$oRegCheckList->state                =OWASP::RequestString('state');



if($oRegCheckList->formID!=NULL){
    RegisterForm($oRegCheckList);
}

function RegisterForm($oRegCheckList){

    if(CrmChecklist::AddNew($oRegCheckList)){
        Response('Gracias por registrarse.');
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