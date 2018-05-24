<?php
require_once("base/Database.php");

class CrmServicio extends Database
{

	public static function  getItem($servicioID){
        $query = "
        SELECT *
        FROM crm_servicio
        WHERE servicioID='$servicioID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_servicio
        ORDER BY servicioID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_servicio
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_servicio
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_servicio
        WHERE state='1'
        ORDER BY servicioID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oServicio){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(servicioID), 0) FROM crm_servicio";
        $result = parent::GetResult($sql);
        $oServicio->servicioID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_servicio(servicioID, description, state, registerDate)
        VALUES ('$oServicio->servicioID', '$oServicio->description', '$oServicio->state',NOW())";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oServicio){
        $query = "
        UPDATE crm_servicio
        SET description='$oServicio->description',
        state='$oServicio->state'
        WHERE servicioID='$oServicio->servicioID'";

        return parent::Execute($query);
    }

    public static function  Delete($oServicio){
        $query = "
        DELETE FROM crm_servicio
        WHERE servicioID='$oServicio->servicioID'";
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