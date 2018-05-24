<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$aFile=isset($_FILES['fleImport'])? $_FILES['fleImport']: NULL;

$UsrSession =isset($_SESSION[ADM_SESSION_ID])? unserialize($_SESSION[ADM_SESSION_ID]): NULL;


if($aFile!=NULL){
  $message = "";
  $messageDenied = "";
  $buffer=file_get_contents($aFile["tmp_name"]);
  $data=str_getcsv($buffer, "\n");
  if(count($data)>1){
    $data[0]=NULL;
    $data=array_filter($data);
    $numRows=0;
    foreach($data as $row){
      $r = str_getcsv($row, ";");
      if(isset($r[0]) && isset($r[1]) && isset($r[2]) && isset($r[3]) && isset($r[4]) && isset($r[5]) && isset($r[6]) && isset($r[7])){
        $oProveedor = CrmProveedor::getItembyRuc($r[0]);
        if(isset($oProveedor)){
          $oRegProveedorxCliente=new eCrmProveedorCliente();
          $oRegProveedorxCliente->clienteID         = $_GET['clienteID'];
          $oRegProveedorxCliente->propuestaID       = $_GET['propuestaID'];
          $oRegProveedorxCliente->proveedorID       = $oProveedor->proveedorID;
          if(CrmProveedorCliente::addNew($oRegProveedorxCliente)){
            $oRequerimiento = new eCrmRequerimiento();
            $oRequerimiento->propxformID       = $_GET['propxformID'];
            $oRequerimiento->proveedorID       = $oProveedor->proveedorID;
            $oRequerimiento->period            = date("Ym");
            CrmRequerimiento::addNew($oRequerimiento);
            Email::Send_Proveedor_Requerimiento($oProveedor->businessName,$oProveedor->email,$oRequerimiento->requerimientoID,$oProveedor->documentNumber);
          }
        }else{
          $eProveedor = new eCrmProveedor();
          $eProveedor->documentNumber   = $r[0];
          $eProveedor->businessName     = $r[1];
          $eProveedor->address          = $r[5];
          $eProveedor->phone            = $r[6];
          $eProveedor->email            = $r[7];
          $eProveedor->pass             = generaPass(); 

          if(CrmProveedor::addNew2($eProveedor)){
            $oRegProveedorxCliente=new eCrmProveedorCliente();
            $oRegProveedorxCliente->clienteID         = $_GET['clienteID'];
            $oRegProveedorxCliente->propuestaID       = $_GET['propuestaID'];
            $oRegProveedorxCliente->proveedorID       = $eProveedor->proveedorID;
            if(CrmProveedorCliente::addNew($oRegProveedorxCliente)){
              $oRequerimiento = new eCrmRequerimiento();
              $oRequerimiento->propxformID       = $_GET['propxformID'];
              $oRequerimiento->proveedorID       = $eProveedor->proveedorID;
              $oRequerimiento->period            = date("Ym");
              CrmRequerimiento::addNew($oRequerimiento);
              Email::Send_Proveedor_Requerimiento($eProveedor->businessName,$eProveedor->email,$oRequerimiento->requerimientoID,$eProveedor->documentNumber);
            }
          }
        }
      }else{
        $r = str_getcsv($row, ","); 
        if(isset($r[0]) && isset($r[1]) && isset($r[2]) && isset($r[3]) && isset($r[4]) && isset($r[5]) && isset($r[6]) && isset($r[7])){
          $oProveedor = CrmProveedor::getItembyRuc($r[0]);
          if(isset($oProveedor)){
            $oRegProveedorxCliente=new eCrmProveedorCliente();
            $oRegProveedorxCliente->clienteID         = $_GET['clienteID'];
            $oRegProveedorxCliente->propuestaID       = $_GET['propuestaID'];
            $oRegProveedorxCliente->proveedorID       = $oProveedor->proveedorID;
            if(CrmProveedorCliente::addNew($oRegProveedorxCliente)){
              $oRequerimiento = new eCrmRequerimiento();
              $oRequerimiento->propxformID       = $_GET['propxformID'];
              $oRequerimiento->proveedorID       = $oProveedor->proveedorID;
              $oRequerimiento->period            = date("Ym");
              CrmRequerimiento::addNew($oRequerimiento);
              Email::Send_Proveedor_Requerimiento($oProveedor->businessName,$oProveedor->email,$oRequerimiento->requerimientoID,$oProveedor->documentNumber);
            }
          }else{
            $eProveedor = new eCrmProveedor();
            $eProveedor->documentNumber   = $r[0];
            $eProveedor->businessName     = $r[1];
            $eProveedor->address          = $r[5];
            $eProveedor->phone            = $r[6];
            $eProveedor->email            = $r[7];
            $eProveedor->pass             = generaPass(); 

            if(CrmProveedor::addNew2($eProveedor)){
              $oRegProveedorxCliente=new eCrmProveedorCliente();
              $oRegProveedorxCliente->clienteID         = $_GET['clienteID'];
              $oRegProveedorxCliente->propuestaID       = $_GET['propuestaID'];
              $oRegProveedorxCliente->proveedorID       = $eProveedor->proveedorID;
              if(CrmProveedorCliente::addNew($oRegProveedorxCliente)){
                $oRequerimiento = new eCrmRequerimiento();
                $oRequerimiento->propxformID       = $_GET['propxformID'];
                $oRequerimiento->proveedorID       = $eProveedor->proveedorID;
                $oRequerimiento->period            = date("Ym");
                CrmRequerimiento::addNew($oRequerimiento);
                Email::Send_Proveedor_Requerimiento($eProveedor->businessName,$eProveedor->email,$oRequerimiento->requerimientoID,$eProveedor->documentNumber);
              }
            }
          }
        }
      }
      $numRows++;
    }
    $message .= "<span>Se han insertado ".$numRows." registros.</span><br>";
  }else{
    $message .= "<span>No se han encontrado registros.</span><br>" ;
  }
}else{
  $message .= "<span>No se ha seleccionado un archivo para importar.</span><br>";
//Common Field
}


echo $message;

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