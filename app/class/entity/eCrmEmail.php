<?php
	/**
	 * Object represents table 'crm_email'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmEmail{
		
		public $emailID;
		public $title;
		public $desde;
		public $subject;
		public $message;
		public $registerDate;
		public $state;

		public function __construct($emailID=NULL, $title=NULL, $desde=NULL,$subject=NULL,$message=NULL,$registerDate=NULL,$state=NULL)
		{
			$this->emailID 			= $emailID;
			$this->title 			= $title;
			$this->desde			= $desde;
			$this->subject			= $subject;
			$this->message			= $message;
			$this->registerDate		= $registerDate;
			$this->state			= $state;
			
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



