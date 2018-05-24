<?php
	/**
	 * Object represents table 'crm_checklist'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmChecklist{
		
		public $checkID;
		public $parentCheckID;
		public $formID;
		public $typeCheck;
		public $title;
		public $question1;
		public $question2;
		public $question3;
		public $question4;
		public $question5;
		public $score;
		public $numScore;
		public $information;
		public $registerDate;
		public $state;
		

		public function __construct($checkID=NULL, $parentCheckID=NULL, $formID=NULL,$typeCheck=NULL,$title=NULL,$question1=NULL,$question2=NULL,$question3=NULL,$question4=NULL,$question5=NULL,$score=NULL,$numScore=NULL,$information=NULL,$registerDate=NULL,$state=NULL)
		{
			$this->checkID 				= $checkID;
			$this->parentCheckID 		= $parentCheckID;
			$this->formID				= $formID;
			$this->typeCheck			= $typeCheck;
			$this->title				= $title;
			$this->question1			= $question1;
			$this->question2			= $question2;
			$this->question3			= $question3;
			$this->question4			= $question4;
			$this->question5			= $question5;
			$this->score				= $score;
			$this->numScore				= $numScore;
			$this->information			= $information;
			$this->registerDate			= $registerDate;
			$this->state				= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



