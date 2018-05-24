<?php
	/**
	 * Object represents table 'crm_homologacion'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmHomologacion{
		
		public $homologacionID;
		public $requerimientoID;
		public $programDate;
		public $hourDate;
		public $hourEndDate;
		public $userID;
		public $document;
		public $scope;
		public $observation;
		public $nivel;
		public $puntajeFinal;
		public $state;
		public $threeDay;
		public $nineDay;
		public $fourteenDay;
		public $alert;
		public $certification;
		public $registerDate;
		public $registerExpire;
		public $registerUpdate;
		
		public $typeForm;

		public function __construct($homologacionID=NULL, $requerimientoID=NULL, $programDate=NULL,$hourDate=NULL,$hourEndDate=NULL,$userID=NULL,$document=NULL,$scope=NULL,$observation=NULL,$nivel=NULL,$puntajeFinal=NULL,$state=NULL,$threeDay=NULL,$nineDay=NULL,$fourteenDay=NULL,$alert=NULL,$certification=NULL,$registerDate=NULL,$registerExpire=NULL,$registerUpdate=NULL)
		{
			$this->homologacionID 	= $homologacionID;
			$this->requerimientoID 	= $requerimientoID;
			$this->programDate		= $programDate;
			$this->hourDate			= $hourDate;
			$this->hourEndDate		= $hourEndDate;
			$this->userID			= $userID;
			$this->document			= $document;	
			$this->scope			= $scope;
			$this->observation		= $observation;
			$this->nivel 			= $nivel;
			$this->puntajeFinal 	= $puntajeFinal;
			$this->state			= $state;
			$this->threeDay			= $threeDay;	
			$this->nineDay			= $nineDay;
			$this->fourteenDay		= $fourteenDay;
			$this->alert			= $alert;
			$this->certification	= $certification;
			$this->registerDate		= $registerDate;
			$this->registerExpire	= $registerExpire;
			$this->registerUpdate	= $registerUpdate;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



