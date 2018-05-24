<?php
require_once("base/Database.php");

class CrmRequerimiento extends Database
{

	public static function  getItem($requerimientoID){
		$query = "
		SELECT *
		FROM crm_requerimiento
		WHERE requerimientoID='$requerimientoID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemRequerimiento($oRequerimiento){
		$query = "
		SELECT r.requerimientoID,p.businessName,c.businessName AS businessCliente,r.state
		FROM crm_requerimiento r INNER JOIN crm_proveedor p ON (r.proveedorID = p.proveedorID)
		INNER JOIN crm_form_propuesta fp ON (r.propxformID = fp.propxformID)
		INNER JOIN crm_propuesta pro ON (fp.propuestaID = pro.propuestaID)
		INNER JOIN crm_cliente c ON (pro.clienteID = c.clienteID)
		WHERE r.requerimientoID='$oRequerimiento->requerimientoID' 
		AND r.state = 1";
		return parent::GetObject(parent::GetResult($query));
		//echo $query;
	}

	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_requerimiento
		ORDER BY requerimientoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListSinAprobar(){
		$query ="
		SELECT *
		FROM crm_requerimiento
		WHERE state in (1,3)
		ORDER BY requerimientoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  getList_Paging(){
		$query ="
		SELECT *
		FROM crm_requerimiento
		";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getListxFinanzas(){
		$query ="
		SELECT *
		FROM crm_requerimiento
		WHERE state in (1,2)
		";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getListxFinanzas_Voucher(){
		$query ="
		SELECT DISTINCT r.*
		FROM crm_requerimiento r  inner join crm_voucher v on(r.requerimientoID = v.requerimientoID)
		WHERE r.state in (1,2)
		";

		return parent::GetCollection(parent::GetResultPaging($query));
	}
	

	public static function  getList_Cliente($clienteID){
		$query ="
		SELECT r.*  
		FROM crm_requerimiento r 
		INNER JOIN crm_form_propuesta fp ON (r.propxformID = fp.propxformID)
		INNER JOIN crm_propuesta p ON (p.propuestaID = fp.propuestaID)
		WHERE p.clienteID = '$clienteID'
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_ClienteByGrafico($clienteID){
		$query ="
		SELECT r.state,count(*) as period,r.requerimientoID
		FROM crm_requerimiento r 
		INNER JOIN crm_form_propuesta fp ON (r.propxformID = fp.propxformID)
		INNER JOIN crm_propuesta p ON (p.propuestaID = fp.propuestaID)
		WHERE p.clienteID = '$clienteID'
		GROUP BY r.state
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Export(){
		$query ="
		SELECT *
		FROM crm_requerimiento
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}


	
	public static function  AddNew($oRequerimiento){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(requerimientoID), 0) FROM crm_requerimiento";
		$result = parent::GetResult($sql);
		$oRequerimiento->requerimientoID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_requerimiento(requerimientoID,period,propxformID,proveedorID,registerDate,registerExpire,registerUpdate,state)
		VALUES ('$oRequerimiento->requerimientoID','$oRequerimiento->period','$oRequerimiento->propxformID','$oRequerimiento->proveedorID',NOW(),NOW()+ INTERVAL 15 DAY,NOW(),1)";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oRequerimiento){
		$query = "
		UPDATE crm_requerimiento
		SET
		observation             =   '$oRequerimiento->observation',
		state                   =   '$oRequerimiento->state'
		WHERE requerimientoID   =   '$oRequerimiento->requerimientoID'";

		return parent::Execute($query);
	}

	public static function  UpdateMonto($id,$monto){
		$query = "
		UPDATE crm_requerimiento
		SET
		amount             		=   '$monto'
		WHERE requerimientoID   =   '$id'";

		return parent::Execute($query);
		//echo $query;
	}

	public static function  UpdateDateExpiration($id,$date){
		$query = "
		UPDATE crm_requerimiento
		SET
		registerExpire        	=   '$date'
		WHERE requerimientoID   =   '$id'";

		return parent::Execute($query);
		//echo $query;
	}	

	public static function  UpdateStateVencido($id,$state){
		$query = "
		UPDATE crm_requerimiento
		SET
		state = '$state'
		WHERE requerimientoID   =   '$id'";

		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update3Day($id,$msg){
		$query = "
		UPDATE crm_requerimiento
		SET
		threeDay             	=   '$msg'
		WHERE requerimientoID   =   '$id'";
		return parent::Execute($query);
	}

	public static function  Update9Day($id,$msg){
		$query = "
		UPDATE crm_requerimiento
		SET
		nineDay             	=   '$msg'
		WHERE requerimientoID   =   '$id'";
		return parent::Execute($query);
	}


	public static function  Update14Day($id,$msg){
		$query = "
		UPDATE crm_requerimiento
		SET
		fourteenDay             =   '$msg'
		WHERE requerimientoID   =   '$id'";
		return parent::Execute($query);
	}

	public static function  UpdateAlerta($id,$msg){
		$query = "
		UPDATE crm_requerimiento
		SET
		alert  =  CONCAT(COALESCE(alert,''),',','$msg')
		WHERE requerimientoID   =   '$id'";
		return parent::Execute($query);
	}

	public static function  Delete($oRequerimiento){
		$query = "
		DELETE FROM crm_requerimiento
		WHERE requerimientoID='$oRequerimiento->requerimientoID'";

		return parent::Execute($query);
	}
	
	public static function getState($state){
		switch($state){
			case 1:
			return "Notificado"; break;
			case 2:
			return "Aprobado"; break;
			case 3:
			return "Vencido"; break;
			case 4:
			return "Anulado"; break;
			case 5:
			return "No Participa"; break;
			case 6:
			return "Facturado"; break;
		}
	}
	
}

?>



