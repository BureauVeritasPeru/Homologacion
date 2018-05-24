<?php
require_once("base/Database.php");

class CrmPropxForm extends Database
{

	public static function  getItem($propxformID){
        $query = "
        SELECT *
        FROM crm_form_propuesta
        WHERE propxformID='$propxformID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_form_propuesta
        ORDER BY propxformID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListByPropuesta($oPropuestaID){
        $query ="
        SELECT *
        FROM crm_form_propuesta
        WHERE propuestaID='$oPropuestaID' 
        ORDER BY propxformID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_form_propuesta
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_form_propuesta
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_form_propuesta
        WHERE stateForm='1'
        ORDER BY propxformID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oPropuesta){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(propxformID), 0) FROM crm_form_propuesta";
        $result = parent::GetResult($sql);
        $oPropuesta->propxformID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_form_propuesta(propxformID,propuestaID,typeForm,titleForm,amount,fileProposal,registerDate,stateForm)
        VALUES ('$oPropuesta->propxformID','$oPropuesta->propuestaID','$oPropuesta->typeForm','$oPropuesta->titleForm','$oPropuesta->amount','$oPropuesta->fileProposal',NOW(),'$oPropuesta->stateForm')";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oPropuesta){
        $query = "
        UPDATE crm_form_propuesta
        SET typeForm        =   '$oPropuesta->typeForm',
        titleForm           =   '$oPropuesta->titleForm',
        amount              =   '$oPropuesta->amount',
        fileProposal        =   '$oPropuesta->fileProposal',
        stateForm           =   '$oPropuesta->stateForm'
        WHERE propxformID   =   '$oPropuesta->propxformID'";

        return parent::Execute($query);
    }

    public static function  UpdateTagImport($oPropuesta){
        $query = "
        UPDATE crm_form_propuesta
        SET tagImport        =   '$oPropuesta->tagImport'
        WHERE propxformID   =   '$oPropuesta->propxformID'";

        return parent::Execute($query);
    }

    public static function  Delete($oPropuesta){
        $query = "
        DELETE FROM crm_form_propuesta
        WHERE propxformID='$oPropuesta->propxformID'";

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



