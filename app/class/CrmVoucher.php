<?php
require_once("base/Database.php");

class CrmVoucher extends Database
{

	public static function  getItem($voucherID){
        $query = "
        SELECT *
        FROM crm_voucher
        WHERE voucherID='$voucherID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_voucher
        ORDER BY voucherID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_voucher
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getListByRequerimiento($requerimientoID){
        $query ="
        SELECT *
        FROM crm_voucher
        WHERE requerimientoID='$requerimientoID' 
        ORDER BY requerimientoID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_voucher
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_voucher
        WHERE state='1'
        ORDER BY voucherID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oVoucher){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(voucherID), 0) FROM crm_voucher";
        $result = parent::GetResult($sql);
        $oVoucher->voucherID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_voucher(voucherID,requerimientoID,fileVoucher,dateVoucher,amount,observation,registerDate,registerUpdate,state)
        VALUES ('$oVoucher->voucherID','$oVoucher->requerimientoID','$oVoucher->fileVoucher','$oVoucher->dateVoucher','$oVoucher->amount','$oVoucher->observation',NOW(),NOW(),'$oVoucher->state')";
            //die($query);
        return parent::Execute($query);
    }

    public static function  AddNew2($oVoucher){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(voucherID), 0) FROM crm_voucher";
        $result = parent::GetResult($sql);
        $oVoucher->voucherID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_voucher(voucherID,requerimientoID,dateVoucher,amount,observation,registerDate,registerUpdate,state)
        VALUES ('$oVoucher->voucherID','$oVoucher->requerimientoID',NOW(),'$oVoucher->amount','$oVoucher->observation',NOW(),NOW(),'$oVoucher->state')";
            //die($query);
        return parent::Execute($query);
    }

    public static function  Update($oVoucher){
        $query = "
        UPDATE crm_voucher
        SET fileVoucher     ='$oVoucher->fileVoucher',
        dateVoucher     ='$oVoucher->dateVoucher',
        amount          ='$oVoucher->amount',
        observation     ='$oVoucher->observation',
        registerUpdate  = NOW(),
        state           ='$oVoucher->state'
        WHERE voucherID='$oVoucher->voucherID'";

        return parent::Execute($query);
    }


    public static function  Update2($oVoucher){
        $query = "
        UPDATE crm_voucher
        SET fileVoucher='$oVoucher->fileVoucher'
        WHERE voucherID='$oVoucher->voucherID'";

        return parent::Execute($query);
    }

    public static function  UpdateState($oVoucher){
        $query = "
        UPDATE crm_voucher
        SET state='$oVoucher->state'
        WHERE voucherID='$oVoucher->voucherID'";

        return parent::Execute($query);
    }

    public static function  UpdateStateObservation($oVoucher){
        $query = "
        UPDATE crm_voucher
        SET state='$oVoucher->state',
        observation     ='$oVoucher->observation'
        WHERE voucherID='$oVoucher->voucherID'";

        return parent::Execute($query);
    }

    public static function  Delete($oVoucher){
        $query = "
        DELETE FROM crm_voucher
        WHERE voucherID='$oVoucher->voucherID'";

        return parent::Execute($query);
    }
    
    public static function getState($state){
        switch($state){
            case 1:
            return "En Proceso"; break;
            case 2:
            return "Aprobado"; break;
            case 3:
            return "No Valido"; break;
            case 4:
            return "Facturado"; break;
            case 5: 
            return "En Observacion"; break;
            case 0:
            return "N/S"; break;
        }
    }
    
}

?>

