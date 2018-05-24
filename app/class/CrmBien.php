<?php
require_once("base/Database.php");

class CrmBien extends Database
{

	public static function  getItem($bienID){
        $query = "
        SELECT *
        FROM crm_bien
        WHERE bienID='$bienID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_bien
        ORDER BY bienID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_bien
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_bien
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_bien
        WHERE state='1'
        ORDER BY bienID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oBien){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(bienID), 0) FROM crm_bien";
        $result = parent::GetResult($sql);
        $oBien->bienID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_bien(bienID, description, state, registerDate)
        VALUES ('$oBien->bienID', '$oBien->description', '$oBien->state',NOW())";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oBien){
        $query = "
        UPDATE crm_bien
        SET description='$oBien->description',
        state='$oBien->state'
        WHERE bienID='$oBien->bienID'";

        return parent::Execute($query);
    }

    public static function  Delete($oBien){
        $query = "
        DELETE FROM crm_bien
        WHERE bienID='$oBien->bienID'";

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