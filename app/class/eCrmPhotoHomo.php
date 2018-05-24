<?php
	/**
	 * Object represents table 'crm_photo_homo'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmPhotoHomo{
		
		public $photoHomoID;
		public $homologacionID;
		public $photo1;
		public $description1;
		public $photo2;
		public $description2;
		public $photo3;
		public $description3;
		public $photo4;
		public $description4;
		public $photo5;
		public $description5;
		public $photo6;
		public $description6;
		public $photo7;
		public $description7;
		public $photo8;
		public $description8;
		public $registerDate;
		public $registerUpdate;
		

		public function __construct($photoHomoID=NULL,$homologacionID=NULL,$photo1=NULL,$description1=NULL,$photo2=NULL,$description2=NULL,$photo3=NULL,$description3=NULL,$photo4=NULL,$description4=NULL,$photo5=NULL,$description5=NULL,$photo6=NULL,$description6=NULL,$photo7=NULL,$description7=NULL,$photo8=NULL,$description8=NULL,$registerDate=NULL,$registerUpdate=NULL)
		{
			$this->photoHomoID			=	$photoHomoID;
			$this->homologacionID		=	$homologacionID;
			$this->photo1				= 	$photo1;			
			$this->description1			= 	$description1;			
			$this->photo2				= 	$photo2;			
			$this->description2			= 	$description2;			
			$this->photo3				= 	$photo3;			
			$this->description3			= 	$description3;			
			$this->photo4				= 	$photo4;			
			$this->description4			= 	$description4;			
			$this->photo5				= 	$photo5;			
			$this->description5			= 	$description5;			
			$this->photo6				= 	$photo6;			
			$this->description6			= 	$description6;			
			$this->photo7				= 	$photo7;			
			$this->description7			= 	$description7;			
			$this->photo8				= 	$photo8;			
			$this->description8			= 	$description8;	
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



