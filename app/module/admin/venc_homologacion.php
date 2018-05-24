<?php
$oItem = new eCrmHomologacion();

$oItem->homologacionID	=	$kID;
$oItem->requerimientoID	=	OWASP::RequestString('requerimientoID');
$oItem->programDate		=	OWASP::RequestString('programDate');
$oItem->hourDate		=	OWASP::RequestString('hourDate');
$oItem->hourEndDate		=	OWASP::RequestString('hourEndDate');
$oItem->userID			=	OWASP::RequestString('userID');
$oItem->document		=	OWASP::RequestString('document');
$oItem->scope			=	OWASP::RequestString('scope');
$oItem->observation		=	OWASP::RequestString('observation');
$oItem->nivel			=	OWASP::RequestString('nivel');
$oItem->puntajeFinal	=	OWASP::RequestString('puntajeFinal');
$oItem->state			=	OWASP::RequestString('state');
$oItem->registerDate	=	OWASP::RequestString('registerDate');
$oItem->registerExpire	=	OWASP::RequestString('registerExpire');
$oItem->registerUpdate	=	OWASP::RequestString('registerUpdate');


$MODULE->processFormAction(new CrmHomologacion(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmHomologacion::getItem($kID);
	if($obj!=null){
		if (empty($oItem->homologacionID))	$oItem->homologacionID		=	$obj->homologacionID;
		if (empty($oItem->requerimientoID))	$oItem->requerimientoID		=	$obj->requerimientoID;
		if (empty($oItem->programDate))		$oItem->programDate			=	$obj->programDate;
		if (empty($oItem->hourDate))		$oItem->hourDate			=	$obj->hourDate;
		if (empty($oItem->hourEndDate))		$oItem->hourEndDate			=	$obj->hourEndDate;
		if (empty($oItem->userID))			$oItem->userID				=	$obj->userID;
		if (empty($oItem->document))		$oItem->document			=	$obj->document;
		if (empty($oItem->scope))			$oItem->scope				=	$obj->scope;
		if (empty($oItem->observation))		$oItem->observation			=	$obj->observation;
		if (empty($oItem->nivel))			$oItem->nivel				=	$obj->nivel;
		if (empty($oItem->puntajeFinal))	$oItem->puntajeFinal		=	$obj->puntajeFinal;
		if (empty($oItem->state))			$oItem->state				=	$obj->state;
		if (empty($oItem->registerDate))	$oItem->registerDate		=	$obj->registerDate;
		if (empty($oItem->registerExpire))	$oItem->registerExpire		=	$obj->registerExpire;
		if (empty($oItem->registerUpdate))	$oItem->registerUpdate		=	$obj->registerUpdate;
	}
	else
		$MODULE->addError(CrmHomologacion::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->homologacionID;
}

$MODULE->FormTitle="Homologacion";
?>



