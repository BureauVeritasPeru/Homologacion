<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

header('Content-type: text/html; charset=utf-8');
$read = ''; $dis = '';
if(isset($oAdmin)){ if($oAdmin->profileID == 2){ $read = 'readOnly'; } }


$oListCheck = CrmChecklist::getListByFormulario($_GET['r']);



function ConteoCasillas($val1,$val2,$val3,$val4,$val5){
	$count = 1;
	if($val1 != 0){ $count++;}if($val2 != 0){ $count++;}if($val3 != 0){ $count++;}if($val4 != 0){ $count++;}if($val5 != 0){ $count++;}
	return $count;
}

function SelectPorc($general,$sacado){
	$data = '';
	for ($i = 0; $i <= 20; $i++) {
		$valorNum = $i*5;
		$resultado = ($sacado/$general)*100;
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
		$data = '<div class="col-sm-'.$conteo.'"><div class="form-group"><label for="input_'.$id.'_'.$num.'_1"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_1" name="input_'.$id.'_'.$num.'" value="1" autocomplete="off">&nbsp;&nbsp;Si</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_2"><input '.$dis.' type="radio" class="radio-template aplica" id="input_'.$id.'_'.$num.'_2" name="input_'.$id.'_'.$num.'" value="2" autocomplete="off">&nbsp;&nbsp;No</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="input_'.$id.'_'.$num.'_3"><input '.$dis.' type="radio" class="radio-template no_aplica" id="input_'.$id.'_'.$num.'_3" name="input_'.$id.'_'.$num.'" value="3" autocomplete="off">&nbsp;&nbsp;N/A</label></div></div>';
		break;
	}
	return $data;
}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta property="og:title" content="<?php echo $PAGE->metaTag['title']; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo SEO::get_HTTPAssets();?>images/logo.png" />
	<meta property="og:description" content="<?php echo $PAGE->metaTag['description']; ?>" />
	<title><?php echo $PAGE->pageTitle;?></title>
	<link href='<?php echo SEO::get_HTTPAssets();?>website/images/favicon.ico' rel='shortcut icon' type='image/x-icon'>
	<script src="<?php echo SEO::get_HTTPAssets();?>website/../admin/admin-plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Custom Fonts en Web-->
	<link href="<?php echo SEO::get_HTTPAssets();?>website/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- JPages -->
	<link href="<?php echo SEO::get_HTTPAssets();?>website/css/jPages.css" rel="stylesheet"><!--paginado-->
	<link href="<?php echo SEO::get_HTTPAssets();?>website/css/bootstrap-datepicker.min.css" rel="stylesheet">  <!-- datepicker -->
	<!-- CSS  alertas --> 
	<link rel="stylesheet" href="<?php echo SEO::get_HTTPAssets();?>website/css/alertify.min.css"/>
	<link rel="stylesheet" href="<?php echo SEO::get_HTTPAssets();?>website/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo SEO::get_HTTPAssets();?>website/css/bootstrap-modal.css"> 
	<link rel="stylesheet" href="<?php echo SEO::get_HTTPAssets();?>website/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo SEO::get_HTTPAssets();?>website/css/dataTables.responsive.css">
	<link rel="stylesheet" href="<?php echo SEO::get_HTTPAssets();?>website/css/buttons.bootstrap4.min.css">
	<link href="<?php echo SEO::get_HTTPAssets();?>website/css/custom.css" rel="stylesheet"><!--paginado-->
	<link type="text/css" href="<?php echo SEO::get_HTTPAssets();?>website/css/main.css" rel="stylesheet">
