<?php
$oProveedor=WebLogin::getProveedorSession();
$oCliente=WebLogin::getClienteSession();
$oAdmin=WebLogin::getAdminSession();

if(isset($oProveedor)){
	$_SESSION['id'] = $oProveedor->documentNumber;
	$_SESSION['type'] = 1;
}elseif (isset($oCliente)) {
	$_SESSION['id'] = $oCliente->ruc;
	$_SESSION['type'] = 2;
}elseif (isset($oAdmin)){
	$_SESSION['id'] = $oAdmin->userID;
	$_SESSION['type'] = 3;
}


?>
<script type="text/javascript">
	$(function(){
		<?php if(isset($oProveedor)){if($oProveedor->state != 1){ ?>$('.nav-item').hide();<?php } } ?>

		$('#select_all').change(function() {
			var checkboxes = $(this).closest('#dataTables-example2').find(':checkbox');
			checkboxes.prop('checked', $(this).is(':checked'));
		});

		$('#download_Graphic').click(function(){
			var url_base64jp = document.getElementById("myChartRequerimiento").toDataURL("image/jpg");
			$('#download_Graphic').attr('href',url_base64jp);
		});
		$('#download_Graphic_2').click(function(){
			var url_base64jp = document.getElementById("myChartHomologacion").toDataURL("image/jpg");
			$('#download_Graphic_2').attr('href',url_base64jp);
		});

	});

	function checkboxChecker(){
		var valor = '';
		$('#dataTables-example2 tr').not(':first').each(function(i) {	
			console.log($(this).find('td:nth-child(2)').text());				
			var $chkbox = $(this).find('input[type="checkbox"]');
			if ($chkbox.length) {
				var status = $chkbox.prop('checked');
				if(status){
					var homologacionID = $(this).find('td:nth-child(2)').text();
					valor += valor + homologacionID + ',';
				}
			}
		});
		if(valor == ''){ 
			alertify.success('Por favor seleccione las empresas auditadas'); 
		}else{
			location.href = '<?php echo $URL_ROOT;?>ajax/reporte_general.php?homologacionID='+valor;
		}
	};

	function GraficoClienteReq(ID){
		$('.bs-chart').modal('show');
		$.getJSON('<?php echo $URL_ROOT;?>ajax/graficoReqCliente.php?clienteID='+ ID, function(data) {
			if(data.retval==1){
				var ctx = document.getElementById("myChartRequerimiento");
				console.log(data.val1);
				console.log(data.val2);
				var val1 = data.val1;
				var labels = val1.split(',');
				var val2 = data.val2;
				var datar = val2.split(',');
				var myChart = new Chart(ctx, {
					type: 'pie',
					data: {
						labels: labels,
						datasets: [{
							data: datar ,
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					}
				});
			}
		});

	}

	function GraficoClienteHom(ID){
		$('.bs-chart2').modal('show');
		$.getJSON('<?php echo $URL_ROOT;?>ajax/graficoHomCliente.php?clienteID='+ ID, function(data) {
			if(data.retval==1){
				var ctx = document.getElementById("myChartHomologacion");
				console.log(data.val1);
				console.log(data.val2);
				var val1 = data.val1;
				var labels = val1.split(',');
				var val2 = data.val2;
				var datar = val2.split(',');
				var myChart = new Chart(ctx, {
					type: 'pie',
					data: {
						labels: labels,
						datasets: [{
							data: datar ,
							backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					}
				});
			}
		});
	}

</script>
<style>
.btn-group{
	width:100%;
}
#dataTables-example2 a {
	color: #dc3545;
	text-decoration: none;
}

#dataTables-example a {
	color: #dc3545;
	text-decoration: none;
}

#dataTables-example3 a {
	color: #dc3545;
	text-decoration: none;
}
@media (min-width: 1200px){
	.container {
		max-width: 1800px !important;
	}
}
.well{
	padding: 15px;
	border: 0.5px dashed black;
	border-radius: 9px;
	margin-top: -5px;
	background-color: #d0d0b6;
}
.btn-default.active {
	color: #fff;
	background-color: #bd2130;
	border-color: #bd2130;
	cursor: pointer;
}
.btn-default{
	background-color: buttonface;
	padding: 11px;
	border: 1px solid #fff;
	border-radius: 8px;
}

.btn-primary {
	color: #fff;
	background-color: #bd2130;
	border-color: #bd2130;
}
.btn-primary:hover {
	color: #fff;
	background-color: #bd2130;
	border-color: #bd2130;
}
.btn-default a{
	color: #000;
}
.row{
	text-align: left;
}
.btn-primary:not([disabled]):not(.disabled).active, .btn-primary:not([disabled]):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
	color: #fff;
	background-color: #bd2130;
	border-color: #bd2130;
	box-shadow: 0 0 0 0.2rem #bd21306e;
}

