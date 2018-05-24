<?php
	/**
	 * Object represents table 'crm_bien'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmVoucher{
		
		public $voucherID;
		public $requerimientoID;
		public $fileVoucher;
		public $dateVoucher;
		public $amount;
		public $observation;
		public $registerDate;
		public $registerUpdate;
		public $state;
		

		public function __construct($voucherID=NULL, $requerimientoID=NULL, $fileVoucher=NULL,$dateVoucher=NULL,$amount=NULL,$observation=NULL,$registerDate=NULL, $registerUpdate=NULL, $state=NULL)
		{
			$this->voucherID 			= $voucherID;
			$this->requerimientoID 		= $requerimientoID;
			$this->fileVoucher			= $fileVoucher;
			$this->dateVoucher			= $dateVoucher;
			$this->amount				= $amount;
			$this->observation 			= $observation;
			$this->registerDate 		= $registerDate;
			$this->registerUpdate		= $registerUpdate;
			$this->state 				= $state;
			
			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>