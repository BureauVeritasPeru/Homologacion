<?php
$oItem = new eCrmDocumento();
$oItem->documentoID       =$kID;
$oItem->title           =OWASP::RequestString('title');
$oItem->description     =OWASP::RequestHtml('description');
$oItem->resumen         =OWASP::RequestHTML('resumen');
$oItem->dateDocumento     =OWASP::RequestString('dateDocumento');
$oItem->fileDocumento     =OWASP::RequestString('fileDocumento');
$oItem->state           =OWASP::RequestString('state');
$oItem->fechaRegistro   =OWASP::RequestString('fechaRegistro');
$oItem->fechaActualizar =OWASP::RequestString('fechaActualizar');

$MODULE->processFormAction(new CrmDocumento(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmDocumento::getItem($kID);
    if($obj!=null){
        if (empty($oItem->title)) 	$oItem->title    =$obj->title;
        if (empty($oItem->description)) 	$oItem->description    =$obj->description;
        if (empty($oItem->resumen)) 	$oItem->resumen    =$obj->resumen;
        if (empty($oItem->dateDocumento)) 	    $oItem->dateDocumento      =$obj->dateDocumento;
        if (empty($oItem->fileDocumento))    $oItem->fileDocumento    =$obj->fileDocumento;
        if (empty($oItem->state))           $oItem->state           =$obj->state;
        if (empty($oItem->fechaRegistro))           $oItem->fechaRegistro           =$obj->fechaRegistro;
        if (empty($oItem->fechaActualizar))           $oItem->fechaActualizar           =$obj->fechaActualizar;
    }
    else
        $MODULE->addError(CrmDocumento::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->title;
}

$MODULE->FormTitle="Planta";
?>
