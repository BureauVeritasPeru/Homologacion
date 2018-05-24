<?php
	/**
	 * Object represents table 'crm_bien'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmBien{
		
		public $bienID;
		public $description;
		public $registerDate;
		public $state;
		

		public function __construct($bienID=NULL, $description=NULL, $registerDate=NULL, $state=NULL)
		{
			$this->bienID 			= $bienID;
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