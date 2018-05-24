<?php
require_once("base/Database.php");

class CrmProceso extends Database
{

	public static function  getItem($procesoID){
		$query = "
		SELECT *
		FROM crm_proceso
		WHERE procesoID='$procesoID' ";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_proceso
		ORDER BY procesoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  getListxFecha($d,$m,$y,$userID){
		$query = "SELECT * FROM crm_proceso
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
	


	public static function  getList_Paging(){
		$query ="
		SELECT *
		FROM crm_proceso
		";

		return parent::GetCollection(parent::GetResultPaging($query));
	}
	
	public static function  AddNew($oProceso){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(procesoID), 0) FROM crm_proceso";
		$result = parent::GetResult($sql);
		$oProceso->procesoID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_proceso(procesoID,programDate,hourDate,hourEndDate,process,userID,registerDate,registerUpdate)
		VALUES ('$oProceso->procesoID','$oProceso->programDate','$oProceso->hourDate','$oProceso->hourEndDate','$oProceso->process','$oProceso->userID', NOW(),NOW())";
		return parent::Execute($query);
		//echo $query;
	}
	public static function  Delete($oProceso){
		$query = "
		DELETE FROM crm_proceso
		WHERE procesoID='$oProceso->procesoID'";

		return parent::Execute($query);
	}

	
}

?>



