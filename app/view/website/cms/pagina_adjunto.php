<?php
$oProveedor=WebLogin::getProveedorSession();
$oCliente=WebLogin::getClienteSession();
$oAdmin=WebLogin::getAdminSession();

//Validacion para que otros con un simple link no entren sin logueo ni por el proveedor
if(isset($oProveedor)){
	$oValidate = CrmHomologacion::getItemValidation($_GET['r'],$oProveedor->proveedorID);
	if(!isset($oValidate)){
		echo '<script type="text/javascript">$(function(){ location.href="/scs/homologacion/relacion-homologacion.html"; });</script>';
	}
}
//-------------------------------------------------------------------------------------

$oForm = CrmHomologacion::getItemFormulario($_GET['r']);

$oListAdjunto = CrmAdjunto::getListByFormulario($oForm->typeForm);

?>
<style>
.btn-group>.btn-group {
	border: 1px solid floralwhite;
}
.well{
	padding: 15px;
	border: 0.5px dashed black;
	border-radius: 9px;
	margin-top: -5px;
	background-color: #d0d0b6;
}
.btn-primary {
	color: #fff;
	background-color: #bd2130;
	border-color: #bd2130;
	cursor: pointer;
}
.btn-default{
	cursor: pointer;
}

.btn-primary:hover {
	color: #fff;
	background-color: #dc3545;
	border-color: #dc3545;
}
.btn-primary:not([disabled]):not(.disabled).active, .btn-primary:not([disabled]):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
	color: #fff;
	background-color: #dc3545;
	border-color: #dc3545;
	box-shadow: 0 0 0 0.2rem #dc35457d;
}

table a{
	color: #dc3545;
}

.btn-primary.focus, .btn-primary:focus {
	box-shadow: 0 0 0 0.2rem #dc35457d;
}
@media (min-width: 1200px){
	.container {
		max-width: 1800px !important;
	}
}
</style>

<main role="main" class="container">
	<div class="starter-template">
		<section class="content">
			<h3>DOCUMENTACION REQUERIDA PARA LA HOMOLOGACION</h3>
			<br>
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">¿ Como adjuntar la documentación ? </legend>
				<p style="text-align: left;">
					<strong>
						1.- Dar click en ADJUNTAR . <br><br>
						2.- Seleccionar el archivo que corresponda al documento solicitado. <br>

					</strong>
				</p>
				<p style="text-align: left;">
					<strong>
						Nota 1: En caso de no contar con el documento obligatorio, debera adjuntar un documento(Word) donde indique que "No cuento con el requisito". Bureau Veritas considerara esta opción como una declaración jurada de no tener planificado ó implementado el requerimiento solicitado. Este estado es irreversible, incluso durante la visita del Homologador a sus instalaciones.<br><br>

						Nota 2: Todos los documentos obligatorios deben ser adjuntados dentro del plazo de 15 días calendario a partir de haber recibido el formulario de evaluación. Sólo si es conforme, se procede con la programación de la visita técnica.<br><br>

						Nota 3: Los documentos requeridos de adjuntar no son limitativos con respectos a los documentos a revisar durante la visita técnica, debiendo considerar todo lo requerido en el Formulario para la evaluación de proveedores.<br><br>

						IMPORTANTE : Para concluir con el formulario de evaluación se requiere tener toda la documentación solicitada adjunta ( De lo contrario el sistema no le permitira concluir). Asegúrese de que toda la documentación este en formato PDF. De no adjuntar toda la información requerida no sera programada 
					</strong>
					
				</p>
			</fieldset>
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered table-hover table-responsive" width='100%' id="dataTables-example">
						<thead>
							<tr>
								<th width="120">Categoria</th>
								<th width="120">Documento</th>
								<th width="120">Nombre del Archivo</th>
								<th width="120">Adjuntar</th>
								<th width="60">Eliminar</th>
								<th width="35">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($oListAdjunto as $oItem) {$oListDetailAdj = CrmAdjunto::getListByAdj($oItem->adjID);
								echo '<tr>';
								echo '<td><strong>'.$oItem->title.'</strong></td>';
								$count=0;
								foreach ($oListDetailAdj as $oDetail) {
									$count++;
									if($count!=1){echo '<tr><td></td>';}
									$oFile = CrmAdjHomo::getItemxAdjHomo($oDetail->adjID,$_GET['r']);
									if(isset($oFile)){ echo '<td style="text-align:left;">'.$oDetail->title.'</td><td><a href="/scs/homologacion/userfiles/cms/adjunto/documento/'.$oFile->fileAdj.'" target="_blank">'.$oFile->fileAdj.'</a></td>'; }else{ echo '<td style="text-align:left;">'.$oDetail->title.'</td><td></td>'; } 
									echo '<td><a href="javascript:ModalAdj('.$oDetail->adjID.');"><i class="fa fa-file"></i></a></td>';
									echo '<td><a href="javascript:DeleteAdj('.$oDetail->adjID.');"><i class="fa fa-trash"></i></a></td>';
									echo '<td>'.$oDetail->code.'</td>';
									echo '</tr>';
								}

							} ?>
						</tbody>
					</table>

				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">&nbsp;</div>
				<div class="col-sm-2"><div class="form-group"><div class="btn btn-danger btn-block" id="btnDownload">Descargar ZIP</div></div></div>
				<div class="col-sm-1"><div class="form-group"><div class="btn btn-danger btn-block" id="btnReturn">Regresar</div></div></div>
			</div>
		</div>
		<!-- Modal -->
		<div id="myModalAdjunto" class="modal bs-Adjunto" tabindex="-1" role="dialog" data-focus-on="input:first">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Adjuntar Documento</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="form_adjunto" name="form_adjunto" autocomplete="off" enctype="multipart/form-data" method="post" target="hideFrame">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Documento (Adjuntar)</label>
									<input name="field[fileAdj]" autocomplete="off" type="file" id="fileAdj" class="form-control">
									<input type="hidden" name="homologacionID" id="homologacionID" value="<?php echo $_GET['r']; ?>">
									<input type="hidden" name="adjID" id="adjID">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<div class="btn btn-secondary" data-dismiss="modal">Cerrar</div>
						<div class="btn btn-primary" id="btn_save_voucher">Guardar Cambios</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
