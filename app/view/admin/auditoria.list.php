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
								<h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?'Homologacion : '.$oItem->homologacionID:$MODULE->moduleName; ?>
							</h2>
						</div>
					</div>
					<div class="card-body">
						<div class="box-body">
							<div class="row">
								<div class="col-sm-3">
									&nbsp;&nbsp;
								</div>
								<div class="col-sm-6">
									<label>Auditor</label>
									<select name="valUserID" id="valUserID" class="form-control">
										<option value="0">Seleccione</option><?php $list= AdmUser::getListHomologador(); foreach ($list as $obj) { echo "<option value=\"".$obj->userID."\"";  echo ">".$obj->firstName.' '.$obj->lastName."</option>";}?>
									</select>
								</div>
								<div class="col-sm-3">
									&nbsp;&nbsp;
								</div>
								<div class="col-sm-12">
									<div class="calendar"></div>
								</div>
								<div class="col-sm-12">
									<input type="hidden" name="homologacionHidID" id="homologacionHidID">
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Listado de Visitas</legend>
										<div class="row">
											<div class="col-sm-12">
												<table class="table table-bordered table-hover" width='100%' id="dataTables-example">
													<thead>
														<tr>
															<th width="120"><?php echo $MODULE->getSortingHeader("homologacionID", "ID");?></th>
															<th width="120"><?php echo $MODULE->getSortingHeader("userID", "Homologador");?></th>
															<th width="60"><?php echo $MODULE->getSortingHeader("programDate", "Fecha de Homologacion");?></th>
															<th width="15">&nbsp;</th>
														</tr>
													</thead>
													<tbody class="list-homologacion">
													</tbody>
												</table>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Fecha</label>
												<input name="valProgramDate" type="text" class="form-control" id="valProgramDate"  placeholder="Ingrese Fecha" maxlength="100" readOnly >
											</div>
											<div class="col-sm-6">
												<label>Homologacion</label>
												<select name="homologacionID" id="homologacionID" class="form-control">
													<option value="0">Seleccione</option><?php $list= CrmHomologacion::getListxProgramar(); foreach ($list as $obj) { echo "<option value=\"".$obj->homologacionID."\""; if($obj->homologacionID == $oItem->homologacionID){ echo 'selected'; } echo ">".$obj->homologacionID."</option>";}?>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-5">
												<label>Hora de Inicio </label>
												<input name="valHourDate" type="text" class="form-control" id="valHourDate" placeholder="Ingrese Hora" maxlength="100" > 
											</div>
											<div class="col-sm-5">
												<label>Hora de Fin </label>
												<input name="valHourEndDate" type="text" class="form-control" id="valHourEndDate" placeholder="Ingrese Hora" maxlength="100"> 
											</div>
											<div class="col-sm-2">
												.<label>&nbsp;</label>
												<div class="btn btn-primary btn-block" name="btnAddProgramacion" id="btnAddProgramacion"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Programar</div>
											</div>
										</div>
									</fieldset>
								</div>
								<div class="col-sm-12">
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Listado de Procesos</legend>
										<div class="row">
											<div class="col-sm-12">
												<table class="table table-bordered table-hover" width='100%' id="dataTables-example">
													<thead>
														<tr>
															<th width="120"><?php echo $MODULE->getSortingHeader("procesoID", "ID");?></th>
															<th width="120"><?php echo $MODULE->getSortingHeader("process", "Proceso");?></th>
															<th width="60"><?php echo $MODULE->getSortingHeader("programDate", "Fecha de Proceso");?></th>
															<th width="15">&nbsp;</th>
														</tr>
													</thead>
													<tbody class="list-proceso">
													</tbody>
												</table>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<label>Fecha</label>
												<input name="valProgramDate_p" type="text" class="form-control" id="valProgramDate_p"  placeholder="Ingrese Fecha" maxlength="100" readOnly >
											</div>
											<div class="col-sm-4">
												<label>Hora de Inicio </label>
												<input name="valHourDate_p" type="text" class="form-control" id="valHourDate_p" placeholder="Ingrese Hora" maxlength="100" > 
											</div>
											<div class="col-sm-4">
												<label>Hora de Fin</label>
												<input name="valHourEndDate_p" type="text" class="form-control" id="valHourEndDate_p" placeholder="Ingrese Hora" maxlength="100"> 
											</div>
										</div>
										<div class="row">
											<div class="col-sm-10">
												<label>Proceso</label>
												<input type="text" name="process_p" id="process_p" class="form-control" placeholder="Ingrese el proceso" maxlength="100">
											</div>
											<div class="col-sm-2">
												.<label>&nbsp;</label>
												<div class="btn btn-primary btn-block" name="btnAddProceso" id="btnAddProceso"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Generar Proceso</div>
											</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<!-- Inicio Modal Contacto  -->
