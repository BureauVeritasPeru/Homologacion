<?php
require_once("base/Database.php");

class CrmHomologacion extends Database
{

	public static function  getItem($homologacionID){
		$query = "
		SELECT *
		FROM crm_homologacion
		WHERE homologacionID='$homologacionID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemValidation($homologacionID,$proveedorID){
		$query = "
		SELECT *
		FROM crm_homologacion h
		INNER JOIN crm_requerimiento r ON (h.requerimientoID = r.requerimientoID)
		WHERE h.homologacionID='$homologacionID'
		AND r.proveedorID='$proveedorID' ";
		return parent::GetObject(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemRequerimiento($requerimientoID){
		$query = "
		SELECT *
		FROM crm_homologacion 
		WHERE requerimientoID='$requerimientoID' ";
		return parent::GetObject(parent::GetResult($query));
		//echo $query;
	}

	public static function  getItemFormulario($homologacionID){
		$query = "
		SELECT fp.typeForm
		FROM crm_homologacion h
		INNER JOIN crm_requerimiento r ON (h.requerimientoID = r.requerimientoID)
		INNER JOIN crm_proveedor p ON (r.proveedorID = p.proveedorID)
		INNER JOIN crm_form_propuesta fp ON (r.propxformID = fp.propxformID)
		WHERE h.homologacionID='$homologacionID'";
		return parent::GetObject(parent::GetResult($query));
		//echo $query;
	}


	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_homologacion
		ORDER BY homologacionID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListxVencimiento(){
		$query ="
		SELECT *
		FROM crm_homologacion
		WHERE 
		state in (1,6)
		ORDER BY homologacionID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListProgramado(){
		$query ="
		SELECT *
		FROM crm_homologacion
		WHERE 
		state in (2,3,4,5,6)
		ORDER BY homologacionID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListInProcess(){
		$query ="
		SELECT *
		FROM crm_homologacion
		WHERE 
		state in (3,4,5,6)
		ORDER BY homologacionID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListxProgramar(){
		$query ="
		SELECT *
		FROM crm_homologacion
		WHERE 
		state in (2)
		AND
		programDate IS NULL
		ORDER BY homologacionID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_ClienteByGrafico($clienteID){
		$query ="
		SELECT h.state,count(*) as homologacionID  
		FROM crm_homologacion h INNER JOIN crm_requerimiento r ON (h.requerimientoID = r.requerimientoID)
		INNER JOIN crm_form_propuesta fp ON (r.propxformID = fp.propxformID)
		INNER JOIN crm_propuesta p ON (p.propuestaID = fp.propuestaID)
		WHERE p.clienteID = '$clienteID'
		GROUP BY h.state
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getlistxProveedor($proveedorID){
		$query ="
		SELECT r.requerimientoID,h.homologacionID,h.state,h.nivel,h.puntajeFinal
		FROM crm_homologacion h 
		INNER JOIN crm_requerimiento r ON (h.requerimientoID = r.requerimientoID)
		WHERE 
		r.proveedorID = '$proveedorID'
		ORDER BY homologacionID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getlistxCliente($clienteID){
		$query ="
		SELECT r.requerimientoID,h.homologacionID,h.state,h.nivel,h.certification,h.puntajeFinal
		FROM crm_homologacion h 
		INNER JOIN crm_requerimiento r ON (h.requerimientoID = r.requerimientoID)
		INNER JOIN crm_proveedor p ON (r.proveedorID = p.proveedorID)
		INNER JOIN crm_form_propuesta fp ON (r.propxformID = fp.propxformID)
		INNER JOIN crm_propuesta pro ON (fp.propuestaID = pro.propuestaID)
		INNER JOIN crm_cliente c ON (pro.clienteID = c.clienteID)
		WHERE 
		c.clienteID = '$clienteID'
		ORDER BY homologacionID DESC ";

		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  getlistxAuditor($auditorID){
		$query ="
		SELECT *
		FROM crm_homologacion h 
		WHERE 
		h.userID = '$auditorID'
		ORDER BY homologacionID DESC ";

		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  getListxFecha($d,$m,$y,$userID){
		$query = "SELECT * FROM crm_homologacion
		WHERE 1=1";
		if($d != ''){
			$query .= " AND  DAY(programDate) =".$d;
		}	
		if($m != ''){
			$query .= " AND MONTH(programDate) =".$m;
		}
		if($y != ''){
			$query .= " AND  YEAR(programDate) =".$y;
		}
		$query .= " AND userID =".$userID;

		$query .= " ORDER BY programDate DESC";
		//echo $query; 
		return parent::GetCollection(parent::GetResult($query));
	}
	

	public static function  getListxFecha2($d,$m,$y){
		$query = "SELECT * FROM crm_homologacion
		WHERE 1=1";
		if($d != ''){
			$query .= " AND  DAY(programDate) =".$d;
		}	
		if($m != ''){
			$query .= " AND MONTH(programDate) =".$m;
		}
		if($y != ''){
			$query .= " AND  YEAR(programDate) =".$y;
		}
		$query .= " ORDER BY programDate DESC";
		//echo $query; 
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  getList_Paging(){
		$query ="
		SELECT *
		FROM crm_homologacion
		";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Export(){
		$query ="
		SELECT *
		FROM crm_homologacion
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}


	
	public static function  AddNew($oHomologacion){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(homologacionID), 0) FROM crm_homologacion";
		$result = parent::GetResult($sql);
		$oHomologacion->homologacionID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_homologacion(homologacionID,requerimientoID,state,registerDate,registerExpire,registerUpdate)
		VALUES ('$oHomologacion->homologacionID','$oHomologacion->requerimientoID','$oHomologacion->state',NOW(),NOW()+ INTERVAL 15 DAY,NOW())";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  UpdateDateExpiration($id,$date){
		$query = "
		UPDATE crm_homologacion
		SET
		registerExpire        	=   '$date'
		WHERE homologacionID   =   '$id'";

		return parent::Execute($query);
		//echo $query;
	}	


	public static function  Update($oHomologacion){
		$query = "
		UPDATE crm_homologacion
		SET
		document				=	'$oHomologacion->document',
		scope					=	'$oHomologacion->scope',
		observation				=	'$oHomologacion->observation',
		registerUpdate			=	NOW()
		WHERE homologacionID    =   '$oHomologacion->homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}

	public static function  UpdateState($homologacionID,$state){
		$query = "
		UPDATE crm_homologacion
		SET
		state 					=   '$state',
		registerUpdate			=	NOW()
		WHERE homologacionID    =   '$homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}

	public static function  UpdateResultados($homologacionID,$puntajeFinal,$nivel){
		$query = "
		UPDATE crm_homologacion
		SET
		puntajeFinal 					=   '$puntajeFinal',
		nivel 							=   '$nivel',
		registerUpdate					=	NOW()
		WHERE homologacionID    =   '$homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}

	public static  function UpdateCertification($homologacionID,$certification){
		$query = "
		UPDATE crm_homologacion
		SET
		certification 					=   '$certification',
		state 							=   5,
		registerUpdate					=	NOW()
		WHERE homologacionID    =   '$homologacionID'";

		return parent::Execute($query);
		//echo $query;	
	}

	public static function  Update2($oHomologacion){
		$query = "
		UPDATE crm_homologacion
		SET
		registerUpdate			=	NOW(),
		state  					=   3
		WHERE homologacionID    =   '$oHomologacion->homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update3($oHomologacion){
		$query = "
		UPDATE crm_homologacion
		SET
		programDate				=	'$oHomologacion->programDate',
		hourDate				=	'$oHomologacion->hourDate',
		hourEndDate				=	'$oHomologacion->hourEndDate',
		userID					=	'$oHomologacion->userID',
		registerUpdate			=	NOW()
		WHERE homologacionID    =   '$oHomologacion->homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update3Day($id,$msg){
		$query = "
		UPDATE crm_homologacion
		SET
		threeDay             	=   '$msg'
		WHERE homologacionID   =   '$id'";
		return parent::Execute($query);
	}

	public static function  Update9Day($id,$msg){
		$query = "
		UPDATE crm_homologacion
		SET
		nineDay             	=   '$msg'
		WHERE homologacionID   =   '$id'";
		return parent::Execute($query);
	}


	public static function  Update14Day($id,$msg){
		$query = "
		UPDATE crm_homologacion
		SET
		fourteenDay             =   '$msg'
		WHERE homologacionID   =   '$id'";
		return parent::Execute($query);
	}
	
	public static function  UpdateAlerta($id,$msg){
		$query = "
		UPDATE crm_homologacion
		SET
		alert  =  CONCAT(COALESCE(alert,''),',','$msg')
		WHERE homologacionID   =   '$id'";
		return parent::Execute($query);
	}


	public static function  Delete($oHomologacion){
		$query = "
		DELETE FROM crm_homologacion
		WHERE homologacionID='$oHomologacion->homologacionID'";

		return parent::Execute($query);
	}
	
	public static function getState($state){
		switch($state){
			case 1:
			return "En Proceso"; break;
			case 2:
			return "Por Programar"; break;
			case 3:
			return "Auditoria Programada"; break;
			case 4:
			return "Auditado"; break;
			case 5:
			return "Auditoria Finalizada"; break;
			case 6:
			return "Vencido"; break;
			case 7:
			return "No Participa"; break;
			case 8:
			return "Control General"; break; //auditado en el caso del General
		}
	}

	public static function getStateCliente($state){
		switch($state){
			case 1:
			return "En Proceso"; break;
			case 2:
			return "Por Programar"; break;
			case 3:
			return "Auditoria Programada"; break;
			case 4:
			return "Auditado"; break;
			case 5:
			return "Auditoria Finalizada"; break;
			case 6:
			return "Vencido"; break;
			case 7:
			return "No Participa"; break;
			case 8:
			return "Auditado"; break; //auditado en el caso del General
		}
	}
	
}

?>



