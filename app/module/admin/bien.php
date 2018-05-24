<?php
$oItem = new eCrmBien();

$oItem->bienID          =$kID;
$oItem->description     =OWASP::RequestString('description');
$oItem->state           =OWASP::RequestString('state');


$MODULE->processFormAction(new CrmBien(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmBien::getItem($kID);
    if($obj!=null){
        if (empty($oItem->description)) 	$oItem->description       =$obj->description;
        if (empty($oItem->state))           $oItem->state             =$obj->state;
    }
    else
        $MODULE->addError(CrmBien::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->description;
}

$MODULE->FormTitle="Bien";
?>