<div id="myModalcalendar" class="modal bs-Reprogramacion" tabindex="-1" role="dialog" data-focus-on="input:first">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="gridSystemModalLabel">Calendario de Auditores</h4>
				<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<input type="hidden" name="homologacionID_r" id="homologacionID_r">
							<div class="col-sm-3">
								<label>Fecha</label>
								<input name="valProgramDate" type="date" class="form-control" id="valProgramDate_r"  placeholder="Ingrese Fecha">
							</div>
							<div class="col-sm-3">
								<label>Hora de Inicio </label>
								<input name="valHourDate" type="text" class="form-control" id="valHourDate_r" placeholder="Ingrese Hora" maxlength="100" value="<?php echo $oItem->hourDate; ?>"> 
							</div>
							<div class="col-sm-3">
								<label>Hora de Fin </label>
								<input name="valHourEndDate" type="text" class="form-control" id="valHourEndDate_r" placeholder="Ingrese Hora" maxlength="100" value="<?php echo $oItem->hourEndDate; ?>"> 
							</div>
							<div class="col-sm-3">
								<label>Auditor</label>
								<select name="valUserID" id="valUserID_r" class="form-control">
									<option value="0">Seleccione</option><?php $list= AdmUser::getListHomologador(); foreach ($list as $obj) { echo "<option value=\"".$obj->userID."\""; if($obj->userID == $oItem->userID){ echo 'selected'; } echo ">".$obj->firstName.' '.$obj->lastName."</option>";}?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-sm-5">
						<div class="btn btn-primary btn-block" name="btnAddReProgramacion" id="btnAddReProgramacion"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Reprogramar</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#valHourDate').mask('00:00');
		$('.calendar').datepicker({
			keyboardNavigation: false,
			todayHighlight: true
		});

		$('#valUserID').change(function(){
			ListaFechaActividades($('#valUserID').val());
		});

		$('.day').click(function(){
			BusquedaFechaActividades($(this).html());
		});

	});

	function MesxNumero(i){
		switch (i) {
			case 'Enero':
			mes = "01";
			break;
			case 'Febrero':
			mes = "02";
			break;
			case 'Marzo':
			mes = "03";
			break;
			case 'Abril':
			mes = "04";
			break;
			case 'Mayo':
			mes = "05";
			break;
			case 'Junio':
			mes = "06";
			break;
			case 'Julio':
			mes = "07";
			break;
			case 'Agosto':
			mes = "08";
			break;
			case 'Septiembre':
			mes = "09";
			break;
			case 'Octubre':
			mes = "10";
			break;
			case 'Noviembre':
			mes = "11";
			break;
			case 'Diciembre':
			mes = "12";
			break;
		}
		return mes;
	}

	function ListaFechaActividades(userID){
		var str = $('.datepicker-switch').html();
		var res = str.split(" ");
		$('.old').removeClass('new-day');
		$('.new').removeClass('new-day');
		$.each( $('.new-day'), function( i, val) {
			<?php $ListHomologacion = CrmHomologacion::getListProgramado(); 
			foreach ($ListHomologacion as $oItem) { 
				$d = date("d", strtotime($oItem->programDate)); 
				$m = date("m", strtotime($oItem->programDate));
				$y = date("Y", strtotime($oItem->programDate));
				?>
				if(userID == <?php echo $oItem->userID; ?>){
					if(res[1] == <?php echo $y; ?>){
						if(MesxNumero(res[0]) == <?php echo $m; ?>){
							if($(this).html() == <?php echo $d; ?>){
								$(this).addClass('active');
							}
						}
					}
				}
				<?php } ?>

				<?php $ListProceso = CrmProceso::getList(); 
				foreach ($ListProceso as $oItem2) { 
					$d = date("d", strtotime($oItem2->programDate)); 
					$m = date("m", strtotime($oItem2->programDate));
					$y = date("Y", strtotime($oItem2->programDate));
					?>
					if(userID == <?php echo $oItem->userID; ?>){
						if(res[1] == <?php echo $y; ?>){
							if(MesxNumero(res[0]) == <?php echo $m; ?>){
								if($(this).html() == <?php echo $d; ?>){
									$(this).addClass('active');
								}
							}
						}
					}
					<?php } ?>
				});

	}

	function BusquedaFechaActividades(i){
		ListaFechaActividades($('#valUserID').val());
		var str = $('.datepicker-switch').html();
		var res = str.split(" ");
		var d = i;
		$('#valProgramDate').val(res[1]+'-'+MesxNumero(res[0])+'-'+d);
		$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_fecha_homologacion2.php?d='+ d +'&m='+MesxNumero(res[0])+'&y='+res[1]+'&userID='+$('#valUserID').val(), function(data) {
			if(data.retval==1){
				$('.list-homologacion').empty();
				$('.list-homologacion').append(data.msg);
			}else{
				$('.list-homologacion').empty();
				$('.list-homologacion').append(data.msg);
			}
		});
		$('#valProgramDate_p').val(res[1]+'-'+MesxNumero(res[0])+'-'+d);
		$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_fecha_proceso.php?d='+ d +'&m='+MesxNumero(res[0])+'&y='+res[1]+'&userID='+$('#valUserID').val(), function(data) {
			if(data.retval==1){
				$('.list-proceso').empty();
				$('.list-proceso').append(data.msg);
			}else{
				$('.list-proceso').empty();
				$('.list-proceso').append(data.msg);
			}
		});
	}
