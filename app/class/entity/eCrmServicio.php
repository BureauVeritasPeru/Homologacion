<?php
	/**
	 * Object represents table 'crm_servicio'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmServicio{
		
		public $servicioID;
		public $description;
		public $registerDate;
		public $state;
		

		public function __construct($servicioID=NULL, $description=NULL, $registerDate=NULL, $state=NULL)
		{
			$this->servicioID 			= $servicioID;
			$this->description 		= $description;
			$this->registerDate		= $registerDate;
			$this->state 			= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>