<?php
$oItem = new eCrmPropuesta();

$oItem->propuestaID       	=	$kID;
$oItem->proposalNumber	  	=	OWASP::RequestString('proposalNumber');
$oItem->clienteID		  	=	OWASP::RequestString('clienteID');
$oItem->proposalDate		=	OWASP::RequestString('proposalDate');
$oItem->description			=	OWASP::RequestString('description');
$oItem->sectorist			=	OWASP::RequestString('sectorist');
$oItem->registerDate		=	OWASP::RequestString('registerDate');
$oItem->state				=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmPropuesta(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmPropuesta::getItem($kID);
	if($obj!=null){
		if (empty($oItem->proposalNumber))	$oItem->proposalNumber	= $obj->proposalNumber;
		if (empty($oItem->clienteID))		$oItem->clienteID		= $obj->clienteID;
		if (empty($oItem->proposalDate))	$oItem->proposalDate	= $obj->proposalDate;
		if (empty($oItem->description))		$oItem->description		= $obj->description;
		if (empty($oItem->sectorist))		$oItem->sectorist		= $obj->sectorist;
		if (empty($oItem->registerDate))	$oItem->registerDate	= $obj->registerDate;
		if (empty($oItem->state))			$oItem->state			= $obj->state;
	}
	else
		$MODULE->addError(CrmPropuesta::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->proposalNumber;
}

$MODULE->FormTitle="Cliente";
?>



