<?php
require_once("base/Database.php");

class CrmChecklist extends Database
{

	public static function  getItem($checkID){
		$query = "
		SELECT *
		FROM crm_checklist
		WHERE checkID='$checkID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="
		SELECT *
		FROM crm_checklist
		ORDER BY checkID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListByFormulario($formID){
		$query ="
		SELECT *
		FROM crm_checklist
		WHERE formID='$formID' 
		AND precheckID = 0
		ORDER BY checkID ASC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListByCheck($checkID){
		$query ="
		SELECT *
		FROM crm_checklist
		WHERE precheckID='$checkID' 
		ORDER BY checkID ASC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="
		SELECT *
		FROM crm_checklist
		";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Export(){
		$query ="
		SELECT *
		FROM crm_checklist
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Active(){
		$query ="
		SELECT *
		FROM crm_checklist
		WHERE state='1'
		ORDER BY checkID DESC";

		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oCheckList){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(checkID), 0) FROM crm_checklist";
		$result = parent::GetResult($sql);
		$oCheckList->checkID =parent::fetchScalar($result)+1;

            //Insert data into the table
		$query = "INSERT INTO crm_checklist(checkID,precheckID,formID,typeCheck,title,question1,question2,question3,question4,question5,score,numScore,information,registerDate,state)
		VALUES ('$oCheckList->checkID','$oCheckList->precheckID','$oCheckList->formID','$oCheckList->typeCheck','$oCheckList->title','$oCheckList->question1','$oCheckList->question2','$oCheckList->question3','$oCheckList->question4','$oCheckList->question5','$oCheckList->score','$oCheckList->numScore','$oCheckList->information',NOW(),'$oCheckList->state')";
            //die($query);
		return parent::Execute($query);
		//echo $query;
	}

	public static function  AddNew2($precheckID,$formID,$typeCheck,$title,$question1,$question2,$question3,$question4,$question5,$score,$numScore,$information,$oCheckList){
            //Search the max Id
		$sql = "SELECT IFNULL(MAX(checkID), 0) FROM crm_checklist";
		$result = parent::GetResult($sql);
		$oCheckList->checkID =parent::fetchScalar($result)+1;
            //Insert data into the table
		$query = "INSERT INTO crm_checklist(checkID,precheckID,formID,typeCheck,title,question1,question2,question3,question4,question5,score,numScore,information,registerDate,state)
		VALUES ('$oCheckList->checkID',$precheckID,'$formID','$typeCheck','$title','$question1','$question2','$question3','$question4','$question5','$score','$numScore','$information',NOW(),1)";
            //die($query);
		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update($oCheckList){
		$query = "
		UPDATE crm_checklist
		SET typeCheck           =   '$oCheckList->typeCheck',
		title                   =   '$oCheckList->title',
		question1               =   '$oCheckList->question1',
		question2               =   '$oCheckList->question2',
		question3               =   '$oCheckList->question3',
		question4               =   '$oCheckList->question4',
		question5               =   '$oCheckList->question5',
		score                   =   '$oCheckList->score',
		numScore                =   '$oCheckList->numScore',
		information             =   '$oCheckList->information',
		state                   =   '$oCheckList->state'
		WHERE checkID   =   '$oCheckList->checkID'";

		return parent::Execute($query);
		//echo $query;
	}


	public static function  Delete($oCheckList){
		$query = "
		DELETE FROM crm_checklist
		WHERE checkID='$oCheckList->checkID'";

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

	public static function getValor($state){
		switch($state){
			case 1:
			return 'Si'; break;
			case 2:
			return "No"; break;
			case 3:
			return "No Aplica"; break;
		}
	}

}

?>



