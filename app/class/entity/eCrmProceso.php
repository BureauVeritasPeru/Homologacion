<?php
	/**
	 * Object represents table 'crm_homologacion'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmProceso{
		
		public $procesoID;
		public $programDate;
		public $hourDate;
		public $hourEndDate;
		public $userID;
		public $process;
		public $registerDate;
		public $registerUpdate;

		public function __construct($procesoID=NULL, $programDate=NULL,$hourDate=NULL,$hourEndDate=NULL,$process=NULL,$userID=NULL,$registerDate=NULL,$registerUpdate=NULL)
		{
			$this->procesoID 		= $procesoID;
			$this->programDate		= $programDate;
			$this->hourDate			= $hourDate;
			$this->hourEndDate		= $hourEndDate;
			$this->process 			= $process;
			$this->userID			= $userID;
			$this->registerDate		= $registerDate;
			$this->registerUpdate	= $registerUpdate;
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



