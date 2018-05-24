<?php //Get MediaGroup
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->basePath;
?>

<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>


<?php
$oProveedor=WebLogin::getProveedorSession();
$oCliente=WebLogin::getClienteSession();
$oAdmin=WebLogin::getAdminSession();

//Validacion para que otros con un simple link no entren sin logueo ni por el proveedor
if(isset($oProveedor)){
	$oValidate = CrmHomologacion::getItemValidation($_GET['r'],$oProveedor->proveedorID);
	if(!isset($oValidate)){
		echo '<script type="text/javascript">$(function(){ location.href="<?php echo $URL_ROOT;?>relacion-homologacion.html"; });</script>';
	}
}
//-------------------------------------------------------------------------------------

$read = ''; $dis = '';
if(isset($oAdmin)){ if($oAdmin->profileID == 2){ $read = 'readOnly'; } }

$oForm = CrmHomologacion::getItemFormulario($_GET['r']);

$oListCheck = CrmChecklist::getListByFormulario($oForm->typeForm);

$oFormulario = CrmFormulario::getItemHomo($_GET['r']);

//Lista para niveles
$oHomNivel = CrmHomologacion::getItem($_GET['r']);
$oReqNivel = CrmRequerimiento::getItem($oHomNivel->requerimientoID); 
$oProvNivel = CrmProveedor::getItem($oReqNivel->proveedorID); 
$oPropxformNivel = CrmPropxForm::getItem($oReqNivel->propxformID); 
$oPropuestaNivel = CrmPropuesta::getItem($oPropxformNivel->propuestaID);
$oClienteNivel = CrmCliente::getItem($oPropuestaNivel->clienteID);
$lNivelCliente = CrmNivelCliente::getListByCliente($oClienteNivel->clienteID);

function ConteoCasillas($val1,$val2,$val3,$val4,$val5){
	$count = 1;
	if($val1 != 0){ $count++;}if($val2 != 0){ $count++;}if($val3 != 0){ $count++;}if($val4 != 0){ $count++;}if($val5 != 0){ $count++;}
	return $count;
}

function SelectPorc($general,$sacado){
	$data = '';
	for ($i = 0; $i <= 20; $i++) {
		$valorNum = $i*5;
		if($general == 0 ){
			$resultado = 0;
		}else{
			$resultado = ($sacado/$general)*100;
		}
		if($valorNum == $resultado){
			$data.='<option value="'.$valorNum.'" selected>'.$valorNum.'%</option>';
		}else{
			$data.='<option value="'.$valorNum.'">'.$valorNum.'%</option>';
		}
	}
	return $data;
}

function SelectSinPorc(){
	$data = '';
	for ($i = 0; $i <= 20; $i++) {
		$valorNum = $i*5;
		$data.='<option value="'.$valorNum.'">'.$valorNum.'%</option>';
	}
	return $data;
}


