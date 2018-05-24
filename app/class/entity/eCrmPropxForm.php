<?php
	/**
	 * Object represents table 'crm_propuesta'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmPropxForm{
		
		public $propxformID;
		public $propuestaID;
		public $typeForm;
		public $titleForm;
		public $amount;
		public $fileProposal;
		public $tagImport;
		public $stateForm;
		public $registerDate;
		

		public function __construct($propxformID=NULL,$propuestaID=NULL,$typeForm=NULL, $titleForm=NULL,$amount=NULL,$fileProposal=NULL,$tagImport=NULL,$stateForm=NULL,$registerDate=NULL)
		{
			$this->propxformID 			= $propxformID;
			$this->propuestaID 			= $propuestaID;
			$this->typeForm 			= $typeForm;
			$this->titleForm			= $titleForm;
			$this->amount				= $amount;
			$this->fileProposal			= $fileProposal;
			$this->tagImport			= $tagImport;
			$this->stateForm			= $stateForm;	
			$this->registerDate			= $registerDate;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



