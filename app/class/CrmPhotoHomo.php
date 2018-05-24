<?php
require_once("base/Database.php");

class CrmPhotoHomo extends Database
{

	public static function  getItem($photoHomoID){
		$query = "
		SELECT *
		FROM crm_photo_homo
		WHERE photoHomoID='$photoHomoID' ";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_photo_homo
		ORDER BY photoHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getItemxHomologacion($homologacionID){
		$query ="
		SELECT count(*) as homologacionID
		FROM crm_photo_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY photoHomoID DESC";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemxHomologacion2($homologacionID){
		$query ="
		SELECT * 
		FROM crm_photo_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY photoHomoID DESC";

		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getListxHomologacion($homologacionID){
		$query ="
		SELECT *
		FROM crm_photo_homo
		WHERE homologacionID='$homologacionID'
		ORDER BY photoHomoID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  AddNew($oPhotoHomo){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(photoHomoID), 0) FROM crm_photo_homo";
		$result = parent::GetResult($sql);
		$oPhotoHomo->photoHomoID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_photo_homo(photoHomoID,homologacionID,photo1,description1,photo2,description2,photo3,description3,photo4,description4,photo5,description5,photo6,description6,photo7,description7,photo8,description8,registerDate,registerUpdate)
		VALUES ('$oPhotoHomo->photoHomoID','$oPhotoHomo->homologacionID','$oPhotoHomo->photo1','$oPhotoHomo->description1','$oPhotoHomo->photo2','$oPhotoHomo->description2','$oPhotoHomo->photo3','$oPhotoHomo->description3','$oPhotoHomo->photo4','$oPhotoHomo->description4','$oPhotoHomo->photo5','$oPhotoHomo->description5','$oPhotoHomo->photo6','$oPhotoHomo->description6','$oPhotoHomo->photo7','$oPhotoHomo->description7','$oPhotoHomo->photo8','$oPhotoHomo->description8',NOW(),NOW())";
            //die($query);
		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update($oPhotoHomo){
		$query = "
		UPDATE crm_photo_homo
		SET
		photo1				=	'$oPhotoHomo->photo1',
		description1		=	'$oPhotoHomo->description1',
		photo2				=	'$oPhotoHomo->photo2',
		description2		=	'$oPhotoHomo->description2',
		photo3				=	'$oPhotoHomo->photo3',
		description3		=	'$oPhotoHomo->description3',
		photo4				=	'$oPhotoHomo->photo4',
		description4		=	'$oPhotoHomo->description4',
		photo5				=	'$oPhotoHomo->photo5',
		description5		=	'$oPhotoHomo->description5',
		photo6				=	'$oPhotoHomo->photo6',
		description6		=	'$oPhotoHomo->description6',
		photo7				=	'$oPhotoHomo->photo7',
		description7		=	'$oPhotoHomo->description7',
		photo8				=	'$oPhotoHomo->photo8',
		description8		=	'$oPhotoHomo->description8',
		registerUpdate 		=	NOW()
		WHERE homologacionID = '$oPhotoHomo->homologacionID'";

		return parent::Execute($query);
		//secho $query;
	}


	public static function  Delete($oPhotoHomo){
		$query = "
		DELETE FROM crm_photo_homo
		WHERE photoHomoID='$oPhotoHomo->photoHomoID'";

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



