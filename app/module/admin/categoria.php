<?php
$oItem = new eCrmCategoria();

$oItem->categoriaID          =$kID;
$oItem->description     =OWASP::RequestString('description');
$oItem->state           =OWASP::RequestString('state');


$MODULE->processFormAction(new CrmCategoria(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmCategoria::getItem($kID);
	if($obj!=null){
		if (empty($oItem->description)) 	$oItem->description       =$obj->description;
		if (empty($oItem->state))           $oItem->state             =$obj->state;
	}
	else
		$MODULE->addError(CrmCategoria::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->description;
}

$MODULE->FormTitle="Categoria";
?>


