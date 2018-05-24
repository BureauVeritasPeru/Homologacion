
<script type="text/javascript">
	$(function(){
		$('#amount').maskMoney();
		$('#dateVoucher').datepicker();
		$('.btn-apr').hide();
		$('.btn-obs').hide();
		$('.btn-fac').hide();
		$('#btnReturnVoucher').click(function(){
			$('.card-voucher').hide();
			$('.card-requerimiento').show();
			$('.card-requerimiento').find("input,textarea").val('').end();
			$('.card-voucher').find("input,textarea").val('').end();
			$('.btn-apr').hide();
			$('.btn-obs').hide();
			$('.btn-fac').hide();
			$("#fileVoucher").removeAttr('href');
		});
	});

	function ModalVoucher(id){
		$("#list-voucher").load('<?php echo $URL_ROOT;?>ajax/list_voucher_finanzas.php?requerimientoID='+id); 
		$('.card-voucher').show();
		$('#requerimientoHidID').val(id);
		$('.card-requerimiento').hide();
		<?php if($oAdmUser->profileID == 5) { ?>$('.btn-fac').show();<?php } ?>
	}

	function ViewVoucher(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/view_voucher.php?voucherID='+id, function(data) {
			if(data.retval==1){
				$("#dateVoucher").val(data.dateVoucher); 
				$("#fileVoucher").attr('href','<?php echo $URL_ROOT;?>userfiles/cms/voucher/documento/'+data.fileVoucher);
				$("#amount").val(data.amount);
				$("#observation").val(data.observation);
				$("#voucherHidID").val(id);
				<?php if($oAdmUser->profileID != 5) { ?>$('.btn-apr').show();$('.btn-obs').show();<?php } ?>
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
											<th width="60"><?php echo $MODULE->getSortingHeader("requerimientoID", "ID");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("period", "Periodo");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("ruc","RUC");?></th>
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
										$list=CrmRequerimiento::getListxFinanzas_Voucher(); 
										foreach ($list as $oItem) {  $oProveedor = CrmProveedor::GetItem($oItem->proveedorID); $oPropxform = CrmPropxForm::getItem($oItem->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);   ?>
										<tr> 
											<td><?php echo $oItem->requerimientoID; ?></td>
											<td><?php echo $oItem->period; ?></td>
											<td><?php echo htmlentities($oProveedor->documentNumber, ENT_QUOTES, "UTF-8"); ?></td>
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
													<th style="text-align:center;"><a>Fecha  Aprobacion</a></th>
													<th style="text-align:center;"><a>PER</a></th>
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
											<input name="dateVoucher" type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="dateVoucher" placeholder="Ingrese Fecha" readonly maxlength="100">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>File Voucher</label>
											<div class="input-group">
												<a name="fileVoucher" id="fileVoucher" class="btn btn-primary btn-block" target="_blank" readonly required="true" type="text">Descargar Archivo</a>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Importe</label>
											<input name="amount" type="money" class="form-control" id="amount" readonly placeholder="Ingrese importe" maxlength="100">
										</div>
									</div>
									<div class="col-sm-6" >
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
								<div class="btn btn-primary btn-apr" name="btnAprobarVoucher" id="btnAprobarVoucher"><i class="fa fa-check"></i>&nbsp;&nbsp;Aprobar</div>
								<div class="btn btn-primary btn-obs" name="btnObservarVoucher" id="btnObservarVoucher"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Observar</div>
								<div class="btn btn-primary btn-fac" name="btnFacturarVoucher" id="btnFacturarVoucher"><i class="fa fa-check"></i>&nbsp;&nbsp;Facturar</div>
								<div class="btn btn-primary btn-back" name="btnReturnVoucher" id="btnReturnVoucher"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Regresar</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

	$(document).ready(function() {

		$('.close').click(function(){
			$('.bs-Requerimiento').modal('hide');

		});


		$( "#btnAprobarVoucher" ).click(function() {
			bootbox.confirm({
				title: "Homologacion - Bureau Veritas",
				message: "Estas seguro de aprobar el voucher?",
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
						var voucherID = $("#voucherHidID").val();
						$.getJSON('<?php echo $URL_ROOT;?>ajax/aprob_voucher.php?voucherID='+voucherID, function(data) {
							if(data.retval==1){
								alertify.success('Voucher aprobado Correctamente');
								location.reload();
							}else{
								alertify.error('No se pudo insertar el Voucher , Contactarse con Soporte - BV');
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

		$( "#btnFacturarVoucher" ).click(function() {
			bootbox.confirm({
				title: "Homologacion - Bureau Veritas",
				message: "Estas seguro de facturar el voucher?",
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
						var voucherID = $("#voucherHidID").val();
						var observaciones = $('#observaciones').val();
						$.getJSON('<?php echo $URL_ROOT;?>ajax/fact_voucher.php?voucherID='+voucherID+'&observaciones='+observaciones, function(data) {
							if(data.retval==1){
								alertify.success('Voucher Facturado Correctamente');
								location.reload();
							}else{
								alertify.error('No se pudo insertar el Voucher , Contactarse con Soporte - BV');
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

		$( "#btnObservarVoucher").click(function() {
			bootbox.confirm({
				title: "Homologacion - Bureau Veritas",
				message: "Estas seguro de observar el voucher?",
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
						var voucherID = $("#voucherHidID").val();
						var observaciones = $('#observaciones').val();
						$.getJSON('<?php echo $URL_ROOT;?>ajax/observ_voucher.php?voucherID='+voucherID+'&observaciones='+observaciones, function(data) {
							if(data.retval==1){
								alertify.success('Voucher en Observaciones Correctamente');
								location.reload();
							}else{
								alertify.error('No se pudo insertar el Voucher , Contactarse con Soporte - BV');
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