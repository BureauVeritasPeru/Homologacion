<?php
$oItem = new eCrmProveedor();

$oItem->proveedorID					=	$kID;
$oItem->documentNumber				=	OWASP::RequestString('documentNumber');
$oItem->typeProvider				=	OWASP::RequestString('typeProvider');
$oItem->businessName				=	OWASP::RequestString('businessName');
$oItem->address						=	OWASP::RequestString('address');
$oItem->country 					= 	OWASP::RequestString('country');
$oItem->department					=	OWASP::RequestString('department');
$oItem->province					=	OWASP::RequestString('province');
$oItem->district					=	OWASP::RequestString('district');
$oItem->postalCode					=	OWASP::RequestString('postalCode');
$oItem->phone						=	OWASP::RequestString('phone');
$oItem->fax							=	OWASP::RequestString('fax');
$oItem->email						=	OWASP::RequestString('email');
$oItem->contacts					=	OWASP::RequestString('contacts');
$oItem->legalDirection				=	OWASP::RequestString('legalDirection');
$oItem->departmentLegal				=	OWASP::RequestString('departmentLegal');
$oItem->provinceLegal				=	OWASP::RequestString('provinceLegal');
$oItem->districtLegal				=	OWASP::RequestString('districtLegal');
$oItem->legalRepresentative			=	OWASP::RequestString('legalRepresentative');
$oItem->commercialContactName		=	OWASP::RequestString('commercialContactName');
$oItem->commercialContactPhone		=	OWASP::RequestString('commercialContactPhone');
$oItem->commercialContactCellphone	=	OWASP::RequestString('commercialContactCellphone');
$oItem->commercialContactEmail		=	OWASP::RequestString('commercialContactEmail');
$oItem->generalManagerName			=	OWASP::RequestString('generalManagerName');
$oItem->generalManagerPhone			=	OWASP::RequestString('generalManagerPhone');
$oItem->generalManagerCellphone		=	OWASP::RequestString('generalManagerCellphone');
$oItem->generalManagerEmail			=	OWASP::RequestString('generalManagerEmail');
$oItem->bienID						=	OWASP::RequestString('bienID');
$oItem->servicioID					=	OWASP::RequestString('servicioID');
$oItem->other						=	OWASP::RequestString('other');
$oItem->numberCollaborateAdmin		=	OWASP::RequestString('numberCollaborateAdmin');
$oItem->numberCollaborateOper		=	OWASP::RequestString('numberCollaborateOper');
$oItem->workShifts					=	OWASP::RequestString('workShifts');
$oItem->businessAction1				=	OWASP::RequestString('businessAction1');
$oItem->percentageParticipant1		=	OWASP::RequestString('percentageParticipant1');
$oItem->businessAction2				=	OWASP::RequestString('businessAction2');
$oItem->percentageParticipant2		=	OWASP::RequestString('percentageParticipant2');
$oItem->businessAction3				=	OWASP::RequestString('businessAction3');
$oItem->percentageParticipant3		=	OWASP::RequestString('percentageParticipant3');
$oItem->activityDate				=	OWASP::RequestString('activityDate');
$oItem->partnerships				=	OWASP::RequestString('partnerships');
$oItem->ecoActivity					=	OWASP::RequestString('ecoActivity');
$oItem->retentionIgv				=	OWASP::RequestString('retentionIgv');
$oItem->observation					=	OWASP::RequestString('observation');
$oItem->user						=	OWASP::RequestString('user');
$oItem->pass						=	OWASP::RequestString('pass');
$oItem->registerDate				=	OWASP::RequestString('registerDate');
$oItem->registerUpdate				=	OWASP::RequestString('registerUpdate');
$oItem->state						=	OWASP::RequestString('state');


$MODULE->processFormAction(new CrmProveedor(), $oItem);

