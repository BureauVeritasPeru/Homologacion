<?php
$oItem = new eCrmAdjunto();

$oItem->adjuntoID       =	$kID;
$oItem->typeFile		=	OWASP::RequestString('typeFile');
$oItem->descriptionFile	=	OWASP::RequestString('descriptionFile');
$oItem->codeFile		=	OWASP::RequestString('codeFile');
$oItem->registerDate	=	OWASP::RequestString('registerDate');
$oItem->state			=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmAdjunto(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmAdjunto::getItem($kID);
	if($obj!=null){
		if (empty($oItem->typeFile))			$oItem->typeFile			= $obj->typeFile;
		if (empty($oItem->descriptionFile))		$oItem->descriptionFile		= $obj->descriptionFile;
		if (empty($oItem->codeFile))			$oItem->codeFile			= $obj->codeFile;
		if (empty($oItem->registerDate))		$oItem->registerDate		= $obj->registerDate;
		if (empty($oItem->state))				$oItem->state				= $obj->state;
	}
	else
		$MODULE->addError(CrmAdjunto::GetErrorMsg());

	$MODULE->ItemtypeFile=$oItem->codeFile;
}

$MODULE->FormTitle="Adjuntos";
?>



