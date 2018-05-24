<?php //Get MediaGroup
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->basePath;
?>
<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
		CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
	});
</script>
<script type="text/javascript">
	$(function(){
		$('#amount').maskMoney();
		$('#dateVoucher').datepicker();
		$('.btn-upd').hide();

		$('.btn-upd').click(function(){
			var voucherHidID      = $("#voucherHidID").val();
			var dateVoucher       = $("#dateVoucher").val(); 
			var fileVoucher       = $("#fileVoucher").val();
			var amount            = $("#amount").val();
			var observation       = $("#observation").val();
			var state 			  = $("#state").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_voucher.php?voucherID='+voucherHidID+'&dateVoucher='+dateVoucher+'&fileVoucher='+fileVoucher+'&amount='+amount+'&observation='+observation+'&state='+state, function(data) {
				if(data.retval==1){
					$('#list-voucher').empty();
					alertify.success('Voucher actualizado Correctamente');
					var idRequerimiento = $('#requerimientoHidID').val();
					$("#list-voucher").load('<?php echo $URL_ROOT;?>ajax/list_voucher.php?requerimientoID='+idRequerimiento); 
					$('.card-voucher').find("input,textarea").val('').end();
					$('#requerimientoHidID').val(idRequerimiento);
				}else{
					alertify.error('No se pudo Actualizar el voucher , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd').hide();
		});

		$('#btnReturnVoucher').click(function(){
			$('.card-voucher').hide();
			$('.card-requerimiento').show();
			$('.card-requerimiento').find("input,textarea").val('').end();
		});
	});

	function ModalVoucher(id){
		$("#list-voucher").load('<?php echo $URL_ROOT;?>ajax/list_voucher.php?requerimientoID='+id); 
		$('.card-voucher').show();
		$('#requerimientoHidID').val(id);
		$('.card-requerimiento').hide();
	}

	function ModalAprobacion(id,montoSolicitado,montoAbonado){
		$('.bs-Requerimiento').modal('show');
		$('#reqAprobHidID').val(id);
		$('#amountSolicitado').val(montoSolicitado);
		$('#amountAbonado').val(montoAbonado);
	}

	function DeleteVoucher(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_voucher.php?voucherID='+id, function(data) {
			if(data.retval==1){
				$('#list-voucher').empty();
				$("#list-voucher").load('<?php echo $URL_ROOT;?>ajax/list_voucher.php?requerimientoID='+$('#requerimientoHidID').val()); 
			}else{
				alertify.error('No se pudo eliminar el voucher , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function ViewVoucher(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/view_voucher.php?voucherID='+id, function(data) {
			if(data.retval==1){
				$("#dateVoucher").val(data.dateVoucher); 
				$("#fileVoucher").val(data.fileVoucher);
				$("#amount").val(data.amount);
				$("#observation").val(data.observation);
				$("#state").val(data.state);
				$("#voucherHidID").val(id);
				$('.btn-upd').show();
			}else{
				alertify.error('No se pudo visualizar el voucher , Contactarse con Soporte - BV');
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
				<div class="card card-requerimiento">
					<div class="box box-default">
						<!-- /.box-header -->
						<div class="card-body">
							<div class="box-body">
								<table class="table table-bordered table-hover" width='100%' id="dataTables-example">
									<thead>
										<tr>
											<th width="35">&nbsp;</th>
											<th width="60"><?php echo $MODULE->getSortingHeader("requerimientoID", "ID");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("period", "Periodo");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("registerDate", "Fecha Registro");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("clienteID", "Cliente");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("proveedorID", "Proveedor");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("per","PER");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("address", "Direccion");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("amount", "Monto Abonado / Monto Solicitado");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
											<th width="35">Vouchers</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if($oAdmUser->profileID != 4) {
											$list=CrmRequerimiento::getList_Paging(); 
										}else{
											$list=CrmRequerimiento::getListxFinanzas(); 
										}
										foreach ($list as $oItem) {  $oProveedor = CrmProveedor::GetItem($oItem->proveedorID); $oPropxform = CrmPropxForm::getItem($oItem->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);   ?>
										<tr> 
											<td><a href="<?php echo "javascript:Edit(".$oItem->requerimientoID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
												<?php if($oItem->state == 1 && $oAdmUser->profileID != 4 ){ ?>
												<a href="<?php echo "javascript:ModalAprobacion(".$oItem->requerimientoID.",".$oPropxform->amount.",".$oItem->amount.");"; ?>"><i class="fa fa-check"></i></a>
												<?php } ?>
											</td>
											<td><?php echo $oItem->requerimientoID; ?></td>
											<td><?php echo $oItem->period; ?></td>
											<td><?php echo $oItem->registerDate; ?></td>
											<td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo htmlentities($oProveedor->businessName, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo htmlentities($oPropuesta->proposalNumber, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo htmlentities($oProveedor->address, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo htmlentities($oItem->amount.'  /  '.$oPropxform->amount, ENT_QUOTES, "UTF-8"); ?></td>
											<td align="center"><?php echo CrmRequerimiento::getState($oItem->state);?></td>
											<td><a href="<?php echo "javascript:ModalVoucher(".$oItem->requerimientoID.");"; ?>"><i class="fa fa-plus"></i></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="card-footer">
							<div class="box-footer">
								<button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">exportar</button>
								<?php echo $MODULE->getPaging();?>
							</div>
						</div>
					</div>
				</div>
				<div class="card card-voucher" style="display: none;">
					<div class="box box-default">
						<!-- /.box-header -->
						<div class="card-body">
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12">
										<input type="hidden" name="requerimientoHidID" id="requerimientoHidID">
										<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbVouchers">
											<thead>
												<tr> 
													<th style="text-align:center;">&nbsp;</th>
													<th style="text-align:center;"><a>Fecha</a></th>
													<th style="text-align:center;"><a>Voucher Adjunto</a></th>
													<th style="text-align:center;"><a>Observaciones</a></th>
													<th style="text-align:center;"><a>Importe</a></th>
													<th style="text-align:center;"><a>Estado</a></th>
												</tr>
											</thead>
											<tbody id="list-voucher"> 
											</tbody>
										</table>
									</div>
								</div>
								<div class="line"></div>
								<div class="line"></div>
								<input type="hidden" name="voucherHidID" id="voucherHidID">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Fecha</label>
											<input name="dateVoucher" type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="dateVoucher" placeholder="Ingrese Fecha" maxlength="100">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>File Voucher</label>
											<div class="input-group">
												<input name="fileVoucher" id="fileVoucher" class="form-control fmanager" rel="<?php echo $media_group["voucher_documento"];?>" required="true" type="text" />
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>Importe</label>
											<input name="amount" type="money" class="form-control" id="amount" placeholder="Ingrese importe" maxlength="100">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Estado</label>
											<select name="state" id="state" class="form-control" autocomplete="off">
												<option value="0">Seleccione</option>
												<option value="1">En proceso</option>
												<option value="2">Aprobado</option>
												<option value="3">En Observacion</option>
											</select>
										</div>
									</div>
									<div class="col-sm-4" >
										<div class="form-group">
											<label>Observaciones</label>
											<textarea name="observation" type="text" class="form-control" id="observation" placeholder="Ingrese observacion" ></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="box-footer">
								<?php if($oAdmUser->profileID != 4) { ?>
								<div class="btn btn-primary" name="btnAddVoucher" id="btnAddVoucher"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
								<?php } ?> 
								<div class="btn btn-primary btn-upd" name="btnUpdateVoucher" id="btnUpdateVoucher"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
								<div class="btn btn-primary btn-back" name="btnReturnVoucher" id="btnReturnVoucher"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Inicio Modal Contacto  -->
<div id="myModalRequerimiento" class="modal bs-Requerimiento" tabindex="-1" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="gridSystemModalLabel">Desea aprobar el requerimiento?</h4>
				<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-3">
						&nbsp;
					</div>
					<div class="col-sm-3">
						<input type="hidden" name="reqAprobHidID" id="reqAprobHidID">
						<label>Monto Solicitado</label><br>
						<input type="text" readonly name="amountSolicitado" id="amountSolicitado" disabled style="text-align: center;">
					</div>
					<div class="col-sm-3">
						<label>Monto Abonado</label><br>
						<input type="text" readonly name="amountAbonado" id="amountAbonado" disabled style="text-align: center;">
					</div>
					<div class="col-sm-3">
						&nbsp;
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-sm-5">
						<div class="btn btn-primary btn-block" name="btnAprobeRequerimiento" id="btnAprobeRequerimiento"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Aprobar</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Fin Modal Contacto  -->
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

<script type="text/javascript">

	$(document).ready(function() {

		$('.close').click(function(){
			$('.bs-Requerimiento').modal('hide');

		});
		$( "#btnAddVoucher" ).click(function() {
			$('.btn-upd').hide();
			if ($('#amount').val() == ''){ $('#amount').focus(); alertify.error('Ingrese una fecha'); return false; }  
			if ($('#fileVoucher').val() == ''){ $('#fileVoucher').focus(); alertify.error('Ingrese un archivo'); return false; }

			var requerimientoID = $("#requerimientoHidID").val();
			var dateVoucher  	= $("#dateVoucher").val(); 
			var fileVoucher    	= $("#fileVoucher").val();
			var amount     		= $("#amount").val();
			var observation     = $("#observation").val();
			var state           = $("#state").val();

			$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_voucher.php?requerimientoID='+requerimientoID+'&dateVoucher='+dateVoucher+'&fileVoucher='+fileVoucher+'&amount='+amount+'&observation='+observation+'&state='+state, function(data) {
				if(data.retval==1){
					$('#list-voucher').empty();
					alertify.success('Voucher registrada Correctamente');
					$("#list-voucher").load('<?php echo $URL_ROOT;?>ajax/list_voucher.php?requerimientoID='+$('#requerimientoHidID').val()); 
					$('.card-voucher').find("input,textarea").val('').end();
				}else{
					alertify.error('No se pudo insertar el voucher , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});
		});


		$( "#btnAprobeRequerimiento" ).click(function() {
			bootbox.confirm({
				title: "Homologacion - Bureau Veritas",
				message: "Estas seguro de aprobar el requerimiento?",
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
						var requerimientoID = $("#reqAprobHidID").val();
						$.getJSON('<?php echo $URL_ROOT;?>ajax/aprob_requerimiento.php?requerimientoID='+requerimientoID, function(data) {
							if(data.retval==1){
								alertify.success('Requerimiento aprobado Correctamente');
								location.reload();
							}else{
								alertify.error('No se pudo insertar el Requerimiento , Contactarse con Soporte - BV');
							}
						}).error(function(jqXHR, textStatus, errorThrown) {
							alertify.error("Error interno");
							console.log("error: " + textStatus);
							console.log("error thrown: " + errorThrown);
							console.log("incoming Text: " + jqXHR.responseText);
						});
					}
				}
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