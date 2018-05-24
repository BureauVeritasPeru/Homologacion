<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../../config/main.php");

$oRegForm = new eCrmAdjHomo();


$oRegForm->homologacionID		    =OWASP::RequestInt('homologacionID');
$oRegForm->adjID	                =OWASP::RequestString('adjID');


$field = OWASP::RequestArray('field');

$upload=isset($_FILES['field'])? $_FILES['field']: NULL;

RegisterForm($oRegForm, $field, $upload);

function RegisterForm($oRegForm, $field, $upload){

    if(CrmAdjHomo::AddNew($oRegForm)){
        if($upload!=NULL){
            $upload=UploadFile::fixArray($upload);
            $path='../userfiles/cms/adjunto/documento/';
            foreach($upload as $file){
                $name=$file["name"];
                if($name != NULL && $name != ""){
                    if(UploadFile::ValidateUpload($file)){
                        UploadFile::MoveUploaded($file, $path.$name);
                        $oRegForm->fileAdj = $file["name"] ; 
                        CrmAdjHomo::Update($oRegForm);
                    }else{
                        RaiseError(UploadFile::$ErrorMessage);
                        return;
                    }
                }
            }
        }
        Response('Gracias por registrarse.');
    }
    else{
        RaiseError(CrmAdjHomo::GetErrorMsg());
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
