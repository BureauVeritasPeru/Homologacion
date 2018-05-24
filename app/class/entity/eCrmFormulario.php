<?php

class eCrmFormulario{
	
	public $formID;
	public $title;
	public $description;
	public $registerDate;
	public $registerUpdate;
	public $state;

	public function __construct($formID=null, $title=null, $description=null, $registerDate=null,$registerUpdate=null, $state=null)
	{
		$this->formID 				= $formID;
		$this->title 				= $title;
		$this->description    		= $description;
		$this->registerDate     	= $registerDate;
		$this->registerUpdate     	= $registerUpdate;
		$this->state				= $state;
		
		return $this;
	}

	public function __toString()
	{
		return Collection::objectToString($this);
	}

}
?>