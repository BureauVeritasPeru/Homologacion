<!-- Modal -->
<div id="myModalVoucher" class="modal bs-voucher" tabindex="-1" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Adjuntar Comprobante de Pago</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_voucher" name="form_voucher" autocomplete="off" enctype="multipart/form-data" method="post" target="hideFrame">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Número de Requerimiento</label>
								<input name="nroRequerimiento" class="form-control" type="text" id="nroRequerimiento" size="20" maxlength="15">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>RUC</label><br>
								<input name="ruc" class="form-control" type="text" id="ruc" size="20" maxlength="15">
							</div>
						</div>
					</div>
					<input type="hidden" name="requerimientoID" id="requerimientoID" >
					<div class="line"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Raz&oacute;n Social</label>
								<input name="razonSocial" autocomplete="off" type="text" id="razonSocial" readonly class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Empresa a Homologarse</label>
								<input name="client" autocomplete="off" type="text" id="client" readonly class="form-control">
							</div>
						</div>
					</div>
					<div class="row ">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Voucher de Pago (Adjuntar)</label>
								<input name="field[voucherFile]" autocomplete="off" type="file" id="voucherFile" class="form-control">
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Monto Abonado</label>
								<input name="amount" autocomplete="off" type="text" id="amount" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Actividad a Homologar</label>
								<input name="observation" autocomplete="off" type="text" id="observation2" class="form-control" >
							</div>
						</div>
					</div>
				</form>
				<hr>
				<h4>Nuestras Cuentas Bancarias (Banco de Credito del Perú - BCP)</h4>
				<p><br>
					Cuenta Corriente en Soles : 193-1127179-0-45
					<br><br>
					Codigo de Cuenta Interbancaria (CCI) : 002 193 001127179045 10
					<br><br>
					Titular de la Cuenta : Bureau Veritas del Perú S.A / RUC : 20101087566
				</p>
			</div>
			<div class="modal-footer">
				<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
				<div class="btn btn-primary" id="btn_save_voucher">Guardar Cambios</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		// $("#amount").maskMoney();
		$('#btn_save_voucher').click(function(){
			if($('#requerimientoID').val() == ''){ alertify.error('Ingrese los datos del requerimiento.'); return false; }
			var ex = $("#voucherFile").val().split('.').pop();
			if(ex!=""){
				var fs = 0;   
				if($("#voucherFile")[0].files[0].size != undefined){
					fs = $("#voucherFile")[0].files[0].size;  
				}else{
					fs = $("#voucherFile")[0].files[0].fileSize;
				}
			}else{
				alertify.error('Porfavor ingrese un archivo');
				return false;
			}
			$('#myModalVoucher').after('<iframe id="hideFrame" name="hideFrame" style="display:none"></iframe>'); //Target Post
			$('#form_voucher').attr('action', '<?php echo SEO::get_URLRoot();?>ajax/form_voucher.php');
			$('#form_voucher').submit();
			alertify.success('Solicitud de Voucher Registrada.');
			$('.bs-voucher').modal('hide');
			$('#form_voucher').find("input,textarea").val('').end();

			return false; 
		});

		$('#nroRequerimiento').change(function(){
			if($('#ruc').val() != ''){
				$.getJSON('<?php echo $URL_ROOT;?>ajax/search_requerimiento.php?nro_requerimiento='+$('#nro_requerimiento').val()+'&ruc='+$('#ruc').val(), function(data) {
					if(data.retval==1){
						if(data.state == 1){
							$('#razonSocial').val(data.businessName);
							$('#client').val(data.businessCliente);
							$('#requerimientoID').val(data.requerimientoID);
						}else{
							alertify.error('Solicitud de Requerimiento Vencida o Aprobada. Consultar al Administrador');
						}
					}else{
						alertify.error(data.message);
					}
				});
			}
		});
		$('#ruc').change(function(){
			if($('#nroRequerimiento').val() != ''){
				$.getJSON('<?php echo $URL_ROOT;?>ajax/search_requerimiento.php?nro_requerimiento='+$('#nroRequerimiento').val()+'&ruc='+$('#ruc').val(), function(data) {
					if(data.retval==1){
						if(data.state == 1){
							$('#razonSocial').val(data.businessName);
							$('#client').val(data.businessCliente);
							$('#requerimientoID').val(data.requerimientoID);
						}else{
							alertify.error('Solicitud de Requerimiento Vencida o Aprobada. Consultar al Administrador');
						}
					}else{
						alertify.error(data.message);
					}
				});
			}
		});
	});
</script>