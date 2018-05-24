<?php
	/**
	 * Object represents table 'crm_check_homo'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmAdjHomo{
		
		public $adjHomoID;
		public $adjID;
		public $homologacionID;
		public $fileAdj;
		public $registerDate;
		public $registerUpdate;
		

		public function __construct($adjHomoID=NULL,$adjID=NULL,$homologacionID=NULL,$fileAdj=NULL,$registerDate=NULL,$registerUpdate=NULL)
		{
			$this->adjHomoID		=	$adjHomoID;
			$this->adjID			=	$adjID;
			$this->homologacionID	=	$homologacionID;
			$this->fileAdj			=	$fileAdj;
			$this->registerDate		=	$registerDate;
			$this->registerUpdate	=	$registerUpdate;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



