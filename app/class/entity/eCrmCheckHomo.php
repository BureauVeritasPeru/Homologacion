<?php
	/**
	 * Object represents table 'crm_check_homo'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmCheckHomo{
		
		public $checkHomoID;
		public $checkID;
		public $homologacionID;
		public $response1;
		public $response2;
		public $response3;
		public $response4;
		public $response5;
		public $score;
		public $registerDate;
		public $registerUpdate;
		

		public function __construct($checkHomoID=NULL,$checkID=NULL,$homologacionID=NULL,$response1=NULL,$response2=NULL,$response3=NULL,$response4=NULL,$response5=NULL,$score=NULL,$registerDate=NULL,$registerUpdate=NULL)
		{
			$this->checkHomoID		=	$checkHomoID;
			$this->checkID			=	$checkID;
			$this->homologacionID	=	$homologacionID;
			$this->response1		=	$response1;
			$this->response2		=	$response2;
			$this->response3		=	$response3;
			$this->response4		=	$response4;
			$this->response5		=	$response5;
			$this->score			=	$score;
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



