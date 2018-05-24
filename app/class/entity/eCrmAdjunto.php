<?php
	/**
	 * Object represents table 'crm_adjunto'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmAdjunto{
		
		public $adjID;
		public $preadjID;
		public $formID;
		public $title;
		public $code;
		public $registerDate;
		public $state;

		public function __construct($adjID=NULL, $preadjID=NULL, $formID=NULL,$title=NULL,$code=NULL,$registerDate=NULL,$state=NULL)
		{
			$this->adjID 			= $adjID;
			$this->preadjID 		= $preadjID;
			$this->formID			= $formID;
			$this->title			= $title;
			$this->code				= $code;
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