.btn-primary.focus, .btn-primary:focus {
	box-shadow: 0 0 0 0.2rem #bd213070;
}
thead tr{
	background-color: beige;
}
tbody tr{
	background-color: white;
}

thead th{
	text-align: center;
}
tbody td{
	text-align: center;
}
@media (max-width: 991px) {
	.table-mobile {
		display: block;
		overflow-x: scroll;
	}
}
@media (max-width: 991px) {
	.hidden-xs{
		display: none;
	}
}

</style>
<main role="main" class="container">
	<div class="starter-template">
		<?php if(!isset($oProveedor) && !isset($oAdmin)){ ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
			<script src="https://cdn.rawgit.com/emn178/Chart.PieceLabel.js/master/build/Chart.PieceLabel.min.js"></script>
			<section class="content">
				<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
					<div class="btn-group" role="group" style="width:100%;">
						<button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab" style="width:100%;"><span class="fa fa-user" aria-hidden="true"></span>
							<div class="hidden-xs">Listado General de Empresas</div>
						</button>
					</div>
					<div class="btn-group" role="group" style="width:100%;">
						<button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab" style="width:100%;"><span class="fa fa-file" aria-hidden="true"></span>
							<div class="hidden-xs">Estado de Empresas Auditadas</div>
						</button>
					</div>
				</div>
				<div class="well">
					<div class="tab-content">
						<div class="tab-pane fade in show active" id="tab1">
							<div class="box box-default">
								<br>
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-mobile table-bordered table-hover" width='100%' id="dataTables-example">
											<thead>
												<tr>
													<th width="60">ID</th>
													<th width="60">Periodo</th>
													<th width="60">Fecha Registro</th>
													<th width="120">Proveedor</th>
													<th width="120">Direccion</th>
													<th width="120">Observaciones</th>
													<th width="60">Estado</th>
													<th width="120">&nbsp;&nbsp;Dia 3&nbsp;&nbsp;</th>
													<th width="120">&nbsp;&nbsp;Dia 9&nbsp;&nbsp;</th>
													<th width="120">&nbsp;&nbsp;Dia 14&nbsp;&nbsp;</th>
													<th width="60">Notificaciones</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!isset($oProveedor) && !isset($oAdmin)){ $list=CrmRequerimiento::getList_Cliente($oCliente->clienteID); foreach ($list as $oItem) { $oProveedorT = CrmProveedor::getItem($oItem->proveedorID); $oHomologacion = CrmHomologacion::getItemRequerimiento($oItem->requerimientoID); ?>
													<tr> 
														<td><?php echo $oItem->requerimientoID; ?></td>
														<td><?php echo $oItem->period; ?></td>
														<td><?php echo $oItem->registerDate; ?></td>
														<td><?php echo htmlentities($oProveedorT->businessName, ENT_QUOTES, "UTF-8"); ?></td>
														<td><?php echo htmlentities($oProveedorT->address, ENT_QUOTES, "UTF-8"); ?></td>
														<td><?php echo htmlentities($oItem->observation, ENT_QUOTES, "UTF-8"); ?></td>
														<td align="center"><?php if(!isset($oHomologacion)){echo CrmRequerimiento::getState($oItem->state);}else{ echo CrmHomologacion::getState($oHomologacion->state);  }?></td>
														<td><?php echo htmlentities($oItem->threeDay, ENT_QUOTES, "UTF-8"); ?></td>
														<td><?php echo htmlentities($oItem->nineDay, ENT_QUOTES, "UTF-8"); ?></td>
														<td><?php echo htmlentities($oItem->fourteenDay, ENT_QUOTES, "UTF-8"); ?></td>
														<td><?php echo htmlentities($oItem->alert, ENT_QUOTES, "UTF-8"); ?></td>
													</tr>
												<?php } }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade in show" id="tab2">
							<div class="box box-default"> 
								<br>
								<?php 
								$list=CrmHomologacion::getlistxCliente($oCliente->clienteID); 
								?>
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-mobile table-bordered table-hover" width='100%' id="dataTables-example2">
											<thead>
												<tr>
													<th width="20"><input type="checkbox" id="select_all"/></th>      
													<th width="60">Nro. Registro</th>
													<th width="60">Periodo</th>
													<th width="60">Cliente</th>
													<th width="120">Proveedor</th>
													<th width="60">Estado</th>
													<th width="60">Nivel</th>
													<th width="60">Puntaje</th>
													<th width="60">Archivos</th>
													<th width="120">&nbsp;&nbsp;Dia 3&nbsp;&nbsp;</th>
													<th width="120">&nbsp;&nbsp;Dia 9&nbsp;&nbsp;</th>
													<th width="120">&nbsp;&nbsp;Dia 14&nbsp;&nbsp;</th>
													<th width="60">Notificaciones</th>
													<th width="60">Fecha Vencimiento</th>
												</tr>
											</thead>
											<tbody><?php foreach ($list as $oItem) {  $oRequerimiento = CrmRequerimiento::getItem($oItem->requerimientoID); $oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID); $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID);  $end = date('Y-m-d', strtotime($oItem->registerUpdate));  ?>
											<tr> 
												<td><input type="checkbox" value="<?php echo $oItem->homologacionID; ?>"/></td> 
												<td><?php echo $oItem->homologacionID; ?></td>
												<td><?php echo $oRequerimiento->period; ?></td>
												<td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
												<td><?php echo htmlentities($oProveedor->businessName, ENT_QUOTES, "UTF-8"); ?></td>
												<td><?php echo CrmHomologacion::getStateCliente($oItem->state);?></td>
												<?php if($oItem->state == 5){ ?>
													<td><?php echo htmlentities($oItem->nivel, ENT_QUOTES, "UTF-8"); ?></td>
													<td><?php echo htmlentities($oItem->puntajeFinal, ENT_QUOTES, "UTF-8"); ?>%</td>
													<td align="center"><a href="javascript:InformeGeneral(<?php echo $oItem->homologacionID; ?>)"><i class="fa fa-file"></i></a>&nbsp;&nbsp;
														<?php $oNivel = CrmNivelCliente::getItemByCliente($oCliente->clienteID,$oItem->nivel); if(isset($oNivel)){ if($oNivel->state == 1){ ?>
															<a href="<?php echo $URL_ROOT;?>userfiles/<?php echo $oItem->certification;?>" target="_blank"><i class="fa fa-clone"></i></a></td>
														<?php } } ?>
													<?php }else{ ?>
														<td align="center">No hay resultados</td>
														<td align="center">No hay resultados</td>
														<td align="center">No hay resultados</td>
													<?php } ?>
													<td><?php echo htmlentities($oItem->threeDay, ENT_QUOTES, "UTF-8"); ?></td>
													<td><?php echo htmlentities($oItem->nineDay, ENT_QUOTES, "UTF-8"); ?></td>
													<td><?php echo htmlentities($oItem->fourteenDay, ENT_QUOTES, "UTF-8"); ?></td>
													<td><?php echo htmlentities($oItem->alert, ENT_QUOTES, "UTF-8"); ?></td>
													<td><?php echo $end ;?></td>
													</tr><?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
				</section>
				<div id="myModalChart" class="modal bs-chart" tabindex="-1" role="dialog" data-focus-on="input:first">
					<div class="modal-dialog modal-lg" role="document" id="mdialTamano">
						<div class="modal-content">
							<div class="modal-header"><h4 class="modal-title" id="gridSystemModalLabel">Requerimientos</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-2">
										&nbsp;
									</div>
									<div class="col-md-8">
										<canvas id="myChartRequerimiento" width="40" height="30"></canvas>
									</div>
									<div class="col-md-2">
										&nbsp;
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-5">
										&nbsp;
									</div>
									<div class="col-md-3">
										<a class="btn btn-secondary" id="download_Graphic" download>Descargar</a>
									</div>
									<div class="col-md-4">
										&nbsp;
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="myModalChart2" class="modal bs-chart2" tabindex="-1" role="dialog" data-focus-on="input:first">
					<div class="modal-dialog modal-lg" role="document" id="mdialTamano">
						<div class="modal-content">
							<div class="modal-header"><h4 class="modal-title" id="gridSystemModalLabel">Auditados</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-2">
										&nbsp;
									</div>
									<div class="col-md-8">
										<canvas id="myChartHomologacion" width="40" height="30"></canvas>
									</div>
									<div class="col-md-2">
										&nbsp;
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-5">
										&nbsp;
									</div>
									<div class="col-md-3">
										<a class="btn btn-secondary" id="download_Graphic_2" download>Descargar</a>
									</div>
									<div class="col-md-4">
										&nbsp;
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php }else{ ?>
				<section class="content">
					<h1>Estado de Empresas Auditadas</h1>
					<br>
					<?php 
					if(isset($oProveedor)){
						$list=CrmHomologacion::getlistxProveedor($oProveedor->proveedorID); 
					}else if(isset($oCliente)){
						$list=CrmHomologacion::getlistxCliente($oProveedor->clienteID); 

					}else if(isset($oAdmin)){
						if($oAdmin->profileID == 2){
							$list=CrmHomologacion::getlistxAuditor($oAdmin->userID);

						}else if($oAdmin->profileID == 3 || $oAdmin->profileID == 1){
							$list=CrmHomologacion::getlist();
						}else{
							$list = NULL;
						}
					}
					?>
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-mobile table-bordered table-hover" width='100%' id="dataTables-example3">
								<thead>
									<tr>
										<th width="60">Nro. Registro</th>
										<th width="60">Periodo</th>
										<th width="60">Cliente</th>
										<th width="120">Proveedor</th>
										<th width="60">Estado</th>
										<th width="60">Fecha Vencimiento</th>
										<th width="60">Nivel</th>
										<th width="60">Puntaje</th>
										<th width="60">Archivos</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($list as $oItem) {  $oRequerimiento = CrmRequerimiento::getItem($oItem->requerimientoID); $oProveedorT = CrmProveedor::getItem($oRequerimiento->proveedorID); $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID); $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID); $oCliente = CrmCliente::getItem($oPropuesta->clienteID); $end = date('Y-m-d', strtotime($oItem->registerUpdate)); ?>
									<tr> 
										<?php if(count($oProveedor) > 0){ if($oItem->state == 1){  ?>
											<td><a href="<?php echo $URL_ROOT;?>relacion-homologacion/formulario.html?r=<?php echo $oItem->homologacionID; ?>"><?php echo $oItem->homologacionID; ?></a></td>
										<?php }else{ ?>
											<td><?php echo $oItem->homologacionID; ?></td>
										<?php } }else if(isset($oAdmin)){ 
											if($oAdmin->profileID == 2){ 
												if($oItem->state == 3 || $oItem->state == 8){ ?>
													<td><a href="<?php echo $URL_ROOT;?>relacion-homologacion/formulario.html?r=<?php echo $oItem->homologacionID; ?>"><?php echo $oItem->homologacionID; ?></a></td>
												<?php }else{ ?>
													<td><?php echo $oItem->homologacionID; ?></td>
												<?php }
											}else{  ?>
												<td><a href="<?php echo $URL_ROOT;?>relacion-homologacion/formulario.html?r=<?php echo $oItem->homologacionID; ?>"><?php echo $oItem->homologacionID; ?></a></td>
											<?php } } ?>
											<td><?php echo $oRequerimiento->period; ?></td>
											<td><?php echo htmlentities($oCliente->businessName, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo htmlentities($oProveedorT->businessName, ENT_QUOTES, "UTF-8"); ?></td>
											<td><?php echo CrmHomologacion::getState($oItem->state);?></td>
											<td><?php echo $end ;?></td>
											<?php if($oItem->state == 5){ ?>
												<td><?php echo htmlentities($oItem->nivel, ENT_QUOTES, "UTF-8"); ?></td>
												<td><?php echo htmlentities($oItem->puntajeFinal, ENT_QUOTES, "UTF-8"); ?>%</td>
												<td align="center"><a href="javascript:InformeGeneral(<?php echo $oItem->homologacionID; ?>)"><i class="fa fa-file"></i></a>&nbsp;&nbsp;
													<?php $oNivel = CrmNivelCliente::getItemByCliente($oCliente->clienteID,$oItem->nivel); if(isset($oNivel)){ if($oNivel->state == 1){ ?>
														<a href="<?php echo $URL_ROOT;?>userfiles/<?php echo $oItem->certification;?>" target="_blank"><i class="fa fa-clone"></i></a></td>
													<?php } } ?>
												<?php }else{ ?>
													<td align="center">No hay resultados</td>
													<td align="center">No hay resultados</td>
													<td align="center">No hay resultados</td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				<?php } ?>
				<br>
				<br>

				<script type="text/javascript">
					$(function(){
						$(".btn-pref .btn").click(function () {
							$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
							$(this).removeClass("btn-default").addClass("btn-primary");   
						});
						var table = $('#dataTables-example').DataTable({
							columnDefs: [
							{ "visible": false, "targets": [7,8,9,10] }
							],
							dom: "<'row'<'col-sm-7'f><'col-sm-5'>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-4'l><'col-sm-2'B><'col-sm-6'p>>",
							buttons: [
							'excel',
							'pdf',
							{
								text: 'Graficos',
								action: function (e, dt, node, config) {
									GraficoClienteReq(<?php echo $oCliente->clienteID; ?>);
								}	
							}
							]
						});
						table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );


						var table2 = $('#dataTables-example2').DataTable({
							columnDefs: [
							{ "visible": false, "targets": [9,10,11,12] }
							],
							dom: "<'row'<'col-sm-7'f><'col-sm-5'>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'p>>",
							buttons: [
							'excel',
							'pdf',
							{
								text: 'Graficos',
								action: function (e, dt, node, config) {
									GraficoClienteHom(<?php echo $oCliente->clienteID; ?>);
								}	
							},
							{
								text: 'Reporte General',
								action: function (e, dt, node, config){
									checkboxChecker();
								}
							}
							]
						});
						table2.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );

						var table3 = $('#dataTables-example3').DataTable({
							responsive: true,
							dom: "<'row'<'col-sm-7'f><'col-sm-5'>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-4'l><'col-sm-2'B><'col-sm-6'p>>",
							buttons: [
							'excel',
							'pdf'
							]
						});
						table3.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
					});

					function InformeGeneral(ID){
						window.open('<?php echo $URL_ROOT;?>ajax/informe_general.php?homologacionID='+ID,'_blank');
					}

				</script>
			</div>
		</main>








