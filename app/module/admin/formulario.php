<?php
$oItem = new eCrmFormulario();

$oItem->formID       	=	$kID;
$oItem->title			=	OWASP::RequestString('title');
$oItem->description		=	OWASP::RequestString('description');
$oItem->registerDate	=	OWASP::RequestString('registerDate');
$oItem->registerUpdate  = 	OWASP::RequestString('registerUpdate');
$oItem->state			=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmFormulario(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmFormulario::getItem($kID);
	if($obj!=null){
		if (empty($oItem->title))			$oItem->title			= $obj->title;
		if (empty($oItem->description))		$oItem->description		= $obj->description;
		if (empty($oItem->registerDate))	$oItem->registerDate	= $obj->registerDate;
		if (empty($oItem->registerUpdate))	$oItem->registerUpdate	= $obj->registerUpdate;
		if (empty($oItem->state))			$oItem->state			= $obj->state;
	}
	else
		$MODULE->addError(CrmFormulario::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->title;
}

$MODULE->FormTitle="Formulario";
?>



