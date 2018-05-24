<?php
	/**
	 * Object represents table 'crm_nota_cliente'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmChat{
		
		public $chatID;
		public $message;
		public $userID;
		public $contactID;
		public $fecha;
		public $hora;
		public $type;

		public function __construct($chatID=NULL, $message=NULL, $userID=NULL,$contactID=NULL,$fecha=NULL,$hora=NULL,$type=NULL)
		{
			$this->chatID 		= $chatID;
			$this->message 		= $message;
			$this->userID		= $userID;
			$this->contactID	= $contactID;
			$this->fecha		= $fecha;
			$this->hora			= $hora;
			$this->type			= $type;
			
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



