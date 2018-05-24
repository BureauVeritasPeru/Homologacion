<?php
require_once("base/Database.php");

class CrmNivelCliente extends Database
{

	public static function  getItem($nivelClienteID){
        $query = "
        SELECT *
        FROM crm_nivel_cliente
        WHERE nivelClienteID='$nivelClienteID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getItemByCliente($clienteID,$nivel){
        $query = "
        SELECT *
        FROM crm_nivel_cliente
        WHERE clienteID='$clienteID'
        AND nivel = '$nivel' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_nivel_cliente
        ORDER BY nivelClienteID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListByCliente($clienteID){
        $query ="
        SELECT *
        FROM crm_nivel_cliente
        WHERE clienteID='$clienteID' 
        ORDER BY nivelClienteID ASC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_nivel_cliente
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_nivel_cliente
        WHERE state='1'
        ORDER BY nivelClienteID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oNivelCliente){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(nivelClienteID), 0) FROM crm_nivel_cliente";
        $result = parent::GetResult($sql);
        $oNivelCliente->nivelClienteID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_nivel_cliente(nivelClienteID,clienteID,nivel,minimo,maximo,registerDate,registerUpdate,state)
        VALUES ('$oNivelCliente->nivelClienteID','$oNivelCliente->clienteID','$oNivelCliente->nivel','$oNivelCliente->minimo','$oNivelCliente->maximo',NOW(),NOW(),'$oNivelCliente->state')";
            //die($query);
        return parent::Execute($query);
    }



    public static function  Update($oNivelCliente){
        $query = "
        UPDATE crm_nivel_cliente
        SET nivel               =   '$oNivelCliente->nivel',
        minimo                  =   '$oNivelCliente->minimo',
        maximo                  =   '$oNivelCliente->maximo',
        registerUpdate          =   NOW()
        WHERE nivelClienteID ='$oNivelCliente->nivelClienteID'";

        return parent::Execute($query);
    }

    public static function  Delete($oNivelCliente){
        $query = "
        DELETE FROM crm_nivel_cliente
        WHERE nivelClienteID='$oNivelCliente->nivelClienteID'";

        return parent::Execute($query);
    }
    
    public static function getState($state){
        switch($state){
            case 1:
            return "Aprobado"; break;
            case 2:
            return "Desaprobado"; break;
            case 0:
            return "Inactivo"; break;
        }
    }
    
}

?>



