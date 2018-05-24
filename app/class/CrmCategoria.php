<?php
require_once("base/Database.php");

class CrmCategoria extends Database
{

	public static function  getItem($categoriaID){
        $query = "
        SELECT *
        FROM crm_categoria
        WHERE categoriaID='$categoriaID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_categoria
        ORDER BY categoriaID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_categoria
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_categoria
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_categoria
        WHERE state='1'
        ORDER BY categoriaID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oCategoria){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(categoriaID), 0) FROM crm_categoria";
        $result = parent::GetResult($sql);
        $oCategoria->categoriaID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_categoria(categoriaID, description, state, registerDate)
        VALUES ('$oCategoria->categoriaID', '$oCategoria->description', '$oCategoria->state',NOW())";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oCategoria){
        $query = "
        UPDATE crm_categoria
        SET description='$oCategoria->description',
        state='$oCategoria->state'
        WHERE categoriaID='$oCategoria->categoriaID'";

        return parent::Execute($query);
    }

    public static function  Delete($oCategoria){
        $query = "
        DELETE FROM crm_categoria
        WHERE categoriaID='$oCategoria->categoriaID'";
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