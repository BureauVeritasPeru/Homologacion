<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");
require_once 'dompdf/autoload.inc.php';
$homologacionID =OWASP::RequestString('homologacionID');
$oHomologacion = CrmHomologacion::getItem($homologacionID);
$oRequerimiento = CrmRequerimiento::getItem($oHomologacion->requerimientoID); 
$oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID); 
$oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); 
$oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID);
$oCliente = CrmCliente::getItem($oPropuesta->clienteID);

function ConteoCasillas($val1,$val2,$val3,$val4,$val5){
	$count = 0;
	if($val1 != 0){ $count++;}if($val2 != 0){ $count++;}if($val3 != 0){ $count++;}if($val4 != 0){ $count++;}if($val5 != 0){ $count++;}
	return $count;
}

$oForm = CrmHomologacion::getItemFormulario($homologacionID);

$oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);
$dateI = new DateTime($oHomologacion->registerDate);
?>
<style>
@page {
	size: 35cm 29.7cm; 
}
*{margin:0;padding:0;}
html{
	margin:0 auto;
	padding: 0;
	width:100%;
	height:100%;
}
body{
	font-size:18px;
	font-family: Helvetica;
	height:100%;
}
div{
	display: block;
}

table {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	border-collapse: collapse;
	width: 100%;
}

table td, table th {
	border: 1px solid #dddddd;
	padding: 8px;
}

.table-form td, .table-form th{
	border: none;
	padding: 8px;
}

table th {
	padding-top: 12px;
	padding-bottom: 12px;
	text-align: left;
	background-color: #4CAF50;
	color: white;
}


.table-portada{
	margin: 0 auto;
	width: 500px; 
	border-collapse: collapse;
}
.table-red{
	margin-top: 300px;
	margin:10%;
	border-collapse: collapse;
}
.table-red tr{
	border: 1px solid #000;
}

.table-red td{
	border: 1px solid #000;
	padding: 10px;
	/*margin-left: 10px;*/

}
.page1{
	margin-top: 150px;
}
.page2{
	margin-top: 150px;
}
.page3{
	margin-top:550px;
	display: block;
	margin-left: 60px;
	margin-right: 60px;
	font-size:14px;
}
.img-insp{
	text-align: center;
	margin-left: 38%;
}

