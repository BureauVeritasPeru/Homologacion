<?php
	/**
	 * Object represents table 'crm_nota_cliente'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmNivelCliente{
		
		public $nivelClienteID;
		public $clienteID;
		public $nivel;
		public $minimo;
		public $maximo;
		public $registerDate;
		public $registerUpdate;
		public $state;
		

		public function __construct($nivelClienteID=NULL, $clienteID=NULL, $nivel=NULL,$minimo=NULL,$maximo=NULL,$registerDate=NULL,$registerUpdate=NULL,$state=NULL)
		{
			$this->nivelClienteID 		= $nivelClienteID;
			$this->clienteID 			= $clienteID;
			$this->nivel				= $nivel;
			$this->minimo				= $minimo;
			$this->maximo				= $maximo;
			$this->registerDate			= $registerDate;
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



