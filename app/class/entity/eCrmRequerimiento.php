<?php
	/**
	 * Object represents table 'crm_requerimiento'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmRequerimiento{
		
		public $requerimientoID;
		public $period;
		public $propxformID;
		public $proveedorID;
		public $observation;
		public $amount;
		public $threeDay;
		public $nineDay;
		public $fourteenDay;
		public $alert;
		public $registerDate;
		public $registerExpire;
		public $registerUpdate;
		public $state;
		

		// ------------------------

		public $businessName;
		public $businessCliente;
		public $ruc;
		
		public function __construct($requerimientoID=NULL, $period=NULL, $propxformID=NULL,$proveedorID=NULL,$observation=NULL,$amount=NULL,$threeDay=NULL,$nineDay=NULL,$fourteenDay=NULL,$alert=NULL,$registerDate=NULL,$registerExpire=NULL,$registerUpdate=NULL,$state=NULL)
		{
			$this->requerimientoID 		= $requerimientoID;
			$this->period 				= $period;
			$this->propxformID			= $propxformID;
			$this->proveedorID			= $proveedorID;
			$this->observation			= $observation;
			$this->amount				= $amount;	
			$this->threeDay				= $threeDay;	
			$this->nineDay				= $nineDay;
			$this->fourteenDay			= $fourteenDay;
			$this->alert				= $alert;
			$this->registerDate			= $registerDate;
			$this->registerExpire		= $registerExpire;
			$this->registerUpdate		= $registerUpdate;
			$this->state				= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



