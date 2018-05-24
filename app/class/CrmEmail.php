<?php
require_once("base/Database.php");

class CrmEmail extends Database
{

	public static function  getItem($emailID){
        $query = "
        SELECT *
        FROM crm_email
        WHERE emailID='$emailID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_email
        ORDER BY emailID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_email
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_email
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_email
        WHERE state='1'
        ORDER BY emailID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oEmail){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(emailID), 0) FROM crm_email";
        $result = parent::GetResult($sql);
        $oEmail->emailID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_email(emailID,title,desde,subject,message,registerDate,state)
        VALUES ('$oEmail->emailID','$oEmail->title','$oEmail->desde','$oEmail->subject','$oEmail->message',NOW(),'$oEmail->state')";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oEmail){
        $query = "
        UPDATE crm_email
        SET title           =   '$oEmail->title',
        desde               =   '$oEmail->desde',
        subject             =   '$oEmail->subject',
        message             =   '$oEmail->message',
        state               =   '$oEmail->state'
        
        WHERE emailID ='$oEmail->emailID'";

        return parent::Execute($query);
    }

    public static function  Delete($oEmail){
        $query = "
        DELETE FROM crm_email
        WHERE emailID='$oEmail->emailID'";

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



