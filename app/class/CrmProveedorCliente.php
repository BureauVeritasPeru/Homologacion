<?php
require_once("base/Database.php");

class CrmProveedorCliente extends Database
{

	public static function  getItem($proveedorCliID){
        $query = "
        SELECT *
        FROM crm_proveedor_cliente
        WHERE proveedorCliID='$proveedorCliID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_proveedor_cliente
        ORDER BY proveedorCliID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    

    
    public static function  AddNew($oProveedorCli){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(proveedorCliID), 0) FROM crm_proveedor_cliente";
        $result = parent::GetResult($sql);
        $oProveedorCli->proveedorCliID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_proveedor_cliente(proveedorCliID,clienteID,proveedorID,propuestaID,registerDate)
        VALUES ('$oProveedorCli->proveedorCliID','$oProveedorCli->clienteID','$oProveedorCli->proveedorID','$oProveedorCli->propuestaID',NOW())";
            //die($query);
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



