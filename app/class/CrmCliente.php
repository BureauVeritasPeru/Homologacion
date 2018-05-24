<?php
require_once("base/Database.php");

class CrmCliente extends Database
{

	public static function  getItem($clienteID){
        $query = "
        SELECT *
        FROM crm_cliente
        WHERE clienteID='$clienteID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_cliente
        ORDER BY clienteID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getItem_Login($userName, $password){
        $query = "SELECT * FROM crm_cliente
        WHERE 
        user='$userName' AND pass='$password' AND state = '1'";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_cliente
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_cliente
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_cliente
        WHERE state='1'
        ORDER BY clienteID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oCliente){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(clienteID), 0) FROM crm_cliente";
        $result = parent::GetResult($sql);
        $oCliente->clienteID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_cliente(clienteID,ruc,businessName,address,department,province,district,phone,email,fax,sectorist,observation,user,pass,registerDate,registerUpdate,state)
        VALUES ('$oCliente->clienteID','$oCliente->ruc','$oCliente->businessName','$oCliente->address','$oCliente->department','$oCliente->province','$oCliente->district','$oCliente->phone','$oCliente->email','$oCliente->fax','$oCliente->sectorist','$oCliente->observation','$oCliente->user','$oCliente->pass',NOW(),NOW(),'$oCliente->state')";
            //die($query);
        EmailAdmin::Send_Cliente($oCliente->businessName,$oCliente->email,$oCliente->user,$oCliente->pass);
        return parent::Execute($query);
    }



    public static function  Update($oCliente){
        $query = "
        UPDATE crm_cliente
        SET ruc             =   '$oCliente->ruc',
        businessName    =   '$oCliente->businessName',
        address         =   '$oCliente->address',
        department      =   '$oCliente->department',
        province        =   '$oCliente->province',
        district        =   '$oCliente->district',
        phone           =   '$oCliente->phone',
        email           =   '$oCliente->email',
        fax             =   '$oCliente->fax',
        sectorist       =   '$oCliente->sectorist',
        observation     =   '$oCliente->observation',
        user            =   '$oCliente->user',
        pass            =   '$oCliente->pass',
        registerUpdate  =   NOW(),
        state           =   '$oCliente->state'
        WHERE clienteID ='$oCliente->clienteID'";

        return parent::Execute($query);
    }

    public static function  Delete($oCliente){
        $query = "
        DELETE FROM crm_cliente
        WHERE clienteID='$oCliente->clienteID'";

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