<!-- 
					<input type="hidden" name="Conexion" value="<?php echo $URL_ROOT;?>" id="Conexion">
					<link rel="stylesheet" type="text/css" href="<?php echo $URL_BASE; ?>css/chat.css">
					<script type="text/javascript" src="<?php echo $URL_BASE; ?>js/chat_style.js"></script>
					<script type="text/javascript" src="<?php echo $URL_BASE; ?>js/funciones.js"></script>
					<script type="text/javascript" src="<?php echo $URL_BASE; ?>js/estadoConversacion.js"></script>
					<script type="text/javascript" src="<?php echo $URL_BASE; ?>js/chat.js"></script>
					<script type="text/javascript" src="<?php echo $URL_BASE; ?>js/estadoUsuario.js"></script>
					<div class="chat-window" style="right:15px;">
						<div class="chat-window-title">
							<div class="close"></div>
							<div class="text">
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;">Chat - Bureau Veritas - Homologacion
									</font>
									<div class="profile-status" id="profile-status"></div>
								</font>
							</div>
						</div>
						<div id="mensajesAjax" class="centrarDiv mensajesAjax" style="display: none;"></div>
						<div class="chat-window-content" style="display: block;">
							<div class="chat-window-inner-content message-board pm-window" style="height: 400px;">
								<div class="messages-wrapper" style="height: 265px;" id="messages-wrapper">
									
								</div>
								<div id="mensajesAjax2" class="mensajesAjax2" style="display: none;"></div>
								<div class="chat-window-text-box-wrapper">
									<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
										<textarea class="chat-window-text-box" style="overflow: hidden; word-wrap: break-word; resize: none; height: 35px;font-size:15px;" placeholder="Ingrese su mensaje aqui"  name="mensaje" id="mensaje" ></textarea>
										<input type="hidden" name="contactID" id="contactID" value="1">
									</form>
									
								</div>
							</div>
						</div>
					</div> -->