<?php
require_once("base/Database.php");

class CrmConcepto extends Database
{

	public static function  getItem($conceptoID){
        $query = "
        SELECT *
        FROM crm_concepto
        WHERE conceptoID='$conceptoID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_concepto
        ORDER BY conceptoID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_concepto
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_concepto
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_concepto
        WHERE state='1'
        ORDER BY conceptoID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oConcepto){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(conceptoID), 0) FROM crm_concepto";
        $result = parent::GetResult($sql);
        $oConcepto->conceptoID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_concepto(conceptoID, description, state, registerDate)
        VALUES ('$oConcepto->conceptoID', '$oConcepto->description', '$oConcepto->state',NOW())";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oConcepto){
        $query = "
        UPDATE crm_concepto
        SET description='$oConcepto->description',
        state='$oConcepto->state'
        WHERE conceptoID='$oConcepto->conceptoID'";

        return parent::Execute($query);
    }

    public static function  Delete($oConcepto){
        $query = "
        DELETE FROM crm_concepto
        WHERE conceptoID='$oConcepto->conceptoID'";
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