<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegProveedor = new eCrmProveedor();
$oRegProveedor->proveedorID                     =OWASP::RequestString('proveedorID');
$oRegProveedor->documentNumber		            =OWASP::RequestString('documentNumber');
$oRegProveedor->typeProvider	                =OWASP::RequestString('typeProvider');
$oRegProveedor->businessName	                =OWASP::RequestString('businessName');
$oRegProveedor->address	                        =OWASP::RequestString('address');
$oRegProveedor->country                         =OWASP::RequestString('country');
$oRegProveedor->postalCode                      =OWASP::RequestString('postalCode');
$oRegProveedor->department                      =OWASP::RequestString('department');
$oRegProveedor->phone                           =OWASP::RequestString('phone');
$oRegProveedor->province                        =OWASP::RequestString('province');
$oRegProveedor->fax                             =OWASP::RequestString('fax');
$oRegProveedor->district                        =OWASP::RequestString('district');
$oRegProveedor->email                           =OWASP::RequestString('email');
$oRegProveedor->contacts                        =OWASP::RequestString('contacts');
$oRegProveedor->legalDirection                  =OWASP::RequestString('legalDirection');
$oRegProveedor->departmentLegal                 =OWASP::RequestString('departmentLegal');
$oRegProveedor->legalRepresentative             =OWASP::RequestString('legalRepresentative');
$oRegProveedor->provinceLegal                   =OWASP::RequestString('provinceLegal');
$oRegProveedor->districtLegal                   =OWASP::RequestString('districtLegal');
$oRegProveedor->commercialContactName           =OWASP::RequestString('commercialContactName');
$oRegProveedor->commercialContactPhone          =OWASP::RequestString('commercialContactPhone');
$oRegProveedor->commercialContactCellphone      =OWASP::RequestString('commercialContactCellphone');
$oRegProveedor->commercialContactEmail          =OWASP::RequestString('commercialContactEmail');
$oRegProveedor->generalMananagerName            =OWASP::RequestString('generalMananagerName');
$oRegProveedor->generalMananagerPhone           =OWASP::RequestString('generalMananagerPhone');
$oRegProveedor->generalMananagerCellphone       =OWASP::RequestString('generalMananagerCellphone');
$oRegProveedor->generalMananagerEmail           =OWASP::RequestString('generalMananagerEmail');
$oRegProveedor->bienID                          =OWASP::RequestString('bienID');
$oRegProveedor->servicioID                      =OWASP::RequestString('servicioID');
$oRegProveedor->other                           =OWASP::RequestString('other');
$oRegProveedor->observation                     =OWASP::RequestString('observation');
$oRegProveedor->state                           =1;


if($oRegProveedor->proveedorID!=NULL){
    RegisterForm($oRegProveedor);
}

function RegisterForm($oRegProveedor){

    if(CrmProveedor::Update2($oRegProveedor)){
        Response('Gracias por registrarse.');
    }
    else{
        RaiseError(CrmRegisterForm::GetErrorMsg());
    }

}

function Response($msg){
    echo json_encode(array('retval'=>'1', 'message'=>$msg));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}

?>