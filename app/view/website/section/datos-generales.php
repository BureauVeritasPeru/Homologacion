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
				<h1>Datos Generales</h1>
				<br>
				<form id="form_proveedor" >
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nro. Documento *</label><br>
								<strong><?php echo $oProveedor->documentNumber; ?></strong>
								<input type="hidden" name="documentNumber" value="<?php echo $oProveedor->documentNumber; ?>">
								<input type="hidden" name="proveedorID" value="<?php echo $oProveedor->proveedorID; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Tipo de Proveedor *</label><br>
								<label for="typeProvider1">
									<input type="radio" class="radio-template radio-type" id="typeProvider1" name="typeProvider" value="1" <?php if($oProveedor->typeProvider == 1){ echo 'checked'; } ?>>
									Nacional
								</label>&nbsp;&nbsp;
								<label for="typeProvider2">
									<input type="radio" class="radio-template radio-type" id="typeProvider2" name="typeProvider" value="2" <?php if($oProveedor->typeProvider == 2){ echo 'checked'; } ?>>
									Extranjero
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Raz&oacute;n Social *</label>
								<input name="businessName" autocomplete="off" type="text" id="businessName" class="form-control" value="<?php echo $oProveedor->businessName; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Direcci&oacute;n *</label>
								<input name="address" autocomplete="off" type="text" id="address" class="form-control" value="<?php echo $oProveedor->address; ?>">
							</div>
						</div>
					</div>
					<div class="row ">
						<div class="col-sm-6 group-pais">
							<div class="form-group">
								<label>País *</label>
								<select name="country" id="country" class="form-control">
									<option value="0">Seleccione</option><?php $lCountry=UbgCountry::getList(); foreach ($lCountry as $obj) { ?>
										<option value="<?php echo $obj->countryID; ?>" <?php if($obj->countryID == $oProveedor->country){ echo 'selected';} ?>><?php echo $obj->countryName; ?></option><?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Codigo Postal</label>
									<input name="postalCode" autocomplete="off" type="text" id="postalCode" class="form-control" value="<?php echo $oProveedor->postalCode; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 group-fijo">
								<div class="form-group">
									<label>Departamento</label>
									<select name="department" id="department" class="form-control">
										<option value="0">Seleccione</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
											<option value="<?php echo $obj->cod_dpto; ?>" <?php if($obj->cod_dpto == $oProveedor->department){ echo 'selected';} ?>><?php echo $obj->nombre; ?></option><?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Tel&eacute;fono *</label>
										<input name="phone" autocomplete="off" type="text" id="phone" class="form-control" value="<?php echo $oProveedor->phone; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 group-fijo">
									<div class="form-group">
										<label>Provincia</label>
										<select name="province" id="province" class="form-control">
											<?php if(isset($oProveedor->province)){ $province = CrmUbigeo::getProvincia_Item($oProveedor->department,$oProveedor->province); ?>
												<option value="<?php echo $oProveedor->province; ?>"><?php echo $province->nombre; ?></option>
												<?php }else{ ?>
													<option value="0">Seleccione</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Fax</label>
												<input name="fax" autocomplete="off" type="text" id="fax" class="form-control" value="<?php echo $oProveedor->fax; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 group-fijo">
											<div class="form-group ">
												<label>Distrito</label>
												<select name="district" id="district" class="form-control">
													<?php if(isset($oProveedor->province)){ $district = CrmUbigeo::getDistrito_Item($oProveedor->department,$oProveedor->province,$oProveedor->district); ?>
														<option value="<?php echo $oProveedor->district; ?>"><?php echo $district->nombre; ?></option>
														<?php }else{ ?>
															<option value="0">Seleccione</option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>E-mail *</label>
														<input name="email" autocomplete="off" type="text" id="email" class="form-control" value="<?php echo $oProveedor->email; ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label>Contactos *</label>
														<textarea name="contacts" id="contacts" class="form-control" ><?php echo $oProveedor->contacts; ?></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="form-group">
														<label>Direccion Legal</label>
														<input name="legalDirection" autocomplete="off" type="text" id="legalDirection" class="form-control" value="<?php echo $oProveedor->legalDirection; ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Departamento Legal</label>
														<select name="departmentLegal" id="departmentLegal" class="form-control">
															<option value="0">Seleccione</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
																<option value="<?php echo $obj->cod_dpto; ?>" <?php if($obj->cod_dpto == $oProveedor->departmentLegal){ echo 'selected'; } ?>><?php echo $obj->nombre; ?></option><?php } ?>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Representante Legal</label>
															<input name="legalRepresentative" autocomplete="off" type="text" id="legalRepresentative" class="form-control" value="<?php echo $oProveedor->legalRepresentative; ?>">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Provincia Legal</label>
															<select name="provinceLegal" id="provinceLegal" class="form-control">
																<?php if($oProveedor->provinceLegal != 0){ $provinceLegal = CrmUbigeo::getProvincia_Item($oProveedor->departmentLegal,$oProveedor->provinceLegal); ?>
																	<option value="<?php echo $oProveedor->provinceLegal; ?>"><?php echo $provinceLegal->nombre; ?></option>
																	<?php }else{ ?>
																		<option value="0">Seleccione</option>
																		<?php } ?>
																	</select>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group">
																	<label>Distrito Legal</label>
																	<select name="districtLegal" id="districtLegal" class="form-control">
																		<?php if($oProveedor->districtLegal != 0){ $districtLegal = CrmUbigeo::getDistrito_Item($oProveedor->departmentLegal,$oProveedor->provinceLegal,$oProveedor->districtLegal); ?>
																			<option value="<?php echo $oProveedor->districtLegal; ?>"><?php echo $districtLegal->nombre; ?></option>
																			<?php }else{ ?>
																				<option value="0">Seleccione</option>
																				<?php } ?>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="line"></div>
																<fieldset class="scheduler-border">
																	<legend class="scheduler-border">Contacto para la Auditoria *</legend>
																	<div class="row">
																		<div class="col-sm-12">
																			<div class="form-group">
																				<label>Nombre</label>
																				<input name="commercialContactName" autocomplete="off" type="text" id="commercialContactName" class="form-control" value="<?php echo $oProveedor->commercialContactName; ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm-6">
																			<div class="form-group">
																				<label>Teléfono</label>
																				<input name="commercialContactPhone" autocomplete="off" type="text" id="commercialContactPhone" class="form-control" value="<?php echo $oProveedor->commercialContactPhone; ?>">
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group">
																				<label>Celular</label>
																				<input name="commercialContactCellphone" autocomplete="off" type="text" id="commercialContactCellphone" class="form-control" value="<?php echo $oProveedor->commercialContactCellphone; ?>">
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm-12">
																			<div class="form-group">
																				<label>E-mail</label>
																				<input name="commercialContactEmail" autocomplete="off" type="text" id="commercialContactEmail" class="form-control" value="<?php echo $oProveedor->commercialContactEmail; ?>">
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
																				<input name="generalManagerName" autocomplete="off" type="text" id="generalManagerName" class="form-control" value="<?php echo $oProveedor->generalManagerName; ?>" >
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm-6">
																			<div class="form-group">
																				<label>Teléfono</label>
																				<input name="generalManagerPhone" autocomplete="off" type="text" id="generalManagerPhone" class="form-control" value="<?php echo $oProveedor->generalManagerPhone; ?>" >
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group">
																				<label>Celular</label>
																				<input name="generalManagerCellphone" autocomplete="off" type="text" id="generalManagerCellphone" class="form-control" value="<?php echo $oProveedor->generalManagerCellphone; ?>" >
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-sm-12">
																			<div class="form-group">
																				<label>E-mail</label>
																				<input name="generalManagerEmail" autocomplete="off" type="text" id="generalManagerEmail" class="form-control"  value="<?php echo $oProveedor->generalManagerEmail; ?>" >
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
																						<option value="<?php echo $obj->bienID; ?>" <?php if($obj->bienID == $oProveedor->bienID){ echo 'selected';} ?>><?php echo $obj->description; ?></option><?php } ?>
																					</select>
																				</div>
																			</div>
																			<div class="col-sm-6">
																				<div class="form-group">
																					<label>Servicio</label>
																					<select name="servicioID" id="servicioID" class="form-control">
																						<option value="0">Seleccione</option><?php  $lServicio=CrmServicio::getList();foreach ($lServicio as $obj) {?>  
																							<option value="<?php echo $obj->servicioID; ?>" <?php if($obj->servicioID == $oProveedor->servicioID){ echo 'selected';} ?>><?php echo $obj->description; ?></option><?php } ?>
																						</select>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm-12">
																					<div class="form-group">
																						<label>Otros</label>
																						<input name="other" autocomplete="off" type="text" id="other" class="form-control" value="<?php echo $oProveedor->other; ?>">
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm-12">
																					<div class="form-group">
																						<label>Colocar la actividad brindada al cliente (Alcance de la homologación)</label>
																						<input name="observation" autocomplete="off" type="text" id="observation" class="form-control" value="<?php echo $oProveedor->observation; ?>">
																					</div>
																				</div>
																			</div>
																			
																		</fieldset>
																		<div class="row">
																			<div class="col-sm-7">&nbsp;</div>&nbsp;&nbsp;
																			<a class="col-sm-2 btn btn-secondary" href="javascript:history.back();">Cerrar</a> &nbsp;&nbsp;
																			<div class="col-sm-2 btn btn-primary" id="btn_guardar">Actualizar Cambios</div>

																		</div>
																	</form>
																</section>
																<br>
																<br>
																<!-- Modal -->
																<div id="myModalThanks" class="modal bs-Thanks" tabindex="-1" role="dialog" data-focus-on="input:first">
																	<div class="modal-dialog modal-lg" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLabel">Muchas Gracias!</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">&times;</span>
																				</button>
																			</div>
																			<div class="modal-body">
																				<p style="text-align: left;">Estimado <strong><?php echo $oProveedor->businessName; ?></strong>,</p>
																				<p style="text-align: left;">Muchas gracias por completar sus datos de formulario , para poder continuar con el proceso se le solicita que cierre sesion y vuelva a loguearse con nosotros.</p><br>
																				<p style="text-align: left;">Atte.<br>Bureau Veritas del Perú</p>
																			</div>
																			<div class="modal-footer">
																				<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
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

																		$('#btn_guardar').click(function(){
																			if($('.radio-type').val() == ''){ alertify.error('Ingrese el tipo de proveedor.'); $('.radio-type').focus(); return false; }
																			if($('#businessName').val() == ''){ alertify.error('Ingrese la razon social.'); $('#businessName').focus(); return false; }
																			if($('#address').val() == ''){ alertify.error('Ingrese la direccion.'); $('#address').focus(); return false; }
																			if($('#country').val() == ''){ alertify.error('Ingrese el pais.'); $('#country').focus(); return false; }
																			if($('#phone').val() == ''){ alertify.error('Ingrese el numero de telefono.'); $('#phone').focus(); return false; }
																			if($('#email').val() == ''){ alertify.error('Ingrese el e-mail.'); $('#email').focus(); return false; }
																			if($('#contacts').val() == ''){ alertify.error('Ingrese los contactos.'); $('#contacts').focus(); return false; }
																			if($('#other').val() == ''){ alertify.error('Ingrese otros servicios o bienes.'); $('#other').focus(); return false; }
																			if($('#commercialContactName').val() == ''){ alertify.error('Ingrese Nombre de Contacto para la auditoria.'); $('#commercialContactName').focus(); return false; }
																			if($('#commercialContactPhone').val() == ''){ alertify.error('Ingrese Telefono de Contacto para la auditoria.'); $('#commercialContactPhone').focus(); return false; }
																			if($('#commercialContactCellphone').val() == ''){ alertify.error('Ingrese Celular de Contacto para la auditoria.'); $('#commercialContactCellphone').focus(); return false; }
																			if($('#commercialContactEmail').val() == ''){ alertify.error('Ingrese Email de Contacto para la auditoria.'); $('#commercialContactEmail').focus(); return false; }

																			var fields2=$('#form_proveedor').serialize();
																			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_proveedor.php?'+fields2, function(data) {
																				if(data.retval==1){
																					alertify.success(data.message);
																					<?php if($oProveedor->state != 1){ ?>$('.bs-Thanks').modal('show');<?php } ?>
																					setTimeout(function(){
																						<?php if($oProveedor->state != 1){ ?>location.href='/scs/homologacion/?cmd=logoff';<?php }else{ ?>location.href='#';<?php } ?>
																					}, 4000);
																				}else{
																					alertify.error(data.message);
																				}
																			});
																		});
																	});
																</script>
															</div>
														</main>