</main>
<script type="text/javascript">
	$(document).ready(function() {
		$(".money").maskMoney();
		$(".datepicker").datepicker();
		$('.numeric').keypress(function(event) {
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
		$('#btnReturn').click(function(){
			window.history.back();
		});
		$(".btn-pref .btn").click(function () {
			$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    		// $(".tab").addClass("active"); // instead of this do the below 
    		$(this).removeClass("btn-default").addClass("btn-primary");   
    	});

		$('#btn_save_voucher').click(function(){
			var ex = $("#fileAdj").val().split('.').pop();
			if(ex!=""){
				var fs = 0;   
				if($("#fileAdj")[0].files[0].size != undefined){
					fs = $("#fileAdj")[0].files[0].size;  
				}else{
					fs = $("#fileAdj")[0].files[0].fileSize;
				}
			}else{
				alertify.error('Porfavor ingrese un archivo');
				return false;
			}

			$('#myModalAdjunto').after('<iframe id="hideFrame" name="hideFrame" style="display:none"></iframe>'); //Target Post
			$('#form_adjunto').attr('action', '<?php echo SEO::get_URLRoot();?>ajax/form_adjunto.php');
			$('#form_adjunto').submit();
			$('.sombra').show();
			alertify.success('Solicitud de Adjunto Registrada.');
			setTimeout(function(){
				location.reload();
			}, 5000);
			$('.bs-Adjunto').modal('hide');
			// $('#form_adjunto').find("input,textarea").val('').end();
			
			return false; 
		});

		$('#btnDownload').click(function(){
			window.open('<?php echo $URL_ROOT;?>ajax/download_zip.php?homologacionID='+$('#homologacionID').val());
		});
	});

	function ModalAdj(ID){
		$('.bs-Adjunto').modal('show');
		$('#adjID').val(ID);
	}

	function DeleteAdj(ID){
		$.getJSON('<?php echo $URL_ROOT;?>ajax/delete_adj_homo.php?homologacionID='+$('#homologacionID').val()+'&adjID='+ID, function(data) {
			if(data.retval==1){
				location.reload();
			}else{
				alertify.error(data.message);
			}
		});
	}
</script>