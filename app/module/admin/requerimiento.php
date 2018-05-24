<?php
$oItem = new eCrmRequerimiento();

$oItem->requerimientoID     =	$kID;
$oItem->period	  			=	OWASP::RequestString('period');
$oItem->propxformID		  	=	OWASP::RequestString('propxformID');
$oItem->proveedorID			=	OWASP::RequestString('proveedorID');
$oItem->observation			=	OWASP::RequestString('observation');
$oItem->amount				=	OWASP::RequestString('amount');
$oItem->threeDay			=	OWASP::RequestString('threeDay');
$oItem->nineDay				=	OWASP::RequestString('nineDay');
$oItem->fourteenDay			=	OWASP::RequestString('fourteenDay');
$oItem->alert				=	OWASP::RequestString('alert');
$oItem->registerDate		=	OWASP::RequestString('registerDate');
$oItem->registerExpire		=	OWASP::RequestString('registerExpire');
$oItem->registerUpdate		=	OWASP::RequestString('registerUpdate');
$oItem->state				=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmRequerimiento(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmRequerimiento::getItem($kID);
	if($obj!=null){
		if (empty($oItem->period))			$oItem->period			= $obj->period;
		if (empty($oItem->propxformID))		$oItem->propxformID		= $obj->propxformID;
		if (empty($oItem->proveedorID))		$oItem->proveedorID		= $obj->proveedorID;
		if (empty($oItem->observation))		$oItem->observation		= $obj->observation;
		if (empty($oItem->amount))			$oItem->amount			= $obj->amount;
		if (empty($oItem->threeDay))		$oItem->threeDay		= $obj->threeDay;
		if (empty($oItem->nineDay))			$oItem->nineDay			= $obj->nineDay;
		if (empty($oItem->fourteenDay))		$oItem->fourteenDay		= $obj->fourteenDay;
		if (empty($oItem->alert))			$oItem->alert			= $obj->alert;
		if (empty($oItem->registerDate))	$oItem->registerDate	= $obj->registerDate;
		if (empty($oItem->registerExpire))	$oItem->registerExpire	= $obj->registerExpire;
		if (empty($oItem->registerUpdate))	$oItem->registerUpdate	= $obj->registerUpdate;
		if (empty($oItem->state))			$oItem->state			= $obj->state;
	}
	else
		$MODULE->addError(CrmRequerimiento::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->requerimientoID;
}

$MODULE->FormTitle="Requerimiento";
?>



