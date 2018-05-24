<!-- Modal -->
<div id="myModalContacto" class="modal bs-proveedor" tabindex="-1" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Datos de la Empresa a auditar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_proveedor" >
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>RUC *</label>
								<input name="documentNumber" class="form-control" type="text" id="documentNumber" size="20" maxlength="15">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Tipo de Proveedor *</label><br>
								<label for="typeProvider1">
									<input type="radio" class="radio-template radio-type" id="typeProvider1" name="typeProvider" value="1">
									Nacional
								</label>&nbsp;&nbsp;
								<label for="typeProvider2">
									<input type="radio" class="radio-template radio-type" id="typeProvider2" name="typeProvider" value="2">
									Extranjero
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Raz&oacute;n Social *</label>
								<input name="businessName" autocomplete="off" type="text" id="businessName" class="form-control">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Direcci&oacute;n *</label>
								<input name="address" autocomplete="off" type="text" id="address" class="form-control">
							</div>
						</div>
					</div>
					<div class="row ">
						<div class="col-sm-6 group-pais">
							<div class="form-group">
								<label>País *</label>
								<select name="country" id="country" class="form-control">
									<option value="0">Seleccione</option><?php $lCountry=UbgCountry::getList(); foreach ($lCountry as $obj) { ?>
										<option value="<?php echo $obj->countryID; ?>"><?php echo $obj->countryName; ?></option><?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Codigo Postal</label>
									<input name="postalCode" autocomplete="off" type="text" id="postalCode" class="form-control" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 group-fijo">
								<div class="form-group">
									<label>Departamento</label>
									<select name="department" id="department" class="form-control">
										<option value="0">Seleccione</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
											<option value="<?php echo $obj->cod_dpto; ?>"><?php echo $obj->nombre; ?></option><?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Tel&eacute;fono *</label>
										<input name="phone" autocomplete="off" type="text" id="phone" class="form-control" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 group-fijo">
									<div class="form-group">
										<label>Provincia</label>
										<select name="province" id="province" class="form-control">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Fax</label>
										<input name="fax" autocomplete="off" type="text" id="fax" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 group-fijo">
									<div class="form-group ">
										<label>Distrito</label>
										<select name="district" id="district" class="form-control">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>E-mail *</label>
										<input name="email" autocomplete="off" type="text" id="email" class="form-control" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Contactos *</label>
										<textarea name="contacts" id="contacts" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Direccion Legal</label>
										<input name="legalDirection" autocomplete="off" type="text" id="legalDirection" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Departamento Legal</label>
										<select name="departmentLegal" id="departmentLegal" class="form-control">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Representante Legal</label>
										<input name="legalRepresentative" autocomplete="off" type="text" id="" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Provincia Legal</label>
										<select name="provinceLegal" id="provinceLegal" class="form-control">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Distrito Legal</label>
										<select name="districtLegal" id="districtLegal" class="form-control">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>
							</div>
							<div class="line"></div>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">Contacto para la Auditoria</legend>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Nombre</label>
											<input name="commercialContactName" autocomplete="off" type="text" id="commercialContactName" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Teléfono</label>
											<input name="commercialContactPhone" autocomplete="off" type="text" id="commercialContactPhone" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Celular</label>
											<input name="commercialContactCellphone" autocomplete="off" type="text" id="commercialContactCellphone" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>E-mail</label>
											<input name="commercialContactEmail" autocomplete="off" type="text" id="commercialContactEmail" class="form-control">
										</div>
									</div>
								</div>
							</fieldset>
							<div class="line"></div>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">Gerente General</legend>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Nombre</label>
											<input name="generalMananagerName" autocomplete="off" type="text" id="generalMananagerName" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Teléfono</label>
											<input name="generalMananagerPhone" autocomplete="off" type="text" id="generalMananagerPhone" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Celular</label>
											<input name="generalMananagerCellphone" autocomplete="off" type="text" id="generalMananagerCellphone" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>E-mail</label>
											<input name="generalMananagerEmail" autocomplete="off" type="text" id="generalMananagerEmail" class="form-control" >
										</div>
									</div>
								</div>
							</fieldset>
							<div class="line"></div>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">Rubros</legend>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Bien</label>
											<select name="bienID" id="bienID" class="form-control">
												<option value="0">Seleccione</option><?php $lBien=CrmBien::getList();foreach ($lBien as $obj) { ?>  
													<option value="<?php echo $obj->bienID; ?>"><?php echo $obj->description; ?></option><?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Servicio</label>
												<select name="servicioID" id="servicioID" class="form-control">
													<option value="0">Seleccione</option><?php  $lServicio=CrmServicio::getList();foreach ($lServicio as $obj) {?>  
														<option value="<?php echo $obj->servicioID; ?>"><?php echo $obj->description; ?></option><?php } ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
													<label>Otros</label>
													<input name="other" autocomplete="off" type="text" id="other" class="form-control" >
												</div>
											</div>
										</div>
									</fieldset>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Colocar la actividad brindada al cliente (Alcance de la homologación)</label>
												<input name="observation" autocomplete="off" type="text" id="observation" class="form-control" >
											</div>
										</div>
									</div> 
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Empresa a Homologarse</label>
												<select name="propxformID" id="propxformID" class="form-control">
													<option value="0">Seleccione</option><?php $lPropForm=CrmPropxForm::getList();foreach ($lPropForm as $obj) { $oPropuesta = CrmPropuesta::getItem($obj->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);?>  
														<option value="<?php echo $obj->propxformID; ?>"><?php echo $obj->titleForm; ?> - <?php echo $oCliente->businessName; ?></option><?php } ?>
													</select>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
									<div class="btn btn-primary" id="btn_guardar">Guardar Cambios</div>
								</div>
							</div>
						</div>
					</div>

					<script type="text/javascript">
						$(function(){
							$('.group-pais').hide();
							$("#department").change(function(event){ 
								var id = $("#department").find(':selected').val();
								$("#province").load('<?php echo $URL_ROOT;?>ajax/select-provincia.php?id='+id); 
							});

							$("#province").change(function(event){ 
								var idDep = $("#department").find(':selected').val();
								var idProv = $("#province").find(':selected').val();
								$("#district").load('<?php echo $URL_ROOT;?>ajax/select-distrito.php?idDep='+idDep+'&idProv='+idProv); 
							});

							$("#departmentLegal").change(function(event){ 
								var id = $("#departmentLegal").find(':selected').val();
								$("#provinceLegal").load('<?php echo $URL_ROOT;?>ajax/select-provincia.php?id='+id); 
							});

							$("#provinceLegal").change(function(event){ 
								var idDep = $("#departmentLegal").find(':selected').val();
								var idProv = $("#provinceLegal").find(':selected').val();
								$("#districtLegal").load('<?php echo $URL_ROOT;?>ajax/select-distrito.php?idDep='+idDep+'&idProv='+idProv); 
							});

							$( ".radio-type" ).on( "click", function() {
								if($( "input:checked" ).val() != '1'){
									$('.group-fijo').hide();
									$('.group-pais').show();
								}else{
									$('.group-fijo').show();
									$('.group-pais').hide();
								}				
							});

							$('#documentNumber').change(function(){
								if($('#documentNumber').val() != ''){
									$.getJSON('<?php echo $URL_ROOT;?>ajax/search_proveedor.php?documentNumber='+$('#documentNumber').val(), function(data) {
										if(data.retval==1){
											alertify.error('Proveedor ya registrado , Consultar a soporte BV');
											$('#documentNumber').focus(); 
										}
									});
								}
							});

							$('#btn_guardar').click(function(){

			//Validar documento de proveedor

			if($('#documentNumber').val() != ''){
				$.getJSON('<?php echo $URL_ROOT;?>ajax/search_proveedor.php?documentNumber='+$('#documentNumber').val(), function(data) {
					if(data.retval==1){
						alertify.error('Proveedor ya registrado , Consultar a soporte BV');
						$('#documentNumber').focus(); 
						return false;
					}
				});
			}

			if($('#documentNumber').val() == ''){ alertify.error('Ingrese el numero de documento.'); $('#documentNumber').focus(); return false; }
			if($('.radio-type').val() == ''){ alertify.error('Ingrese el tipo de proveedor.'); $('.radio-type').focus(); return false; }
			if($('#businessName').val() == ''){ alertify.error('Ingrese la razon social.'); $('#businessName').focus(); return false; }
			if($('#address').val() == ''){ alertify.error('Ingrese la direccion.'); $('#address').focus(); return false; }
			if($('#country').val() == ''){ alertify.error('Ingrese el pais.'); $('#country').focus(); return false; }
			if($('#phone').val() == ''){ alertify.error('Ingrese el numero de telefono.'); $('#phone').focus(); return false; }
			if($('#email').val() == ''){ alertify.error('Ingrese el e-mail.'); $('#email').focus(); return false; }
			if($('#contacts').val() == ''){ alertify.error('Ingrese los contactos.'); $('#contacts').focus(); return false; }
			if($('#other').val() == ''){ alertify.error('Ingrese otros servicios o bienes.'); $('#other').focus(); return false; }
			
			var fields2=$('#form_proveedor').serialize();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_proveedor.php?'+fields2, function(data) {
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