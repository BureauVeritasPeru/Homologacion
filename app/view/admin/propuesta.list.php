<?php //Get MediaGroup
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->basePath;
?>

<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript">
	$(function(){
		$('.btn-upd').hide();
		$('.btn-upd-form').hide();
		$('.btn-upd').click(function(){
			var proposalHidID   = $("#proposalHidID").val();
			var proposalNumber  = $("#proposalNumber").val(); 
			var proposalDate    = $("#proposalDate").val();
			var description     = $("#description").val();
			var sectorist       = $("#sectorist").val();
			var state           = $("#state").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_proposal.php?propuestaID='+proposalHidID+'&proposalNumber='+proposalNumber+'&proposalDate='+proposalDate+'&description='+description+'&sectorist='+sectorist+'&state='+state, function(data) {
				if(data.retval==1){
					$('#list-proposal').empty();
					alertify.success('Propuesta actualizada Correctamente');
					var idCliente = $('#clienteHidID').val();
					$("#list-proposal").load('<?php echo $URL_ROOT;?>ajax/list_proposal.php?clienteID='+idCliente); 
					$('.card-propuesta').find("input,textarea").val('').end();
					$('.card-propuesta').find("#sectorist").val('0').end();
					$('.card-propuesta').find("#state").val('0').end();
					$('#clienteHidID').val(idCliente);
				}else{
					alertify.error('No se pudo actualizar la propuesta , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd').hide();
		});
		$('.btn-upd-form').click(function(){
			var propxformHidID  = $("#propxformHidID").val();
			var typeForm  		= $("#typeForm").val(); 
			var titleForm	    = $("#titleForm").val();
			var amount     		= $("#amount").val();
			var fileProposal    = $("#fileProposal").val();
			var stateForm       = $("#stateForm").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_propxform.php?propxformHidID='+propxformHidID+'&typeForm='+typeForm+'&titleForm='+titleForm+'&amount='+amount+'&fileProposal='+fileProposal+'&stateForm='+stateForm, function(data) {
				if(data.retval==1){
					$('#list-propxform').empty();
					alertify.success('Propuesta x Formulario actualizada Correctamente');
					var proposalHidID2 = $('#proposalHidID2').val();
					$("#list-propxform").load('<?php echo $URL_ROOT;?>ajax/list_propxform.php?propuestaID='+proposalHidID2); 
					$('#myModalPropxForm').find("input,textarea").val('').end();
					$('#myModalPropxForm').find("#typeForm").val('0').end();
					$('#myModalPropxForm').find("#stateForm").val('0').end();
					$('#proposalHidID2').val(proposalHidID2);
				}else{
					alertify.error('No se pudo actualizar la propuesta , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd-form').hide();
		});

		$('#btnReturnProposal').click(function(){
			$('.card-propuesta').hide();
			$('.card-cliente').show();
			$('.card-cliente').find("input,textarea").val('').end();
		});

		$('#btnReturnPropxForm').click(function(){
			$('.card-propxform').hide();
			$('.card-propuesta').show();
			$('.card-propuesta').find("input,textarea").val('').end();
		});
	});
	

	function ModalProposal(id){
		$("#list-proposal").load('<?php echo $URL_ROOT;?>ajax/list_proposal.php?clienteID='+id); 
		$('.card-propuesta').show();
		$('#clienteHidID').val(id);
		$('.card-cliente').hide();
	}

	function DeleteProposal(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_proposal.php?propuestaID='+id, function(data) {
			if(data.retval==1){
				$('#list-proposal').empty();
				alertify.success('Propuesta eliminada Correctamente');
				$("#list-proposal").load('<?php echo $URL_ROOT;?>ajax/list_proposal.php?clienteID='+$('#clienteHidID').val()); 
			}else{
				alertify.error('No se pudo eliminar el contacto , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function ViewProposal(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/view_proposal.php?propuestaID='+id, function(data) {
			if(data.retval==1){
				$("#proposalNumber").val(data.proposalNumber); 
				$("#proposalDate").val(data.proposalDate);
				$("#description").val(data.description);
				$("#sectorist").val(data.sectorist);
				$("#proposalHidID").val(id);
				$("#state").find("option[value=" + data.state + "]").attr("selected", true);
				$('.btn-upd').show();
			}else{
				alertify.error('No se pudo eliminar el contacto , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	////////////////////////////////////////////////////////////////////////////////////////////////


	function ModalDetProposal(id){
		$("#list-propxform").load('<?php echo $URL_ROOT;?>ajax/list_propxform.php?propuestaID='+id); 
		$('.card-propxform').show();
		$('#proposalHidID2').val(id);
		$('.card-propuesta').hide();
	}

	function DeletePropxForm(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_propxform.php?propxformID='+id, function(data) {
			if(data.retval==1){
				$('#list-propxform').empty();
				alertify.success('Propuesta eliminada Correctamente');
				$("#list-propxform").load('<?php echo $URL_ROOT;?>ajax/list_propxform.php?propuestaID='+$('#proposalHidID2').val()); 
			}else{
				alertify.error('No se pudo eliminar el contacto , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function ViewPropxForm(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/view_propxform.php?propxformID='+id, function(data) {
			if(data.retval==1){
				$("#typeForm").val(data.typeForm); 
				$("#titleForm").val(data.titleForm);
				$("#amount").val(data.amount);
				$("#stateForm").val(data.stateForm);
				$("#fileProposal").val(data.fileProposal);
				$("#propxformHidID").val(id);
				$('.btn-upd-form').show();
				if(data.tagImport != 1){
					$("#btnUploadProv").show();
				}
			}else{
				alertify.error('No se pudo visualizar la propuesta , Contactarse con Soporte - BV');
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
				<div class="card card-cliente">
					<div class="box box-default">
						<div class="card-body">
							<div class="box-body">
								<table class="table table-bordered table-hover " width='100%' id="dataTables-example">
									<thead>
										<tr>
											<th width="120"><?php echo $MODULE->getSortingHeader("ruc", "RUC");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("businessName", "Razon Social");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("address", "Dirección");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("email", "Correo");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
											<th width="35">Propuestas</th>
										</tr>
									</thead>
									<tbody><?php $list=CrmCliente::getList_Paging(); foreach ($list as $oItem) { ?>
										<tr> 
											<td><?php echo $oItem->ruc; ?></td>
											<td><?php echo $oItem->businessName; ?></td>
											<td><?php echo htmlentities($oItem->address, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo $oItem->email; ?></td>
											<td align="center"><?php echo CrmServicio::getState($oItem->state);?></td>
											<td><a href="<?php echo "javascript:ModalProposal(".$oItem->clienteID.");"; ?>"><i class="fa fa-plus"></i></a></td>
											</tr><?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-propuesta" style="display: none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="clienteHidID" id="clienteHidID">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive"  width='100%' id="tbPropuesta">
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Nro Propuesta</a></th>
														<th style="text-align:center;"><a>Fecha de Propuesta</a></th>
														<th style="text-align:center;"><a>Estado</a></th>
													</tr>
												</thead>
												<tbody id="list-proposal"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<input type="hidden" name="proposalHidID" id="proposalHidID">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Nro de Propuesta</label>
												<input name="proposalNumber" type="text" class="form-control" id="proposalNumber" placeholder="Ingrese Nro de Propuesta" maxlength="100">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Fecha de Propuesta</label>
												<input name="proposalDate" type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="proposalDate" placeholder="Ingrese Fecha de Propuesta" maxlength="100">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Descripcion</label>
												<textarea name="description" class="form-control" id="description" maxlength="500"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6" >
											<div class="form-group">
												<label>Sectorista</label>
												<select name="sectorist" id="sectorist" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(1, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-6" >
											<div class="form-group">
												<label>Estado</label>
												<select name="state" id="state" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option>
													<option value="1">Activo</option>
													<option value="2">Bloqueado</option>
													<option value="3">Inactivo</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">
									<div class="btn btn-primary" name="btnAddProposal" id="btnAddProposal"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-upd" name="btnUpdateProposal" id="btnUpdateProposal"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-back" name="btnReturnProposal" id="btnReturnProposal"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>

					<script type="text/javascript">
						$(document).ready(function(){
							$('#proposalDate').datepicker();
							$('#amount').maskMoney({precision:2,thousands:'', decimal:'.', allowZero:true});
							CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
							CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
						});
					</script>
					<div class="card card-propxform" style="display: none;">
						<div class="box box-default">
							<div class="card-body">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<input type="hidden" name="proposalHidID2" id="proposalHidID2">
											<table class="table table-striped table-hover table-condensed table-bordered table-responsive" >
												<thead>
													<tr> 
														<th style="text-align:center;">&nbsp;</th>
														<th style="text-align:center;"><a>Titulo</a></th>
														<th style="text-align:center;"><a>Importe</a></th>
														<th style="text-align:center;"><a>Estado</a></th>
													</tr>
												</thead>
												<tbody id="list-propxform"> 
												</tbody>
											</table>
										</div>
									</div>
									<div class="line"></div>
									<input type="hidden" name="propxformHidID" id="propxformHidID">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label>Tipo de Formulario</label>
												<select name="typeForm" id="typeForm" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option><?php $list= CrmFormulario::getList(); foreach ($list as $obj) { echo "<option value=\"".$obj->formID."\""; echo ">".$obj->title."</option>";}?> 
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Titulo</label>
												<input name="titleForm" type="text" class="form-control" id="titleForm" placeholder="Ingrese Titulo" maxlength="100">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label>Estado</label>
												<select name="stateForm" id="stateForm" class="form-control" autocomplete="off">
													<option value="0">Seleccione</option>
													<option value="1">Activo</option>
													<option value="2">Bloqueado</option>
													<option value="3">Inactivo</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6" >
											<div class="form-group">
												<label>Importe Referencial</label>
												<input name="amount" type="text" class="form-control money" id="amount" placeholder="Ingrese Importe" maxlength="100">
											</div>	
										</div>
										<div class="col-sm-6" >
											<div class="form-group">
												<label>Archivo de Propuesta</label>
												<div class="input-group">
													<input name="fileProposal" id="fileProposal"  class="form-control fmanager" rel="<?php echo $media_group["propuesta_documento"];?>" required="true" type="text" />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">
									<div class="btn btn-primary" name="btnAddPropxForm" id="btnAddPropxForm"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
									<div class="btn btn-primary btn-upd-form" name="btnUpdatePropxForm" id="btnUpdatePropxForm"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
									<div class="btn btn-primary btn-upl-form" name="btnUploadProv" id="btnUploadProv" style="display: none;"><i class="fa fa-upload"></i>&nbsp;&nbsp;Importar Proveedores</div>
									<div class="btn btn-primary btn-back" name="btnReturnPropxForm" id="btnReturnPropxForm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>
	<!-- Modal de Importacion -->

	<script type="text/javascript">
		$(document).ready(function() {
			$('#btnUploadProv').click(function (e) {
				$('#ModalImport').modal('show');
				$('.FiltroImport').hide();
				return false;
			});
			$('#btnSelect').click(function (e){
				var  form  = document.getElementById("myForm");

				if($("#fleImport").val()==""){
					$("#fleImport").focus();
					alert("Seleccione el archivo ");
					return false;
				}else{
					var fs = 0;   
					if($("#fleImport")[0].files[0].size != undefined){
						fs = $("#fleImport")[0].files[0].size;  
					}else{
						fs = $("#fleImport")[0].files[0].fileSize;
					}

					var ex = $("#fleImport").val().split('.').pop();

					if(ex !="csv"){
						$("#fleImport").focus();
						alert("Seleccione un archivo csv");
						return false;
					}
					$.ajax({
						type: "POST",
						data: new FormData(form),
						contentType: false,       
						cache: false,             
						processData:false, 
						url: '<?php echo $URL_ROOT;?>ajax/form_import_view.php',
						success: function( response ) {
							if(response==1){
								alert('exito');
							}else{
								$('.FiltroImport').show();
								$('.RespuestaImport').html(response);
							}
						}
					});
				}
			});

			$('#ready_import').click(function (e){
				var  form  = document.getElementById("myForm");

				if($("#fleImport").val()==""){
					$("#fleImport").focus();
					alert("Seleccione el archivo ");
					return false;
				}else{
					var fs = 0;   
					if($("#fleImport")[0].files[0].size != undefined){
						fs = $("#fleImport")[0].files[0].size;  
					}else{
						fs = $("#fleImport")[0].files[0].fileSize;
					}

					var ex = $("#fleImport").val().split('.').pop();

					if(ex !="csv"){
						$("#fleImport").focus();
						alert("Seleccione un archivo csv");
						return false;
					}
					$.ajax({
						type: "POST",
						data: new FormData(form),
						contentType: false,       
						cache: false,             
						processData:false, 
						url: '<?php echo $URL_ROOT;?>ajax/form_import.php?propuestaID='+$('#proposalHidID2').val()+'&clienteID='+$('#clienteHidID').val()+'&propxformID='+$('#propxformHidID').val(),
						success: function( response ) {
							if(response==1){
								alert('exito');
								$('#ModalImport').modal('hide');
							}else{
								$('#ModalImport').modal('hide');
								alertify.success(response);
							}
						}
					});
				}
			});

		});
	</script>
	<!-- Modal de Importacion -->
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
	<!-- Fin Modal Propuesta X Formulario -->

	<script type="text/javascript">

		$(document).ready(function() {


			$( "#btnAddProposal" ).click(function() {
				$('.btn-upd').hide();
				if ($('#proposalNumber').val() == ''){ $('#proposalNumber').focus(); alertify.error('Ingrese un Nro de Propuesta'); return false; }  
				if ($('#proposalDate').val() == ''){ $('#proposalDate').focus(); alertify.error('Ingrese una Fecha de Propuesta'); return false; }

				var clienteID       = $("#clienteHidID").val();
				var proposalNumber  = $("#proposalNumber").val(); 
				var proposalDate    = $("#proposalDate").val();
				var description     = $("#description").val();
				var sectorist       = $("#sectorist").val();
				var state           = $("#state").val();

				$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_proposal.php?clienteID='+clienteID+'&proposalNumber='+proposalNumber+'&proposalDate='+proposalDate+'&description='+description+'&sectorist='+sectorist+'&state='+state, function(data) {
					if(data.retval==1){
						$('#list-proposal').empty();
						alertify.success('Propuesta registrada Correctamente');
						$("#list-proposal").load('<?php echo $URL_ROOT;?>ajax/list_proposal.php?clienteID='+$('#clienteHidID').val()); 
						$('#myModalPropuesta').find("input,textarea").val('').end();
					}else{
						alertify.error('No se pudo insertar la propuesta , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});


			});

			$( "#btnAddPropxForm" ).click(function() {
				$('.btn-upd-form').hide();
				if ($('#typeForm').val() == '0'){ $('#typeForm').focus(); alertify.error('Ingrese un tipo de formulario'); return false; }  
				if ($('#titleForm').val() == ''){ $('#titleForm').focus(); alertify.error('Ingrese una Titulo'); return false; }

				var proposalHidID2  = $("#proposalHidID2").val();
				var typeForm  		= $("#typeForm").val(); 
				var titleForm    	= $("#titleForm").val();
				var fileProposal    = $("#fileProposal").val();
				var amount       	= $("#amount").val();
				var stateForm       = $("#stateForm").val();


				$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_propxform.php?propuestaID='+proposalHidID2+'&typeForm='+typeForm+'&titleForm='+titleForm+'&fileProposal='+fileProposal+'&amount='+amount+'&stateForm='+stateForm, function(data) {
					if(data.retval==1){
						$('#list-propxform').empty();
						alertify.success('Propuesta registrada Correctamente');
						$("#list-propxform").load('<?php echo $URL_ROOT;?>ajax/list_propxform.php?propuestaID='+$('#proposalHidID2').val()); 
						$('#myModalPropxForm').find("input,textarea").val('').end();
					}else{
						alertify.error('No se pudo insertar la propuesta , Contactarse con Soporte - BV');
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