<?php
	/**
	 * Object represents table 'crm_proveedor'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmProveedor{
		
		public $proveedorID;
		public $documentNumber;
		public $typeProvider;
		public $businessName;
		public $address;
		public $country;
		public $department;
		public $province;
		public $district;
		public $postalCode;
		public $phone;
		public $fax;
		public $email;
		public $contacts;
		public $legalDirection;
		public $departmentLegal;
		public $provinceLegal;
		public $districtLegal;
		public $legalRepresentative;
		public $commercialContactName;
		public $commercialContactPhone;
		public $commercialContactCellphone;
		public $commercialContactEmail;
		public $generalManagerName;
		public $generalManagerPhone;
		public $generalManagerCellphone;
		public $generalManagerEmail;
		public $bienID;
		public $servicioID;
		public $other;
		public $numberCollaborateAdmin;
		public $numberCollaborateOper;
		public $workShifts;
		public $businessAction1;
		public $percentageParticipant1;
		public $businessAction2;
		public $percentageParticipant2;
		public $businessAction3;
		public $percentageParticipant3;
		public $activityDate;
		public $partnerships;
		public $ecoActivity;
		public $retentionIgv;
		public $observation;
		public $user;
		public $pass;
		public $registration;
		public $testConstitution;
		public $firm;
		public $representation;
		public $licence;
		public $certInspeccion;
		public $registerMine;
		public $registerDate;
		public $registerUpdate;
		public $state;
		

		public function __construct($proveedorID=NULL, $documentNumber=NULL, $typeProvider=NULL, $businessName=NULL, $address=NULL, $country=NULL, $department=NULL, $province=NULL, $district=NULL, $postalCode=NULL, $phone=NULL, $fax=NULL, $email=NULL, $contacts=NULL, $legalDirection=NULL, $departmentLegal=NULL,$provinceLegal=NULL,$districtLegal=NULL,$legalRepresentative=NULL,$commercialContactName=NULL,$commercialContactPhone=NULL,$commercialContactCellphone=NULL,$commercialContactEmail=NULL,$generalManagerName=NULL,$generalManagerPhone=NULL,$generalManagerCellphone=NULL,$generalManagerEmail=NULL,$bienID=NULL,$servicioID=NULL,$other=NULL,$numberCollaborateAdmin=NULL,$numberCollaborateOper=NULL,$workShifts=NULL,$businessAction1=NULL,$percentageParticipant1=NULL,$businessAction2=NULL,$percentageParticipant2=NULL,$businessAction3=NULL,$percentageParticipant3=NULL,$activityDate=NULL,$partnerships=NULL,$ecoActivity=NULL,$retentionIgv=NULL,$observation=NULL,$user=NULL,$pass=NULL,$registration=NULL,$testConstitution=NULL,$firm=NULL,$representation=NULL,$licence=NULL,$certInspeccion=NULL,$registerMine=NULL,$registerDate=NULL,$registerUpdate=NULL,$state=NULL)
		{
			$this->proveedorID 					= $proveedorID;
			$this->documentNumber 				= $documentNumber;
			$this->typeProvider					= $typeProvider;
			$this->businessName					= $businessName;
			$this->address						= $address;
			$this->country 						= $country;
			$this->department					= $department;
			$this->province						= $province;
			$this->district						= $district;
			$this->postalCode					= $postalCode;
			$this->phone						= $phone;
			$this->fax							= $fax;
			$this->email						= $email;
			$this->contacts						= $contacts;
			$this->legalDirection				= $legalDirection;
			$this->departmentLegal				= $departmentLegal;
			$this->registerUpdate				= $registerUpdate;
			$this->provinceLegal				= $provinceLegal;
			$this->districtLegal				= $districtLegal;
			$this->legalRepresentative			= $legalRepresentative;
			$this->commercialContactName		= $commercialContactName;
			$this->commercialContactPhone		= $commercialContactPhone;
			$this->commercialContactCellphone	= $commercialContactCellphone;
			$this->commercialContactEmail		= $commercialContactEmail;
			$this->generalManagerName			= $generalManagerName;
			$this->generalManagerPhone			= $generalManagerPhone;
			$this->generalManagerCellphone		= $generalManagerCellphone;
			$this->generalManagerEmail			= $generalManagerEmail;
			$this->bienID						= $bienID;
			$this->servicioID					= $servicioID;
			$this->other						= $other;
			$this->numberCollaborateAdmin		= $numberCollaborateAdmin;
			$this->numberCollaborateOper		= $numberCollaborateOper;
			$this->workShifts					= $workShifts;
			$this->businessAction1				= $businessAction1;
			$this->percentageParticipant1		= $percentageParticipant1;
			$this->businessAction2				= $businessAction2;
			$this->percentageParticipant2		= $percentageParticipant2;
			$this->businessAction3				= $businessAction3;
			$this->percentageParticipant3		= $percentageParticipant3;
			$this->activityDate					= $activityDate;
			$this->partnerships					= $partnerships;
			$this->ecoActivity					= $ecoActivity;
			$this->retentionIgv					= $retentionIgv;
			$this->observation					= $observation;
			$this->user							= $user;
			$this->pass							= $pass;
			$this->registration					= $registration;
			$this->testConstitution				= $testConstitution;
			$this->firm							= $firm;
			$this->representation				= $representation;
			$this->licence						= $licence;
			$this->certInspeccion				= $certInspeccion;
			$this->registerMine					= $registerMine;
			$this->registerDate					= $registerDate;
			$this->registerUpdate				= $registerUpdate;
			$this->state						= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



