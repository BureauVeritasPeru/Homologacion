<?php
$userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
	function on_submit(xform){
		xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
		xform.submit();
	} 
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
								<h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->ruc:$MODULE->moduleName; ?></h2>
							</div>
						</div>
						<?php 
						if($MODULE->FormView=="edit"){
							$oProveedor = CrmProveedor::getItem($oItem->proveedorID);
							$oPropxform = CrmPropxForm::getItem($oItem->propxformID);
						} 
						?>
						<div class="card-body">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label ">Nro. Requerimiento</label>
									<div class="col-sm-10">
										<?php
										if($MODULE->FormView=="edit"){
											echo '<strong>'.$oItem->requerimientoID.'</strong>';
											echo '<input type="hidden" name="requerimientoID" value="'.$oItem->requerimientoID.'" />';
										}
										else{
											echo '<input name="requerimientoID" class="form-control" type="text" id="requerimientoID" value="'.$oItem->requerimientoID.'" size="20" maxlength="15">';
										}
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Proveedor</label>
									<div class="col-sm-10">
										<input autocomplete="off" type="text" id="businessName" readonly class="form-control disabled" value="<?php echo $oProveedor->businessName; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Direcci&oacute;n</label>
									<div class="col-sm-10">
										<input  autocomplete="off" type="text" id="address" readonly class="form-control disabled" value="<?php echo $oProveedor->address; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Telefono</label>
									<div class="col-sm-10">
										<input autocomplete="off" type="text" id="phone" readonly class="form-control disabled" value="<?php echo $oProveedor->phone; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Email</label>
									<div class="col-sm-10">
										<input  autocomplete="off" type="text" id="email" readonly class="form-control disabled" value="<?php echo $oProveedor->email; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Contactos</label>
									<div class="col-sm-10">
										<input  autocomplete="off" type="text" id="contacts" readonly class="form-control disabled" value="<?php echo $oProveedor->contacts; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Observacion</label>
									<div class="col-sm-10">
										<textarea name="observation" id="observation" class="form-control"><?php echo $oItem->observation; ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Costo</label>
									<div class="col-sm-10">
										<input  autocomplete="off" type="text" id="amount" readonly class="form-control disabled" value="<?php echo $oPropxform->amount; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Abonado</label>
									<div class="col-sm-10">
										<input  autocomplete="off" type="text" id="amount" readonly class="form-control disabled" value="<?php echo $oItem->amount; ?>">
									</div>
								</div>
								<div class="line"></div>
								<?php if($oItem->state == 1 && $oAdmUser->profileID != 4 ){ ?>
								<div class="form-group">
									<label class="col-sm-2 control-label ">Estado</label>
									<div class="col-sm-10">
										<label for="radio1">
											<input type="radio" class="radio-template" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>
											En Proceso
										</label>&nbsp;&nbsp;
										<label for="radio2">
											<input type="radio" class="radio-template" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>
											Aprobado
										</label>&nbsp;&nbsp;
										<label for="radio3">
											<input type="radio" class="radio-template" id="radio3" name="state" value="4" <?php if($oItem->state==4) echo "checked";?>>
											Anulado
										</label>&nbsp;&nbsp;
										<label for="radio3">
											<input type="radio" class="radio-template" id="radio3" name="state" value="5" <?php if($oItem->state==5) echo "checked";?>>
											No Participa
										</label>
									</div>
								</div>
								<?php } ?>
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