<?php
$oItem = new eCrmConcepto();

$oItem->conceptoID          =$kID;
$oItem->description     =OWASP::RequestString('description');
$oItem->state           =OWASP::RequestString('state');


$MODULE->processFormAction(new CrmConcepto(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmConcepto::getItem($kID);
	if($obj!=null){
		if (empty($oItem->description)) 	$oItem->description       =$obj->description;
		if (empty($oItem->state))           $oItem->state             =$obj->state;
	}
	else
		$MODULE->addError(CrmConcepto::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->description;
}

$MODULE->FormTitle="concepto";
?>


