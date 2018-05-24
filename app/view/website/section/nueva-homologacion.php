<?php
$oProveedor=WebLogin::getProveedorSession();
?>
<script type="text/javascript">
	$(function(){
		<?php if($oProveedor->state != 1){ ?>
			$('.nav-item').hide();
			<?php } ?>
		});
	</script>
	<main role="main" class="container">
		<div class="starter-template">
			<section class="content">
				<h1>Nueva Homologacion</h1>
				<br>
				<form id="form_homologacion" >
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Empresa a Homologarse</label>
								<select name="propxformID" id="propxformID" class="form-control">
									<option value="0">Seleccione</option><?php $lPropForm=CrmPropxForm::getList();foreach ($lPropForm as $obj) { $oPropuesta = CrmPropuesta::getItem($obj->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);?>  <option value="<?php echo $obj->propxformID; ?>"><?php echo $obj->titleForm; ?> - <?php echo $oCliente->businessName; ?></option><?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Alcance a Homologar</label>
								<input type="text" name="scope" id="scope" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Observaciones</label>
								<textarea name="observation" id="observation" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-7">&nbsp;</div>&nbsp;&nbsp;
						<a class="col-sm-2 btn btn-secondary" href="javascript:history.back();">Regresar</a> &nbsp;&nbsp;
						<div class="col-sm-2 btn btn-primary" id="btn_guardar">Enviar Correo</div>

					</div>
				</form>
			</section>
			<br>
			<br>
			<script type="text/javascript">
				$(function(){

					$('#btn_guardar').click(function(){
						if($('.radio-type').val() == ''){ alertify.error('Ingrese el tipo de proveedor.'); $('.radio-type').focus(); return false; }
						if($('#businessName').val() == ''){ alertify.error('Ingrese la razon social.'); $('#businessName').focus(); return false; }
						if($('#address').val() == ''){ alertify.error('Ingrese la direccion.'); $('#address').focus(); return false; }
						if($('#country').val() == ''){ alertify.error('Ingrese el pais.'); $('#country').focus(); return false; }
						if($('#phone').val() == ''){ alertify.error('Ingrese el numero de telefono.'); $('#phone').focus(); return false; }
						if($('#email').val() == ''){ alertify.error('Ingrese el e-mail.'); $('#email').focus(); return false; }
						if($('#contacts').val() == ''){ alertify.error('Ingrese los contactos.'); $('#contacts').focus(); return false; }
						if($('#other').val() == ''){ alertify.error('Ingrese otros servicios o bienes.'); $('#other').focus(); return false; }

						var fields2=$('#form_proveedor').serialize();
						$.getJSON('<?php echo $URL_ROOT;?>ajax/update_proveedor.php?'+fields2, function(data) {
							if(data.retval==1){
								alertify.success(data.message);
								setTimeout(function(){
									location.href='#';
								}, 2000);
							}else{
								alertify.error(data.message);
							}
						});
					});
				});
			</script>
		</div>
	</main>