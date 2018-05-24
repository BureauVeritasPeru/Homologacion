<?php
$oItem = new eCrmChat();

$oItem->chatID       		=	$kID;
$oItem->message	  			=	OWASP::RequestString('message');
$oItem->userID		  		=	OWASP::RequestString('userID');
$oItem->contactID			=	OWASP::RequestString('contactID');
$oItem->fecha				=	OWASP::RequestString('fecha');
$oItem->hora				=	OWASP::RequestString('hora');
$oItem->type				=	OWASP::RequestString('type');


$MODULE->processFormAction(new CrmChat(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmChat::getItem($kID);
	if($obj!=null){
		if (empty($oItem->message))			$oItem->message		= $obj->message;
		if (empty($oItem->userID))			$oItem->userID		= $obj->userID;
		if (empty($oItem->contactID	))		$oItem->contactID	= $obj->contactID;
		if (empty($oItem->fecha))			$oItem->fecha		= $obj->fecha;
		if (empty($oItem->hora))			$oItem->hora		= $obj->hora;
		if (empty($oItem->type))			$oItem->type		= $obj->type;
	}
	else
		$MODULE->addError(CrmChat::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->message;
}

$MODULE->FormTitle="Chat";
?>