</head>

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
			<h3>Formulario de Evaluación de Cliente</h3>
			<br>
			<ul class="nav nav-pills nav-justified " role="tablist">
				<?php $count=0; foreach ($oListCheck as $oCheck1) { $count++; ?>
					<li role="presentation" class="btn-default <?php if($count==1){ echo 'active'; }else{ echo ''; } ?>"><a href="#tab<?php echo $oCheck1->checkID; ?>" aria-controls="<?php echo $oCheck1->checkID; ?>" role="tab" data-toggle="tab"><?php echo $oCheck1->title; ?></a></li>
					<?php } ?>
				</ul>
				<form  id="form_homologacion">
					<div class="well"> 
						<div class="tab-content ">
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
													echo '<div class="col-sm-9">';
													echo '<div class="row">';
													echo '<div class="col-sm-'.$valInicial.'"><label>'.$value1->title.'</label></div>';
													if($value1->question1 != 0){  echo InputTextoSinResp($value1->question1,$valorCol,$value1->checkID,1,$read);  }	
													if($value1->question2 != 0){  echo InputTextoSinResp($value1->question2,$valorCol,$value1->checkID,2,$read);  }	
													if($value1->question3 != 0){  echo InputTextoSinResp($value1->question3,$valorCol,$value1->checkID,3,$read);  }	
													if($value1->question4 != 0){  echo InputTextoSinResp($value1->question4,$valorCol,$value1->checkID,4,$read);  }	
													if($value1->question5 != 0){  echo InputTextoSinResp($value1->question5,$valorCol,$value1->checkID,5,$read);  }	
													echo '</div></div>';
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
														echo '</div></div>';
													}
													echo '</div>';

												}else{
													echo '<div class="row">';
													if($value1->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';}
													echo '<div class="row">';
													echo '<div class="col-sm-12"><fieldset class="scheduler-border"><legend class="scheduler-border">'.$value1->title.'</legend>';
													$oListPreCheck2 = CrmChecklist::getListByCheck($value1->checkID);
													foreach ($oListPreCheck2 as $value2) { $conteo2 = 0;
														if($value2->typeCheck != 1){ 
															$conteo2 = ConteoCasillas($value2->question1,$value2->question2,$value2->question3,$value2->question4,$value2->question5); if($conteo2!=5){$valorCol2 = 12/$conteo2;}else{$valorCol2 = 2;} if($conteo2!=5){$valInicial2 = $valorCol2;}else{$valInicial2 = '4';}
															echo '<div class="row">';
															if($value2->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';}
															echo '<div class="row">';
															echo '<div class="col-sm-'.$valInicial2.'"><label>'.$value2->title.'</label></div>';
															
															if($value2->question1 != 0){  echo InputTextoSinResp($value2->question1,$valorCol2,$value2->checkID,1,$read);  }	
															if($value2->question2 != 0){  echo InputTextoSinResp($value2->question2,$valorCol2,$value2->checkID,2,$read);  }	
															if($value2->question3 != 0){  echo InputTextoSinResp($value2->question3,$valorCol2,$value2->checkID,3,$read);  }	
															if($value2->question4 != 0){  echo InputTextoSinResp($value2->question4,$valorCol2,$value2->checkID,4,$read);  }	
															if($value2->question5 != 0){  echo InputTextoSinResp($value2->question5,$valorCol2,$value2->checkID,5,$read);  }	
															echo '</div></div>';
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
																echo '</div></div>';
															}
															echo '</div>';
														}else{
															echo '<div class="row">';
															if($value2->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} 
															echo '<div class="row">';
															echo '<div class="col-sm-12"><fieldset class="scheduler-border"><legend class="scheduler-border">'.$value2->title.'</legend>';
															$oListPreCheck3 = CrmChecklist::getListByCheck($value2->checkID);
															foreach ($oListPreCheck3 as $value3) { $conteo3 = 0;
																if($value3->typeCheck != 1){ 
																	$conteo3 = ConteoCasillas($value3->question1,$value3->question2,$value3->question3,$value3->question4,$value3->question5); if($conteo3!=5){$valorCol3 = 12/$conteo3;}else{$valorCol3 = 2;} if($conteo3!=5){$valInicial3 = $valorCol3;}else{$valInicial3 = '4';}
																	echo '<div class="row">';
																	if($value3->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';} 
																	echo '<div class="row">';
																	echo '<div class="col-sm-'.$valInicial3.'"><label>'.$value3->title.'</label></div>';
																	if($value3->question1 != 0){   echo InputTextoSinResp($value3->question1,$valorCol3,$value3->checkID,1,$read);  }	
																	if($value3->question2 != 0){   echo InputTextoSinResp($value3->question2,$valorCol3,$value3->checkID,2,$read);  }	
																	if($value3->question3 != 0){   echo InputTextoSinResp($value3->question3,$valorCol3,$value3->checkID,3,$read);  }	
																	if($value3->question4 != 0){   echo InputTextoSinResp($value3->question4,$valorCol3,$value3->checkID,4,$read);  }	
																	if($value3->question5 != 0){   echo InputTextoSinResp($value3->question5,$valorCol3,$value3->checkID,5,$read);   }	
																	echo '</div></div>';
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
																		echo '</div></div>';
																	}
																	echo '</div>';
																}else{
																	echo '<div class="row">';
																	if($value3->score == 1){ echo '<div class="col-sm-9">'; }else{ echo '<div class="col-sm-12">';}
																	echo '<div class="row">';
																	echo '<div class="col-sm-12"><fieldset class="scheduler-border"><legend class="scheduler-border">'.$value3->title.'</legend>';
																	$oListPreCheck4 = CrmChecklist::getListByCheck($value3->checkID);
																	foreach ($oListPreCheck4 as $value4) { $conteo4 = 0;
																		if($value4->typeCheck != 1){ 
																			$conteo4 = ConteoCasillas($value4->question1,$value4->question2,$value4->question3,$value4->question4,$value4->question5); if($conteo4!=5){$valorCol4 = 12/$conteo4;}else{$valorCol4 = 2;} if($conteo4!=5){$valInicial4 = $valorCol4;}else{$valInicial4 = '4';}
																			echo '<div class="row">';
																			echo '<div class="col-sm-9">'; 
																			echo '<div class="row">';
																			echo '<div class="col-sm-'.$valInicial4.'"><label>'.$value4->title.'</label></div>';
																			if($value4->question1 != 0){  echo InputTextoSinResp($value4->question1,$valorCol4,$value4->checkID,1,$read); }	
																			if($value4->question2 != 0){  echo InputTextoSinResp($value4->question2,$valorCol4,$value4->checkID,2,$read); }	
																			if($value4->question3 != 0){  echo InputTextoSinResp($value4->question3,$valorCol4,$value4->checkID,3,$read); }	
																			if($value4->question4 != 0){  echo InputTextoSinResp($value4->question4,$valorCol4,$value4->checkID,4,$read); }	
																			if($value4->question5 != 0){  echo InputTextoSinResp($value4->question5,$valorCol4,$value4->checkID,5,$read); }	
																			echo '</div></div>';
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
																				echo '</div></div>';
																			}
																			echo '</div>';
																		}
																	}
																	echo '</fieldset></div></div></div>';
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
																		echo '</div></div>';
																	}
																	echo '</div>';
																}
															}
															echo '</fieldset></div></div></div>';
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
																echo '</div></div>';
															}
															echo '</div>';
														}  	
													}
													echo '</fieldset></div></div></div>';
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
														echo '</div></div>';
													}
													echo '</div>';
												} } ?>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>	
					</form>
					<br>
				</section>
				<br>
				<br>
			</div>
		</main>



		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/bootstrap.min.js"></script> 
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script> -->

		<!-- Contact Form JavaScript -->
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/jqBootstrapValidation.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/contact_me.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/jquery.maskMoney.js"></script>

		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/jquery.dataTables.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/dataTables.responsive.js"></script>


		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/buttons.bootstrap4.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/jszip.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/pdfmake.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/vfs_fonts.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/buttons.html5.min.js"></script>
		<!-- Jpages -->
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/jPages.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/bootbox.min.js"></script>
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/responsive-tabs.js"></script>


		<!-- JavaScript -->
		<script src="<?php echo SEO::get_HTTPAssets();?>website/js/alertify.min.js"></script> 