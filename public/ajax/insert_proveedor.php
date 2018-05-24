<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$oRegProveedor = new eCrmProveedor();

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
$oRegProveedor->pass                            = generaPass();
$oRegProveedor->state                           =1;


if($oRegProveedor->documentNumber!=NULL){
    RegisterForm($oRegProveedor);
}

function RegisterForm($oRegProveedor){

    if(CrmProveedor::AddNew3($oRegProveedor)){
        $oRegProveedorxCliente=new eCrmProveedorCliente();
        $oRegProveedorxCliente->clienteID         = 1;
        $oRegProveedorxCliente->propuestaID       = 1;
        $oRegProveedorxCliente->proveedorID       = $oRegProveedor->proveedorID;
        if(CrmProveedorCliente::addNew($oRegProveedorxCliente)){
            $oRequerimiento = new eCrmRequerimiento();
            $oRequerimiento->propxformID       = 1;
            $oRequerimiento->proveedorID       = $oRegProveedor->proveedorID;
            $oRequerimiento->period            = date("Ym");
            CrmRequerimiento::addNew($oRequerimiento);
            EmailAdmin::Send_Proveedor_Requerimiento($oRegProveedor->businessName,$oRegProveedor->email,$oRegProveedor->documentNumber,$oRequerimiento->requerimientoID);
        }
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

function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);

    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=8;

    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
      $pos=rand(0,$longitudCadena-1);

        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
      $pass .= substr($cadena,$pos,1);
  }
  return $pass;
}

?>