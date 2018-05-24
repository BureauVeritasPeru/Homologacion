<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../../config/main.php");

$oRegForm = new eCrmVoucher();


$oRegForm->requerimientoID		    =OWASP::RequestInt('requerimientoID');
$oRegForm->amount	                =OWASP::RequestString('amount');
$oRegForm->observation	            =OWASP::RequestString('observation');
$oRegForm->state	                =1;


$field = OWASP::RequestArray('field');

$upload=isset($_FILES['field'])? $_FILES['field']: NULL;

RegisterForm($oRegForm, $field, $upload);

function RegisterForm($oRegForm, $field, $upload){

    if(CrmVoucher::AddNew2($oRegForm)){
        if($upload!=NULL){
            $upload=UploadFile::fixArray($upload);
            $path='../userfiles/cms/voucher/documento/';
            foreach($upload as $file){
                $name= str_replace(' ','_',$file["name"]);
                if($name != NULL && $name != ""){
                    if(UploadFile::ValidateUpload($file)){
                        UploadFile::MoveUploaded($file, $path.$name);
                        $oRegForm->fileVoucher = str_replace(' ','_',$file["name"]); 
                        CrmVoucher::Update2($oRegForm);
                        Email::Send_Voucher_Requerimiento($oRegForm->requerimientoID,$oRegForm->amount);
                    }else{
                        CrmVoucher::Delete($oRegForm);
                        RaiseError(UploadFile::$ErrorMessage);
                        return;
                    }
                }
            }
        }
        Response('Gracias por registrarse.');
    }
    else{
        RaiseError(CrmVoucher::GetErrorMsg());
    }

}


function Response($msg){
    echo '<script type="text/javascript">parent.getMessage(1, "'.$msg.'");</script>';
    exit;
}

function RaiseError($msg){
    echo '<script type="text/javascript">parent.getMessage(0, "'.$msg.'");</script>';
    exit;
}
