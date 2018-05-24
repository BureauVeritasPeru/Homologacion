<?php 

function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}

?>
<style type="text/css">
thead th{
	text-align: center;
}
tbody td{
	text-align: center;
}
.datepicker{
	z-index: 1000000 !important;
}
</style>
<script type="text/javascript">
	function ModalDate(id,registerDate,registerExpire){
		$('.bs-Contacto').modal('show');
		$('#homologacionHidID').val(id);
		$('#registerDate').val(registerDate);
		$('#registerExpire').val(registerExpire);
	}
	function Alerta(ID){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/alert_homologacion.php?homologacionID='+ID, function(data) {
			if(data.retval==1){
				alertify.success('Se envio la alerta Correctamente');
			}else{
				alertify.error(data.message);
			}
		});
	}
</script>
<section class="tables">   
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-homologacion">
					<div class="box box-default">
						<!-- /.box-header -->
						<div class="card-body">
							<div class="box-body">
								<table class="table table-bordered table-hover" width='100%' id="dataTables-example">
									<thead>
										<tr>
											<th width="60"><?php echo $MODULE->getSortingHeader("homologacionID", "ID");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("businessCliente", "Cliente");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("proveedorID", "Proveedor");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("registerDate", "Fecha de Registro");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("registerExpire", "Fecha de Expiracion");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("registerExpire", "Dias Establecidos");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
											<th width="35">Ampliar Plazo</th>
										</tr>
									</thead>
									<tbody>
										<?php $list=CrmHomologacion::getListxVencimiento(); foreach ($list as $oItem) { 
											$oRequerimiento = CrmRequerimiento::getItem($oItem->homologacionID);
											/*Proveedor */ $oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID);
											/*PropxForm */ $oCrmPropxForm = CrmPropxForm::getItem($oRequerimiento->propxformID);
											/*Propuesta */ $oPropuesta = CrmPropuesta::getItem($oCrmPropxForm->propuestaID);
											/*Cliente */   $oCliente = CrmCliente::getItem($oPropuesta->clienteID);
											?>
											<tr>
												<td align="center"><?php echo $oItem->homologacionID; ?></td>
												<td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
												<td><?php echo htmlentities($oProveedor->businessName, ENT_QUOTES, "UTF-8"); ?></td>
												<td><?php echo $oItem->registerDate; ?></td>
												<td><?php echo $oItem->registerExpire; ?></td>
												<td><?php echo dias_transcurridos($oItem->registerDate,$oItem->registerExpire); ?></td>
												<td align="center" <?php if($oItem->state == 1){ echo 'style="background-color: greenyellow;"'; }else{echo 'style="background-color: red;"'; } ?> ><?php echo CrmHomologacion::getState($oItem->state);?></td>
												<td><a href="<?php echo "javascript:ModalDate(".$oItem->homologacionID.",'".$oItem->registerDate."','".$oItem->registerExpire."');"; ?>"><i class="fa fa-plus"></i></a>&nbsp;&nbsp;<a href="<?php echo "javascript:Alerta(".$oItem->homologacionID.");"; ?>"><i class="fa fa-bell"></i></a></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-footer">
								<div class="box-footer">
									<button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">Exportar</button>
									<?php echo $MODULE->getPaging();?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Inicio Modal Contacto  -->
	<div id="myModalContacto" class="modal bs-Contacto" tabindex="-1" role="dialog" data-focus-on="input:first">
		<div class="modal-dialog modal-lg" role="document" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="gridSystemModalLabel">Cambiar Plazo de Auditoria</h4>
					<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<label>Fecha de registro</label>
							<input name="registerDate" type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="registerDate" readOnly disabled placeholder="Ingrese Fecha" maxlength="100">
						</div>
						<div class="col-sm-6">
							<label>Fecha de expiración</label>
							<input name="registerExpire" type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="registerExpire" placeholder="Ingrese Fecha" maxlength="100">
						</div>
						<input type="hidden" name="homologacionHidID" id="homologacionHidID">
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-sm-5">
							<div class="btn btn-primary btn-block" name="btnUpdateHomologacion" id="btnUpdateHomologacion"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal Contacto  -->


	<script type="text/javascript">

		$(document).ready(function() {
			$('#registerDate').datepicker();
			$('#registerExpire').datepicker();
			$('.close').click(function(){
				$('.bs-Contacto').modal('hide');
			});
			$('#myModalContacto').on('hidden.bs.modal', function () {
				$(this).find("input,textarea").val('').end();
			});
			$('#dataTables-example').DataTable({
				responsive: true,
				dom: "<'row'<'col-sm-6'f><'col-sm-6'>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-4'l><'col-sm-2'i><'col-sm-6'p>>"
			});

			$('#btnUpdateHomologacion').click(function(){
				var homologacionHidID      			= $("#homologacionHidID").val();
				var registerExpire       		 		= $("#registerExpire").val();		
				$.getJSON('<?php echo $URL_ROOT;?>ajax/update_date_homo.php?homologacionID='+homologacionHidID+'&registerExpire='+registerExpire, function(data) {
					if(data.retval==1){
						// alertify.success('requerimiento actualizado Correctamente');
						alertify.success(data.message);
						$('.bs-Contacto').modal('hide');
						$('.bs-Contacto').find("input,textarea").val('').end();
						location.reload();
					}else{
						alertify.error('No se pudo Actualizar la homologacion , Contactarse con Soporte - BV');
					}
				}).error(function(jqXHR, textStatus, errorThrown) {
					alertify.error("Error interno");
					console.log("error: " + textStatus);
					console.log("error thrown: " + errorThrown);
					console.log("incoming Text: " + jqXHR.responseText);
				});  
			});


		});
	</script>