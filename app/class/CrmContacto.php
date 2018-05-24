<?php
require_once("base/Database.php");

class CrmContacto extends Database
{

	public static function  getItem($contactoID){
        $query = "
        SELECT *
        FROM crm_contacto
        WHERE contactoID='$contactoID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_contacto
        ORDER BY contactoID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListByCliente($clienteID){
        $query ="
        SELECT *
        FROM crm_contacto
        WHERE clienteID='$clienteID' 
        ORDER BY contactoID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }


    
    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_contacto
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    
    public static function  AddNew($oContacto){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(contactoID), 0) FROM crm_contacto";
        $result = parent::GetResult($sql);
        $oContacto->contactoID =parent::fetchScalar($result)+1;

        //Insert data into the table
        $query = "INSERT INTO crm_contacto(contactoID,clienteID,nameContact,positionContact,phoneContact,emailContact,registerDate)
        VALUES ('$oContacto->contactoID','$oContacto->clienteID','$oContacto->nameContact','$oContacto->positionContact','$oContacto->phoneContact','$oContacto->emailContact',NOW())";
        return parent::Execute($query);
    }

    public static function  Update($oContacto){
        $query = "
        UPDATE crm_contacto
        SET nameContact             =   '$oContacto->nameContact',
        positionContact             =   '$oContacto->positionContact',
        phoneContact                =   '$oContacto->phoneContact',
        emailContact                =   '$oContacto->emailContact'
        WHERE contactoID            =   '$oContacto->contactoID'";

        return parent::Execute($query);
        //echo $query;
    }

    public static function  Delete($oContacto){
        $query = "
        DELETE FROM crm_contacto
        WHERE contactoID='$oContacto->contactoID'";

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



