<?php
require_once("base/Database.php");

class CrmChat extends Database
{

	public static function  getItem($chatID){
        $query = "
        SELECT *
        FROM crm_chat
        WHERE chatID='$chatID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_chat
        ORDER BY chatID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListCantMessage($idUsuario,$idContacto,$type){
        $query ="
        SELECT * 
        FROM crm_chat  
        WHERE (userID='$idContacto' AND contactID='$idUsuario') 
        OR (userID='$idUsuario' AND contactID='$idContacto') 
        AND type='$type'
        ORDER BY chatID ASC";
        return parent::GetCollection(parent::GetResult($query));
        //echo $query;
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_chat
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  AddNew($oChat){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(chatID), 0) FROM crm_chat";
        $result = parent::GetResult($sql);
        $oChat->chatID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_chat(chatID, message, userID, contactID, fecha, hora, type)
        VALUES ('$oChat->chatID','$oChat->message','$oChat->userID','$oChat->contactID','$oChat->fecha','$oChat->hora','$oChat->type')";
            //die($query);
        return parent::Execute($query);
        //echo $query;
    }

    
}

?>

