<?php
require_once("base/Database.php");

class CrmProveedor extends Database
{

	public static function  getItem($proveedorID){
        $query = "
        SELECT *
        FROM crm_proveedor
        WHERE proveedorID='$proveedorID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getItembyDocument($documentNumber){
        $query = "
        SELECT *
        FROM crm_proveedor
        WHERE documentNumber='$documentNumber' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getItem_Login($userName, $password){
        $query = "SELECT * FROM crm_proveedor
        WHERE 
        user='$userName' AND pass='$password' AND state <> '2'";
        return parent::GetObject(parent::GetResult($query));
    }
    
    public static function  getItembyRuc($ruc){
        $query = "
        SELECT *
        FROM crm_proveedor
        WHERE documentNumber='$ruc' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $query ="
        SELECT *
        FROM crm_proveedor
        ORDER BY proveedorID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="
        SELECT *
        FROM crm_proveedor
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Export(){
        $query ="
        SELECT *
        FROM crm_proveedor
        ";
        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  getList_Active(){
        $query ="
        SELECT *
        FROM crm_proveedor
        WHERE state='1'
        ORDER BY proveedorID DESC";

        return parent::GetCollection(parent::GetResult($query));
    }
    
    public static function  AddNew($oProveedor){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(proveedorID), 0) FROM crm_proveedor";
        $result = parent::GetResult($sql);
        $oProveedor->proveedorID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_proveedor(proveedorID,documentNumber,typeProvider,businessName,address,country,department,province,district,postalCode,phone,fax,email,contacts,legalDirection,departmentLegal,provinceLegal,districtLegal,legalRepresentative,commercialContactName,commercialContactPhone,commercialContactCellphone,commercialContactEmail,generalManagerName,generalManagerPhone,generalManagerCellphone,generalManagerEmail,bienID,servicioID,other,numberCollaborateAdmin,numberCollaborateOper,workShifts,businessAction1,percentageParticipant1,businessAction2,percentageParticipant2,businessAction3,percentageParticipant3,partnerships,ecoActivity,retentionIgv,observation,user,pass,registerDate,registerUpdate,state)
        VALUES ('$oProveedor->proveedorID','$oProveedor->documentNumber','$oProveedor->typeProvider','$oProveedor->businessName','$oProveedor->address','$oProveedor->country','$oProveedor->department','$oProveedor->province','$oProveedor->district','$oProveedor->postalCode','$oProveedor->phone','$oProveedor->fax','$oProveedor->email','$oProveedor->contacts','$oProveedor->legalDirection','$oProveedor->departmentLegal','$oProveedor->provinceLegal','$oProveedor->districtLegal','$oProveedor->legalRepresentative','$oProveedor->commercialContactName','$oProveedor->commercialContactPhone','$oProveedor->commercialContactCellphone','$oProveedor->commercialContactEmail','$oProveedor->generalManagerName','$oProveedor->generalManagerPhone','$oProveedor->generalManagerCellphone','$oProveedor->generalManagerEmail','$oProveedor->bienID','$oProveedor->servicioID','$oProveedor->other','$oProveedor->numberCollaborateAdmin','$oProveedor->numberCollaborateOper','$oProveedor->workShifts','$oProveedor->businessAction1','$oProveedor->percentageParticipant1','$oProveedor->businessAction2','$oProveedor->percentageParticipant2','$oProveedor->businessAction3','$oProveedor->percentageParticipant3','$oProveedor->partnerships','$oProveedor->ecoActivity','$oProveedor->retentionIgv','$oProveedor->observation','$oProveedor->user','$oProveedor->pass',NOW(),NOW(),'$oProveedor->state')";
            //die($query);
        return parent::Execute($query);
    }


    public static function  AddNew2($oProveedor){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(proveedorID), 0) FROM crm_proveedor";
        $result = parent::GetResult($sql);
        $oProveedor->proveedorID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_proveedor(proveedorID,documentNumber,businessName,address,phone,email,user,pass,registerDate,registerUpdate,state)
        VALUES ('$oProveedor->proveedorID','$oProveedor->documentNumber','$oProveedor->businessName','$oProveedor->address','$oProveedor->phone','$oProveedor->email','$oProveedor->documentNumber','$oProveedor->pass',NOW(),NOW(),0)";
            //die($query);
        return parent::Execute($query);
        //echo $query;
    }

    public static function  AddNew3($oProveedor){
            //Search the max Id
        $sql = "SELECT IFNULL(MAX(proveedorID), 0) FROM crm_proveedor";
        $result = parent::GetResult($sql);
        $oProveedor->proveedorID =parent::fetchScalar($result)+1;

            //Insert data into the table
        $query = "INSERT INTO crm_proveedor(proveedorID,documentNumber,typeProvider,businessName,address,country,department,province,district,postalCode,phone,fax,email,contacts,legalDirection,departmentLegal,provinceLegal,districtLegal,legalRepresentative,commercialContactName,commercialContactPhone,commercialContactCellphone,commercialContactEmail,generalManagerName,generalManagerPhone,generalManagerCellphone,generalManagerEmail,bienID,servicioID,other,observation,user,pass,registerDate,registerUpdate,state)
        VALUES ('$oProveedor->proveedorID','$oProveedor->documentNumber','$oProveedor->typeProvider','$oProveedor->businessName','$oProveedor->address','$oProveedor->country','$oProveedor->department','$oProveedor->province','$oProveedor->district','$oProveedor->postalCode','$oProveedor->phone','$oProveedor->fax','$oProveedor->email','$oProveedor->contacts','$oProveedor->legalDirection','$oProveedor->departmentLegal','$oProveedor->provinceLegal','$oProveedor->districtLegal','$oProveedor->legalRepresentative','$oProveedor->commercialContactName','$oProveedor->commercialContactPhone','$oProveedor->commercialContactCellphone','$oProveedor->commercialContactEmail','$oProveedor->generalManagerName','$oProveedor->generalManagerPhone','$oProveedor->generalManagerCellphone','$oProveedor->generalManagerEmail','$oProveedor->bienID','$oProveedor->servicioID','$oProveedor->other','$oProveedor->observation','$oProveedor->documentNumber','$oProveedor->pass',NOW(),NOW(),'$oProveedor->state')";
            //die($query);
        return parent::Execute($query);
    }

    public static function Update($oProveedor){
        $query = "
        UPDATE crm_proveedor
        SET documentNumber          = '$oProveedor->documentNumber',
        typeProvider                = '$oProveedor->typeProvider',
        businessName                = '$oProveedor->businessName',
        address                     = '$oProveedor->address',
        country                     = '$oProveedor->country',
        department                  = '$oProveedor->department',
        province                    = '$oProveedor->province',
        district                    = '$oProveedor->district',
        postalCode                  = '$oProveedor->postalCode',
        phone                       = '$oProveedor->phone',
        fax                         = '$oProveedor->fax',
        email                       = '$oProveedor->email',
        contacts                    = '$oProveedor->contacts',
        legalDirection              = '$oProveedor->legalDirection',
        departmentLegal             = '$oProveedor->departmentLegal',
        provinceLegal               = '$oProveedor->provinceLegal',
        districtLegal               = '$oProveedor->districtLegal',
        legalRepresentative         = '$oProveedor->legalRepresentative',
        commercialContactName       = '$oProveedor->commercialContactName',
        commercialContactPhone      = '$oProveedor->commercialContactPhone',
        commercialContactCellphone  = '$oProveedor->commercialContactCellphone',
        commercialContactEmail      = '$oProveedor->commercialContactEmail',
        generalManagerName          = '$oProveedor->generalManagerName',
        generalManagerPhone         = '$oProveedor->generalManagerPhone',
        generalManagerCellphone     = '$oProveedor->generalManagerCellphone',
        generalManagerEmail         = '$oProveedor->generalManagerEmail',
        bienID                      = '$oProveedor->bienID',
        servicioID                  = '$oProveedor->servicioID',
        other                       = '$oProveedor->other',
        numberCollaborateAdmin      = '$oProveedor->numberCollaborateAdmin',
        numberCollaborateOper       = '$oProveedor->numberCollaborateOper',
        workShifts                  = '$oProveedor->workShifts',
        businessAction1             = '$oProveedor->businessAction1',
        percentageParticipant1      = '$oProveedor->percentageParticipant1',
        businessAction2             = '$oProveedor->businessAction2',
        percentageParticipant2      = '$oProveedor->percentageParticipant2',
        businessAction3             = '$oProveedor->businessAction3',
        percentageParticipant3      = '$oProveedor->percentageParticipant3',
        partnerships                = '$oProveedor->partnerships',
        ecoActivity                 = '$oProveedor->ecoActivity',
        retentionIgv                = '$oProveedor->retentionIgv',
        observation                 = '$oProveedor->observation',
        user                        = '$oProveedor->user',
        pass                        = '$oProveedor->pass',
        registerUpdate              = NOW(),
        state                       = '$oProveedor->state'
        WHERE proveedorID               ='$oProveedor->proveedorID'";

        return parent::Execute($query);
    }

    public static function Update2($oProveedor){
        $query = "
        UPDATE crm_proveedor
        SET documentNumber              = '$oProveedor->documentNumber',
        typeProvider                = '$oProveedor->typeProvider',
        businessName                = '$oProveedor->businessName',
        address                     = '$oProveedor->address',
        country                     = '$oProveedor->country',
        department                  = '$oProveedor->department',
        province                    = '$oProveedor->province',
        district                    = '$oProveedor->district',
        postalCode                  = '$oProveedor->postalCode',
        phone                       = '$oProveedor->phone',
        fax                         = '$oProveedor->fax',
        email                       = '$oProveedor->email',
        contacts                    = '$oProveedor->contacts',
        legalDirection              = '$oProveedor->legalDirection',
        departmentLegal             = '$oProveedor->departmentLegal',
        provinceLegal               = '$oProveedor->provinceLegal',
        districtLegal               = '$oProveedor->districtLegal',
        legalRepresentative         = '$oProveedor->legalRepresentative',
        commercialContactName       = '$oProveedor->commercialContactName',
        commercialContactPhone      = '$oProveedor->commercialContactPhone',
        commercialContactCellphone  = '$oProveedor->commercialContactCellphone',
        commercialContactEmail      = '$oProveedor->commercialContactEmail',
        generalManagerName          = '$oProveedor->generalManagerName',
        generalManagerPhone         = '$oProveedor->generalManagerPhone',
        generalManagerCellphone     = '$oProveedor->generalManagerCellphone',
        generalManagerEmail         = '$oProveedor->generalManagerEmail',
        bienID                      = '$oProveedor->bienID',
        servicioID                  = '$oProveedor->servicioID',
        other                       = '$oProveedor->other',
        observation                 = '$oProveedor->observation',
        registerUpdate              = NOW(),
        state                       = '$oProveedor->state'
        WHERE proveedorID           ='$oProveedor->proveedorID'";

        return parent::Execute($query);
    }

    public static function Update3($oProveedor){
        $query = "
        UPDATE crm_proveedor
        SET registration    =   '$oProveedor->registration',
        testConstitution    =   '$oProveedor->testConstitution',
        firm                =   '$oProveedor->firm',
        representation      =   '$oProveedor->representation',
        licence             =   '$oProveedor->licence',
        certInspeccion      =   '$oProveedor->certInspeccion',
        registerMine        =   '$oProveedor->registerMine',
        registerUpdate      =   NOW()
        WHERE proveedorID   =   '$oProveedor->proveedorID'";

        return parent::Execute($query);
    }
    public static function  Delete($oProveedor){
        $query = "
        DELETE FROM crm_proveedor
        WHERE proveedorID='$oProveedor->proveedorID'";

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



