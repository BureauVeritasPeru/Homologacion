<?php
require_once("base/Database.php");

class CrmPropuesta extends Database
{

	public static function  getItem($propuestaID){
        $query = "
        SELECT *
        FROM crm_propuesta
        WHERE propuestaID='$propuestaID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_propuesta
        ORDER BY propuestaID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListByCliente($clienteID){
        $query ="
        SELECT *
        FROM crm_propuesta
        WHERE clienteID='$clienteID' 
        ORDER BY propuestaID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_propuesta
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_propuesta
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_propuesta
        WHERE state='1'
        ORDER BY propuestaID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oPropuesta){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(propuestaID), 0) FROM crm_propuesta";
        $result = parent::GetResult($sql);
        $oPropuesta->propuestaID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_propuesta(propuestaID,proposalNumber,clienteID,proposalDate,description,sectorist,registerDate,state)
        VALUES ('$oPropuesta->propuestaID','$oPropuesta->proposalNumber','$oPropuesta->clienteID','$oPropuesta->proposalDate','$oPropuesta->description','$oPropuesta->sectorist',NOW(),'$oPropuesta->state')";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oPropuesta){
        $query = "
        UPDATE crm_propuesta
        SET proposalNumber  =   '$oPropuesta->proposalNumber',
        proposalDate        =   '$oPropuesta->proposalDate',
        description         =   '$oPropuesta->description',
        sectorist           =   '$oPropuesta->sectorist',
        state               =   '$oPropuesta->state'
        WHERE propuestaID   =   '$oPropuesta->propuestaID'";

        return parent::Execute($query);
    }

    public static function  Delete($oPropuesta){
        $query = "
        DELETE FROM crm_propuesta
        WHERE propuestaID='$oPropuesta->propuestaID'";

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



