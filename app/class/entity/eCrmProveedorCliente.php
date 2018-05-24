<?php
	/**
	 * Object represents table 'crm_proveedor_cliente'
	 *
     	 * @author: Junior Huallullo
     	 * @date: 2011-05-18 09:54
	*/
	class eCrmProveedorCliente{
		
		public $proveedorCliID;
		public $clienteID;
		public $proveedorID;
		public $propuestaID;
		public $registerDate;

		public function __construct($proveedorCliID=NULL,$clienteID=NULL,$proveedorID=NULL, $propuestaID=NULL,$registerDate=NULL)
		{
			$this->proveedorCliID 		= $proveedorCliID;
			$this->clienteID 			= $clienteID;
			$this->proveedorID 			= $proveedorID;
			$this->propuestaID			= $propuestaID;
			$this->registerDate			= $registerDate;

			return $this;
		}

		public function __toString()
		{
			return Collection::objectToString($this);
		}

	}
	?>



