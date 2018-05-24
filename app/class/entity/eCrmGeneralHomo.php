<?php
	/**
	 * Object represents table 'crm_general_homo'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmGeneralHomo{
		
		public $generalHomoID;
		public $checkID;
		public $homologacionID;
		public $scoreAcu;
		public $scoreRes;
		public $observation;
		public $registerDate;
		public $registerUpdate;
		

		public function __construct($generalHomoID=NULL,$checkID=NULL,$homologacionID=NULL,$scoreAcu=NULL,$scoreRes=NULL,$observation=NULL,$registerDate=NULL,$registerUpdate=NULL)
		{
			$this->generalHomoID		=	$generalHomoID;
			$this->checkID				=	$checkID;
			$this->homologacionID		=	$homologacionID;
			$this->scoreAcu				=	$scoreAcu;
			$this->scoreRes				=	$scoreRes;
			$this->observation			=	$observation;
			$this->registerDate			=	$registerDate;
			$this->registerUpdate		=	$registerUpdate;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



