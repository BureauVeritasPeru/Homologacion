<?php
require_once("base/Database.php");

class CrmCheckHomo extends Database
{

	public static function  getItem($checkHomoID){
		$query = "
		SELECT *
		FROM crm_check_homo
		WHERE checkHomoID='$checkHomoID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemxCheckHomo($checkID,$homologacionID){
		$query = "
		SELECT *
		FROM crm_check_homo
		WHERE checkID='$checkID' 
		AND   homologacionID='$homologacionID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	
	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_check_homo
		ORDER BY checkHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getItemxHomologacion($homologacionID){
		$query ="
		SELECT count(*) as homologacionID
		FROM crm_check_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY checkHomoID DESC";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getListxHomologacion($homologacionID){
		$query ="
		SELECT *
		FROM crm_check_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY checkHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Active(){
		$query ="
		SELECT *
		FROM crm_check_homo
		WHERE state='1'
		ORDER BY checkHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oCheckHomo){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(checkHomoID), 0) FROM crm_check_homo";
		$result = parent::GetResult($sql);
		$oCheckHomo->checkHomoID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_check_homo(checkHomoID,checkID,homologacionID,response1,response2,response3,response4,response5,score,registerDate,registerUpdate)
		VALUES ('$oCheckHomo->checkHomoID','$oCheckHomo->checkID','$oCheckHomo->homologacionID','$oCheckHomo->response1','$oCheckHomo->response2','$oCheckHomo->response3','$oCheckHomo->response4','$oCheckHomo->response5','$oCheckHomo->score',NOW(),NOW())";
            //die($query);
		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update($oCheckHomo){
		$query = "
		UPDATE crm_check_homo
		SET
		response1               =   '$oCheckHomo->response1',
		response2               =   '$oCheckHomo->response2',
		response3               =   '$oCheckHomo->response3',
		response4               =   '$oCheckHomo->response4',
		response5               =   '$oCheckHomo->response5',
		score                   =   '$oCheckHomo->score',
		registerUpdate 			=	NOW()
		WHERE checkID   =   '$oCheckHomo->checkID'
		AND homologacionID = '$oCheckHomo->homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update2($oCheckHomo){
		$query = "
		UPDATE crm_check_homo
		SET
		score                   =   '$oCheckHomo->score',
		registerUpdate 			=	NOW()
		WHERE checkID   =   '$oCheckHomo->checkID'
		AND homologacionID = '$oCheckHomo->homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}


	public static function  Delete($oCheckHomo){
		$query = "
		DELETE FROM crm_check_homo
		WHERE checkHomoID='$oCheckHomo->checkHomoID'";

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



