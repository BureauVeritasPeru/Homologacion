<?php
	/**
	 * Object represents table 'crm_contacto'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmContacto{
		
		public $contactoID;
		public $clienteID;
		public $nameContact;
		public $positionContact;
		public $phoneContact;
		public $emailContact;
		public $registerDate;
		
		public function __constclienteIDt($contactoID=NULL,$clienteID=NULL,$nameContact=NULL,$positionContact=NULL,$phoneContact=NULL,$emailContact=NULL,$registerDate=NULL)
		{
			$this->contactoID 			= $bienID;
			$this->clienteID 			= $clienteID;
			$this->nameContact			= $nameContact;
			$this->positionContact		= $positionContact;
			$this->phoneContact			= $phoneContact;
			$this->emailContact			= $emailContact;
			$this->registerDate			= $registerDate;
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



