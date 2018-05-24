<?php
$userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
	function on_submit(xform){
		xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
		xform.submit();
	}
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
		$("#ruc").change(function(event){ 
			var ruc = $("#ruc").val();
			$("#user").val(ruc);
		});

		$(".getNewPass").click(function(){
			var pass = $("#pass");
			$('#pass').val(randString(pass));
			console.log(randString(pass));
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

	});
</script>
<section class="tables">   
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="box box-default">
						<div class="card-close">
							<div class="dropdown">
								<button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
								<div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a onClick="javascript:Back();" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
							</div>
						</div>
						<div class="card-header">
							<div class="box-header">
								<h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->documentNumber:$MODULE->moduleName; ?></h2>
							</div>
						</div>
						<div class="card-body">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label ">Nro. Documento</label>
									<div class="col-sm-10">
										<?php
										if($MODULE->FormView=="edit"){
											echo '<strong>'.$oItem->documentNumber.'</strong>';
											echo '<input type="hidden" name="documentNumber" value="'.$oItem->documentNumber.'" />';
										}
										else{
											echo '<input name="documentNumber" class="form-control" type="text" id="documentNumber" value="'.$oItem->documentNumber.'" size="20" maxlength="15">';
										}
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Tipo de Proveedor</label>
									<div class="col-sm-10">
										<label for="typeProvider1">
											<input type="radio" class="radio-template radio-type" id="typeProvider1" name="typeProvider" value="1" <?php if($MODULE->FormView=="edit"){if($oItem->typeProvider==1) echo "checked";}else{ echo "checked";} ?>>
											Nacional
										</label>&nbsp;&nbsp;
										<label for="typeProvider2">
											<input type="radio" class="radio-template radio-type" id="typeProvider2" name="typeProvider" value="2" <?php if($oItem->typeProvider==2) echo "checked";?>>
											Extranjero
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Raz&oacute;n Social</label>
									<div class="col-sm-10">
										<input name="businessName" autocomplete="off" type="text" id="businessName" class="form-control" value="<?php echo $oItem->businessName; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Direcci&oacute;n</label>
									<div class="col-sm-10">
										<input name="address" autocomplete="off" type="text" id="address" class="form-control" value="<?php echo $oItem->address; ?>">
									</div>
								</div>
								<div class="form-group group-pais">
									<label class="col-sm-2 control-label">País</label>
									<div class="col-sm-10">
										<select name="country" id="country" class="form-control">
											<option value="0">Seleccione</option><?php $lCountry=UbgCountry::getList(); foreach ($lCountry as $obj) { ?>
											<option value="<?php echo $obj->countryID; ?>" <?php if($MODULE->FormView=="edit"){ if($obj->countryID==$oItem->country) echo 'selected="true"';} ?>><?php echo $obj->countryName; ?></option><?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group group-fijo">
									<label class="col-sm-2 control-label">Departamento</label>
									<div class="col-sm-10">
										<select name="department" id="department" class="form-control">
											<option value="0">Seleccione</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
											<option value="<?php echo $obj->cod_dpto; ?>" <?php if($MODULE->FormView=="edit"){ if($obj->cod_dpto==$oItem->department) echo 'selected="true"';} ?>><?php echo $obj->nombre; ?></option><?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group group-fijo">
									<label class="col-sm-2 control-label ">Provincia</label>
									<div class="col-sm-10">
										<select name="province" id="province" class="form-control">
											<option value="0">Seleccione</option><?php if($MODULE->FormView=="edit"){ $lProv=CrmUbigeo::getProvincia_List($oItem->department);foreach ($lProv as $obj) {?>  
											<option value="<?php echo $obj->cod_prov; ?>" <?php if($obj->cod_prov==$oItem->province) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option><?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group group-fijo">
									<label class="col-sm-2 control-label ">Distrito</label>
									<div class="col-sm-10">
										<select name="district" id="district" class="form-control">
											<option value="0">Seleccione</option><?php if($MODULE->FormView=="edit"){ $lDist=CrmUbigeo::getDistrito_List($oItem->department,$oItem->province);foreach ($lDist as $obj) {?>  
											<option value="<?php echo $obj->cod_dist; ?>" <?php if($obj->cod_dist==$oItem->district) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option><?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Codigo Postal</label>
									<div class="col-sm-10">
										<input name="postalCode" autocomplete="off" type="text" id="postalCode" class="form-control" value="<?php echo $oItem->postalCode; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Tel&eacute;fono</label>
									<div class="col-sm-10">
										<input name="phone" autocomplete="off" type="text" id="phone" class="form-control" value="<?php echo $oItem->phone; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Fax</label>
									<div class="col-sm-10">
										<input name="fax" autocomplete="off" type="text" id="fax" class="form-control" value="<?php echo $oItem->fax; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">E-mail</label>
									<div class="col-sm-10">
										<input name="email" autocomplete="off" type="text" id="email" class="form-control" value="<?php echo $oItem->email; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Contactos</label>
									<div class="col-sm-10">
										<textarea name="contacts" id="contacts" class="form-control"><?php echo $oItem->contacts; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Direccion Legal</label>
									<div class="col-sm-10">
										<input name="legalDirection" autocomplete="off" type="text" id="legalDirection" class="form-control" value="<?php echo $oItem->legalDirection; ?>">
									</div>
								</div>
								<div class="form-group group-fijo">
									<label class="col-sm-2 control-label ">Departamento Legal</label>
									<div class="col-sm-10">
										<select name="departmentLegal" id="departmentLegal" class="form-control">
											<option value="0">Seleccione</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
											<option value="<?php echo $obj->cod_dpto; ?>" <?php if($MODULE->FormView=="edit"){ if($obj->cod_dpto==$oItem->departmentLegal) echo 'selected="true"';} ?>><?php echo $obj->nombre; ?></option><?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group group-fijo">
									<label class="col-sm-2 control-label ">Provincia Legal</label>
									<div class="col-sm-10">
										<select name="provinceLegal" id="provinceLegal" class="form-control">
											<option value="0">Seleccione</option><?php if($MODULE->FormView=="edit"){ $lProv=CrmUbigeo::getProvincia_List($oItem->departmentLegal);foreach ($lProv as $obj) {?>  
											<option value="<?php echo $obj->cod_prov; ?>" <?php if($obj->cod_prov==$oItem->provinceLegal) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option><?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group group-fijo">
									<label class="col-sm-2 control-label ">Distrito Legal</label>
									<div class="col-sm-10">
										<select name="districtLegal" id="districtLegal" class="form-control">
											<option value="0">Seleccione</option><?php if($MODULE->FormView=="edit"){ $lDist=CrmUbigeo::getDistrito_List($oItem->departmentLegal,$oItem->provinceLegal);foreach ($lDist as $obj) {?>  
											<option value="<?php echo $obj->cod_dist; ?>" <?php if($obj->cod_dist==$oItem->districtLegal) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option><?php }} ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Representante Legal</label>
									<div class="col-sm-10">
										<input name="legalRepresentative" autocomplete="off" type="text" id="legalRepresentative" class="form-control" value="<?php echo $oItem->legalRepresentative; ?>">
									</div>
								</div>
								<div class="line"></div>
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Contacto Comercial</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Nombre</label>
										<div class="col-sm-10">
											<input name="commercialContactName" autocomplete="off" type="text" id="commercialContactName" class="form-control" value="<?php echo $oItem->commercialContactName; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Teléfono</label>
										<div class="col-sm-10">
											<input name="commercialContactPhone" autocomplete="off" type="text" id="commercialContactPhone" class="form-control" value="<?php echo $oItem->commercialContactPhone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Celular</label>
										<div class="col-sm-10">
											<input name="commercialContactCellphone" autocomplete="off" type="text" id="commercialContactCellphone" class="form-control" value="<?php echo $oItem->commercialContactCellphone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">E-mail</label>
										<div class="col-sm-10">
											<input name="commercialContactEmail" autocomplete="off" type="text" id="commercialContactEmail" class="form-control" value="<?php echo $oItem->commercialContactEmail; ?>">
										</div>
									</div>
								</fieldset>
								<div class="line"></div>
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Gerente General</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Nombre</label>
										<div class="col-sm-10">
											<input name="generalManagerName" autocomplete="off" type="text" id="generalManagerName" class="form-control" value="<?php echo $oItem->generalManagerName; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Teléfono</label>
										<div class="col-sm-10">
											<input name="generalManagerPhone" autocomplete="off" type="text" id="generalManagerPhone" class="form-control" value="<?php echo $oItem->generalManagerPhone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Celular</label>
										<div class="col-sm-10">
											<input name="generalManagerCellphone" autocomplete="off" type="text" id="generalManagerCellphone" class="form-control" value="<?php echo $oItem->generalManagerCellphone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">E-mail</label>
										<div class="col-sm-10">
											<input name="generalManagerEmail" autocomplete="off" type="text" id="generalManagerEmail" class="form-control" value="<?php echo $oItem->generalManagerEmail; ?>">
										</div>
									</div>
								</fieldset>
								<div class="line"></div>
								<fieldset class="scheduler-border">
									<legend class="scheduler-border">Rubros*</legend>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Bien</label>
										<div class="col-sm-10">
											<select name="bienID" id="bienID" class="form-control" autocomplete="off">
												<option value="0">Seleccione</option><?php $list= CrmBien::getList(); foreach ($list as $obj) { echo "<option value=\"".$obj->bienID."\""; if($oItem->bienID == $obj->bienID){echo ' selected ';} echo ">".$obj->description."</option>";}?> 
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Servicio</label>
										<div class="col-sm-10">
											<select name="servicioID" id="servicioID" class="form-control" autocomplete="off">
												<option value="0">Seleccione</option><?php $list= CrmServicio::getList(); foreach ($list as $obj) { echo "<option value=\"".$obj->servicioID."\""; if($oItem->servicioID == $obj->servicioID){echo ' selected ';} echo ">".$obj->description."</option>";}?> 
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label ">Otros</label>
										<div class="col-sm-10">
											<input name="other" autocomplete="off" type="text" id="other" class="form-control" value="<?php echo $oItem->other; ?>">
										</div>
									</div>

								</fieldset>
								<div class="line"></div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Numeros de Colaboradores Administrativos</label>
									<div class="col-sm-10">
										<input name="numberCollaborateAdmin" id="numberCollaborateAdmin" class="form-control" value="<?php echo $oItem->numberCollaborateAdmin; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Numeros de Colaboradores Operativos</label>
									<div class="col-sm-10">
										<input name="numberCollaborateOper" id="numberCollaborateOper" class="form-control" value="<?php echo $oItem->numberCollaborateOper; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Turnos de trabajo</label>
									<div class="col-sm-10">
										<input name="workShifts" id="workShifts" class="form-control" value="<?php echo $oItem->workShifts; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Accionistas de la empresa 1</label>
									<div class="col-sm-10">
										<input name="businessAction1" id="businessAction1" class="form-control" value="<?php echo $oItem->businessAction1; ?>"> 
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Porcentaje de Participante 1</label>
									<div class="col-sm-10">
										<input name="percentageParticipant1" id="percentageParticipant1" class="form-control" value="<?php echo $oItem->percentageParticipant1; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Accionistas de la empresa 2</label>
									<div class="col-sm-10">
										<input name="businessAction2" id="businessAction2" class="form-control" value="<?php echo $oItem->businessAction2; ?>"> 
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Porcentaje de Participante 2</label>
									<div class="col-sm-10">
										<input name="percentageParticipant2" id="percentageParticipant2" class="form-control" value="<?php echo $oItem->percentageParticipant2; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Accionistas de la empresa 3</label>
									<div class="col-sm-10">
										<input name="businessAction3" id="businessAction3" class="form-control" value="<?php echo $oItem->businessAction3; ?>"> 
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Porcentaje de Participante 3</label>
									<div class="col-sm-10">
										<input name="percentageParticipant3" id="percentageParticipant3" class="form-control" value="<?php echo $oItem->percentageParticipant3; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Gremios y Asociaciones a los que pertenece</label>
									<div class="col-sm-10">
										<input name="partnerships" id="partnerships" class="form-control" value="<?php echo $oItem->partnerships; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Actividad Economica</label>
									<div class="col-sm-10">
										<input name="ecoActivity" id="ecoActivity" class="form-control" value="<?php echo $oItem->ecoActivity; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Aporte Retencion IGV</label>
									<div class="col-sm-10">
										<label for="radio1IGV">
											<input type="radio" class="radio-template" id="radio1IGV" name="retentionIgv" value="1" <?php if($oItem->retentionIgv==1) echo "checked";?>>
											Si
										</label>&nbsp;&nbsp;
										<label for="radio2IGV">
											<input type="radio" class="radio-template" id="radio2IGV" name="retentionIgv" value="0" <?php if($oItem->retentionIgv==0) echo "checked";?>>
											No
										</label>&nbsp;&nbsp;
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Observacion</label>
									<div class="col-sm-10">
										<textarea name="observation" id="observation" class="form-control"><?php echo $oItem->observation; ?></textarea>
									</div>
								</div>
								<div class="line"></div>

								<div class="form-group">
									<label class="col-sm-2 control-label ">Usuario</label>
									<div class="col-sm-10">
										<input name="user" autocomplete="off" type="text" id="user" class="form-control" value="<?php echo $oItem->user; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Password</label>
									<div class="col-sm-10">
										<div class="input-group">
											<input name="pass" style="z-index:1 " data-size="10" data-character-set="a-z,A-Z" autocomplete="off" type="text" id="pass" readOnly class="form-control" value="<?php echo $oItem->pass; ?>"><span class="input-group-btn"><button type="button" class="btn btn-default getNewPass"><span class="fa fa-refresh"></span></button></span>
										</div>
									</div>
								</div>
								<div class="line"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Estado</label>
									<div class="col-sm-10">
										<label for="radio1">
											<input type="radio" class="radio-template" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>

											Activo
										</label>&nbsp;&nbsp;
										<label for="radio2">
											<input type="radio" class="radio-template" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>

											Bloqueado
										</label>&nbsp;&nbsp;

										<label for="radio3">
											<input type="radio" class="radio-template" id="radio3" name="state" value="0" <?php if($oItem->state==0) echo "checked";?>>

											Inactivo
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="card-footer">
							<div class="box-footer">
								<input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
								<input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>