function InputTexto($valor,$conteo,$id,$num,$resp,$read){
	$data = ''; $dis = '';
	$read = '';
	if($read == 'readOnly'){ $dis = 'disabled';}
	switch ($valor) {
		case '1': //Abierto
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input type="text" class="form-control text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" value="'.$resp.'" '.$read.' data-toggle="tooltip" title="'.$resp.'"></div></div>';
		break;
		case '2': //Cerrado
		if($resp != ''){
			if($resp == 1){
				$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input type="radio" '.$dis.' class="radio-template" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off" checked >&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off" >&nbsp;&nbsp;No</label></div></div>';
			}else{
				$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input type="radio" '.$dis.' class="radio-template" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input type="radio" '.$dis.' class="radio-template" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off" checked>&nbsp;&nbsp;No</label></div></div>';
			}
		}else{
			$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input type="radio" class="radio-template" '.$dis.' id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input type="radio" class="radio-template" '.$dis.' id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label></div></div>';
		}
		break;
		case '3': //Numerica
		if($resp != ''){
			$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="'.$resp.'" class="form-control numeric text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		}else{
			$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="0" class="form-control numeric text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		}
		break;
		case '4': //Alternativa
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="'.$response1.'" class="form-control text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		break;
		case '5': //Fecha
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="'.$resp.'" class="form-control datepicker text" data-date-format="yyyy-mm-dd" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		break;
		case '6': //Monetaria
		if($resp != ''){
			$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="'.$resp.'" class="form-control money text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		}else{
			$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="0.00" class="form-control money text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		}
		break;
		case '7': //Cerrado
		if($resp != ''){
			if($resp == 1){
				$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off" checked>&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_3"><input '.$dis.' type="radio" class="radio-template no_aplica" id="input_'.$id.'_'.$num.'_3" name="input_'.$id.'_'.$num.'" value="3" autocomplete="off">&nbsp;&nbsp;No Aplica</label></div></div>';
			}else if($resp == 2) {
				$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off" checked>&nbsp;&nbsp;No</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_3"><input '.$dis.' type="radio" class="radio-template no_aplica" id="input_'.$id.'_'.$num.'_3" name="input_'.$id.'_'.$num.'" value="3" autocomplete="off">&nbsp;&nbsp;No Aplica</label></div></div>';
			}else{
				$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_3"><input '.$dis.' type="radio" class="radio-template no_aplica" id="input_'.$id.'_'.$num.'_3" name="input_'.$id.'_'.$num.'" value="3" autocomplete="off" checked>&nbsp;&nbsp;No Aplica</label></div></div>';
				$data .= '<script>$(function(){ $("input[name=score_'.$id.']").val("0.000"); });</script>'; 
			}
			
		}else{
			$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_3"><input '.$dis.' type="radio" class="radio-template no_aplica" id="input_'.$id.'_'.$num.'_3" name="input_'.$id.'_'.$num.'" value="3" autocomplete="off">&nbsp;&nbsp;No Aplica</label></div></div>';
		}
		break;
	}
	return $data;
}


function InputTextoSinResp($valor,$conteo,$id,$num,$read){
	$data = '';
	$dis = '';
	if($read == 'readOnly'){ $dis = 'disabled';  }
	switch ($valor) {
		case '1': //Abierto
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input type="text" class="form-control text" id="input_'.$id.'_'.$num.'" '.$read.' name="input_'.$id.'_'.$num.'"></div></div>';
		break;
		case '2': //Cerrado
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input type="radio" '.$dis.' class="radio-template" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input type="radio" '.$dis.' class="radio-template" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label></div></div>';
		break;
		case '3': //Numerica
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input type="text" value="0" class="form-control numeric text" '.$read.' id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		break;
		case '4': //Alternativa
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input type="text" class="form-control text" id="input_'.$id.'_'.$num.'" '.$read.' name="input_'.$id.'_'.$num.'" ></div></div>';
		break;
		case '5': //Fecha
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" class="form-control datepicker text" data-date-format="yyyy-mm-dd" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		break;
		case '6': //Monetaria
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><input '.$read.' type="text" value="0.00" class="form-control money text" id="input_'.$id.'_'.$num.'" name="input_'.$id.'_'.$num.'" ></div></div>';
		break;
		case '7': //Cerrado
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_3"><input '.$dis.' type="radio" class="radio-template no_aplica" id="input_'.$id.'_'.$num.'_3" name="input_'.$id.'_'.$num.'" value="3" autocomplete="off">&nbsp;&nbsp;No Aplica</label></div></div>';
		break;
	}
	return $data;
}
?>


<style>
.btn-group>.btn-group {
	border: 1px solid floralwhite;
}
.form-control{
	text-align: center;
}
.well{
	padding: 15px;
	border: 0.5px dashed black;
	border-radius: 9px;
	margin-top: -5px;
	background-color: #d0d0b6;
}
.btn-default.active {
	color: #fff;
	background-color: #bd2130;
	border-color: #bd2130;
	cursor: pointer;
}
.btn-default{
	background-color: buttonface;
	padding: 11px;
	border: 1px solid #fff;
	border-radius: 8px;
}

.btn-default a{
	color: #000;
}
.row{
	text-align: left;
}

.btn{
	cursor:pointer;
}

.btn-default.active{
	background-color: #dc3545;
	padding: 11px;
	border: 1px solid #fff;
	border-radius: 8px;
}

.btn-default.active a{
	color : #fff;
}

.btn-default.active a:hover{
	color : #fff !important;
}
.nav {
	flex-wrap: wrap;
}
.row-style{
	margin-top: 15px;
}
.form-control:disabled, .form-control[readonly] {
	background-color: #e9ecef;
	opacity: 1;
	pointer-events: none;
}

.btn-default.active:hover {
	color: #fff;
	background-color: #dc3545;
	border-color: #dc3545;
}
.btn-default.active:not([disabled]):not(.disabled).active, .btn-default.active:not([disabled]):not(.disabled):active, .show>.btn-default.active.dropdown-toggle {
	color: #fff;
	background-color: #dc3545;
	border-color: #dc3545;
	box-shadow: 0 0 0 0.2rem #dc35457d;
}

.btn-default.active.focus, .btn-default.active:focus {
	box-shadow: 0 0 0 0.2rem #dc35457d;
}
@media (min-width: 1200px){
	.container {
		max-width: 1800px !important;
	}
	.nav {
		flex-wrap: nowrap;
	}
}
</style>


<main role="main" class="container">
	<div class="starter-template">
		<section class="content">
			<h3>Formulario de Evaluación de Cliente - <?php echo $oFormulario->title; ?></h3>
			<br>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">Importante</legend>
				<p>
					<strong>
						Ingresar a cada casillero para completar la informacion solicitada. La informacion en todos los casilleros es obligatoria. Al finalizar, dar click en el boton de adjuntos para iniciar la carga de documentos minima obligatoria
					</strong>
				</p>
				
				<div class="row">
					<div class="col-sm-6">
						<h4><strong>Criterios de Evaluación</strong></h4>
						<fieldset class="scheduler-border">
							<br>
							<ul>
								<li>100%= Las evidencias proporcionan los elementos o datos satisfactorios, claros y acordes con el ítem correspondiente.</li>
								<li>30 - 60 - 90%= Las evidencias sólo proporcionan algunos de los elementos o datos suficientes, claros y acordes con el ítem correspondiente.</li>
								<li>30% Inicio 60% En proceso 90% Por concluir</li>
								<li>0%= Las evidencias no proporcionan ninguno de los elementos o datos suficientes, claros y acordes con el ítem correspondiente.</li>
							</ul>		
						</fieldset>
					</div>
					<div class="col-sm-6">
						<h4><strong>Niveles de Cumplimiento</strong></h4>
						<fieldset class="scheduler-border">
							<br>
							<ul><?php foreach ($lNivelCliente as $value) { echo '<li>NIVEL '.$value->nivel.' : '.$value->minimo.'% - '.$value->maximo.'% ('. CrmNivelCliente::getState($value->state) .')</li><br>'; } ?>
						</ul>		
						<p style="text-align: justify;"><strong>Nota: El porcentaje total alcanzado por el proveedor es calculado teniendo en cuenta el "porcentaje obtenido" multiplicado por el peso ponderado de cada "área evaluada" establecida por <?Php echo strtoupper($oClienteNivel->businessName); ?>. Esta informacion es confidencial.</strong></p>
					</fieldset>
				</div>
			</div>

		</fieldset>
		<div class="col-sm-2 pull-right"><div class="form-group"><div class="btn btn-info btn-block" id="btnAdjunto" >Adjuntos</div></div></div>
		<br>
		<br>
		<ul class="nav nav-pills nav-justified " role="tablist">
			<?php $count=0; foreach ($oListCheck as $oCheck1) { $count++; ?>
				<li role="presentation" class="btn-default <?php if($count==1){ echo 'active'; }else{ echo ''; } ?>"><a href="#tab<?php echo $oCheck1->checkID; ?>" aria-controls="<?php echo $oCheck1->checkID; ?>" role="tab" data-toggle="tab"><?php echo $oCheck1->title; ?></a></li>
				<?php } ?>
			</ul>
			<form  id="form_homologacion">
				<div class="well"> 
					<div class="tab-content ">
						<input type="hidden" name="homologacionID" value="<?php echo $_GET['r']; ?>" id="homologacionID">
						<?php $count=0; foreach($oListCheck as $oCheck1) { $count++; $oListPreCheck = CrmChecklist::getListByCheck($oCheck1->checkID); ?>
							<div class="tab-pane fade in show <?php if($count==1){ echo ' active'; } ?> <?php if($count==2){ echo ' finance'; } ?>" id="tab<?php echo $oCheck1->checkID; ?>" role="tabpanel">
								<div class="box box-default">
									<div class="row">
										<?php echo '<div class="col-sm-12">';?>
										<br>
										<?php foreach ($oListPreCheck as $value1){ $conteo = 0;
											if($value1->typeCheck != 1){ 
												$conteo = ConteoCasillas($value1->question1,$value1->question2,$value1->question3,$value1->question4,$value1->question5); if($conteo!=5){$valorCol = 12/$conteo;}else{$valorCol = 2;} if($conteo!=5){$valInicial = $valorCol;}else{$valInicial = '4';}
												echo '<div class="row">';
												if(isset($oAdmin)){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} 
												echo '<div class="row">';
												if($value1->information != ''){ 
													echo '<div class="col-sm-11"><div class="row">';
												}	
												echo '<div class="col-sm-'.$valInicial.'"><label for="input_'.$value1->checkID.'">'.$value1->title.'</label></div>';
												$response1 = CrmCheckHomo::getItemxCheckHomo($value1->checkID,$_GET['r']);
												if($value1->question1 != 0){  if(isset($response1)){echo InputTexto($value1->question1,$valorCol,$value1->checkID,1,$response1->response1,$read); }else{ echo InputTextoSinResp($value1->question1,$valorCol,$value1->checkID,1,$read); } }	
												if($value1->question2 != 0){  if(isset($response1)){echo InputTexto($value1->question2,$valorCol,$value1->checkID,2,$response1->response2,$read); }else{ echo InputTextoSinResp($value1->question2,$valorCol,$value1->checkID,2,$read); } }	
												if($value1->question3 != 0){  if(isset($response1)){echo InputTexto($value1->question3,$valorCol,$value1->checkID,3,$response1->response3,$read); }else{ echo InputTextoSinResp($value1->question3,$valorCol,$value1->checkID,3,$read); } }	
												if($value1->question4 != 0){  if(isset($response1)){echo InputTexto($value1->question4,$valorCol,$value1->checkID,4,$response1->response4,$read); }else{ echo InputTextoSinResp($value1->question4,$valorCol,$value1->checkID,4,$read); } }	
												if($value1->question5 != 0){  if(isset($response1)){echo InputTexto($value1->question5,$valorCol,$value1->checkID,5,$response1->response5,$read); }else{ echo InputTextoSinResp($value1->question5,$valorCol,$value1->checkID,5,$read); } }	
												if($value1->information != ''){ 
													echo '</div></div>';
													echo '<div class="col-sm-1"><i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value1->information.'"></i></div>'; 
												}
												echo '</div></div>';
												if(isset($oAdmin)){
													if($value1->score == 1){ 	
														echo '<div class="col-sm-3"><div class="row">';
														echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value1->checkID.'" id="score_'.$value1->checkID.'" value="'.$value1->numScore.'" readOnly  class="form-control total"></div></div>';
														$response1 = CrmCheckHomo::getItemxCheckHomo($value1->checkID,$_GET['r']);
														if(isset($response1)){
															echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value1->checkID.'" id="score_porc'.$value1->checkID.'" class="form-control">'.SelectPorc($value1->numScore,$response1->score).'</select></div></div>';
															echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value1->checkID.'" id="score_resp'.$value1->checkID.'" value="'.$response1->score.'" class="form-control result money"></div></div>';
														}else{
															echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value1->checkID.'" id="score_porc'.$value1->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
															echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value1->checkID.'" id="score_resp'.$value1->checkID.'" value="0.00" class="form-control result money"></div></div>';
														}
														echo '<script>$(function(){ $("#score_porc'.$value1->checkID.'").change(function(){ var generico = $("#score_porc'.$value1->checkID.'").val(); var total = $("#score_'.$value1->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value1->checkID.'").val(resultado.toFixed(3)); });  });</script>';
														echo '</div></div>';
													}
												}
												echo '</div>';
											}else{
												echo '<div class="row">';
												if(isset($oAdmin)){ if($value1->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} }else{ echo '<div class="col-sm-12">'; } 
												echo '<div class="row">';
												echo '<div class="col-sm-12"><fieldset class="scheduler-border"><legend class="scheduler-border">'.$value1->title.'</legend>';
												if($value1->information != ''){ 
													echo '<i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value1->information.'"></i><br><br>'; 
												}
												$oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
												foreach ($oListPreCheck2 as $value2) { $conteo2 = 0;
													if($value2->typeCheck != 1){ 
														$conteo2 = ConteoCasillas($value2->question1,$value2->question2,$value2->question3,$value2->question4,$value2->question5); if($conteo2!=5){$valorCol2 = 12/$conteo2;}else{$valorCol2 = 2;} if($conteo2!=5){$valInicial2 = $valorCol2;}else{$valInicial2 = '4';}
														echo '<div class="row">';
														if(isset($oAdmin)){ if($value2->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} }else{ echo '<div class="col-sm-12">'; } 
														echo '<div class="row">';
														if($value2->information != ''){ 
															echo '<div class="col-sm-11"><div class="row">';
														}
														echo '<div class="col-sm-'.$valInicial2.'"><label for="input_'.$value2->checkID.'">'.$value2->title.'</label></div>';
														$response2 = CrmCheckHomo::getItemxCheckHomo($value2->checkID,$_GET['r']);
														if($value2->question1 != 0){  if(isset($response2)){echo InputTexto($value2->question1,$valorCol2,$value2->checkID,1,$response2->response1,$read); }else{ echo InputTextoSinResp($value2->question1,$valorCol2,$value2->checkID,1,$read); } }	
														if($value2->question2 != 0){  if(isset($response2)){echo InputTexto($value2->question2,$valorCol2,$value2->checkID,2,$response2->response2,$read); }else{ echo InputTextoSinResp($value2->question2,$valorCol2,$value2->checkID,2,$read); } }	
														if($value2->question3 != 0){  if(isset($response2)){echo InputTexto($value2->question3,$valorCol2,$value2->checkID,3,$response2->response3,$read); }else{ echo InputTextoSinResp($value2->question3,$valorCol2,$value2->checkID,3,$read); } }	
														if($value2->question4 != 0){  if(isset($response2)){echo InputTexto($value2->question4,$valorCol2,$value2->checkID,4,$response2->response4,$read); }else{ echo InputTextoSinResp($value2->question4,$valorCol2,$value2->checkID,4,$read); } }	
														if($value2->question5 != 0){  if(isset($response2)){echo InputTexto($value2->question5,$valorCol2,$value2->checkID,5,$response2->response5,$read); }else{ echo InputTextoSinResp($value2->question5,$valorCol2,$value2->checkID,5,$read); } }	
														if($value2->information != ''){ 
															echo '</div></div>';
															echo '<div class="col-sm-1"><i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value2->information.'"></i></div>'; 
														}
														echo '</div></div>';
														if(isset($oAdmin)){
															if($value2->score == 1){ 	
																echo '<div class="col-sm-3"><div class="row">';
																echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value2->checkID.'" id="score_'.$value2->checkID.'" value="'.$value2->numScore.'" readOnly  class="form-control total"></div></div>';
																$response2 = CrmCheckHomo::getItemxCheckHomo($value2->checkID,$_GET['r']);
																if(isset($response2)){
																	echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value2->checkID.'" id="score_porc'.$value2->checkID.'" class="form-control">'.SelectPorc($value2->numScore,$response2->score).'</select></div></div>';
																	echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value2->checkID.'" id="score_resp'.$value2->checkID.'" value="'.$response2->score.'" class="form-control result money"></div></div>';
																}else{
																	echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value2->checkID.'" id="score_porc'.$value2->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
																	echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value2->checkID.'" id="score_resp'.$value2->checkID.'" value="0.00" class="form-control result money"></div></div>';
																}
																echo '<script>$(function(){ $("#score_porc'.$value2->checkID.'").change(function(){ var generico = $("#score_porc'.$value2->checkID.'").val(); var total = $("#score_'.$value2->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value2->checkID.'").val(resultado.toFixed(3)); });  });</script>';
																echo '</div></div>';
															}
														}
														echo '</div>';
													}else{
														echo '<div class="row">';
														if(isset($oAdmin)){ if($value2->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} }else{ echo '<div class="col-sm-12">'; } 
														echo '<div class="row">';
														echo '<div class="col-sm-12"><fieldset class="scheduler-border"><legend class="scheduler-border">'.$value2->title.'</legend>';
														if($value2->information != ''){ 
															echo '<i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value2->information.'"></i><br><br>'; 
														}
														$oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
														foreach ($oListPreCheck3 as $value3) { $conteo3 = 0;
															if($value3->typeCheck != 1){ 
																$conteo3 = ConteoCasillas($value3->question1,$value3->question2,$value3->question3,$value3->question4,$value3->question5); if($conteo3!=5){$valorCol3 = 12/$conteo3;}else{$valorCol3 = 2;} if($conteo3!=5){$valInicial3 = $valorCol3;}else{$valInicial3 = '4';}
																echo '<div class="row">';
																if(isset($oAdmin)){ if($value3->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} }else{ echo '<div class="col-sm-12">'; } 
																echo '<div class="row">';
																if($value3->information != ''){ 
																	echo '<div class="col-sm-11"><div class="row">';
																}
																echo '<div class="col-sm-'.$valInicial3.'"><label for="input_'.$value3->checkID.'">'.$value3->title.'</label></div>';
																$response3 = CrmCheckHomo::getItemxCheckHomo($value3->checkID,$_GET['r']);
																if($value3->question1 != 0){  if(isset($response3)){echo InputTexto($value3->question1,$valorCol3,$value3->checkID,1,$response3->response1,$read); }else{ echo InputTextoSinResp($value3->question1,$valorCol3,$value3->checkID,1,$read); } }	
																if($value3->question2 != 0){  if(isset($response3)){echo InputTexto($value3->question2,$valorCol3,$value3->checkID,2,$response3->response2,$read); }else{ echo InputTextoSinResp($value3->question2,$valorCol3,$value3->checkID,2,$read); } }	
																if($value3->question3 != 0){  if(isset($response3)){echo InputTexto($value3->question3,$valorCol3,$value3->checkID,3,$response3->response3,$read); }else{ echo InputTextoSinResp($value3->question3,$valorCol3,$value3->checkID,3,$read); } }	
																if($value3->question4 != 0){  if(isset($response3)){echo InputTexto($value3->question4,$valorCol3,$value3->checkID,4,$response3->response4,$read); }else{ echo InputTextoSinResp($value3->question4,$valorCol3,$value3->checkID,4,$read); } }	
																if($value3->question5 != 0){  if(isset($response3)){echo InputTexto($value3->question5,$valorCol3,$value3->checkID,5,$response3->response5,$read); }else{ echo InputTextoSinResp($value3->question5,$valorCol3,$value3->checkID,5,$read); } }	
																if($value3->information != ''){ 
																	echo '</div></div>';
																	echo '<div class="col-sm-1"><i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value3->information.'"></i></div>'; 
																}
																echo '</div></div>';
																if(isset($oAdmin)){
																	if($value3->score == 1){ 	
																		echo '<div class="col-sm-3"><div class="row">';
																		echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value3->checkID.'" id="score_'.$value3->checkID.'" value="'.$value3->numScore.'" readOnly  class="form-control total"></div></div>';
																		$response3 = CrmCheckHomo::getItemxCheckHomo($value3->checkID,$_GET['r']);
																		if(isset($response3)){
																			echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value3->checkID.'" id="score_porc'.$value3->checkID.'" class="form-control">'.SelectPorc($value3->numScore,$response3->score).'</select></div></div>';
																			echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value3->checkID.'" id="score_resp'.$value3->checkID.'" value="'.$response3->score.'" class="form-control result money"></div></div>';
																		}else{
																			echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value3->checkID.'" id="score_porc'.$value3->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
																			echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value3->checkID.'"  id="score_resp'.$value3->checkID.'" value="0.00" class="form-control result money"></div></div>';
																		}
																		echo '<script>$(function(){ $("#score_porc'.$value3->checkID.'").change(function(){ var generico = $("#score_porc'.$value3->checkID.'").val(); var total = $("#score_'.$value3->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value3->checkID.'").val(resultado.toFixed(3)); });  });</script>';
																		echo '</div></div>';
																	}
																}
																echo '</div>';
															}else{
																echo '<div class="row">';
																if(isset($oAdmin)){ if($value3->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} }else{ echo '<div class="col-sm-12">'; } 
																echo '<div class="row">';
																echo '<div class="col-sm-12"><fieldset class="scheduler-border"><legend class="scheduler-border">'.$value3->title.'</legend>';
																if($value3->information != ''){ 
																	echo '<i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value3->information.'"></i><br><br>'; 
																}
																$oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
																foreach ($oListPreCheck4 as $value4) { $conteo4 = 0;
																	if($value4->typeCheck != 1){ 
																		$conteo4 = ConteoCasillas($value4->question1,$value4->question2,$value4->question3,$value4->question4,$value4->question5); if($conteo4!=5){$valorCol4 = 12/$conteo4;}else{$valorCol4 = 2;} if($conteo4!=5){$valInicial4 = $valorCol4;}else{$valInicial4 = '4';}
																		echo '<div class="row">';
																		if(isset($oAdmin)){ if($value4->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} }else{ echo '<div class="col-sm-12">'; } 
																		echo '<div class="row">';
																		if($value4->information != ''){ 
																			echo '<div class="col-sm-11"><div class="row">';
																		}
																		echo '<div class="col-sm-'.$valInicial4.'"><label for="input_'.$value4->checkID.'">'.$value4->title.'</label></div>';
																		$response4 = CrmCheckHomo::getItemxCheckHomo($value4->checkID,$_GET['r']);
																		if($value4->question1 != 0){  if(isset($response4)){echo InputTexto($value4->question1,$valorCol4,$value4->checkID,1,$response4->response1,$read); }else{ echo InputTextoSinResp($value4->question1,$valorCol4,$value4->checkID,1,$read); } }	
																		if($value4->question2 != 0){  if(isset($response4)){echo InputTexto($value4->question2,$valorCol4,$value4->checkID,2,$response4->response2,$read); }else{ echo InputTextoSinResp($value4->question2,$valorCol4,$value4->checkID,2,$read); } }	
																		if($value4->question3 != 0){  if(isset($response4)){echo InputTexto($value4->question3,$valorCol4,$value4->checkID,3,$response4->response3,$read); }else{ echo InputTextoSinResp($value4->question3,$valorCol4,$value4->checkID,3,$read); } }	
																		if($value4->question4 != 0){  if(isset($response4)){echo InputTexto($value4->question4,$valorCol4,$value4->checkID,4,$response4->response4,$read); }else{ echo InputTextoSinResp($value4->question4,$valorCol4,$value4->checkID,4,$read); } }	
																		if($value4->question5 != 0){  if(isset($response4)){echo InputTexto($value4->question5,$valorCol4,$value4->checkID,5,$response4->response5,$read); }else{ echo InputTextoSinResp($value4->question5,$valorCol4,$value4->checkID,5,$read); } }	
																		if($value4->information != ''){ 
																			echo '</div></div>';
																			echo '<div class="col-sm-1"><i class="fa fa-question-circle fa-2x pull-right" data-toggle="tooltip" title="'.$value4->information.'"></i></div>'; 
																		}
																		echo '</div></div>';
																		if(isset($oAdmin)){
																			if($value4->score == 1){ 	
																				echo '<div class="col-sm-3"><div class="row">';
																				echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value4->checkID.'"  id="score_'.$value4->checkID.'" value="'.$value4->numScore.'" readOnly  class="form-control total"></div></div>';
																				$response4 = CrmCheckHomo::getItemxCheckHomo($value4->checkID,$_GET['r']);
																				if(isset($response4)){
																					echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value4->checkID.'" id="score_porc'.$value4->checkID.'" class="form-control">'.SelectPorc($value4->numScore,$response4->score).'</select></div></div>';
																					echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value4->checkID.'" id="score_resp'.$value4->checkID.'" value="'.$response4->score.'" class="form-control result money"></div></div>';
																				}else{
																					echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value4->checkID.'" id="score_porc'.$value4->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
																					echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value4->checkID.'" id="score_resp'.$value4->checkID.'" value="0.00" class="form-control result money"></div></div>';
																				}
																				echo '<script>$(function(){ $("#score_porc'.$value4->checkID.'").change(function(){ var generico = $("#score_porc'.$value4->checkID.'").val(); var total = $("#score_'.$value4->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value4->checkID.'").val(resultado.toFixed(3)); });  });</script>';
																				echo '</div></div>';
																			}
																		}
																		echo '</div>';
																	}
																}
																echo '</fieldset></div></div></div>';
																if(isset($oAdmin)){
																	if($value3->score == 1){ 	
																		echo '<div class="col-sm-3"><div class="row row-style">';
																		echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value3->checkID.'" id="score_'.$value3->checkID.'" value="'.$value3->numScore.'" readOnly  class="form-control total"></div></div>';
																		$response3 = CrmCheckHomo::getItemxCheckHomo($value3->checkID,$_GET['r']);
																		if(isset($response3)){
																			echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value3->checkID.'" id="score_porc'.$value3->checkID.'" class="form-control">'.SelectPorc($value3->numScore,$response3->score).'</select></div></div>';
																			echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value3->checkID.'" id="score_resp'.$value3->checkID.'" value="'.$response3->score.'" class="form-control result money"></div></div>';
																		}else{
																			echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value3->checkID.'" id="score_porc'.$value3->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
																			echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value3->checkID.'" id="score_resp'.$value3->checkID.'" value="0.00" class="form-control result money"></div></div>';
																		}
																		echo '<script>$(function(){ $("#score_porc'.$value3->checkID.'").change(function(){ var generico = $("#score_porc'.$value3->checkID.'").val(); var total = $("#score_'.$value3->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value3->checkID.'").val(resultado.toFixed(3)); });  });</script>';
																		echo '</div></div>';
																	}
																}
																echo '</div>';
															}
														}
														echo '</fieldset></div></div></div>';
														if(isset($oAdmin)){
															if($value2->score == 1){ 	
																echo '<div class="col-sm-3"><div class="row row-style">';
																echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value2->checkID.'" id="score_'.$value2->checkID.'" value="'.$value2->numScore.'" readOnly  class="form-control total"></div></div>';
																$response2 = CrmCheckHomo::getItemxCheckHomo($value2->checkID,$_GET['r']);
																if(isset($response2)){
																	echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value2->checkID.'" id="score_porc'.$value2->checkID.'" class="form-control">'.SelectPorc($value2->numScore,$response2->score).'</select></div></div>';
																	echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value2->checkID.'" id="score_resp'.$value2->checkID.'" value="'.$response2->score.'" class="form-control result money"></div></div>';
																}else{
																	echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value2->checkID.'" id="score_porc'.$value2->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
																	echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value2->checkID.'" id="score_resp'.$value2->checkID.'" value="0.00" class="form-control result money"></div></div>';
																}
																echo '<script>$(function(){ $("#score_porc'.$value2->checkID.'").change(function(){ var generico = $("#score_porc'.$value2->checkID.'").val(); var total = $("#score_'.$value2->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value2->checkID.'").val(resultado.toFixed(3)); });  });</script>';
																echo '</div></div>';
															}
														}
														echo '</div>';
													}  	
												}
												echo '</fieldset></div></div></div>';
												if(isset($oAdmin)){
													if($value1->score == 1){ 	
														echo '<div class="col-sm-3"><div class="row row-style">';
														echo '<div class="col-sm-4"><div class="form-group"><input name="score_'.$value1->checkID.'" id="score_'.$value1->checkID.'" value="'.$value1->numScore.'" readOnly  class="form-control total"></div></div>';
														$response1 = CrmCheckHomo::getItemxCheckHomo($value1->checkID,$_GET['r']);
														if(isset($response1)){
															echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value1->checkID.'" id="score_porc'.$value1->checkID.'" class="form-control">'.SelectPorc($value1->numScore,$response1->score).'</select></div></div>';
															echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value1->checkID.'" id="score_resp'.$value1->checkID.'" value="'.$response1->score.'" class="form-control result money"></div></div>';
														}else{
															echo '<div class="col-sm-4"><div class="form-group"><select name="score_porc'.$value1->checkID.'" id="score_porc'.$value1->checkID.'" class="form-control">'.SelectSinPorc().'</select></div></div>';
															echo '<div class="col-sm-4"><div class="form-group"><input name="score_resp'.$value1->checkID.'" id="score_resp'.$value1->checkID.'" value="0.00" class="form-control result money"></div></div>';
														}
														echo '<script>$(function(){ $("#score_porc'.$value1->checkID.'").change(function(){ var generico = $("#score_porc'.$value1->checkID.'").val(); var total = $("#score_'.$value1->checkID.'").val(); var resultado = (parseFloat(generico)*parseFloat(total))/100; $("#score_resp'.$value1->checkID.'").val(resultado.toFixed(3)); });  });</script>';
														echo '</div></div>';
													}
												}
												echo '</div>';
											} } ?>
										</div>
									</div>
									<script type="text/javascript">
										$(function(){
											var valor = 0.000;
											$( "#tab<?php echo $oCheck1->checkID; ?> .total" ).each(function( index ) {
												valor += parseFloat($(this).val());
												$('#pointAcu_<?php echo $oCheck1->checkID ?>').val(valor.toFixed(3));
											});
											var valor2 = 0.000;
											$( "#tab<?php echo $oCheck1->checkID; ?> .result" ).each(function( index ) {
												valor2 += parseFloat($(this).val());
												$('#pointResult_<?php echo $oCheck1->checkID ?>').val(valor2.toFixed(3));
											});
											var valor3 = 0.000;
											$('#tab<?php echo $oCheck1->checkID; ?> .result').change(function(){
												valor3 = 0.000;
												$( "#tab<?php echo $oCheck1->checkID; ?> .result" ).each(function( index ) {
													valor3 += parseFloat($(this).val());
													$('#pointResult_<?php echo $oCheck1->checkID ?>').val(valor3.toFixed(3));
												});
											});

											$('.no_aplica').click(function(){
												var name = $(this).attr('name');var res = name.replace("input_", ""); var res2 = res.replace("_1", "");
												$('input[name=score_'+res2+']').val('0.000');
												//actualizar lista de total
												var valor = 0.000;
												$( "#tab<?php echo $oCheck1->checkID; ?> .total" ).each(function( index ) {
													valor += parseFloat($(this).val());
													$('#pointAcu_<?php echo $oCheck1->checkID ?>').val(valor.toFixed(3));
												});
											});

											$('.aplica').click(function(){
												var name = $(this).attr('name');var res = name.replace("input_", ""); var res2 = res.replace("_1", "");
												$.post('<?php echo $URL_ROOT;?>ajax/search_point.php?id='+res2, '', function(data,textStatus) {
													if(data.retval==1){
														$('input[name=score_'+res2+']').val(data.point);
														var valor = 0.000;
														$( "#tab<?php echo $oCheck1->checkID; ?> .total" ).each(function( index ) {
															valor += parseFloat($(this).val());
															$('#pointAcu_<?php echo $oCheck1->checkID ?>').val(valor.toFixed(3));
														});
													}
												}, "json");

											});

										});
									</script>
									<?php if($read != ''){ 
										$generalHomo = CrmGeneralHomo::getItemxGeneralHomo($oCheck1->checkID,$_GET['r']);
										?>
										<div class="row">
											<div class="col-sm-9">
												<div class="row">
													<div class="col-sm-12">
														<label>Observaciones</label>
														<?php if(isset($generalHomo)){ ?>
															<textarea name="observation_<?php echo $oCheck1->checkID ?>" id="observation_<?php echo $oCheck1->checkID ?>" class="form-control" style="text-align: left;height:150px;" ><?php echo $generalHomo->observation; ?></textarea>
															<?php }else{ ?>
																<textarea name="observation_<?php echo $oCheck1->checkID ?>" id="observation_<?php echo $oCheck1->checkID ?>" class="form-control" style="text-align: left;height:150px;" ></textarea>
																<?php } ?>
															</div>	
														</div>
													</div>
													<div class="col-sm-3">
														<div class="row">
															<div class="col-sm-6" style="text-align: center;">
																<label>Puntaje Total</label>
																<input type="text" name="pointTotal_<?php echo $oCheck1->checkID ?>" id="pointAcu_<?php echo $oCheck1->checkID ?>" class="form-control money" readOnly >
															</div>	
															<div class="col-sm-6" style="text-align: center;">
																<label>Puntaje Resultado</label>
																<input type="text" name="pointResult_<?php echo $oCheck1->checkID ?>" id="pointResult_<?php echo $oCheck1->checkID ?>" class="form-control money" readOnly >
															</div>
														</div>
													</div>
												</div>
												<?php } ?>


											</div>
										</div>
										<?php } ?>

									</div>
								</div>	
							</form>
							<br>
							<div class="row">
								<div class="col-sm-9">&nbsp;</div>
								<?php if(isset($oProveedor)){ $oItem2 = CrmCheckHomo::getItemxHomologacion($_GET['r']); if($oItem2->homologacionID == 0){ ?>
									<div class="col-sm-1"><div class="form-group"><div class="btn btn-success" id="btn_guardar_proveedor">Guardar </div></div></div>
									<?php }else{ ?>
										<div class="col-sm-1"><div class="form-group"><div class="btn btn-success" id="btn_actualizar_proveedor">Actualizar</div></div></div>
										<?php } ?>
										<div class="col-sm-1"><div class="form-group"><div class="btn btn-success" id="btn_finalizar_proveedor">Finalizar</div></div></div>
										<?php }   ?>
										<?php if(isset($oAdmin)){ 
											if($oAdmin->profileID == 2){ $oItem3 = CrmGeneralHomo::getItemxHomologacion($_GET['r']); if($oItem3->homologacionID == 0){
												?>
												<div class="col-sm-1"><div class="form-group"><div class="btn btn-success" id="btn_guardar_auditor">Guardar</div></div></div>
												<?php }else{ ?>
													<div class="col-sm-1"><div class="form-group"><div class="btn btn-success" id="btn_actualizar_auditor">Actualizar</div></div></div>
													<?php } ?>
													<div class="col-sm-1"><div class="form-group"><div class="btn btn-success" id="btn_finalizar_auditor">Finalizar</div></div></div>
													<?php } 
												} 
												?>
												<div class="col-sm-1 pull-right"><div class="form-group"><div class="btn btn-danger btn-block" id="btnReturn">Regresar</div></div></div>
												<!-- <div class="col-sm-1 pull-right"><div class="form-group"><div class="btn btn-info btn-block" id="btnAdjunto" >Adjuntos</div></div></div> -->
											</div>
										</div>
									</section>
									<br>
									<br>
								</div>
							</main>
							<!-- Modal -->
							<div id="myModalProveedor" class="modal bs-Proveedor" tabindex="-1" role="dialog" data-focus-on="input:first">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Detalles de Proveedor Requeridos * </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form id="frm_proveedor" name="frm_proveedor" >
												<input type="hidden" name="proveedorID" id="proveedorID" value="<?php if(isset($oProveedor)){ echo $oProveedor->proveedorID; } ?>">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Partida Electrónica / Ficha Registral*</label>
															<input name="registration" autocomplete="off" type="text" id="registration" class="form-control">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Testimonio de Constitución / Modificación de Estatutos o Similar*</label>
															<input name="testConstitution" autocomplete="off" type="text" id="testConstitution" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Acuerdos con otras firmas*</label>
															<input name="firm" autocomplete="off" type="text" id="firm" class="form-control">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Acuerdos de Representación o Distribución*</label>
															<input name="representation" autocomplete="off" type="text" id="representation" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Número de Licencia de Funcionamiento*</label>
															<input name="licence" autocomplete="off" type="text" id="licence" class="form-control">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Número de Certificado de Inspección Técnica de Seguridad en Defensa Civil *</label>
															<input name="certInspeccion" autocomplete="off" type="text" id="certInspeccion" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<label>Número   de Registro como Empresa Contratista Minera (si aplica)</label>
															<input name="registerMine" autocomplete="off" type="text" id="registerMine" class="form-control">
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
											<div class="btn btn-primary" id="btn_save_proveedor">Guardar Cambios</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal -->
							<div id="myModalAuditor" class="modal bs-Auditor" tabindex="-1" role="dialog" data-focus-on="input:first">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Fotografias de la Homologacion</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form id="frm_fotografia" name="frm_fotografia" >
												<input type="hidden" name="homologacionPhotoID" value="<?php echo $_GET['r']; ?>" id="homologacionPhotoID">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 1</label>
															<div class="input-group">
																<input name="photo1" autocomplete="off" type="text" id="photo1" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 1</label>
															<input name="description1" autocomplete="off" type="text" id="description1" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 2</label>
															<div class="input-group">
																<input name="photo2" autocomplete="off" type="text" id="photo2" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 2</label>
															<input name="description2" autocomplete="off" type="text" id="description2" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 3</label>
															<div class="input-group">
																<input name="photo3" autocomplete="off" type="text" id="photo3" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 3</label>
															<input name="description3" autocomplete="off" type="text" id="description3" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 4</label>
															<div class="input-group">
																<input name="photo4" autocomplete="off" type="text" id="photo4" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 4</label>
															<input name="description4" autocomplete="off" type="text" id="description4" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 5</label>
															<div class="input-group">
																<input name="photo5" autocomplete="off" type="text" id="photo5" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 5</label>
															<input name="description5" autocomplete="off" type="text" id="description5" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 6</label>
															<div class="input-group">
																<input name="photo6" autocomplete="off" type="text" id="photo6" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 6</label>
															<input name="description6" autocomplete="off" type="text" id="description6" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 7</label>
															<div class="input-group">
																<input name="photo7" autocomplete="off" type="text" id="photo7" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 7</label>
															<input name="description7" autocomplete="off" type="text" id="description7" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>fotografia 8</label>
															<div class="input-group">
																<input name="photo8" autocomplete="off" type="text" id="photo8" class="form-control fmanager" rel="<?php echo $media_group["homologacion_foto"];?>">
															</div>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Descripcion 8</label>
															<input name="description8" autocomplete="off" type="text" id="description8" class="form-control">
														</div>
													</div>
												</div>
											</form>
										</div>
										<script type="text/javascript">
											$(document).ready(function(){
												CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
												CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
											});
										</script>
										<script type="text/javascript">
											$(document).ready(function(){
												$('.fmanager').each(function(idx, item){
													var rel=$(item).attr('rel');
													var id=$(item).attr('id');
													var btn=$('<span class="input-group-btn"><button class="btn btn-info btn-flat" type="button"><i class="fa fa-camera"></i></button></span>');
													var pnl=$('<div class="fpanel"><iframe width="100%" height="400" frameborder="0" src="<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=1&field_id='+id+'&relative_url=1&fldr='+rel+'"></iframe></div>');
													$(this).parent().append(btn);
													$(this).parent().parent().append(pnl);
													$(btn).click(function(){
														$(pnl).toggle();
													});
												});
												$(".fpanel").hide();
											});
										</script>
										<div class="modal-footer">
											<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
											<div class="btn btn-primary" id="btn_save_auditor">Guardar Cambios</div>
										</div>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$(document).ready(function() {
									$('[data-toggle="tooltip"]').tooltip();   
				//
				$( ".tab-content .finance .money.text" ).each(function( index ) {
					$(this).attr('readOnly','');
				});
				$('input').keyup(function(){
					$(this).attr('data-original-title',$(this).val());
				})


				$('.tab-content .finance .numeric').change(function(){
					var valor1 = 0;var valor2 = 0; var valor3 = 0;var valor4 = 0;
					var valor5 = 0;var valor6 = 0; var valor7 = 0;var valor8 = 0;
					var valor9 = 0;var valor10 = 0; var valor11 = 0;var valor12 = 0;
					var valor13 = 0;var valor14 = 0; var valor15 = 0;var valor16 = 0;
					//valor 1
					var calc1 = 0; var calc2 = 0; var calc3 = 0;
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 4){ calc1 = $(this).val(); }
						if(index == 10){ calc2 = $(this).val(); }
						valor1 = ( parseFloat('0.'+calc1) / calc2)  * 100 ; 
						console.log(parseFloat(parseFloat('0.'+calc1) / calc2) );
					});
					//valor 2
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 5){ calc1 = $(this).val(); }
						if(index == 11){ calc2 = $(this).val(); }
						valor2 = ( parseFloat('0.'+calc1) / calc2 ) * 100 ; 
					});
					//valor 3
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 4){ calc1 = $(this).val(); }
						if(index == 10){ calc2 = $(this).val(); }
						if(index == 34){ calc3 = $(this).val(); }

						valor3 = ( parseFloat('0.'+(calc1-calc3)) / calc2 ) * 100 ; 
					});
					//valor 4
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 5){ calc1 = $(this).val(); }
						if(index == 11){ calc2 = $(this).val(); }
						if(index == 35){ calc3 = $(this).val(); }
						valor4 = ( parseFloat('0.'+(calc1-calc3)) / calc2 ) * 100 ;
					});
					//valor 5
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 6){ calc1 = $(this).val(); }
						if(index == 12){ calc2 = $(this).val(); }
						valor5 = ( parseFloat('0.'+calc1) / calc2 ) * 100 ; 
					});
					//valor 6	
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 7){ calc1 = $(this).val(); }
						if(index == 13){ calc2 = $(this).val(); }
						valor6 = ( parseFloat('0.'+calc1 )/ calc2 ) * 100 ; 
					});

					//valor 7	
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 34){ calc1 = $(this).val(); }
						if(index == 22){ calc2 = $(this).val(); }
						valor7 = (( parseFloat('0.'+calc1 )/ calc2 )* 365) * 100 ; 
					});
					//valor 8
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 35){ calc1 = $(this).val(); }
						if(index == 23){ calc2 = $(this).val(); }
						valor8 = (( parseFloat('0.'+calc1 )/ calc2 )*365) * 100 ; 
					});
					//valor 9
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 28){ calc1 = $(this).val(); }
						if(index == 20){ calc2 = $(this).val(); }
						valor9 = (( parseFloat('0.'+calc1 )/ calc2 )*365) * 100 ; 
					});
					//valor 10
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 29){ calc1 = $(this).val(); }
						if(index == 21){ calc2 = $(this).val(); }
						valor10 = (( parseFloat('0.'+calc1 )/ calc2 )*365) * 100 ; 
					});
					//valor 11
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 30){ calc1 = $(this).val(); }
						if(index == 22){ calc2 = $(this).val(); }
						valor11 = (( parseFloat('0.'+calc1 )/ calc2 )*365) * 100 ; 
					});
					//valor 12
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 31){ calc1 = $(this).val(); }
						if(index == 23){ calc2 = $(this).val(); }
						valor12 = (( parseFloat('0.'+calc1 )/ calc2 )*365) * 100 ; 
					});
					//valor 13
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 14){ calc1 = $(this).val(); }
						if(index == 8){ calc2 = $(this).val(); }
						valor13 = (( parseFloat('0.'+calc1 )/ calc2 )) * 100 ; 
					});
					//valor 14
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 15){ calc1 = $(this).val(); }
						if(index == 9){ calc2 = $(this).val(); }
						valor14 = (( parseFloat('0.'+calc1 )/ calc2 )) * 100 ; 
					});
					//valor 15
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 26){ calc1 = $(this).val(); }
						if(index == 16){ calc2 = $(this).val(); }
						valor15 = (( parseFloat('0.'+calc1 )/ calc2 )) * 100 ; 
					});
					//valor 16
					$( ".tab-content .finance .numeric" ).each(function( index ) {
						if(index == 27){ calc1 = $(this).val(); }
						if(index == 17){ calc2 = $(this).val(); }
						valor16 = (( parseFloat('0.'+calc1 )/ calc2 )) * 100 ; 
					});
					$( ".tab-content .finance .money" ).each(function( index ) {
						if( index == 0 ) { $(this).val(parseFloat(valor1).toFixed(2)); }if( index == 1 ) { $(this).val(parseFloat(valor2).toFixed(2)); }if( index == 2 ) { $(this).val(parseFloat(valor3).toFixed(2)); }if( index == 3 ) { $(this).val(parseFloat(valor4).toFixed(2)); }if( index == 4 ) { $(this).val(parseFloat(valor5).toFixed(2)); }if( index == 5 ) { $(this).val(parseFloat(valor6).toFixed(2)); }if( index == 6 ) { $(this).val(parseFloat(valor7).toFixed(2)); }if( index == 7 ) { $(this).val(parseFloat(valor8).toFixed(2)); }if( index == 8 ) { $(this).val(parseFloat(valor9).toFixed(2)); }if( index == 9 ) { $(this).val(parseFloat(valor10).toFixed(2)); }if( index == 10 ) { $(this).val(parseFloat(valor11).toFixed(2)); }if( index == 11 ) { $(this).val(parseFloat(valor12).toFixed(2)); }if( index == 12 ) { $(this).val(parseFloat(valor13).toFixed(2)); }if( index == 13 ) { $(this).val(parseFloat(valor14).toFixed(2)); }if( index == 14 ) { $(this).val(parseFloat(valor15).toFixed(2)); }if( index == 15 ) { $(this).val(parseFloat(valor16).toFixed(2)); }
					});
				});


				//Demas Data
				$(".money").maskMoney({precision:3,thousands:'', decimal:'.', allowZero:true});
				$(".datepicker").datepicker();
				$('.numeric').keypress(function(event) {
					if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
						event.preventDefault();
					}
				});
				$('#btnReturn').click(function(){
					window.history.back();
				});

				$('#btnAdjunto').click(function(){
					location.href='<?php echo $URL_ROOT;?>relacion-homologacion/adjuntos.html?r=<?php echo $_GET['r']; ?>';
				})

				$(".btn-pref .btn").click(function () {
					$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
					$(this).removeClass("btn-default").addClass("btn-primary");   
				});

				$('#form_homologacion .radio-template').click(function() {
					$(this).attr('checked','');
				});


				$('#btn_guardar_proveedor').click(function(){
					var fields=$('#form_homologacion').serialize();
					$('.sombra').show();
					$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=insert', fields, function(data,textStatus) {
						if(data.retval==1){
							$('.sombra').hide();
							alertify.success(data.message);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							alertify.error(data.message);
						}
					}, "json");
				});

				$('#btn_actualizar_proveedor').click(function(){
					var fields=$('#form_homologacion').serialize();
					$('.sombra').show();
					$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=update',fields, function(data,textStatus) {
						if(data.retval==1){
							$('.sombra').hide();
							alertify.success(data.message);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							alertify.error(data.message);
						}
					}, "json");
				});

				$('#btn_finalizar_proveedor').click(function(){

					var fin = 0;
					var message = '<ul>';
					$('#form_homologacion .radio-template').each(function() {
						var valid = 0;
						$('#form_homologacion input[name='+ $(this).attr('name')+']').each(function(){
							if($(this).attr('checked') == 'checked'){ valid = 1; }
						});	
						if(valid == 0 ){
							var name = $(this).attr('name');
							name = name.slice(0,-2);
							var labelText = $('label[for='+  name  +']').text();
							message += '<li>"'+ labelText +'" falta completar.</li>';
							// alertify.error('Datos del formulario no completados, Por favor para finalizar , completar el formulario.');
							// $(this).focus();
							fin = 1;
							return false;
						}
					});
					message += '<ul>';
					if(fin == 0){
						bootbox.confirm({
							title: "Homologacion - Bureau Veritas",
							message: "Estas seguro de finalizar la auditoria?",
							buttons: {
								cancel: {
									label: '<i class="fa fa-times"></i> Cancelar'
								},
								confirm: {
									label: '<i class="fa fa-check"></i> Confirmar'
								}
							},
							callback: function (result) {
								if(result){
									$.getJSON('<?php echo $URL_ROOT;?>ajax/search_adjuntos_homologacion.php?homologacionID='+$('#homologacionID').val(), function(data) {
										if(data.retval==1){
											alertify.error('Por favor para finalizar , completar todos los archivos Adjuntos.');
											fin = 1;
										}else{
											$.getJSON('<?php echo $URL_ROOT;?>ajax/search_proveedor_data_secundaria.php?proveedorID='+$('#proveedorID').val(), function(data) {
												if(data.retval==1){
													$('.bs-Proveedor').modal('show');
												}else{
													$('.sombra').show();
													var fields =$('#form_homologacion').serialize();
													$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=finish',fields, function(data,textStatus) {
														if(data.retval==1){
															$('.sombra').hide();
															alertify.success(data.message);
															setTimeout(function(){
																location.href = '<?php echo $URL_ROOT;?>relacion-homologacion.html';
															}, 2000);
														}else{
															alertify.error(data.message);
														}
													}, "json");
												}
											});
										}
									});		
								}
							}
						});				
					}else{
						bootbox.alert({
							title: "Homologacion - Bureau Veritas",
							message: message
						});
					}
				});

				$('#btn_save_proveedor').click(function(){
					if($('#registration').val() == ''){ alertify.error('Se requiere registrar esta información');$('#registration').focus(); return false;}
					if($('#testConstitution').val() == ''){ alertify.error('Se requiere registrar esta información');$('#testConstitution').focus(); return false;}
					if($('#firm').val() == ''){ alertify.error('Se requiere registrar esta información');$('#firm').focus(); return false;}
					if($('#representation').val() == ''){ alertify.error('Se requiere registrar esta información');$('#representation').focus(); return false;}
					if($('#licence').val() == ''){ alertify.error('Se requiere registrar esta información');$('#licence').focus(); return false;}
					if($('#certInspeccion').val() == ''){ alertify.error('Se requiere registrar esta información');$('#certInspeccion').focus(); return false;}

					var fields2 = $('#frm_proveedor').serialize();
					var fields =$('#form_homologacion').serialize();
					$('.sombra').show();
					$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=proveedor',fields2, function(data,textStatus) {
						if(data.retval==1){
							$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=finish',fields, function(data,textStatus) {
								if(data.retval==1){
									$('.sombra').hide();
									alertify.success(data.message);
									setTimeout(function(){
										location.href='<?php echo $URL_ROOT;?>relacion-homologacion.html';
									}, 2000);
								}else{
									alertify.error(data.message);
								}
							}, "json");
						}else{
							alertify.error(data.message);
						}
					}, "json");


				});

				$('#btn_guardar_auditor').click(function(){
					$('.sombra').show();
					var fields=$('#form_homologacion').serialize();
					$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=insert_auditor',fields, function(data,textStatus) {
						if(data.retval==1){
							$('.sombra').hide();
							alertify.success(data.message);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							alertify.error(data.message);
						}
					},"json");
				});


				$('#btn_actualizar_auditor').click(function(){
					$('.sombra').show();
					var fields=$('#form_homologacion').serialize();
					$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=update_auditor', fields, function(data, textStatus) {
						if(data.retval==1){
							$('.sombra').hide();
							alertify.success(data.message);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							alertify.error(data.message);
						}
					}, "json");
				});

				$('#btn_finalizar_auditor').click(function(){
					var fin = 0;

					$('#form_homologacion .result').each(function() {
						if(!$(this).val()){
							alertify.success('Datos del formulario no completados, Por favor para finalizar , completar el formulario.');
							$(this).focus();
							fin = 1;
							return false;
						}
					});

					if(fin == 0){
						$('.bs-Auditor').modal('show');	
					}
				});

				$('#btn_save_auditor').click(function(){
					bootbox.confirm({
						title: "Homologacion - Bureau Veritas",
						message: "Estas seguro de finalizar la auditoria?",
						buttons: {
							cancel: {
								label: '<i class="fa fa-times"></i> Cancelar'
							},
							confirm: {
								label: '<i class="fa fa-check"></i> Confirmar'
							}
						},
						callback: function (result) {
							if(result){
								var fields = $('#form_homologacion').serialize();
								var fields2 = $('#frm_fotografia').serialize();
								$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=photo_auditor',fields2, function(data,textStatus) {
									if(data.retval==1){
										$.post('<?php echo $URL_ROOT;?>ajax/form_homologacion.php?cmd=finish_auditor',fields, function(data,textStatus) {
											if(data.retval==1){
												alertify.success(data.message);
												setTimeout(function(){
													location.href='<?php echo $URL_ROOT;?>relacion-homologacion.html';
												}, 2000);
											}else{
												alertify.error(data.message);
											}
										},"json");
									}else{
										alertify.error(data.message);
									}
								},"json");
							}
						}
					});		
				});



			});

		</script>



