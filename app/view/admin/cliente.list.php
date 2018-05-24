<script type="text/javascript">
	$(function(){
		$('.btn-upd').hide();
		$('.btn-updNivel').hide();


		$('.btn-upd').click(function(){
			var contactoHidID   	= $("#contactoHidID").val();
			var nameContact  		= $("#nameContact").val(); 
			var positionContact    	= $("#positionContact").val();
			var emailContact     	= $("#emailContact").val();
			var phoneContact       	= $("#phoneContact").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_contact.php?contactoID='+contactoHidID+'&nameContact='+nameContact+'&positionContact='+positionContact+'&emailContact='+emailContact+'&phoneContact='+phoneContact, function(data) {
				if(data.retval==1){
					$('#list-contact').empty();
					alertify.success('Contacto actualizado Correctamente');
					var idCliente = $('#clienteHidID').val();
					$("#list-contact").load('<?php echo $URL_ROOT;?>ajax/list_contact.php?clienteID='+idCliente); 
					$('#myModalContacto').find("input,textarea").val('').end();
					$('#clienteHidID').val(idCliente);
				}else{
					alertify.error('No se pudo actualizar el contacto , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-upd').hide();
		});

		$('.btn-updNivel').click(function(){
			var nivelClienteHidID   = $("#nivelClienteHidID").val();
			var nivel  				= $("#nivel").val(); 
			var minimo    			= $("#minimo").val();
			var maximo     			= $("#maximo").val();
			var state       		= $("#state").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/update_nivel_cliente.php?nivelClienteID='+nivelClienteHidID+'&nivel='+nivel+'&minimo='+minimo+'&maximo='+maximo+'&state='+state, function(data) {
				if(data.retval==1){
					$('#list-nivel').empty();
					alertify.success('Nivel actualizado Correctamente');
					var idCliente = $('#clienteHidID2').val();
					$("#list-nivel").load('<?php echo $URL_ROOT;?>ajax/list_nivel_cliente.php?clienteID='+idCliente); 
					$('#myModalNivel').find("input,textarea").val('').end();
					$('#clienteHidID2').val(idCliente);
				}else{
					alertify.error('No se pudo actualizar el nivel , Contactarse con Soporte - BV');
				}
			}).error(function(jqXHR, textStatus, errorThrown) {
				alertify.error("Error interno");
				console.log("error: " + textStatus);
				console.log("error thrown: " + errorThrown);
				console.log("incoming Text: " + jqXHR.responseText);
			});    
			$('.btn-updNivel').hide();
		});
	});

	function ModalContact(id){
		$("#list-contact").load('<?php echo $URL_ROOT;?>ajax/list_contact.php?clienteID='+id); 
		$('.bs-Contacto').modal('show');
		$('#clienteHidID').val(id);
	}

	function ModalNivel(id){
		$("#list-nivel").load('<?php echo $URL_ROOT;?>ajax/list_nivel_cliente.php?clienteID='+id); 
		$('.bs-Nivel').modal('show');
		$('#clienteHidID2').val(id);
	}


	function DeleteContact(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_contact.php?contactoID='+id, function(data) {
			if(data.retval==1){
				$('#list-contact').empty();
				$("#list-contact").load('<?php echo $URL_ROOT;?>ajax/list_contact.php?clienteID='+$('#clienteHidID').val()); 
			}else{
				alertify.error('No se pudo eliminar el contacto , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function DeleteNivel(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_nivel_cliente.php?nivelClienteID='+id, function(data) {
			if(data.retval==1){
				$('#list-nivel').empty();
				$("#list-nivel").load('<?php echo $URL_ROOT;?>ajax/list_nivel_cliente.php?clienteID='+$('#clienteHidID').val()); 
			}else{
				alertify.error('No se pudo eliminar el nivel , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function ViewContact(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/view_contact.php?contactoID='+id, function(data) {
			if(data.retval==1){
				$("#nameContact").val(data.nameContact); 
				$("#positionContact").val(data.positionContact);
				$("#phoneContact").val(data.phoneContact);
				$("#emailContact").val(data.emailContact);
				$("#contactoHidID").val(id);
				$('.btn-upd').show();
			}else{
				alertify.error('No se pudo eliminar el contacto , Contactarse con Soporte - BV');
			}
		}).error(function(jqXHR, textStatus, errorThrown) {
			alertify.error("Error interno");
			console.log("error: " + textStatus);
			console.log("error thrown: " + errorThrown);
			console.log("incoming Text: " + jqXHR.responseText);
		});
	}

	function ViewNivel(id){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/view_nivel_cliente.php?nivelClienteID='+id, function(data) {
			if(data.retval==1){
				$("#nivel").val(data.nivel); 
				$("#minimo").val(data.minimo);
				$("#maximo").val(data.maximo);
				$("#state").val(data.state);
				$("#nivelClienteHidID").val(id);
				$('.btn-updNivel').show();
			}else{
				alertify.error('No se pudo visualizar el nivel , Contactarse con Soporte - BV');
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
				<div class="card">
					<div class="box box-default">
						<!-- /.box-header -->
						<div class="card-body">
							<div class="box-body">
								<table class="table table-bordered table-hover" width='100%' id="dataTables-example">
									<thead>
										<tr>
											<th style="text-align: center;" width="35">&nbsp;</th>
											<th style="text-align: center;" width="120"><?php echo $MODULE->getSortingHeader("ruc", "RUC");?></th>
											<th style="text-align: center;" width="120"><?php echo $MODULE->getSortingHeader("businessName", "Razon Social");?></th>
											<th style="text-align: center;" width="120"><?php echo $MODULE->getSortingHeader("address", "Dirección");?></th>
											<th style="text-align: center;" width="120"><?php echo $MODULE->getSortingHeader("email", "Correo");?></th>
											<th style="text-align: center;" width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
											<th style="text-align: center;" width="35">Contactos</th>
											<th style="text-align: center;" width="35">Niveles</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$list=CrmCliente::getList_Paging();
										foreach ($list as $oItem) {
											?>
											<tr> 
												<td><a href="<?php echo "javascript:Edit(".$oItem->clienteID.");"; ?>"><i class="fa fa-edit"></i></a>
													<a href="<?php echo "javascript:Delete(".$oItem->clienteID.");"; ?>"><i class="fa fa-remove"></i></a></td>
													<td><?php echo $oItem->ruc; ?></td>
													<td><?php echo $oItem->businessName; ?></td>
													<td><?php echo htmlentities($oItem->address, ENT_QUOTES, "UTF-8"); ?></td>
													<td><?php echo $oItem->email; ?></td>
													<td align="center"><?php echo CrmServicio::getState($oItem->state);?></td>
													<td style="text-align: center;"><a href="<?php echo "javascript:ModalContact(".$oItem->clienteID.");"; ?>"><i class="fa fa-plus"></i></a></td>
													<td style="text-align: center;"><a href="<?php echo "javascript:ModalNivel(".$oItem->clienteID.");"; ?>"><i class="fa fa-at"></i></a></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<div class="box-footer">
										<button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
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
		<!-- Inicio Modal Contacto  -->
		<div id="myModalContacto" class="modal bs-Contacto" tabindex="-1" role="dialog" data-focus-on="input:first">
			<div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="gridSystemModalLabel">Nuevo Contacto</h4>
						<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<input type="hidden" name="clienteHidID" id="clienteHidID">
								<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbContactos">
									<thead>
										<tr> 
											<th style="text-align:center;">&nbsp;</th>
											<th style="text-align:center;"><a>Nombre</a></th>
											<th style="text-align:center;"><a>Cargo</a></th>
											<th style="text-align:center;"><a>Teléfono</a></th>
											<th style="text-align:center;"><a>Correo Electronico</a></th>                          
										</tr>
									</thead>
									<tbody id="list-contact"> 
									</tbody>
								</table>
							</div>
						</div>
						<div class="line"></div>
						<div class="line"></div>
						<input type="hidden" name="contactoHidID" id="contactoHidID">
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
									<label>Nombre</label>
									<input name="nameContact" type="text" class="form-control" id="nameContact" placeholder="Ingrese Nombre" maxlength="100">
								</div>
							</div>
							<div class="col-sm-5 col-sm-offset-2">
								<div class="form-group">
									<label>Cargo</label>
									<input name="positionContact" type="text" class="form-control" id="positionContact" placeholder="Ingrese Cargo" maxlength="100">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
									<label>Teléfono</label>
									<input name="phoneContact" type="text" class="form-control" id="phoneContact" placeholder="Ingrese Teléfono" maxlength="100">
								</div>
							</div>
							<div class="col-sm-5 col-sm-offset-2 capacidad_none" >
								<div class="form-group">
									<label>Correo Electrónico</label>
									<input name="emailContact" type="text" class="form-control" id="emailContact" placeholder="Ingrese Email" maxlength="100">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-sm-5">
								<div class="btn btn-primary btn-block" name="btnAddContact" id="btnAddContact"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
							</div>
							<div class="col-sm-5 col-sm-offset-2">
								<div class="btn btn-primary btn-block btn-upd" name="btnUpdateContacto" id="btnUpdateContacto"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Fin Modal Contacto  -->

		<!-- Inicio Modal Nivel  -->
		<div id="myModalNivel" class="modal bs-Nivel" tabindex="-1" role="dialog" data-focus-on="input:first">
			<div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="gridSystemModalLabel">Niveles</h4>
						<button type="button" class="close2" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<input type="hidden" name="clienteHidID2" id="clienteHidID2">
								<table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbNiveles">
									<thead>
										<tr> 
											<th style="text-align:center;">&nbsp;</th>
											<th style="text-align:center;"><a>Nivel</a></th>
											<th style="text-align:center;"><a>Minimo</a></th>
											<th style="text-align:center;"><a>Maximo</a></th>
											<th style="text-align:center;"><a>Estado</a></th>                          
										</tr>
									</thead>
									<tbody id="list-nivel"> 
									</tbody>
								</table>
							</div>
						</div>
						<div class="line"></div>
						<div class="line"></div>
						<input type="hidden" name="nivelClienteHidID" id="nivelClienteHidID">
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
									<label>Nivel</label>
									<select id="nivel" name="nivel" class="form-control">
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
									</select>
								</div>
							</div>
							<div class="col-sm-5 col-sm-offset-2">
								<div class="form-group">
									<label>Minimo</label>
									<input name="minimo" type="text" class="form-control" id="minimo" placeholder="Ingrese valor" maxlength="100">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
									<label>Maximo</label>
									<input name="maximo" type="text" class="form-control" id="maximo" placeholder="Ingrese valor" maxlength="100">
								</div>
							</div>
							<div class="col-sm-5 col-sm-offset-2" >
								<div class="form-group">
									<label>Estado</label>
									<select name="state" id="state" class="form-control" autocomplete="off">
										<option value="0">Seleccione</option>
										<option value="1">Aprobado</option>
										<option value="2">Desaprobado</option>
										<option value="3">Inactivo</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-sm-5">
								<div class="btn btn-primary btn-block" name="btnAddNivel" id="btnAddNivel"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
							</div>
							<div class="col-sm-5 col-sm-offset-2">
								<div class="btn btn-primary btn-block btn-updNivel" name="btnUpdateNivel" id="btnUpdateNivel"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Fin Modal Contacto  -->


		<script type="text/javascript">

			$(document).ready(function() {


				$('.close').click(function(){
					$('.bs-Contacto').modal('hide');

				});

				$('.close2').click(function(){
					$('.bs-Nivel').modal('hide');

				});


				$('#myModalContacto').on('hidden.bs.modal', function () {
					$(this).find("input,textarea").val('').end();
				});

				$('#myModalNivel').on('hidden.bs.modal', function () {
					$(this).find("input,textarea").val('').end();
				});

				$( "#btnAddContact" ).click(function() {
					if ($('#nameContact').val() == ''){ $('#nameContact').focus(); alertify.error('Ingrese un Nombre'); return false; }  
					if ($('#positionContact').val() == ''){ $('#positionContact').focus(); alertify.error('Ingrese un Cargo'); return false; }
					if ($('#phoneContact').val() == ''){ $('#phoneContact').focus(); alertify.error('Ingrese un Telefono'); return false; }
					if ($('#emailContact').val() == ''){ $('#emailContact').focus(); alertify.error('Ingrese un Email'); return false; }

					var clienteID     = $("#clienteHidID").val();
					var nameContact   = $("#nameContact").val(); 
					var positionContact =  $("#positionContact").val();
					var phoneContact = $("#phoneContact").val();
					var emailContact = $("#emailContact").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_contact.php?clienteID='+clienteID+'&nameContact='+nameContact+'&positionContact='+positionContact+'&phoneContact='+phoneContact+'&emailContact='+emailContact, function(data) {
						if(data.retval==1){
							$('#list-contact').empty();
							$("#list-contact").load('<?php echo $URL_ROOT;?>ajax/list_contact.php?clienteID='+$('#clienteHidID').val()); 
							$('#myModalContacto').find("input,textarea").val('').end();
						}else{
							alertify.error('No se pudo insertar el contacto , Contactarse con Soporte - BV');
						}
					}).error(function(jqXHR, textStatus, errorThrown) {
						alertify.error("Error interno");
						console.log("error: " + textStatus);
						console.log("error thrown: " + errorThrown);
						console.log("incoming Text: " + jqXHR.responseText);
					});


				});

				$( "#btnAddNivel" ).click(function() {
					if ($('#nivel').val() == ''){ $('#nivel').focus(); alertify.error('Ingrese un nivel'); return false; }  
					if ($('#minimo').val() == ''){ $('#minimo').focus(); alertify.error('Ingrese un minimo'); return false; }
					if ($('#maximo').val() == ''){ $('#maximo').focus(); alertify.error('Ingrese un maximo'); return false; }
					if ($('#state').val() == ''){ $('#state').focus(); alertify.error('Ingrese un estado'); return false; }

					var clienteID     	= $("#clienteHidID2").val();
					var nivel   		= $("#nivel").val(); 
					var minimo 			= $("#minimo").val();
					var maximo 			= $("#maximo").val();
					var state 			= $("#state").val();

					$.getJSON('<?php echo $URL_ROOT;?>ajax/insert_nivel_cliente.php?clienteID='+clienteID+'&nivel='+nivel+'&minimo='+minimo+'&maximo='+maximo+'&state='+state, function(data) {
						if(data.retval==1){
							$('#list-nivel').empty();
							$("#list-nivel").load('<?php echo $URL_ROOT;?>ajax/list_nivel_cliente.php?clienteID='+$('#clienteHidID2').val()); 
						}else{
							alertify.error('No se pudo insertar el nivel , Contactarse con Soporte - BV');
						}
					}).error(function(jqXHR, textStatus, errorThrown) {
						alertify.error("Error interno");
						console.log("error: " + textStatus);
						console.log("error thrown: " + errorThrown);
						console.log("incoming Text: " + jqXHR.responseText);
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