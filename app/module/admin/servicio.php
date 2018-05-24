<?php
$oItem = new eCrmServicio();

$oItem->servicioID          =$kID;
$oItem->description     =OWASP::RequestString('description');
$oItem->state           =OWASP::RequestString('state');


$MODULE->processFormAction(new CrmServicio(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmServicio::getItem($kID);
	if($obj!=null){
		if (empty($oItem->description)) 	$oItem->description       =$obj->description;
		if (empty($oItem->state))           $oItem->state             =$obj->state;
	}
	else
		$MODULE->addError(CrmServicio::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->description;
}

$MODULE->FormTitle="Servicio";
?>


