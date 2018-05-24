<?php
require_once("base/Database.php");

class CrmAdjHomo extends Database
{

	public static function  getItem($adjHomoID){
		$query = "
		SELECT *
		FROM crm_adj_homo
		WHERE adjHomoID='$adjHomoID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemxAdjHomo($adjID,$homologacionID){
		$query = "
		SELECT *
		FROM crm_adj_homo
		WHERE adjID='$adjID' 
		AND   homologacionID='$homologacionID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	
	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_adj_homo
		ORDER BY adjHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListxHomologacion($homologacionID){
		$query ="
		SELECT *
		FROM crm_adj_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY adjHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Active(){
		$query ="
		SELECT *
		FROM crm_adj_homo
		ORDER BY adjHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oAdjHomo){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(adjHomoID), 0) FROM crm_adj_homo";
		$result = parent::GetResult($sql);
		$oAdjHomo->adjHomoID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_adj_homo(adjHomoID,adjID,homologacionID,fileAdj,registerDate,registerUpdate)
		VALUES ('$oAdjHomo->adjHomoID','$oAdjHomo->adjID','$oAdjHomo->homologacionID','$oAdjHomo->fileAdj',NOW(),NOW())";
            //die($query);
		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update($oAdjHomo){
		$query = "
		UPDATE crm_adj_homo
		SET
		fileAdj               	=   '$oAdjHomo->fileAdj',
		registerUpdate 			=	NOW()
		WHERE adjID   		=   '$oAdjHomo->adjID'
		AND homologacionID = '$oAdjHomo->homologacionID'";

		return parent::Execute($query);
		//echo $query;
	}


	public static function  Delete($oAdjHomo){
		$query = "
		DELETE FROM crm_adj_homo
		WHERE adjID='$oAdjHomo->adjID'
		AND homologacionID = '$oAdjHomo->homologacionID'";

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



