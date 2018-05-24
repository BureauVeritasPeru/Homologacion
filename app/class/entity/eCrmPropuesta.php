<?php
	/**
	 * Object represents table 'crm_propuesta'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmPropuesta{
		
		public $propuestaID;
		public $proposalNumber;
		public $clienteID;
		public $proposalDate;
		public $description;
		public $sectorist;
		public $registerDate;
		public $state;
		

		public function __construct($propuestaID=NULL, $proposalNumber=NULL, $clienteID=NULL,$proposalDate=NULL,$description=NULL,$sectorist=NULL,$registerDate=NULL,$state=NULL)
		{
			$this->propuestaID 			= $propuestaID;
			$this->proposalNumber 		= $proposalNumber;
			$this->clienteID			= $clienteID;
			$this->proposalDate			= $proposalDate;
			$this->description			= $description;
			$this->sectorist			= $sectorist;	
			$this->registerDate			= $registerDate;
			$this->state				= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



