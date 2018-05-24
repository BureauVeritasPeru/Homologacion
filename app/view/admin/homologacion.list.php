<?php //Get MediaGroup
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->basePath;
?>
<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<section class="tables">   
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-homologacion">
					<div class="box box-default">
						<!-- /.box-header -->
						<div class="card-body">
							<div class="box-body">
								<table class="table table-bordered table-hover" width='100%' id="dataTables-example" style="display: block;width:100%;overflow-x: scroll;">
									<thead>
										<tr>
											<th width="35">&nbsp;</th>
											<th width="60"><?php echo $MODULE->getSortingHeader("homologacionID", "ID");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("period", "Periodo");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("clienteID", "Cliente");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("proveedorID", "Proveedor");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("ruc", "RUC");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("telefono", "Telefono");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("correo", "Correo");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("registerDate", "Fecha Registro");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("userID", "Homologador");?></th>
											<th width="120"><?php echo $MODULE->getSortingHeader("programDate", "Fecha Programada");?></th>
											<th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
										</tr>
									</thead>
									<tbody>
										<?php $list=CrmHomologacion::getList_Paging(); foreach ($list as $oItem) {  $oRequerimiento = CrmRequerimiento::GetItem($oItem->requerimientoID); 
											$oUser = AdmUser::getItem($oItem->userID);
											$oProveedor = CrmProveedor::GetItem($oRequerimiento->proveedorID); 
											$oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);  
											
											
											?>
											<tr> 
												<td>
													<?php if($oItem->state == 1){ ?>
														<a href="<?php echo "javascript:Edit(".$oItem->homologacionID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
														<a href="<?php echo "javascript:Anular(".$oItem->homologacionID.");"; ?>"><i class="fa fa-close"></i></a>&nbsp;&nbsp;
														<?php }elseif ($oItem->state == 2){ ?>
															<a href="<?php echo "javascript:Edit(".$oItem->homologacionID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
															<a href="<?php echo "javascript:Anular(".$oItem->homologacionID.");"; ?>"><i class="fa fa-close"></i></a>&nbsp;&nbsp;	
															<?php }elseif ($oItem->state == 3){ ?>
																<a href="<?php echo "javascript:Edit(".$oItem->homologacionID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
																<a href="<?php echo "javascript:Anular(".$oItem->homologacionID.");"; ?>"><i class="fa fa-close"></i></a>&nbsp;&nbsp;	
																<?php }elseif ($oItem->state == 4){ ?>
																	<a href="<?php echo "javascript:InformeGeneral(".$oItem->homologacionID.");"; ?>"><i class="fa fa-archive"></i></a>&nbsp;&nbsp;
																	<a href="<?php echo "javascript:ControlGeneral(".$oItem->homologacionID.");"; ?>"><i class="fa fa-undo"></i></a>&nbsp;&nbsp;
																	<a href="<?php echo "javascript:Aprobar(".$oItem->homologacionID.");"; ?>"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
																	<a href="<?php echo "javascript:Anular(".$oItem->homologacionID.");"; ?>"><i class="fa fa-close"></i></a>&nbsp;&nbsp;		
																	<?php }elseif ($oItem->state == 5){ ?>
																		<a href="<?php echo "/scs/homologacion/userfiles/".$oItem->certification; ?>" target="_blank"><i class="fa fa-clone"></i></a>&nbsp;&nbsp;
																		<a href="<?php echo "javascript:InformeGeneral(".$oItem->homologacionID.");"; ?>"><i class="fa fa-archive"></i></a>&nbsp;&nbsp;	
																		<?php }elseif ($oItem->state == 6){ ?>
																			<a href="<?php echo "javascript:Edit(".$oItem->homologacionID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;	
																			<?php }elseif ($oItem->state == 7){ ?>
																				<a href="<?php echo "javascript:Edit(".$oItem->homologacionID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
																				<?php }elseif ($oItem->state == 8){ ?>
																					<a href="<?php echo "javascript:Edit(".$oItem->homologacionID.");"; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
																					<a href="<?php echo "javascript:Anular(".$oItem->homologacionID.");"; ?>"><i class="fa fa-close"></i></a>&nbsp;&nbsp;
																					<?php } ?>
																				</td>
																				<td><?php echo $oItem->homologacionID; ?></td>
																				<td><?php echo $oRequerimiento->period; ?></td>
																				<td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
																				<td><?php echo htmlentities($oProveedor->businessName, ENT_QUOTES, "UTF-8"); ?></td>
																				<td><?php echo htmlentities($oProveedor->documentNumber, ENT_QUOTES, "UTF-8"); ?></td>
																				<td><?php echo htmlentities($oProveedor->phone, ENT_QUOTES, "UTF-8"); ?></td>
																				<td><?php echo htmlentities($oProveedor->email, ENT_QUOTES, "UTF-8"); ?></td>
																				<td><?php echo $oItem->registerDate; ?></td>
																				<td><?php if(isset($oItem->userID)){echo htmlentities($oUser->firstName.' '.$oUser->lastName, ENT_QUOTES, "UTF-8");} ?></td>
																				<td><?php echo htmlentities($oItem->programDate.' '.$oItem->hourDate.' - '.$oItem->hourEndDate, ENT_QUOTES, "UTF-8"); ?></td>
																				<td align="center"><?php echo CrmHomologacion::getState($oItem->state);?></td>
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

												</div>
											</div>
										</div>
									</section>
									<script type="text/javascript">
										$(document).ready(function(){
											CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
											CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
										});
									</script>
									<div class="modal bs-modal_upd_cert" id="ModalUpdateCert" tabindex="-1" role="dialog"  data-focus-on="input:first">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4>Seleccione un archivo:</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" name="homoID" id="homoID" >
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group">
																<label>Certificado de Auditoria</label>
																<div class="input-group">
																	<input name="fileCert" id="fileCert"  class="form-control fmanager" rel="<?php echo $media_group["homologacion_certificado"];?>" required="true" type="text" />
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
													<div class="btn btn-primary" id="btn_save_cert">Guardar Cambios</div>
												</div>
											</div>
										</div>
									</div>
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
											$('#dataTables-example').DataTable({
												dom: "<'row'<'col-sm-6'f><'col-sm-6'>>" +
												"<'row'<'col-sm-12'tr>>" +
												"<'row'<'col-sm-4'l><'col-sm-2'i><'col-sm-6'p>>"
											});


											$( "#btn_save_cert" ).click(function() {
												var homoID  		= $("#homoID").val();	
												var fileCert    	= $("#fileCert").val();

												$.getJSON('<?php echo $URL_ROOT;?>ajax/form_cert.php?homoID='+homoID+'&fileCert='+fileCert, function(data) {
													if(data.retval==1){
														alertify.success('Certificado registrado Correctamente');
														location.reload();
													}else{
														alertify.error('No se pudo insertar el certificado , Contactarse con Soporte - BV');
													}
												}).error(function(jqXHR, textStatus, errorThrown) {
													alertify.error("Error interno");
													console.log("error: " + textStatus);
													console.log("error thrown: " + errorThrown);
													console.log("incoming Text: " + jqXHR.responseText);
												});


											});
										});

										function Anular(ID){
											bootbox.confirm({
												title: "Homologacion - Bureau Veritas",
												message: "Estas seguro de anular la homologacion?",
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
														$.getJSON('<?php echo $URL_ROOT;?>ajax/anulacion_homologacion.php?homologacionID='+ID, function(data) {
															if(data.retval==1){
																alertify.success('Homologacion Anulada');
																location.reload();
															}else{
																alertify.error('No se pudo anular la homologacion , Contactarse con Soporte - BV');
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
										}

										function ControlGeneral(ID){
											bootbox.confirm({
												title: "Homologacion - Bureau Veritas",
												message: "Estas seguro de generar Control General a la homologacion?",
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
														$.getJSON('<?php echo $URL_ROOT;?>ajax/control_general_homologacion.php?homologacionID='+ID, function(data) {
															if(data.retval==1){
																alertify.success('Control General Iniciado');
																location.reload();
															}else{
																alertify.error('No se pudo generar el control a la homologacion , Contactarse con Soporte - BV');
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
										}

										function Aprobar(ID){
											$('#ModalUpdateCert').modal('show');
											$('#homoID').val(ID);
											return false;
										}	

										function InformeGeneral(ID){
											window.open('<?php echo $URL_ROOT;?>ajax/informe_general.php?homologacionID='+ID,'_blank');
										}



									</script>