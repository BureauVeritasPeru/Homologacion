<?php
	/**
	 * Object represents table 'crm_concepto'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmConcepto{
		
		public $conceptoID;
		public $description;
		public $registerDate;
		public $state;
		

		public function __construct($conceptoID=NULL, $description=NULL, $registerDate=NULL, $state=NULL)
		{
			$this->conceptoID 		= $conceptoID;
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