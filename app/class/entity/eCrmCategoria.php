<?php
	/**
	 * Object represents table 'crm_categoria'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmCategoria{
		
		public $categoriaID;
		public $description;
		public $registerDate;
		public $state;
		

		public function __construct($categoriaID=NULL, $description=NULL, $registerDate=NULL, $state=NULL)
		{
			$this->categoriaID 			= $categoriaID;
			$this->description 		= $description;
			$this->registerDate		= $registerDate;
			$this->state 			= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>