</script>

<script type="text/javascript">
	$(function(){
		$( "#btnAddProgramacion" ).click(function() {
			var homologacionID  = $("#homologacionID").val();
			var valProgramDate  = $("#valProgramDate").val(); 
			var valHourDate     = $("#valHourDate").val();
			var valHourEndDate  = $("#valHourEndDate").val();
			var valUserID       = $("#valUserID").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/programa_homologacion.php?homologacionID='+homologacionID+'&programDate='+valProgramDate+'&hourDate='+valHourDate+'&hourEndDate='+valHourEndDate+'&userID='+valUserID, function(data) {
				if(data.retval==1){
					alertify.success('Homologacion Programada Correctamente');
					$('#valHourDate').val('');
					$('#valHourEndDate').val('');
					location.reload();
				}else{
					alertify.error('No se pudo insertar la propuesta , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});
		});

		$( "#btnAddReProgramacion" ).click(function() {
			var homologacionID  = $("#homologacionID_r").val();
			var valProgramDate  = $("#valProgramDate_r").val(); 
			var valHourDate     = $("#valHourDate_r").val();
			var valHourEndDate  = $("#valHourEndDate_r").val();
			var valUserID       = $("#valUserID_r").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/programa_homologacion.php?homologacionID='+homologacionID+'&programDate='+valProgramDate+'&hourDate='+valHourDate+'&hourEndDate='+valHourEndDate+'&userID='+valUserID, function(data) {
				if(data.retval==1){
					alertify.success('Homologacion ReProgramada Correctamente');
					$('#valHourDate').val('');
					$('#valHourEndDate').val('');
					location.reload();
				}else{
					alertify.error('No se pudo insertar la propuesta , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});
		});

		$( "#btnAddProceso" ).click(function() {
			var valProgramDate  = $("#valProgramDate_p").val(); 
			var valHourDate     = $("#valHourDate_p").val();
			var valHourEndDate  = $("#valHourEndDate_p").val();
			var valUserID       = $("#valUserID").val();
			var proceso         = $("#process_p").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/proceso_insert.php?programDate='+valProgramDate+'&hourDate='+valHourDate+'&hourEndDate='+valHourEndDate+'&userID='+valUserID+'&process='+proceso, function(data) {
				if(data.retval==1){
					alertify.success('Proceso Programado Correctamente');
					$('#valHourDate_p').val('');
					$('#hourEndDate_p').val('');
					location.reload();
				}else{
					alertify.error('No se pudo insertar el proceso , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});
		});
	});
	function Reprogramacion(ID){
		$('.bs-Reprogramacion').modal('show');
		$('#homologacionID_r').val(ID);
	}


	function Finalizacion(ID){
		var homologacionID  = ID;
		$.getJSON('<?php echo $URL_ROOT;?>ajax/programa_homologacion2.php?homologacionID='+homologacionID, function(data) {
			if(data.retval==1){
				alertify.success('Homologacion Programada Correctamente');
				$('#programDate').val('');
				$('#hourDate').val('');
				$('#hourEndDate').val('');
				location.reload();
			}else{
				alertify.error('No se pudo insertar la programacion , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function eliminarProceso(ID){
		var procesoID  = ID;
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_proceso.php?procesoID='+procesoID, function(data) {
			if(data.retval==1){
				alertify.success('Proceso Eliminada Correctamente');
				location.reload();
			}else{
				alertify.error('No se pudo eliminar el proceso , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}
</script>