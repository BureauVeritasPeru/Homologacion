<script type="text/javascript">
	$(function(){
		$('.btn-upd').hide();

		$('.btn-upd2').hide();

		$('.btn-upd3').hide();

		$('.btn-upd4').hide();

		$('.btn-updAdj').hide();

		$('.btn-updAdj2').hide();

		$('.btn-upd').click(function(){
			var checkID     = $("#checkHidID").val();
			var formID 		= $("#formHidID").val();
			var title       = $("#title").val(); 
			var type_check  = $('input[name=type]:checked').val();
			var question1   = $("#question1").val();
			var question2   = $("#question2").val();
			var question3   = $("#question3").val();
			var question4   = $("#question4").val();
			var question5   = $("#question5").val();
			var score       = $('input[name=score]:checked').val();
			var numScore    = $("#numScore").val();
			var state       = $('input[name=state]:checked').val();
			var information = $("#information_1").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_checklist.php?checkID='+checkID+'&title='+title+'&type_check='+type_check+'&question1='+question1+'&question2='+question2+'&question3='+question3+'&question4='+question4+'&question5='+question5+'&score='+score+'&numScore='+numScore+'&state='+state+'&information='+information, function(data) {
				if(data.retval==1){
					$('#list-check').empty();
					alertify.success('CheckList actualizada Correctamente');
					$("#list-check").load('<?php echo $URL_ROOT;?>ajax/list_checklist.php?formID='+$('#formHidID').val()); 
					// $('.card-check').find("input,textarea").val('').end();
					$('.card-check').find("#question1").val('0').end();
					$('.card-check').find("#question2").val('0').end();
					$('.card-check').find("#question3").val('0').end();
					$('.card-check').find("#question4").val('0').end();
					$('.card-check').find("#question5").val('0').end();
					// $('.card-check').find(".state").val('1').end();
					// $('.card-check').find(".score").val('1').end();
					$('#formHidID').val(formID);
				}else{
					alertify.error('No se pudo actualizar el checklist , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd').hide();
		});

		$('.btn-upd2').click(function(){
			var checkID2     = $("#check2HidID").val();
			var checkID      = $("#checkHidID_2").val();
			var title2       = $("#title2").val(); 
			var type_check2  = $('input[name=type2]:checked').val();
			var question1_2   = $("#question1_2").val();
			var question2_2   = $("#question2_2").val();
			var question3_2   = $("#question3_2").val();
			var question4_2   = $("#question4_2").val();
			var question5_2   = $("#question5_2").val();
			var score2       = $('input[name=score2]:checked').val();
			var numScore2    = $("#numScore2").val();
			var state2       = $('input[name=state2]:checked').val();
			var information2 = $("#information_2").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_checklist.php?checkID='+checkID2+'&title='+title2+'&type_check='+type_check2+'&question1='+question1_2+'&question2='+question2_2+'&question3='+question3_2+'&question4='+question4_2+'&question5='+question5_2+'&score='+score2+'&numScore='+numScore2+'&state='+state2+'&information='+information2, function(data) {
				if(data.retval==1){
					$('#list-check2').empty();
					alertify.success('CheckList actualizada Correctamente');
					$("#list-check2").load('<?php echo $URL_ROOT;?>ajax/list_checklist2.php?checkID='+$('#checkHidID_2').val()); 
					// $('.card-check2').find("input,textarea").val('').end();
					$('.card-check2').find("#question1_2").val('0').end();
					$('.card-check2').find("#question2_2").val('0').end();
					$('.card-check2').find("#question3_2").val('0').end();
					$('.card-check2').find("#question4_2").val('0').end();
					$('.card-check2').find("#question5_2").val('0').end();
					// $('.card-check2').find(".state2").val('1').end();
					// $('.card-check2').find(".score2").val('1').end();
					$('#checkHidID_2').val(checkID);
				}else{
					alertify.error('No se pudo actualizar el checklist , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd2').hide();
		});

		$('.btn-upd3').click(function(){
			var checkID3     = $("#check3HidID").val();
			var checkID2     = $("#checkHidID_3").val();
			var title3       = $("#title3").val(); 
			var type_check3  = $('input[name=type3]:checked').val();
			var question1_3   = $("#question1_3").val();
			var question2_3   = $("#question2_3").val();
			var question3_3   = $("#question3_3").val();
			var question4_3   = $("#question4_3").val();
			var question5_3   = $("#question5_3").val();
			var score3       = $('input[name=score3]:checked').val();
			var numScore3    = $("#numScore3").val();
			var state3       = $('input[name=state3]:checked').val();
			var information3 = $("#information_3").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_checklist.php?checkID='+checkID3+'&title='+title3+'&type_check='+type_check3+'&question1='+question1_3+'&question2='+question2_3+'&question3='+question3_3+'&question4='+question4_3+'&question5='+question5_3+'&score='+score3+'&numScore='+numScore3+'&state='+state3+'&information='+information3, function(data) {
				if(data.retval==1){
					$('#list-check3').empty();
					alertify.success('CheckList actualizada Correctamente');
					$("#list-check3").load('<?php echo $URL_ROOT;?>ajax/list_checklist3.php?checkID='+$('#checkHidID_3').val()); 
					// $('.card-check3').find("input,textarea").val('').end();
					$('.card-check3').find("#question1_3").val('0').end();
					$('.card-check3').find("#question2_3").val('0').end();
					$('.card-check3').find("#question3_3").val('0').end();
					$('.card-check3').find("#question4_3").val('0').end();
					$('.card-check3').find("#question5_3").val('0').end();
					// $('.card-check3').find(".state3").val('1').end();
					// $('.card-check3').find(".score3").val('1').end();
					$('#checkHidID_3').val(checkID2);
				}else{
					alertify.error('No se pudo actualizar el checklist , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd3').hide();
		});

		$('.btn-upd4').click(function(){
			var checkID4     = $("#check4HidID").val();
			var checkID3     = $("#checkHidID_4").val();
			var title4       = $("#title4").val(); 
			var type_check4  = $('input[name=type4]:checked').val();
			var question1_4   = $("#question1_4").val();
			var question2_4   = $("#question2_4").val();
			var question3_4   = $("#question3_4").val();
			var question4_4   = $("#question4_4").val();
			var question5_4   = $("#question5_4").val();
			var score4       = $('input[name=score4]:checked').val();
			var numScore4    = $("#numScore4").val();
			var state4       = $('input[name=state4]:checked').val();
			var information4 = $("#information_4").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_checklist.php?checkID='+checkID4+'&title='+title4+'&type_check='+type_check4+'&question1='+question1_4+'&question2='+question2_4+'&question3='+question3_4+'&question4='+question4_4+'&question5='+question5_4+'&score='+score4+'&numScore='+numScore4+'&state='+state4+'&information='+information4, function(data) {
				if(data.retval==1){
					$('#list-check4').empty();
					alertify.success('CheckList actualizada Correctamente');
					$("#list-check4").load('<?php echo $URL_ROOT;?>ajax/list_checklist4.php?checkID='+$('#checkHidID_4').val()); 
					// $('.card-check4').find("input,textarea").val('').end();
					$('.card-check4').find("#question1_4").val('0').end();
					$('.card-check4').find("#question2_4").val('0').end();
					$('.card-check4').find("#question3_4").val('0').end();
					$('.card-check4').find("#question4_4").val('0').end();
					$('.card-check4').find("#question5_4").val('0').end();
					// $('.card-check4').find(".state4").val('1').end();
					// $('.card-check4').find(".score4").val('1').end();
					$('#checkHidID_4').val(checkID3);
				}else{
					alertify.error('No se pudo actualizar el checklist , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd4').hide();
		});

		$('.btn-updAdj').click(function(){
			var adjID       = $("#adjuntoHidID").val();
			var title       = $("#titleAdj").val();
			var formID 		= $("#formAdjHidID").val();
			var code 		= '';
			var state       = $('input[name=stateAdj]:checked').val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_adjunto.php?adjID='+adjID+'&title='+title+'&code='+code+'&state='+state, function(data) {
				if(data.retval==1){
					$('#list-adjunto').empty();
					alertify.success('Adjunto actualizada Correctamente');
					$("#list-adjunto").load('<?php echo $URL_ROOT;?>ajax/list_adjunto.php?formID='+$('#formAdjHidID').val()); 
					// $('.card-adjunto').find("input,textarea").val('').end();
					$('.card-adjunto').find(".stateAdj").val('1').end();
					$('#formAdjHidID').val(formID);
				}else{
					alertify.error('No se pudo actualizar el adjunto , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-updAdj').hide();
		});

		$('.btn-updAdj2').click(function(){
			var adjID2       = $("#adjunto2HidID").val();
			var adjID 		 = $("#adjHidID_2").val();
			var title2       = $("#titleAdj2").val(); 
			var code2    	 = $("#code2").val();
			var stateAdj2    = $('input[name=stateAdj2]:checked').val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_adjunto.php?adjID='+adjID2+'&title='+title2+'&code='+code2+'&state='+stateAdj2, function(data) {
				if(data.retval==1){
					$('#list-adjunto2').empty();
					alertify.success('Adjunto actualizada Correctamente');
					$("#list-adjunto2").load('<?php echo $URL_ROOT;?>ajax/list_adjunto2.php?adjID='+$('#adjHidID_2').val()); 
					// $('.card-adjunto2').find("input,textarea").val('').end();
					$('.card-adjunto2').find(".stateAdj2").val('1').end();
					$('#adjHidID_2').val(adjID);
				}else{
					alertify.error('No se pudo actualizar el checklist , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd2').hide();
		});

		$('#btnReturnCheck').click(function(){
			$('.card-check').hide();
			$('.card-formulario').show();
		});

		$('#btnReturnCheck2').click(function(){
			$('.card-check2').hide();
			$('.card-check').show();
		});

		$('#btnReturnCheck3').click(function(){
			$('.card-check3').hide();
			$('.card-check2').show();
		});

		$('#btnReturnCheck4').click(function(){
			$('.card-check4').hide();
			$('.card-check3').show();
		});

		$('#btnReturnAdj').click(function(){
			$('.card-adjunto').hide();
			$('.card-formulario').show();
		});

		$('#btnReturnAdj2').click(function(){
			$('.card-adjunto2').hide();
			$('.card-adjunto').show();
		});

	});

function ModalCheckList(id){
	$("#list-check").load('<?php echo $URL_ROOT;?>ajax/list_checklist.php?formID='+id); 
	$('.card-check').show();
	$('.card-formulario').hide();
	$('#formHidID').val(id);
}

function Previsualizacion(id){
	$('.bs-Previsualizacion').modal('show');
	$("iframe").attr("src", id);
}

function ModalCheckList2(id){
	$("#list-check2").load('<?php echo $URL_ROOT;?>ajax/list_checklist2.php?checkID='+id); 
	$('.card-check2').show();
	$('.card-check').hide();
	$('#checkHidID_2').val(id);
}

function ModalCheckList3(id){
	$("#list-check3").load('<?php echo $URL_ROOT;?>ajax/list_checklist3.php?checkID='+id); 
	$('.card-check3').show();
	$('.card-check2').hide();
	$('#checkHidID_3').val(id);
}

function ModalCheckList4(id){
	$("#list-check4").load('<?php echo $URL_ROOT;?>ajax/list_checklist4.php?checkID='+id); 
	$('.card-check4').show();
	$('.card-check3').hide();
	$('#checkHidID_4').val(id);
}

function ModalAdjunto(id){
	$("#list-adjunto").load('<?php echo $URL_ROOT;?>ajax/list_adjunto.php?formID='+id); 
	$('.card-adjunto').show();
	$('.card-formulario').hide();
	$('#formAdjHidID').val(id);
}

function ModalAdjunto2(id){
	$("#list-adjunto2").load('<?php echo $URL_ROOT;?>ajax/list_adjunto2.php?adjID='+id); 
	$('.card-adjunto2').show();
	$('.card-adjunto').hide();
	$('#adjHidID_2').val(id);
}

function DeleteChecklist(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$('#list-check').empty();
			$("#list-check").load('<?php echo $URL_ROOT;?>ajax/list_checklist.php?formID='+$('#formHidID').val()); 
		}else{
			alertify.error('No se pudo eliminar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function DeleteChecklist2(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$('#list-check2').empty();
			$("#list-check2").load('<?php echo $URL_ROOT;?>ajax/list_checklist2.php?checkID='+$('#checkHidID_2').val()); 
		}else{
			alertify.error('No se pudo eliminar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function DeleteChecklist3(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$('#list-check3').empty();
			$("#list-check3").load('<?php echo $URL_ROOT;?>ajax/list_checklist3.php?checkID='+$('#checkHidID_3').val()); 
		}else{
			alertify.error('No se pudo eliminar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function DeleteChecklist4(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$('#list-check4').empty();
			$("#list-check4").load('<?php echo $URL_ROOT;?>ajax/list_checklist4.php?checkID='+$('#checkHidID_4').val()); 
		}else{
			alertify.error('No se pudo eliminar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function DeleteAdjunto(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_adjunto.php?adjID='+id, function(data) {
		if(data.retval==1){
			$('#list-adjunto').empty();
			$("#list-adjunto").load('<?php echo $URL_ROOT;?>ajax/list_adjunto.php?formID='+$('#formAdjHidID').val()); 
		}else{
			alertify.error('No se pudo eliminar el adjunto , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function DeleteAdjunto2(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_adjunto.php?adjID='+id, function(data) {
		if(data.retval==1){
			$('#list-adjunto2').empty();
			$("#list-adjunto2").load('<?php echo $URL_ROOT;?>ajax/list_adjunto2.php?adjID='+$('#adjHidID_2').val()); 
		}else{
			alertify.error('No se pudo eliminar el adjunto , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function ViewChecklist(id){
	console.log('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id);
	$.getJSON('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$("#title").val(data.title); 
			if(data.type_check != 2){$("#type_check1").prop('checked', true);}else{$("#type_check2").prop('checked', true);}
			$("#question1").val(data.question1);
			$("#question2").val(data.question2);
			$("#question3").val(data.question3);
			$("#question4").val(data.question4);
			$("#question5").val(data.question5);
			if(data.score != 2){$("#score1").prop('checked', true);}else{$("#score2").prop('checked', true);}
			$("#numScore").val(data.numScore);
			if(data.state != 2){$("#state1").prop('checked', true);}else{$("#state2").prop('checked', true);}
			$("#information_1").val(data.information);
			$("#checkHidID").val(id);
			$('.btn-upd').show();
		}else{
			alertify.error('No se pudo visualizar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function ViewChecklist2(id){
	console.log('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id);
	$.getJSON('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$("#title2").val(data.title); 
			if(data.type_check != 2){$("#type_check1_2").prop('checked', true);}else{$("#type_check2_2").prop('checked', true);}
			$("#question1_2").val(data.question1);
			$("#question2_2").val(data.question2);
			$("#question3_2").val(data.question3);
			$("#question4_2").val(data.question4);
			$("#question5_2").val(data.question5);
			if(data.score != 2){$("#score1_2").prop('checked', true);}else{$("#score2_2").prop('checked', true);}
			$("#numScore2").val(data.numScore);
			if(data.state != 2){$("#state1_2").prop('checked', true);}else{$("#state2_2").prop('checked', true);}
			$("#check2HidID").val(id);
			$("#information_2").val(data.information);
			$('.btn-upd2').show();
		}else{
			alertify.error('No se pudo visualizar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function ViewChecklist3(id){
	console.log('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id);
	$.getJSON('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$("#title3").val(data.title); 
			if(data.type_check != 2){$("#type_check1_3").prop('checked', true);}else{$("#type_check2_3").prop('checked', true);}
			$("#question1_3").val(data.question1);
			$("#question2_3").val(data.question2);
			$("#question3_3").val(data.question3);
			$("#question4_3").val(data.question4);
			$("#question5_3").val(data.question5);
			if(data.score != 2){$("#score1_3").prop('checked', true);}else{$("#score2_3").prop('checked', true);}
			$("#numScore3").val(data.numScore);
			if(data.state != 2){$("#state1_3").prop('checked', true);}else{$("#state2_3").prop('checked', true);}
			$("#check3HidID").val(id);
			$("#information_3").val(data.information);
			$('.btn-upd3').show();
		}else{
			alertify.error('No se pudo visualizar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function ViewChecklist4(id){
	console.log('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id);
	$.getJSON('<?php echo $URL_ROOT;?>ajax/view_checklist.php?checkID='+id, function(data) {
		if(data.retval==1){
			$("#title4").val(data.title); 
			if(data.type_check != 2){$("#type_check1_4").prop('checked', true);}else{$("#type_check2_4").prop('checked', true);}
			$("#question1_4").val(data.question1);
			$("#question2_4").val(data.question2);
			$("#question3_4").val(data.question3);
			$("#question4_4").val(data.question4);
			$("#question5_4").val(data.question5);
			if(data.score != 2){$("#score1_4").prop('checked', true);}else{$("#score2_4").prop('checked', true);}
			$("#numScore4").val(data.numScore);
			if(data.state != 2){$("#state1_4").prop('checked', true);}else{$("#state2_4").prop('checked', true);}
			$("#check4HidID").val(id);
			$("#information_4").val(data.information);
			$('.btn-upd4').show();
		}else{
			alertify.error('No se pudo visualizar el checklist , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function ViewAdjunto(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/view_adjunto.php?adjID='+id, function(data) {
		if(data.retval==1){
			$("#titleAdj").val(data.title); 
			if(data.state != 2){$("#stateAdj1").prop('checked', true);}else{$("#stateAdj2").prop('checked', true);}
			$("#adjuntoHidID").val(id);
			$('.btn-updAdj').show();
		}else{
			alertify.error('No se pudo visualizar el adjunto , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}

function ViewAdjunto2(id){
	$.getJSON('<?php echo $URL_ROOT;?>ajax/view_adjunto.php?adjID='+id, function(data) {
		if(data.retval==1){
			$("#titleAdj2").val(data.title); 
			$("#code2").val(data.code);
			if(data.state != 2){$("#stateAdj1_2").prop('checked', true);}else{$("#stateAdj2_2").prop('checked', true);}
			$("#adjunto2HidID").val(id);
			$('.btn-updAdj2').show();
		}else{
			alertify.error('No se pudo visualizar el adjunto , Contactarse con Soporte - BV');
		}
	}).error(function(jqXHR, textStatus, errorThrown) {
		alertify.error("Error interno");
		console.log("error: " + textStatus);
		console.log("error thrown: " + errorThrown);
		console.log("incoming Text: " + jqXHR.responseText);
	});
}


</script> 

<section class="tables">   
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-formulario">
					<div class="box box-default">
						<div class="card-body">
							<div class="box-body">
								<table class="table table-bordered table-hover" width='100%' id="dataTables-example">
									<thead>
										<tr>
											<th width="35">&nbsp;</th>
											<th width="120"><?php echo $MODULE->getSortingHeader("title", "Titulo");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("registerDate", "Fecha Registro");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
											<th width="35">CheckList</th>
											<th width="35">Adjuntos</th>
										</tr>
									</thead>
									<tbody><?php $list=CrmFormulario::getList_Paging(); foreach ($list as $oItem) { ?>
										<tr> 
											<td><a href="<?php echo "javascript:Edit(".$oItem->formID.");"; ?>"><i class="fa fa-edit"></i></a>
												<a href="<?php echo "javascript:Delete(".$oItem->formID.");"; ?>"><i class="fa fa-remove"></i></a>
												<a onClick="Previsualizacion('<?php echo $URL_ROOT.'/ajax/form_prueba.php?r='.$oItem->formID ?>')" href="#" id="Previsualizacion"><i class="fa fa-list-alt"></i></a>
											</td>
											<td><?php echo $oItem->title; ?></td>
											<td><?php echo $oItem->registerDate; ?></td>
											<td align="center"><?php echo CrmFormulario::getState($oItem->state);?></td>
											<td align="center"><a href="<?php echo "javascript:ModalCheckList(".$oItem->formID.");"; ?>"><i class="fa fa-plus"></i></a></td>
											<td align="center"><a href="<?php echo "javascript:ModalAdjunto(".$oItem->formID.");"; ?>"><i class="fa fa-file"></i></a></td>
											</tr><?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">
									<button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
									<button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">exportar</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-check" style="display:none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="formHidID" id="formHidID">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbCheckList">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Fecha Registro</a></th>    
														<th style="text-align:center;"><a>Estado</a></th>
														<th style="text-align:center;">Detalles</th>           
													</tr>
												</thead>
												<tbody id="list-check"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<div class="line"></div>
									<input type="hidden" name="checkHidID" id="checkHidID">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-sm-2 control-label ">Tipo</label>
												<div class="col-sm-10">
													<label for="type_check1">
														<input type="radio" class="radio-template type_check" id="type_check1" name="type" value="1">
														Contenedor
													</label>&nbsp;&nbsp;
													<label for="type_check2">
														<input type="radio" class="radio-template type_check" id="type_check2" name="type" value="2">
														Pregunta
													</label>
												</div>
											</div>
										</div>
										<script type="text/javascript">
											$(function(){
												$('.type_check').change(function(){
													if($('input[name=type]:checked').val() != 2){
														$('#type_check1').val('1');
														$('#type_check2').val('2');
														console.log($('input[name=type]:checked').val());
														$('#question1').css('pointer-events','none');$('#question1').attr('readOnly','');$('#question1').val('0');
														$('#question2').css('pointer-events','none');$('#question2').attr('readOnly','');$('#question2').val('0');
														$('#question3').css('pointer-events','none');$('#question3').attr('readOnly','');$('#question3').val('0');
														$('#question4').css('pointer-events','none');$('#question4').attr('readOnly','');$('#question4').val('0');
														$('#question5').css('pointer-events','none');$('#question5').attr('readOnly','');$('#question5').val('0');
													}else{
														$('#type_check1').val('1');
														$('#type_check2').val('2');
														console.log($('input[name=type]:checked').val());
														$('#question1').css('pointer-events','all');$('#question1').removeAttr('readOnly');
														$('#question2').css('pointer-events','all');$('#question2').removeAttr('readOnly');
														$('#question3').css('pointer-events','all');$('#question3').removeAttr('readOnly');
														$('#question4').css('pointer-events','all');$('#question4').removeAttr('readOnly');
														$('#question5').css('pointer-events','all');$('#question5').removeAttr('readOnly');	
													}
												});
											});
										</script>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Titulo o Pregunta</label>
												<input name="title" type="text" class="form-control" id="title" placeholder="Ingrese Titulo">
											</div>
										</div>
										<div class="col-sm-4" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Estado</label>
												<div class="col-sm-10">
													<label for="state1">
														<input type="radio" class="radio-template state" id="state1" name="state" value="1">
														Activo
													</label>&nbsp;&nbsp;
													<label for="state2">
														<input type="radio" class="radio-template state" id="state2" name="state" value="2">
														Inactivo
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 1</label>
												<select name="question1" id="question1" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 2</label>
												<select name="question2" id="question2" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 3</label>
												<select name="question3" id="question3" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4" >
											<div class="form-group">
												<label>Alternativa 4</label>
												<select name="question4" id="question4" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 5</label>
												<select name="question5" id="question5" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-2" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Hay puntaje?</label>
												<div class="col-sm-10" >
													<label for="score1">
														<input type="radio" class="radio-template score" id="score1" name="score" value="1">
														Si
													</label>&nbsp;&nbsp;
													<label for="score2">
														<input type="radio" class="radio-template score" id="score2" name="score" value="2">
														No
													</label>
												</div>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label>Puntaje</label>
												<input type="text" name="numScore" id="numScore" class="form-control" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12" >
											<div class="form-group">
												<label>Información</label>
												<textarea name="information_1" id="information_1" class="form-control"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">			
									<div class="btn btn-primary " name="btnAddCheck" id="btnAddCheck"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-upd" name="btnUpdateCheck" id="btnUpdateCheck"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back" name="btnReturnCheck" id="btnReturnCheck"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-check2" style="display:none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="checkHidID_2" id="checkHidID_2">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbCheckList">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Fecha Registro</a></th>    
														<th style="text-align:center;"><a>Estado</a></th>    
														<th style="text-align:center;">&nbsp;</th>                      
													</tr>
												</thead>
												<tbody id="list-check2"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<div class="line"></div>
									<input type="hidden" name="check2HidID" id="check2HidID">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-sm-2 control-label ">Tipo</label>
												<div class="col-sm-10">
													<label for="type_check1_2">
														<input type="radio" class="radio-template type_check2" id="type_check1_2" name="type2" value="1">
														Contenedor
													</label>&nbsp;&nbsp;
													<label for="type_check2_2">
														<input type="radio" class="radio-template type_check2" id="type_check2_2" name="type2" value="2">
														Pregunta
													</label>
												</div>
											</div>
										</div>
										<script type="text/javascript">
											$(function(){
												$('.type_check2').change(function(){
													if($('input[name=type2]:checked').val() != 2){
														$('#type_check1_2').val('1');
														$('#type_check2_2').val('2');
														console.log($('input[name=type2]:checked').val());
														$('#question1_2').css('pointer-events','none');$('#question1_2').attr('readOnly','');$('#question1_2').val('0');
														$('#question2_2').css('pointer-events','none');$('#question2_2').attr('readOnly','');$('#question2_2').val('0');
														$('#question3_2').css('pointer-events','none');$('#question3_2').attr('readOnly','');$('#question3_2').val('0');
														$('#question4_2').css('pointer-events','none');$('#question4_2').attr('readOnly','');$('#question4_2').val('0');
														$('#question5_2').css('pointer-events','none');$('#question5_2').attr('readOnly','');$('#question5_2').val('0');
													}else{
														$('#type_check1_2').val('1');
														$('#type_check2_2').val('2');
														console.log($('input[name=type2]:checked').val());
														$('#question1_2').css('pointer-events','all');$('#question1_2').removeAttr('readOnly');
														$('#question2_2').css('pointer-events','all');$('#question2_2').removeAttr('readOnly');
														$('#question3_2').css('pointer-events','all');$('#question3_2').removeAttr('readOnly');
														$('#question4_2').css('pointer-events','all');$('#question4_2').removeAttr('readOnly');
														$('#question5_2').css('pointer-events','all');$('#question5_2').removeAttr('readOnly');	
													}
												});
											});

										</script>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Titulo o Pregunta</label>
												<input name="title2" type="text" class="form-control" id="title2" placeholder="Ingrese Titulo">
											</div>
										</div>
										<div class="col-sm-4" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Estado</label>
												<div class="col-sm-10">
													<label for="state1_2">
														<input type="radio" class="radio-template state2" id="state1_2" name="state2" value="1">
														Activo
													</label>&nbsp;&nbsp;
													<label for="state2_2">
														<input type="radio" class="radio-template state2" id="state2_2" name="state2" value="2">
														Inactivo
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 1</label>
												<select name="question1_2" id="question1_2" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 2</label>
												<select name="question2_2" id="question2_2" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 3</label>
												<select name="question3_2" id="question3_2" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4" >
											<div class="form-group">
												<label>Alternativa 4</label>
												<select name="question4_2" id="question4_2" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 5</label>
												<select name="question5_2" id="question5_2" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-2" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Hay puntaje?</label>
												<div class="col-sm-10" >
													<label for="score1_2">
														<input type="radio" class="radio-template score2" id="score1_2" name="score2" value="1">
														Si
													</label>&nbsp;&nbsp;
													<label for="score2_2">
														<input type="radio" class="radio-template score2" id="score2_2" name="score2" value="2">
														No
													</label>
												</div>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label>Puntaje</label>
												<input type="text" name="numScore2" id="numScore2" class="form-control" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12" >
											<div class="form-group">
												<label>Información</label>
												<textarea name="information_2" id="information_2" class="form-control"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">			
									<div class="btn btn-primary " name="btnAddCheck2" id="btnAddCheck2"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-upd2" name="btnUpdateCheck2" id="btnUpdateCheck2"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back2" name="btnReturnCheck2" id="btnReturnCheck2"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-check3" style="display:none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="checkHidID_3" id="checkHidID_3">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbCheckList">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Fecha Registro</a></th>    
														<th style="text-align:center;"><a>Estado</a></th>  
														<th style="text-align:center;">&nbsp;</th>                           
													</tr>
												</thead>
												<tbody id="list-check3"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<div class="line"></div>
									<input type="hidden" name="check3HidID" id="check3HidID">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-sm-2 control-label ">Tipo</label>
												<div class="col-sm-10">
													<label for="type_check1_3">
														<input type="radio" class="radio-template type_check3" id="type_check1_3" name="type3" value="1">
														Contenedor
													</label>&nbsp;&nbsp;
													<label for="type_check2_3">
														<input type="radio" class="radio-template type_check3" id="type_check2_3" name="type3" value="2">
														Pregunta
													</label>
												</div>
											</div>
										</div>
										<script type="text/javascript">
											$(function(){
												$('.type_check3').change(function(){
													if($('input[name=type3]:checked').val() != 2){
														$('#type_check1_3').val('1');
														$('#type_check2_3').val('2');
														console.log($('input[name=type3]:checked').val());
														$('#question1_3').css('pointer-events','none');$('#question1_3').attr('readOnly','');$('#question1_3').val('0');
														$('#question2_3').css('pointer-events','none');$('#question2_3').attr('readOnly','');$('#question2_3').val('0');
														$('#question3_3').css('pointer-events','none');$('#question3_3').attr('readOnly','');$('#question3_3').val('0');
														$('#question4_3').css('pointer-events','none');$('#question4_3').attr('readOnly','');$('#question4_3').val('0');
														$('#question5_3').css('pointer-events','none');$('#question5_3').attr('readOnly','');$('#question5_3').val('0');
													}else{
														$('#type_check1_3').val('1');
														$('#type_check2_3').val('2');
														console.log($('input[name=type3]:checked').val());
														$('#question1_3').css('pointer-events','all');$('#question1_3').removeAttr('readOnly');
														$('#question2_3').css('pointer-events','all');$('#question2_3').removeAttr('readOnly');
														$('#question3_3').css('pointer-events','all');$('#question3_3').removeAttr('readOnly');
														$('#question4_3').css('pointer-events','all');$('#question4_3').removeAttr('readOnly');
														$('#question5_3').css('pointer-events','all');$('#question5_3').removeAttr('readOnly');	
													}
												});
											});

										</script>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Titulo o Pregunta</label>
												<input name="title3" type="text" class="form-control" id="title3" placeholder="Ingrese Titulo">
											</div>
										</div>
										<div class="col-sm-4" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Estado</label>
												<div class="col-sm-10">
													<label for="state1_3">
														<input type="radio" class="radio-template state3" id="state1_3" name="state3" value="1">
														Activo
													</label>&nbsp;&nbsp;
													<label for="state2_3">
														<input type="radio" class="radio-template state3" id="state2_3" name="state3" value="2">
														Inactivo
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 1</label>
												<select name="question1_3" id="question1_3" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 2</label>
												<select name="question2_3" id="question2_3" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 3</label>
												<select name="question3_3" id="question3_3" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4" >
											<div class="form-group">
												<label>Alternativa 4</label>
												<select name="question4_3" id="question4_3" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 5</label>
												<select name="question5_3" id="question5_3" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-2" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Hay puntaje?</label>
												<div class="col-sm-10" >
													<label for="score1_3">
														<input type="radio" class="radio-template score3" id="score1_3" name="score3" value="1">
														Si
													</label>&nbsp;&nbsp;
													<label for="score2_3">
														<input type="radio" class="radio-template score3" id="score2_3" name="score3" value="2">
														No
													</label>
												</div>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label>Puntaje</label>
												<input type="text" name="numScore3" id="numScore3" class="form-control" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12" >
											<div class="form-group">
												<label>Información</label>
												<textarea name="information_3" id="information_3" class="form-control"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">			
									<div class="btn btn-primary " name="btnAddCheck3" id="btnAddCheck3"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-upd3" name="btnUpdateCheck3" id="btnUpdateCheck3"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back3" name="btnReturnCheck3" id="btnReturnCheck3"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-check4" style="display:none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="checkHidID_4" id="checkHidID_4">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbCheckList">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Fecha Registro</a></th>    
														<th style="text-align:center;"><a>Estado</a></th>   
													</tr>
												</thead>
												<tbody id="list-check4"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<div class="line"></div>
									<input type="hidden" name="check4HidID" id="check4HidID">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="col-sm-2 control-label ">Tipo</label>
												<div class="col-sm-10">
													<label for="type_check1_4">
														<input type="radio" class="radio-template type_check4" id="type_check1_4" name="type4" value="1">
														Contenedor
													</label>&nbsp;&nbsp;
													<label for="type_check2_4">
														<input type="radio" class="radio-template type_check4" id="type_check2_4" name="type4" value="2">
														Pregunta
													</label>
												</div>
											</div>
										</div>
										<script type="text/javascript">
											$(function(){
												$('.type_check4').change(function(){
													if($('input[name=type4]:checked').val() != 2){
														$('#type_check1_4').val('1');
														$('#type_check2_4').val('2');
														console.log($('input[name=type4]:checked').val());
														$('#question1_4').css('pointer-events','none');$('#question1_4').attr('readOnly','');$('#question1_4').val('0');
														$('#question2_4').css('pointer-events','none');$('#question2_4').attr('readOnly','');$('#question2_4').val('0');
														$('#question3_4').css('pointer-events','none');$('#question3_4').attr('readOnly','');$('#question3_4').val('0');
														$('#question4_4').css('pointer-events','none');$('#question4_4').attr('readOnly','');$('#question4_4').val('0');
														$('#question5_4').css('pointer-events','none');$('#question5_4').attr('readOnly','');$('#question5_4').val('0');
													}else{
														$('#type_check1_3').val('1');
														$('#type_check2_3').val('2');
														console.log($('input[name=type3]:checked').val());
														$('#question1_4').css('pointer-events','all');$('#question1_4').removeAttr('readOnly');
														$('#question2_4').css('pointer-events','all');$('#question2_4').removeAttr('readOnly');
														$('#question3_4').css('pointer-events','all');$('#question3_4').removeAttr('readOnly');
														$('#question4_4').css('pointer-events','all');$('#question4_4').removeAttr('readOnly');
														$('#question5_4').css('pointer-events','all');$('#question5_4').removeAttr('readOnly');	
													}
												});
											});

										</script>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Titulo o Pregunta</label>
												<input name="title4" type="text" class="form-control" id="title4" placeholder="Ingrese Titulo">
											</div>
										</div>
										<div class="col-sm-4" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Estado</label>
												<div class="col-sm-10">
													<label for="state1_4">
														<input type="radio" class="radio-template state4" id="state1_4" name="state4" value="1">
														Activo
													</label>&nbsp;&nbsp;
													<label for="state2_4">
														<input type="radio" class="radio-template state4" id="state2_4" name="state4" value="2">
														Inactivo
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 1</label>
												<select name="question1_4" id="question1_4" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 2</label>
												<select name="question2_4" id="question2_4" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 3</label>
												<select name="question3_4" id="question3_4" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4" >
											<div class="form-group">
												<label>Alternativa 4</label>
												<select name="question4_4" id="question4_4" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Alternativa 5</label>
												<select name="question5_4" id="question5_4" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(2, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-2" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Hay puntaje?</label>
												<div class="col-sm-10" >
													<label for="score1_4">
														<input type="radio" class="radio-template score4" id="score1_4" name="score4" value="1">
														Si
													</label>&nbsp;&nbsp;
													<label for="score2_4">
														<input type="radio" class="radio-template score4" id="score2_4" name="score4" value="2">
														No
													</label>
												</div>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label>Puntaje</label>
												<input type="text" name="numScore4" id="numScore4" class="form-control" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12" >
											<div class="form-group">
												<label>Información</label>
												<textarea name="information_4" id="information_4" class="form-control"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">			
									<div class="btn btn-primary " name="btnAddCheck4" id="btnAddCheck4"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-upd4" name="btnUpdateCheck4" id="btnUpdateCheck4"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back4" name="btnReturnCheck4" id="btnReturnCheck4"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-adjunto" style="display:none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="formAdjHidID" id="formAdjHidID">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbAdjuntoList">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Fecha Registro</a></th>    
														<th style="text-align:center;"><a>Estado</a></th>
														<th style="text-align:center;">Detalles</th>           
													</tr>
												</thead>
												<tbody id="list-adjunto"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<div class="line"></div>
									<input type="hidden" name="adjuntoHidID" id="adjuntoHidID">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Titulo</label>
												<input name="titleAdj" type="text" class="form-control" id="titleAdj" placeholder="Ingrese Titulo">
											</div>
										</div>
										<div class="col-sm-6" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Estado</label>
												<div class="col-sm-10">
													<label for="stateAdj1">
														<input type="radio" class="radio-template stateAdj" id="stateAdj1" name="stateAdj" value="1">
														Activo
													</label>&nbsp;&nbsp;
													<label for="stateAdj2">
														<input type="radio" class="radio-template stateAdj" id="stateAdj2" name="stateAdj" value="2">
														Inactivo
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">			
									<div class="btn btn-primary " name="btnAddAdj" id="btnAddAdj"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-updAdj" name="btnUpdateAdj" id="btnUpdateAdj"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back" name="btnReturnAdj" id="btnReturnAdj"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-adjunto2" style="display:none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="adjHidID_2" id="adjHidID_2">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbAdjuntoList">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Codigo</a></th>
														<th style="text-align:center;"><a>Fecha Registro</a></th>    
														<th style="text-align:center;"><a>Estado</a></th>         
													</tr>
												</thead>
												<tbody id="list-adjunto2"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<div class="line"></div>
									<input type="hidden" name="adjunto2HidID" id="adjunto2HidID">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Titulo</label>
												<input name="titleAdj2" type="text" class="form-control" id="titleAdj2" placeholder="Ingrese Titulo">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Codigo</label>
												<input name="code2" type="text" class="form-control" id="code2" placeholder="Ingrese Codigo">
											</div>
										</div>
										<div class="col-sm-4" >
											<div class="form-group">
												<label class="col-sm-2 control-label ">Estado</label>
												<div class="col-sm-10">
													<label for="stateAdj1_2">
														<input type="radio" class="radio-template stateAdj2" id="stateAdj1_2" name="stateAdj2" value="1">
														Activo
													</label>&nbsp;&nbsp;
													<label for="stateAdj2_2">
														<input type="radio" class="radio-template stateAdj2" id="stateAdj2_2" name="stateAdj2" value="2">
														Inactivo
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">			
									<div class="btn btn-primary " name="btnAddAdj2" id="btnAddAdj2"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-updAdj2" name="btnUpdateAdj2" id="btnUpdateAdj2"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back" name="btnReturnAdj2" id="btnReturnAdj2"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div id="myModalPreVisualizacion" class="modal bs-Previsualizacion" tabindex="-1" role="dialog" data-focus-on="input:first">
			<div class="modal-dialog modal-lg" role="document" style="width: 1400px !important;max-width: 1400px !important;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Previsualizacion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<iframe style="width: 100%;height: 750px;">
							<p>Your browser does not support iframes.</p>
						</iframe>
					</div>
				</div>
			</div>
		</div>





		<script type="text/javascript">

			$(document).ready(function() {
				$( "#btnAddCheck" ).click(function() {
					if ($('#title').val() == ''){ $('#title').focus(); alertify.error('Ingrese un titulo o Pregunta'); return false; }  
					if ($('#type_check').val() == ''){ $('#type_check').focus(); alertify.error('Ingrese un Tipo'); return false; }
					if ($('#state').val() == '0'){ $('#state').focus(); alertify.error('Ingrese un estado'); return false; }

					var formID      = $("#formHidID").val();
					var title       = $("#title").val(); 
					var precheckID  = 0;
					var type_check  = $('input[name=type]:checked').val();
					var question1   = $("#question1").val();
					var question2   = $("#question2").val();
					var question3   = $("#question3").val();
					var question4   = $("#question4").val();
					var question5   = $("#question5").val();
					var score       = $('input[name=score]:checked').val();
					var numScore    = $("#numScore").val();
					var state       = $(".state").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_checklist.php?formID='+formID+'&title='+title+'&precheckID='+precheckID+'&type_check='+type_check+'&question1='+question1+'&question2='+question2+'&question3='+question3+'&question4='+question4+'&question5='+question5+'&score='+score+'&numScore='+numScore+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-check').empty();
							$("#list-check").load('<?php echo $URL_ROOT;?>ajax/list_checklist.php?formID='+$('#formHidID').val()); 
						// $('.card-check').find("input,textarea").val('').end();
						$("#formHidID").val(formID);
					}else{
						alertify.error('No se pudo insertar el formulario , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});
			});

				$( "#btnAddCheck2" ).click(function() {
					if ($('#title2').val() == ''){ $('#title2').focus(); alertify.error('Ingrese un titulo o Pregunta'); return false; }  
					if($('input[name=type2]:checked').length<=0){
						alertify.error('Ingrese un Tipo'); return false;
					}
					if($('input[name=state2]:checked').length<=0){
						alertify.error('Ingrese un estado'); return false;
					}
					var formID      = $("#formHidID").val();
					var title       = $("#title2").val(); 
					var precheckID  = $("#checkHidID_2").val();
					var type_check  = $('input[name=type2]:checked').val();
					var question1   = $("#question1_2").val();
					var question2   = $("#question2_2").val();
					var question3   = $("#question3_2").val();
					var question4   = $("#question4_2").val();
					var question5   = $("#question5_2").val();
					var score       = $('input[name=score2]:checked').val();
					var numScore    = $("#numScore2").val();
					var state       = $(".state2").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_checklist.php?formID='+formID+'&title='+title+'&precheckID='+precheckID+'&type_check='+type_check+'&question1='+question1+'&question2='+question2+'&question3='+question3+'&question4='+question4+'&question5='+question5+'&score='+score+'&numScore='+numScore+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-check2').empty();
							$("#list-check2").load('<?php echo $URL_ROOT;?>ajax/list_checklist2.php?checkID='+$('#checkHidID_2').val()); 
						// $('.card-check2').find("input,textarea").val('').end();
					}else{
						alertify.error('No se pudo insertar el formulario , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});
			});

				$( "#btnAddCheck3" ).click(function() {
					if ($('#title3').val() == ''){ $('#title3').focus(); alertify.error('Ingrese un titulo o Pregunta'); return false; }  
					if($('input[name=type3]:checked').length<=0){
						alertify.error('Ingrese un Tipo'); return false;
					}
					if($('input[name=state3]:checked').length<=0){
						alertify.error('Ingrese un estado'); return false;
					}
					var formID      = $("#formHidID").val();
					var title       = $("#title3").val(); 
					var precheckID  = $("#checkHidID_3").val();
					var type_check  = $('input[name=type3]:checked').val();
					var question1   = $("#question1_3").val();
					var question2   = $("#question2_3").val();
					var question3   = $("#question3_3").val();
					var question4   = $("#question4_3").val();
					var question5   = $("#question5_3").val();
					var score       = $('input[name=score3]:checked').val();
					var numScore    = $("#numScore3").val();
					var state       = $(".state3").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_checklist.php?formID='+formID+'&title='+title+'&precheckID='+precheckID+'&type_check='+type_check+'&question1='+question1+'&question2='+question2+'&question3='+question3+'&question4='+question4+'&question5='+question5+'&score='+score+'&numScore='+numScore+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-check3').empty();
							$("#list-check3").load('<?php echo $URL_ROOT;?>ajax/list_checklist3.php?checkID='+$('#checkHidID_3').val()); 
						// $('.card-check3').find("input,textarea").val('').end();
					}else{
						alertify.error('No se pudo insertar el formulario , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});
			});

				$( "#btnAddCheck4" ).click(function() {
					if ($('#title4').val() == ''){ $('#title4').focus(); alertify.error('Ingrese un titulo o Pregunta'); return false; }  
					if($('input[name=type4]:checked').length<=0){
						alertify.error('Ingrese un Tipo'); return false;
					}
					if($('input[name=state4]:checked').length<=0){
						alertify.error('Ingrese un estado'); return false;
					}
					var formID      = $("#formHidID").val();
					var title       = $("#title4").val(); 
					var precheckID  = $("#checkHidID_4").val();
					var type_check  = $('input[name=type4]:checked').val();
					var question1   = $("#question1_4").val();
					var question2   = $("#question2_4").val();
					var question3   = $("#question3_4").val();
					var question4   = $("#question4_4").val();
					var question5   = $("#question5_4").val();
					var score       = $('input[name=score4]:checked').val();
					var numScore    = $("#numScore4").val();
					var state       = $(".state4").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_checklist.php?formID='+formID+'&title='+title+'&precheckID='+precheckID+'&type_check='+type_check+'&question1='+question1+'&question2='+question2+'&question3='+question3+'&question4='+question4+'&question5='+question5+'&score='+score+'&numScore='+numScore+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-check4').empty();
							$("#list-check4").load('<?php echo $URL_ROOT;?>ajax/list_checklist4.php?checkID='+$('#checkHidID_4').val()); 
						// $('.card-check4').find("input,textarea").val('').end();
					}else{
						alertify.error('No se pudo insertar el formulario , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});
			});

				$( "#btnAddAdj" ).click(function() {
					if ($('#titleAdj').val() == ''){ $('#titleAdj').focus(); alertify.error('Ingrese un titulo'); return false; }  
					if ($('#stateAdj').val() == '0'){ $('#stateAdj').focus(); alertify.error('Ingrese un estado'); return false; }

					var formID      = $("#formAdjHidID").val();
					var title       = $("#titleAdj").val(); 
					var code        = '';
					var preadjID  = 0;
					var state       = $(".stateAdj").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_adjunto.php?formID='+formID+'&title='+title+'&code='+code+'&preadjID='+preadjID+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-adjunto').empty();
							$("#list-adjunto").load('<?php echo $URL_ROOT;?>ajax/list_adjunto.php?formID='+$('#formAdjHidID').val()); 
						//$('.card-adjunto').find("input,textarea").val('').end();
						$("#formAdjHidID").val(formID);
					}else{
						alertify.error('No se pudo insertar el adjunto , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});
			});

				$( "#btnAddAdj2" ).click(function() {
					if ($('#titleAdj2').val() == ''){ $('#titleAdj2').focus(); alertify.error('Ingrese un titulo'); return false; }  
					if($('input[name=stateAdj2]:checked').length<=0){
						alertify.error('Ingrese un estado'); return false;
					}

					var formID      = $("#formAdjHidID").val();
					var title       = $("#titleAdj2").val(); 
					var code        = $("#code2").val();
					var preadjID  	= $("#adjHidID_2").val();
					var state       = $(".stateAdj2").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_adjunto.php?formID='+formID+'&title='+title+'&code='+code+'&preadjID='+preadjID+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-adjunto2').empty();
							$("#list-adjunto2").load('<?php echo $URL_ROOT;?>ajax/list_adjunto2.php?adjID='+$('#adjHidID_2').val()); 
						//$('.card-adjunto2').find("input,textarea").val('').end();
					}else{
						alertify.error('No se pudo insertar el adjunto , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});
			});


				$('#dataTables-example').DataTable({
					responsive: true,
					dom: "<'row'<'col-sm-6'f><'col-sm-6'>>" +
					"<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-4'l><'col-sm-2'i><'col-sm-6'p>>"
				});

			});
		</script>