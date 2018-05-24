<?php
$oItem = new eCrmEmail();

$oItem->emailID       	=	$kID;
$oItem->title			=	OWASP::RequestString('title');
$oItem->desde			=	OWASP::RequestString('desde');
$oItem->subject			=	OWASP::RequestString('subject');
$oItem->message			=	OWASP::RequestHtml('message');
$oItem->registerDate	=	OWASP::RequestString('registerDate');
$oItem->state			=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmEmail(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmEmail::getItem($kID);
	if($obj!=null){
		if (empty($oItem->title))				$oItem->title			= $obj->title;
		if (empty($oItem->desde))				$oItem->desde			= $obj->desde;
		if (empty($oItem->subject))				$oItem->subject			= $obj->subject;
		if (empty($oItem->message))				$oItem->message			= $obj->message;
		if (empty($oItem->registerDate))		$oItem->registerDate	= $obj->registerDate;
		if (empty($oItem->state))				$oItem->state			= $obj->state;
	}
	else
		$MODULE->addError(CrmEmail::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->title;
}

$MODULE->FormTitle="Email";
?>



