<?php
require_once("base/Database.php");

class CrmGeneralHomo extends Database
{

	public static function  getItem($generalHomoID){
		$query = "
		SELECT *
		FROM crm_general_homo
		WHERE generalHomoID='$generalHomoID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemxGeneralHomo($checkID,$homologacionID){
		$query = "
		SELECT *
		FROM crm_general_homo
		WHERE checkID='$checkID' 
		AND   homologacionID='$homologacionID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	
	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_general_homo
		ORDER BY generalHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getItemxHomologacion($homologacionID){
		$query ="
		SELECT count(*) as homologacionID
		FROM crm_general_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY generalHomoID DESC";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getListxHomologacion($homologacionID){
		$query ="
		SELECT *
		FROM crm_general_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY generalHomoID ASC";

		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  AddNew($oGeneralHomo){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(generalHomoID), 0) FROM crm_general_homo";
		$result = parent::GetResult($sql);
		$oGeneralHomo->generalHomoID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_general_homo(generalHomoID,checkID,homologacionID,scoreAcu,scoreRes,observation,registerDate,registerUpdate)
		VALUES ('$oGeneralHomo->generalHomoID','$oGeneralHomo->checkID','$oGeneralHomo->homologacionID','$oGeneralHomo->scoreAcu','$oGeneralHomo->scoreRes','$oGeneralHomo->observation',NOW(),NOW())";
            //die($query);
		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update($oGeneralHomo){
		$query = "
		UPDATE crm_general_homo
		SET
		scoreAcu               		=   '$oGeneralHomo->scoreAcu',
		scoreRes               		=   '$oGeneralHomo->scoreRes',
		observation               	=   '$oGeneralHomo->observation',
		registerUpdate 				=	NOW()
		WHERE checkID   =   '$oGeneralHomo->checkID'
		AND homologacionID = '$oGeneralHomo->homologacionID'";

		return parent::Execute($query);
		//secho $query;
	}


	public static function  Delete($oGeneralHomo){
		$query = "
		DELETE FROM crm_general_homo
		WHERE generalHomoID='$oGeneralHomo->generalHomoID'";

		return parent::Execute($query);
	}

	public static function getState($state){
		switch($state){
			case 1:
			return "Activo"; break;
			case 2:
			return "Bloqueado"; break;
			case 0:
			return "Inactivo"; break;
		}
	}

}

?>