if($MODULE->FormView=="edit"){
	$obj=CrmProveedor::getItem($kID);
	if($obj!=null){
		if (empty($oItem->documentNumber))				$oItem->documentNumber				=	$obj->documentNumber;
		if (empty($oItem->typeProvider))				$oItem->typeProvider				=	$obj->typeProvider;
		if (empty($oItem->businessName))				$oItem->businessName				=	$obj->businessName;
		if (empty($oItem->address))						$oItem->address						=	$obj->address;
		if (empty($oItem->country))						$oItem->country						=	$obj->country;
		if (empty($oItem->department))					$oItem->department					=	$obj->department;
		if (empty($oItem->province))					$oItem->province					=	$obj->province;
		if (empty($oItem->district))					$oItem->district					=	$obj->district;
		if (empty($oItem->postalCode))					$oItem->postalCode					=	$obj->postalCode;
		if (empty($oItem->phone))						$oItem->phone						=	$obj->phone;
		if (empty($oItem->fax))							$oItem->fax							=	$obj->fax;
		if (empty($oItem->email))						$oItem->email						=	$obj->email;
		if (empty($oItem->contacts))					$oItem->contacts					=	$obj->contacts;
		if (empty($oItem->legalDirection))				$oItem->legalDirection				=	$obj->legalDirection;
		if (empty($oItem->departmentLegal))				$oItem->departmentLegal				=	$obj->departmentLegal;
		if (empty($oItem->provinceLegal))				$oItem->provinceLegal				=	$obj->provinceLegal;
		if (empty($oItem->districtLegal))				$oItem->districtLegal				=	$obj->districtLegal;
		if (empty($oItem->legalRepresentative))			$oItem->legalRepresentative			=	$obj->legalRepresentative;
		if (empty($oItem->commercialContactName))		$oItem->commercialContactName		=	$obj->commercialContactName;
		if (empty($oItem->commercialContactPhone))		$oItem->commercialContactPhone		=	$obj->commercialContactPhone;
		if (empty($oItem->commercialContactCellphone))	$oItem->commercialContactCellphone	=	$obj->commercialContactCellphone;
		if (empty($oItem->commercialContactEmail))		$oItem->commercialContactEmail		=	$obj->commercialContactEmail;
		if (empty($oItem->generalManagerName))			$oItem->generalManagerName			=	$obj->generalManagerName;
		if (empty($oItem->generalManagerPhone))			$oItem->generalManagerPhone			=	$obj->generalManagerPhone;
		if (empty($oItem->generalManagerCellphone))		$oItem->generalManagerCellphone		=	$obj->generalManagerCellphone;
		if (empty($oItem->generalManagerEmail))			$oItem->generalManagerEmail			=	$obj->generalManagerEmail;
		if (empty($oItem->bienID))						$oItem->bienID						=	$obj->bienID;
		if (empty($oItem->servicioID))					$oItem->servicioID					=	$obj->servicioID;
		if (empty($oItem->other))						$oItem->other						=	$obj->other;
		if (empty($oItem->numberCollaborateAdmin))		$oItem->numberCollaborateAdmin		=	$obj->numberCollaborateAdmin;
		if (empty($oItem->numberCollaborateOper))		$oItem->numberCollaborateOper		=	$obj->numberCollaborateOper;
		if (empty($oItem->workShifts))					$oItem->workShifts					=	$obj->workShifts;
		if (empty($oItem->businessAction1))				$oItem->businessAction1				=	$obj->businessAction1;
		if (empty($oItem->percentageParticipant1))		$oItem->percentageParticipant1		=	$obj->percentageParticipant1;
		if (empty($oItem->businessAction2))				$oItem->businessAction2				=	$obj->businessAction2;
		if (empty($oItem->percentageParticipant2))		$oItem->percentageParticipant2		=	$obj->percentageParticipant2;
		if (empty($oItem->businessAction3))				$oItem->businessAction3				=	$obj->businessAction3;
		if (empty($oItem->percentageParticipant3))		$oItem->percentageParticipant3		=	$obj->percentageParticipant3;
		if (empty($oItem->activityDate))				$oItem->activityDate				=	$obj->activityDate;
		if (empty($oItem->partnerships))				$oItem->partnerships				=	$obj->partnerships;
		if (empty($oItem->ecoActivity))					$oItem->ecoActivity					=	$obj->ecoActivity;
		if (empty($oItem->retentionIgv))				$oItem->retentionIgv				=	$obj->retentionIgv;
		if (empty($oItem->observation))					$oItem->observation					=	$obj->observation;
		if (empty($oItem->user))						$oItem->user						=	$obj->user;
		if (empty($oItem->pass))						$oItem->pass						=	$obj->pass;
		if (empty($oItem->registerDate))				$oItem->registerDate				=	$obj->registerDate;
		if (empty($oItem->registerUpdate))				$oItem->registerUpdate				=	$obj->registerUpdate;
		if (empty($oItem->state))						$oItem->state						=	$obj->state;
	}
	else
		$MODULE->addError(CrmProveedor::GetErrorMsg());

	$MODULE->ItemTitle=$oItem->documentNumber;
}

$MODULE->FormTitle="Proveedor";
?>