</style>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<title>Informe General</title>
</head>
<body>
	<div class="page1">
		<table  class="table-portada">	
			<tr><td style="border:2px double #000;padding:30px;text-align: center;font-weight: bolder;font-size:20px;">EVALUACION DEL PROVEEDOR<br><b style="font-size:18px;text-decoration:underline;"><?php echo $oPropuesta->proposalNumber; ?></b></td></tr>
		</table>
		<br><br><br>
		<table  class="table-portada">	
			<tr><td style="text-align: center;"><img src="http://app.bureauveritas.com.pe/scs/homologacion/userfiles/logo.png" width="40%"></td></tr>
		</table>
		<br><br>
		<table class="table-portada">	
			<tr><td style="border:2px double #000;padding:45px;text-align: center;font-weight: bolder;font-size:20px"><?php echo $oProveedor->businessName; ?></td></tr>
		</table>
		<br>
		<p style="text-align: center;font-size:16px;">FECHA</p>
		<br>
		<p style="text-align: center;font-size:16px;"><?php echo date_format($dateI, 'd/m/y'); ?></p>
	</div><br><br><br><br><br><br><br><br><br><br>
	<div class="page2">
		<p style="text-align: center;font-size:16px;font-weight:bolder;text-decoration:underline">ÍNDICE GENERAL</p>
		<br><br><br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">I.	INTRODUCCIÓN</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">II.	ALCANCE</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">III.	METODOLOGÍA</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">IV.	INFORMACIÓN DE LA EMPRESA</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">V.	FORMULARIO DE EVALUACION</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">VI.	RESÚMEN DE RESULTADOS</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">VII.	CONCLUSIONES</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">VIII.	OBSERVACIONES</p>
		<br>
		<p style="text-align: left;font-size:16px;margin-left:90px;font-weight:bolder;">IX.	FOTOGRAFIAS DE INSPECCIÓN</p>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<p style="text-align: left;font-size:14px;margin-left:120px;margin-right:120px;margin-top:120px;font-weight:bolder;">I.	INTRODUCCIÓN</p><br>
	<p style="text-align: left;font-size:14px;;margin-left:120px;margin-right:120px;text-align:justify;"><strong>BUREAU VERITAS</strong> por encargo de COMPAÑÍA <strong><?php echo mb_strtoupper($oCliente->businessName); ?></strong> ha realizado un proceso de homologación de proveedores, que consiste en una evaluación independiente e imparcial a la empresa <strong><?php echo mb_strtoupper($oProveedor->businessName); ?></strong>, con la finalidad de calificar su gestión. Para la realización del presente servicio de Homologación se evaluaron aspectos de capacidad técnica, operativa, administrativa, financiera, entre otros; tomando en cuenta los estándares establecidos por <strong><?php echo mb_strtoupper($oCliente->businessName); ?></strong></p>
	<br><br>
	<p style="text-align: left;font-size:14px;margin-left:120px;margin-right:120px;font-weight:bolder;">II.	ALCANCE</p><br>
	<p style="text-align: left;font-size:14px;margin-left:120px;margin-right:120px;">El alcance del servicio del sistema de homologación comprendió:</p>
	<p style="text-align: center;font-size:14px;margin-left:120px;margin-right:120px;font-weight: bolder;">“<?php echo mb_strtoupper($oHomologacion->scope); ?>”</p>
	<br><br>
	<p style="text-align: left;font-size:14px;margin-left:120px;margin-right:120px;font-weight:bolder;">III.	METODOLOGIA</p><br>
	<p style="text-align: left;font-size:14px;margin-left:120px;margin-right:120px;text-align:justify;">La metodología está basada en la calificación de la conformidad de la información proporcionada por el proveedor <?php echo mb_strtoupper($oProveedor->businessName); ?>, en función al cumplimiento de los criterios considerados en el Formulario de Evaluación de Proveedores establecido por Bureau Veritas del Perú S.A.</p>
	<br><br>
	<p style="text-align: left;font-size:14px;margin-left:120px;margin-right:120px;font-weight:bolder;">IV.	INFORMACIÓN DE LA EMPRESA</p>
	<br>
	<table class="table-portada" style="width:70%; font-size:14px;">	
		<tr><td style="text-align:left;width:40%;">Razón Social</td><td><?php echo mb_strtoupper($oProveedor->businessName); ?></td></tr>
		<tr><td style="text-align:left;width:40%;">R.U.C.</td><td><?php echo mb_strtoupper($oProveedor->documentNumber); ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Teléfono</td><td><?php echo $oProveedor->phone; ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Dirección Legal</td><td><?php echo mb_strtoupper($oProveedor->legalDirection); ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Dirección Visita</td><td><?php echo mb_strtoupper($oProveedor->address); ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Actividad Económica</td><td><?php echo mb_strtoupper($oProveedor->ecoActivity); ?> </td></tr>
		<tr><td style="text-align:left;width:40%;">Agente de Retención del IGV</td><td><?php if($oProveedor->retentionIgv != 0){ echo 'SI';}else{echo 'NO';} ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Fecha de Visita</td><td><?php echo $oHomologacion->programDate ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Representante Legal</td><td><?php echo mb_strtoupper($oProveedor->legalRepresentative); ?></td></tr>
		<tr><td style="text-align:left;width:40%;">Contacto</td><td><?php echo mb_strtoupper($oProveedor->commercialContactName); ?></td></tr>
	</table>

	<br><br><br><br><br><br>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;">&nbsp;</p>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;">&nbsp;</p>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;">&nbsp;</p>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;">&nbsp;</p>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;">&nbsp;</p>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;">&nbsp;</p>
	<div style="page-break-after:always;"><br><br><br>
		<table  style="font-size:14px;width:100%;margin-left: 40px;margin-right: 15%;">	
			<tr><td colspan="6" style="text-align:center;border:1px solid #000;">DATOS GENERALES</td></tr>
			<?php $oDepartamento = CrmUbigeo::getDepartamento_Item($oProveedor->department); $oProvince = CrmUbigeo::getProvincia_Item($oProveedor->department,$oProveedor->province); $oDistrict = CrmUbigeo::getDistrito_Item($oProveedor->department,$oProveedor->province,$oProveedor->district);
			$oDepartamentoLegal = CrmUbigeo::getDepartamento_Item($oProveedor->departmentLegal); $oProvinceLegal = CrmUbigeo::getProvincia_Item($oProveedor->departmentLegal,$oProveedor->provinceLegal); $oDistrictLegal = CrmUbigeo::getDistrito_Item($oProveedor->departmentLegal,$oProveedor->provinceLegal,$oProveedor->districtLegal);
			?>
			<tr><td style="text-align:center;background-color:#9e9e9e;width:50%;" colspan="3">RAZÓN SOCIAL</td><td colspan="3" style="text-align:center;background-color:#9e9e9e;width:50%;">RUC</td></tr>
			<tr><td style="text-align:center;width:50%;" colspan="3"><?php echo mb_strtoupper($oProveedor->businessName); ?></td><td style="text-align:center;width:50%;" colspan="3"><?php echo mb_strtoupper($oProveedor->documentNumber); ?></td></tr>
			<tr><td style="text-align:left;" rowspan="4">Dirección de oficinas</td><td colspan="2">Direccion</td><td>Distrito</td><td>Provincia</td><td>Departamento</td></tr>
			<tr><td colspan="2"><?php echo mb_strtoupper($oProveedor->address); ?></td><td><?php if($oProveedor->district != 0){echo mb_strtoupper($oDistrict->nombre);}else{ echo '-';} ?></td><td><?php if($oProveedor->province != 0){echo mb_strtoupper($oProvince->nombre);}else{ echo '-';}; ?></td><td><?php if($oProveedor->department != 0){echo mb_strtoupper($oDepartamento->nombre);}else{ echo '-';} ?></td></tr>
			<tr><td style="width:50%;">País</td><td style="width:50%;">Código postal</td><td>Teléfono</td><td>Fax</td><td>E-Mail</td></tr>
			<tr><td><?php if($oProveedor->country != 0){echo mb_strtoupper($oProveedor->country);}else{ echo 'PERÚ';} ?></td><td><?php echo mb_strtoupper($oProveedor->postalCode); ?></td><td><?php echo mb_strtoupper($oProveedor->phone); ?></td><td><?php echo mb_strtoupper($oProveedor->fax); ?></td><td><?php echo mb_strtoupper($oProveedor->email); ?></td></tr>
			<tr><td style="text-align:left;" rowspan="2">Dirección legal</td><td colspan="2">Direccion</td><td>Distrito</td><td>Provincia</td><td>Departamento</td></tr>
			<tr><td colspan="2"><?php echo mb_strtoupper($oProveedor->legalDirection); ?></td><td><?php if($oProveedor->districtLegal != 0){echo mb_strtoupper($oDistrictLegal->nombre);}else{echo '-';} ?></td><td><?php if($oProveedor->provinceLegal != 0){echo mb_strtoupper($oProvinceLegal->nombre);}else{echo '-';} ?></td><td><?php if($oProveedor->departmentLegal){echo mb_strtoupper($oDepartamentoLegal->nombre);}else{echo '-';} ?></td></tr>
			<tr><td style="text-align:left;">Alcance de la Homologación (Línea de productos a homologar)</td><td colspan="5"><?php echo mb_strtoupper($oHomologacion->scope); ?></td></tr>
			<tr><td style="text-align:left;">Unidad Minera en la que trabaja</td><td colspan="5">--</td></tr>
			<tr><td style="text-align:left;">Persona contacto</td><td colspan="5"><?php echo mb_strtoupper($oProveedor->commercialContactName); ?></td></tr>
			<tr><td style="text-align:left;">Sector</td><td colspan="2">Bienes ()</td><td colspan="2">Servicios()</td><td>Mixto()</td></tr>
			<tr><td style="text-align:left;">Antigüedad de la Empresa</td><td colspan="5">??</td></tr>	
			<tr><td style="text-align:left;" rowspan="3">Accionistas de la Empresa</td><td colspan="3"><?php echo $oProveedor->businessAction1; ?></td><td colspan="2"><?php echo $oProveedor->percentageParticipant1; ?></td></tr>
			<tr><td colspan="3"><?php echo $oProveedor->businessAction2; ?></td><td colspan="2"><?php echo $oProveedor->percentageParticipant2; ?></td></tr>
			<tr><td colspan="3"><?php echo $oProveedor->businessAction3; ?></td><td colspan="2"><?php echo $oProveedor->percentageParticipant3; ?></td></tr>
			<tr><td style="text-align:left;">Partida Electrónica / Ficha Registral</td><td colspan="5"><?php echo mb_strtoupper($oProveedor->registration); ?></td></tr>
			<tr><td style="text-align:left;">Testimonio de Constitución / Modificación de Estatutos o Similar</td><td colspan="5"><?php echo mb_strtoupper($oProveedor->testConstitution); ?></td></tr>
			<tr><td style="text-align:left;">Acuerdos con otras firmas</td><td colspan="5"><?php echo mb_strtoupper($oProveedor->firm); ?></td></tr>
			<tr><td style="text-align:left;">Acuerdos de Representación o Distribución</td><td colspan="5"><?php echo mb_strtoupper($oProveedor->representation); ?></td></tr>
			<tr><td style="text-align:left;">Número de Licencia de Funcionamiento</td><td colspan="5"><?php echo mb_strtoupper($oProveedor->licence); ?></td></tr>
			<tr><td style="text-align:left;">Número de Certificado de Inspección Técnica de Seguridad en Defensa Civil </td><td colspan="5"><?php echo mb_strtoupper($oProveedor->certInspeccion); ?></td></tr>
			<tr><td style="text-align:left;">Número   de Registro como Empresa Contratista Minera (si aplica) </td><td colspan="5"><?php echo mb_strtoupper($oProveedor->registerMine); ?></td></tr>
		</table>
	</div>
	<br><br>
	<p style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;font-weight:bolder;">V.	FORMULARIO DE EVALUACION: </p>
	<br>


	<?php foreach ($oListCheck as $oCheck1) {
		echo '<div style="page-break-after:always;"><br><br><br>';
		echo '	<table class="table-form" style="font-size: 14px;width: 100%;margin-left: 40px;margin-right: 5%;">';
		echo '<tr><td colspan="5" style="padding:0px;border: 1px solid #dddddd;text-align:center;font-size:20PX;width:87%;background:#9e9e9e;color:#000;">'.mb_strtoupper($oCheck1->title).'</td>';
		echo '<td style="text-align:center;width:13%;background:#9e9e9e;color:#000;border-bottom:1px solid #dddddd;">Porcentaje Obtenido</td></tr>';
		echo ' </table>';

		echo '	<table class="table-form" style="font-size: 14px;width: 100%;margin-left: 40px;margin-right: 5%;">';
		$oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID); 
		foreach ($oListPreCheck as $value1) {
			$Carga = '';
			$oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID); 
			$response1 = CrmCheckHomo::getItemxCheckHomo($value1->checkID,$homologacionID);
			$conteo = ConteoCasillas($value1->question1,$value1->question2,$value1->question3,$value1->question4,$value1->question5);
			echo '<tr><td colspan="5" style="padding:0px;border: 1px solid #dddddd;text-align:center;width:87%;">';
			if($value1->typeCheck != 1){ 
				echo '	<table style="font-size: 14px;width: 100%;">';
				echo '		<tr><td style="text-align:left;font-size:14px;width:30%">'.$value1->title.'</td>';
				if($value1->question1 != 0){  
					if($value1->question1 == 2 || $value1->question1 == 7) {
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;">'.mb_strtoupper(CrmCheckList::getValor($response1->response1)).'</td>'; 
					}else{ 
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;" >'.mb_strtoupper($response1->response1).'</td>'; 
					}
				}	
				if($value1->question2 != 0){
					if($value1->question2 == 2 || $value1->question2 == 7) {
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;">'.mb_strtoupper(CrmCheckList::getValor($response1->response2)).'</td>'; 
					}else{ 
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;" >'.mb_strtoupper($response1->response2).'</td>'; 
					}
				}	
				if($value1->question3 != 0){
					if($value1->question3 == 2 || $value1->question3 == 7) {
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;">'.mb_strtoupper(CrmCheckList::getValor($response1->response3)).'</td>'; 
					}else{ 
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;" >'.mb_strtoupper($response1->response3).'</td>'; 
					}
				}	
				if($value1->question4 != 0){
					if($value1->question4 == 2 || $value1->question4 == 7) {
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;">'.mb_strtoupper(CrmCheckList::getValor($response1->response4)).'</td>'; 
					}else{ 
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;" >'.mb_strtoupper($response1->response4).'</td>'; 
					}
				}	
				if($value1->question5 != 0){
					if($value1->question5 == 2 || $value1->question5 == 7) {
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;">'.mb_strtoupper(CrmCheckList::getValor($response1->response5)).'</td>'; 
					}else{ 
						echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo).'%;" >'.mb_strtoupper($response1->response5).'</td>';
					} 
				}	
				if($value1->score == 1){
					if($value1->numScore == 0 ){ 
						$Carga =  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">0%</td></tr>';
					}else{
						$Carga =  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">'.(($response1->score / $value1->numScore)*100).'%</td></tr>';
					}
				}
				echo '</tr></table>';
			}else{
				$contador=0;$count=0;foreach ($oListPreCheck2 as $value2) {$count++;}
				echo '<table style="font-size: 14px;width: 100%;">';
				echo '<tr><td style="text-align:left;font-size:14px;width:20%;background: darkgray;" rowspan="'.$count.'">'.mb_strtoupper($value1->title).'</td>';
				$Carga2 = '';
				foreach ($oListPreCheck2 as $value2) {
					$contador++;
					$oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
					$response2 = CrmCheckHomo::getItemxCheckHomo($value2->checkID,$homologacionID);
					$conteo2 = ConteoCasillas($value2->question1,$value2->question2,$value2->question3,$value2->question4,$value2->question5);
					if($value2->typeCheck != 1){ 
						echo '<td style="padding:0px;border: 1px solid #dddddd;text-align:center;width:80%;">';
						echo '	<table style="font-size: 14px;width: 100%;">';
						echo '		<tr><td style="text-align:left;font-size:14px;width:30%">'.$value2->title.'</td>';
						if($value2->question1 != 0){  
							if($value2->question1 == 2 || $value2->question1 == 7) {
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;">'.mb_strtoupper(CrmCheckList::getValor($response2->response1)).'</td>'; 
							}else{ 
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;">'.mb_strtoupper($response2->response1).'</td>'; 
							}
						}	
						if($value2->question2 != 0){  
							if($value2->question2 == 2 || $value2->question2 == 7) {
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;">'.mb_strtoupper(CrmCheckList::getValor($response2->response2)).'</td>'; 
							}else{ 
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;" >'.mb_strtoupper($response2->response2).'</td>'; 
							}
						}	
						if($value2->question3 != 0){  
							if($value2->question3 == 2 || $value2->question3 == 7) {
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;">'.mb_strtoupper(CrmCheckList::getValor($response2->response3)).'</td>'; 
							}else{ 
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;" >'.mb_strtoupper($response2->response3).'</td>'; 
							}
						}	
						if($value2->question4 != 0){  
							if($value2->question4 == 2 || $value2->question4 == 7) {
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;">'.mb_strtoupper(CrmCheckList::getValor($response2->response4)).'</td>'; 
							}else{ 
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;" >'.mb_strtoupper($response2->response4).'</td>'; 
							}
						}	
						if($value2->question5 != 0){  
							if($value2->question5 == 2 || $value2->question5 == 7) {
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;">'.mb_strtoupper(CrmCheckList::getValor($response2->response5)).'</td>'; 
							}else{ 
								echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo2).'%;" >'.mb_strtoupper($response2->response5).'</td>'; 
							}
						}


						if($value2->score == 1){
							if($value2->numScore == 0 ){ 
								$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">0%</td></tr>';
							}else{
								$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">'.(($response2->score / $value2->numScore)*100).'%</td></tr>';
							}
						}else{
							if($value1->score == 1){
								if($value1->numScore == 0 ){ 
									$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">0%</td></tr>';
								}else{
									$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">'.(($response1->score / $value1->numScore)*100).'%</td></tr>';
								}
							}
						}

						echo '</tr></table></td></tr>';
					}else{
						$contador2=0;$count2=0;foreach ($oListPreCheck3 as $value3) {$count2++;}
						echo '<td style="padding:0px;border: 1px solid #dddddd;text-align:center;width:80%;">';
						echo '<table style="font-size: 14px;width: 100%;">';
						echo '<tr><td style="text-align:left;font-size:14px;width:20%;background: darkgray;" rowspan="'.$count2.'">'.mb_strtoupper($value2->title).'</td>';
						$Carga3 = '';
						foreach ($oListPreCheck3 as $value3) {
							$contador2++;
							$oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
							$response3 = CrmCheckHomo::getItemxCheckHomo($value3->checkID,$homologacionID);
							$conteo3 = ConteoCasillas($value3->question1,$value3->question2,$value3->question3,$value3->question4,$value3->question5);
							if($value3->typeCheck != 1){ 
								echo '<td style="padding:0px;border: 1px solid #dddddd;text-align:center;width:80%;">';
								echo '	<table style="font-size: 14px;width: 100%;">';
								echo '		<tr><td style="text-align:left;font-size:14px;width:30%">'.$value3->title.'</td>';
								if($value3->question1 != 0){  
									if($value3->question1 == 2 || $value3->question1 == 7) {
										if(isset($respone3->response1)){
											echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper(CrmCheckList::getValor($response3->response1)).'</td>'; 
										}else{
											echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper('No Aplica').'</td>'; 
										}	

									}else{ 
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper($response3->response1).'</td>'; 
									}
								}	
								if($value3->question2 != 0){  
									if($value3->question2 == 2 || $value3->question2 == 7) {
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper(CrmCheckList::getValor($response3->response2)).'</td>'; 
									}else{ 
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;" >'.mb_strtoupper($response3->response2).'</td>'; 
									}
								}	
								if($value3->question3 != 0){  
									if($value3->question3 == 2 || $value3->question3 == 7) {
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper(CrmCheckList::getValor($response3->response3)).'</td>'; 
									}else{ 
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;" >'.mb_strtoupper($response3->response3).'</td>'; 
									}
								}	
								if($value3->question4 != 0){  
									if($value3->question4 == 2 || $value3->question4 == 7) {
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper(CrmCheckList::getValor($response3->response4)).'</td>'; 
									}else{ 
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;" >'.mb_strtoupper($response3->response4).'</td>'; 
									}
								}	
								if($value3->question5 != 0){  
									if($value3->question5 == 2 || $value3->question5 == 7) {
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;">'.mb_strtoupper(CrmCheckList::getValor($response3->response5)).'</td>'; 
									}else{ 
										echo '<td style="text-align:center;padding:18px;border-right:1px solid #dddddd;border-left:1px solid #dddddd; width:'.(70/$conteo3).'%;" >'.mb_strtoupper($response3->response5).'</td>'; 
									}
								}
								
								if($value3->score == 1){
									if($value3->numScore == 0 ){ 
										$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">0%</td></tr>';
									}else{
										$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">'.(($response3->score / $value3->numScore)*100).'%</td></tr>';
									}
								}else{
									if($value2->score == 1){
										if($value2->numScore == 0 ){ 
											$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">0%</td></tr>';
										}else{
											$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">'.(($response2->score / $value2->numScore)*100).'%</td></tr>';
										}
									}else{
										if($value1->score == 1){
											if($value1->numScore == 0 ){ 
												$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">0%</td></tr>';
											}else{
												$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">'.(($response1->score / $value1->numScore)*100).'%</td></tr>';
											}
										}else{
											$Carga .=  '<tr><td style="text-align:center;font-size:14px;border:none;padding:16px;">INFORMATIVO</td></tr>';
										}
									}
								}
								
								echo '</tr></table></td></tr>';
							}
						}
						echo '</td></tr></table></td></tr>';
					}
					
				}
				echo '</tr></table>';
			}
			echo '</td>';
			
			if($Carga != ''){
				echo '<td class="broke_array" style="text-align:center;border-bottom:1px solid #dddddd;width:13%;border-right:1px solid #dddddd;"><table class="broke_array2" style="font-size: 14px;width: 100%;">'.$Carga.'</table></td></tr>';
				
			}else{
				echo '<td class="broke_array" style="text-align:center;border-bottom:1px solid #dddddd;width:13%;border-right:1px solid #dddddd;"><table class="broke_array2" style="font-size: 14px;width: 100%;"><tr><td style="text-align:center;font-size:14px;border:none;padding:0px;">INFORMATIVO</td></tr></table></td></tr>';
			}
		}
		$oCheckGeneral = CrmGeneralHomo::getItemxGeneralHomo($oCheck1->checkID,$homologacionID);
		echo '<table style="font-size: 14px;width: 100%;margin-left: 40px;margin-right: 5%;"><tr><td colspan="5" style="padding:0px;border: 1px solid #dddddd;text-align:center;font-size:14PX;width:87%;background:#9e9e9e;color:#000;">Comentarios:</td>';
		if($oCheckGeneral->scoreRes != 0){
			echo '<td style="text-align:center;width:13%; background:darkgray;">'.Round((($oCheckGeneral->scoreRes/$oCheckGeneral->scoreAcu)*100),2).'%</td></tr>';
		}else{
			echo '<td style="text-align:center;width:13%;">&nbsp;</td></tr>';
		}
		echo '<tr><td colspan="5" style="padding:0px;border: 1px solid #dddddd;text-align:left;font-size:14px;width:87%;">Las evidencias sólo proporcionan algunos de los elementos o datos suficientes, acorde con el ítem correspondiente. Durante la homologación se evidenció que la organización cuenta con:<br>'.$oCheckGeneral->observation.'</td>';
		echo '<td style="text-align:center;width:13%;background:darkgray;">&nbsp;</td></tr>';
		echo ' </table>';
		echo '</div>';
	}
	?>
	<br>
	<br>
	<div style="page-break-after:always;"><br><br><br>
		<p style="text-align: left;font-size:14px;margin-left:60px;margin-right:60px;font-weight:bolder;">VI.	RESUMEN DE RESULTADOS: </p>
		<br>
		<?php 
		$lGeneralHomo = CrmGeneralHomo::getListxHomologacion($homologacionID);
		$oHomologacion = CrmHomologacion::getItem($homologacionID);
		echo '<table style="font-size: 14px;width: 80%;margin:0 auto;text-align:center;"><tr><td colspan="3" style="background-color:darkgray;text-align:center;">CUADRO DE PUNTAJES</td></tr>';
		echo '<tr><td style="text-align:center;"><strong>ITEM</strong></td><td><strong>DESCRIPCIÓN</strong></td><td><strong>PORCENTAJES OBTENIDOS</strong></td></tr>';
		$count = 0; $total = 0;
		foreach ($lGeneralHomo as $value) {
			$count++;
			$oCheck = CrmChecklist::getItem($value->checkID);
			if($value->scoreAcu != 0){
				echo '<tr><td style="text-align:center;">'.$count.'</td><td style="text-align:left;">'.mb_strtoupper($oCheck->title,'UTF-8').'</td><td style="text-align:center;">'.round((($value->scoreRes/$value->scoreAcu)*100),2).'%</td></tr>';
			}else{
				echo '<tr><td style="text-align:center;">'.$count.'</td><td style="text-align:left;">'.mb_strtoupper($oCheck->title,'UTF-8').'</td><td style="text-align:center;">0%</td></tr>';
			}
		}
		echo '<tr><td style="background-color:darkgray;text-align:center;"></td><td style="background-color:darkgray;text-align:center;" >TOTAL</td><td style="background-color:darkgray;text-align:center;">'.$oHomologacion->puntajeFinal.'%</td></tr></table>';
		?>
		<br><br>
		<p style="text-align: left;font-size:14px;margin-left:60px;margin-right:60px;font-weight: bolder;">VII.	CONCLUSIONES : </p>
		<p style="text-align: left;font-size:14px;margin-left:60px;margin-right:60px;">La empresa ha alcanzado <strong><?php echo $oHomologacion->puntajeFinal; ?> %</strong> de cumplimiento total, correspondiéndole la calificación en el <strong>NIVEL <?php echo $oHomologacion->nivel; ?></strong>. Por lo tanto BV considera que la empresa <strong><?php echo $oProveedor->businessName; ?></strong>, aprobó el proceso de homologación.</p>	
		<br>
		<?php 
		$lNivelCliente = CrmNivelCliente::getListByCliente($oCliente->clienteID);
		echo '<table style="font-size: 14px;width: 40%;margin-left: 40px;margin-right: 5%;text-align:center;margin:0 auto;">';
		echo '<tr style="background-color:darkgray;"><td>NIVEL</td><td>RANGO (%)</td></tr>';
		foreach ($lNivelCliente as $value) {
			if($value->minimo <= $oHomologacion->puntajeFinal  && $value->maximo >= $oHomologacion->puntajeFinal){ 
				if($value->state != 1){
					echo '<tr style="background-color:red;color:#fff;"><td>NIVEL '.$value->nivel.'</td><td>'.$value->minimo.' - '.$value->maximo.'</td></tr>';
				}else{
					echo '<tr style="background-color:green;color:#fff;"><td>NIVEL '.$value->nivel.'</td><td>'.$value->minimo.' - '.$value->maximo.'</td></tr>';
				}
			}else{
				echo '<tr><td>NIVEL '.$value->nivel.'</td><td>'.$value->minimo.' - '.$value->maximo.'</td></tr>';
			}
		}
		echo '</table>';
		?>
		<br>
		<p style="text-align:left;font-size:14px;margin-left:60px;margin-right:60px;font-style:oblique;">
			El porcentaje total alcanzado por la empresa es calculado teniendo en cuenta el "porcentaje obtenido" multiplicado por el peso ponderado de cada "área evaluada" establecidos por el cliente.
		</p>
	</div>
	<br><br>

	<p style="text-align: left;font-size:14px;margin-left:60px;margin-right:60px;font-weight:bolder;">VIII.	OBSERVACIONES : </p>
	<br><br>
	<p style="text-align: left;font-size:14px;margin-left:60px;margin-right:60px;font-weight:bolder;">IX.	FOTOGRAFIAS DE INSPECCION: </p>
	<?php 
	$oPhotoHomo = CrmPhotoHomo::getItemxHomologacion2($homologacionID);
	if(isset($oPhotoHomo)){
		if($oPhotoHomo->photo1 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo1.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description1.'</p>';
		}
		if($oPhotoHomo->photo2 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo2.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description2.'</p>';
		}
		if($oPhotoHomo->photo3 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo3.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description3.'</p>';
		}
		if($oPhotoHomo->photo4 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo4.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description4.'</p>';
		}
		if($oPhotoHomo->photo5 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo5.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description5.'</p>';
		}
		if($oPhotoHomo->photo6 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo6.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description6.'</p>';
		}
		if($oPhotoHomo->photo7 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo7.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description7.'</p>';
		}
		if($oPhotoHomo->photo8 != ''){
			echo '<img class="img-insp" src="/scs/homologacion/userfiles/'.$oPhotoHomo->photo8.'" >';
			echo '<p style="text-align: center;font-size:16px;margin-left:60px;margin-right:60px;">'.$oPhotoHomo->description8.'</p>';
		}
	}
	?>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<?php 
	$oAdmUser = AdmUser::getItem($oHomologacion->userID);
	echo '<p  style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;font-weight:bolder;">'.mb_strtoupper($oAdmUser->firstName.' '.$oAdmUser->lastName).'</p>';
	echo '<p  style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;font-weight:bolder;">'.mb_strtoupper($oAdmUser->profileName).'</p>';
	echo '<p  style="text-align: left;font-size:16px;margin-left:60px;margin-right:60px;font-weight:bolder;">BUREAU VERITAS DEL PERU SA.</p>';
	?>

</body>
</html>