<?php
$oItem = new eCrmCliente();

$oItem->clienteID       =	$kID;
$oItem->ruc				=	OWASP::RequestString('ruc');
$oItem->businessName	=	OWASP::RequestString('businessName');
$oItem->address			=	OWASP::RequestString('address');
$oItem->department		=	OWASP::RequestString('department');
$oItem->province		=	OWASP::RequestString('province');
$oItem->district		=	OWASP::RequestString('district');
$oItem->phone			=	OWASP::RequestString('phone');
$oItem->email			=	OWASP::RequestString('email');
$oItem->fax				=	OWASP::RequestString('fax');
$oItem->sectorist		=	OWASP::RequestString('sectorist');
$oItem->observation		=	OWASP::RequestString('observation');
$oItem->user			=	OWASP::RequestString('user');
$oItem->pass			=	OWASP::RequestString('pass');
$oItem->registerDate	=	OWASP::RequestString('registerDate');
$oItem->registerUpdate	=	OWASP::RequestString('registerUpdate');
$oItem->state			=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmCliente(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmCliente::getItem($kID);
	if($obj!=null){
		if (empty($oItem->ruc))				$oItem->ruc				= $obj->ruc;
		if (empty($oItem->businessName))	$oItem->businessName	= $obj->businessName;
		if (empty($oItem->address))			$oItem->address			= $obj->address;
		if (empty($oItem->department))		$oItem->department		= $obj->department;
		if (empty($oItem->province))		$oItem->province		= $obj->province;
		if (empty($oItem->district))		$oItem->district		= $obj->district;
		if (empty($oItem->phone))			$oItem->phone			= $obj->phone;
		if (empty($oItem->email))			$oItem->email			= $obj->email;
		if (empty($oItem->fax))				$oItem->fax				= $obj->fax;
		if (empty($oItem->sectorist))		$oItem->sectorist		= $obj->sectorist;
		if (empty($oItem->observation))		$oItem->observation		= $obj->observation;
		if (empty($oItem->user))			$oItem->user			= $obj->user;
		if (empty($oItem->pass))			$oItem->pass			= $obj->pass;
		if (empty($oItem->registerDate))	$oItem->registerDate	= $obj->registerDate;
		if (empty($oItem->registerUpdate))	$oItem->registerUpdate	= $obj->registerUpdate;
		if (empty($oItem->state))			$oItem->state			= $obj->state;
	}
	else
		$MODULE->addError(CrmCliente::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->ruc;
}

$MODULE->FormTitle="Cliente";
?>



		