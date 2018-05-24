<?php
	/**
	 * Object represents table 'crm_cliente'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmCliente{
		
		public $clienteID;
		public $ruc;
		public $businessName;
		public $address;
		public $department;
		public $province;
		public $district;
		public $phone;
		public $email;
		public $fax;
		public $sectorist;
		public $observation;
		public $user;
		public $pass;
		public $registerDate;
		public $registerUpdate;
		public $state;
		

		public function __construct($clienteID=NULL, $ruc=NULL, $businessName=NULL,$address=NULL,$department=NULL,$province=NULL,$district=NULL,$phone=NULL,$email=NULL,$fax=NULL,$sectorist=NULL,$observation=NULL,$user=NULL,$pass=NULL,$registerDate=NULL,$registerUpdate=NULL,$state=NULL)
		{
			$this->clienteID 			= $clienteID;
			$this->ruc 					= $ruc;
			$this->businessName			= $businessName;
			$this->address				= $address;
			$this->department			= $department;
			$this->province				= $province;
			$this->district				= $district;
			$this->phone				= $phone;
			$this->email				= $email;
			$this->fax					= $fax;
			$this->sectorist			= $sectorist;
			$this->observation			= $observation;
			$this->user					= $user;
			$this->pass					= $pass;
			$this->registerDate			= $registerDate;
			$this->registerUpdate		= $registerUpdate;
			$this->state				= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



