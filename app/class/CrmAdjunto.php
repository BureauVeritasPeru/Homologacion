<?php
require_once("base/Database.php");

class CrmAdjunto extends Database
{

	public static function  getItem($adjID){
        $query = "
        SELECT *
        FROM crm_adjunto
        WHERE adjID='$adjID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_adjunto
        ORDER BY adjID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    public static function  getListByFormulario($formID){
        $query ="
        SELECT *
        FROM crm_adjunto
        WHERE formID='$formID' 
        AND preadjID = 0
        ORDER BY adjID ASC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListByAdj($adjID){
        $query ="
        SELECT *
        FROM crm_adjunto
        WHERE preadjID='$adjID' 
        ORDER BY adjID ASC";

        return parent::GetCollection(parent::GetResult($query));
    }
    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_adjunto
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_adjunto
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_adjunto
        WHERE state='1'
        ORDER BY adjID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oAdjunto){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(adjID), 0) FROM crm_adjunto";
        $result = parent::GetResult($sql);
        $oAdjunto->adjID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_adjunto(adjID,preadjID,formID,title,code,registerDate,state)
        VALUES ('$oAdjunto->adjID','$oAdjunto->preadjID','$oAdjunto->formID','$oAdjunto->title','$oAdjunto->code',NOW(),'$oAdjunto->state')";
            //die($query);
        return parent::Execute($query);
    }

    public static function  AddNew2($preadjID,$formID,$title,$code,$oAdjunto){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(adjID), 0) FROM crm_adjunto";
        $result = parent::GetResult($sql);
        $oAdjunto->adjID =parent::fetchScalar($result)+1;
            //Insert data into the table
        $query = "INSERT INTO crm_adjunto(adjID,preadjID,formID,title,code,registerDate,state)
        VALUES ('$oAdjunto->adjID','$preadjID','$formID','$title','$code',NOW(),1)";
            //die($query);
        return parent::Execute($query);
        //echo $query;
    }

    public static function  Update($oAdjunto){
        $query = "
        UPDATE crm_adjunto
        SET
        title               =   '$oAdjunto->title',
        code                =   '$oAdjunto->code',
        state               =   '$oAdjunto->state'
        WHERE adjID ='$oAdjunto->adjID'";
        //echo $query;
        return parent::Execute($query);
    }

    public static function  Delete($oAdjunto){
        $query = "
        DELETE FROM crm_adjunto
        WHERE adjID='$oAdjunto->adjID'";

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



