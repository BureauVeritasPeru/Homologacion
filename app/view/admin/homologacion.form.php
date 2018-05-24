<?php //Get MediaGroup
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->basePath;
?>
<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript">
  $(document).ready(function(){
    CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
    CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
  });
</script>

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
                <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?'Homologacion : '.$oItem->homologacionID:$MODULE->moduleName; ?>
              </h2>
            </div>
          </div>
          <?php 
          if($MODULE->FormView=="edit"){
            $oRequerimiento = CrmRequerimiento::getItem($oItem->requerimientoID);
            $oProveedor = CrmProveedor::getItem($oRequerimiento->proveedorID);
            $oPropxform = CrmPropxForm::getItem($oRequerimiento->propxformID);
            $oPropuesta = CrmPropuesta::getItem($oPropxform->propuestaID);
            $oCliente = CrmCliente::getItem($oPropuesta->clienteID);
          } 
          ?>
          <div class="card-body">
            <div class="box-body">
              <fieldset class="scheduler-border">
                <legend class="scheduler-border">Control de Homologación</legend>
                <input type="hidden" name="homologacionID" id="homologacionID" value="<?php echo $oItem->homologacionID; ?> ">
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Nro. Inspección</label>
                  <div class="col-sm-10">
                    <?php if($MODULE->FormView=="edit"){ echo '<strong>'.$oRequerimiento->requerimientoID.'</strong>'; } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Periodo</label>
                  <div class="col-sm-10">
                    <?php if($MODULE->FormView=="edit"){ echo '<strong>'.$oRequerimiento->period.'</strong>'; } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Cliente</label>
                  <div class="col-sm-10"><?php if($MODULE->FormView=="edit"){ echo '<strong>'.$oCliente->businessName.'</strong>'; } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Contrato</label>
                <div class="col-sm-10"><?php if($MODULE->FormView=="edit"){ echo '<strong>'.$oPropxform->titleForm.'</strong>'; } ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label ">Proveedor</label>
              <div class="col-sm-10">
                <?php if($MODULE->FormView=="edit"){ echo '<strong>'.$oProveedor->businessName.'</strong>'; } ?>
              </div>
            </div>
          </fieldset>
          <?php if($oItem->state != 1){ ?>
            <fieldset class="scheduler-border">
              <legend class="scheduler-border">Calendario de Homologacion</legend>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Fecha Programada</label>
                <div class="col-sm-10">
                  <?php
                  if($MODULE->FormView=="edit"){echo '<input type="text" readOnly id="programaFecha" class="form-control" value="'.$oItem->programDate.' '.$oItem->hourDate.' - '.$oItem->hourEndDate.'" ></input>'; } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Homologador</label>
                <div class="col-sm-10">
                  <?php  $oUser = AdmUser::getItem($oItem->userID);
                  if(isset($oUser)){
                    if($MODULE->FormView=="edit"){ echo '<input type="text" readOnly id="auditor" class="form-control" value="'.$oUser->firstName.' '.$oUser->lastName.'"></input>'; }
                  }else{
                    if($MODULE->FormView=="edit"){ echo '<input type="text" readOnly id="auditor" class="form-control" value=""></input>'; }
                  }
                  ?>
                </div>
              </div>
              <?php if($oItem->state != 4 && $oItem->state != 5 && $oItem->state != 6 && $oItem->state != 7 ){ ?>
                <div class="form-group">
                  <div class="col-sm-6">
                    <div class="btn btn-primary" id="calendar-homo" >Ver Calendario de Auditor</div>
                  </div>
                </div>
                <?php } ?>
              </fieldset>
              <?php } ?>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Documento Infocorp</label>
                <div class="col-sm-10 input-group">
                  <input name="document" id="document" class="form-control fmanager" rel="<?php echo $media_group["homologacion_documento"];?>" required="true" type="text"  value="<?php echo $oItem->document; ?>"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Alcance</label>
                <div class="col-sm-10">
                  <input  autocomplete="off" type="text" id="scope" name="scope" class="form-control" value="<?php echo $oItem->scope; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Observaciones</label>
                <div class="col-sm-10">
                  <textarea id="observation" class="form-control" name="observation"><?php echo $oItem->observation; ?></textarea>
                </div>
              </div>
              <div class="line"></div>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#valHourDate').mask('00:00');
    $('.calendar').datepicker({
      keyboardNavigation: false,
      todayHighlight: true
    });
    ListaFechaActividades();

    $('.day').click(function(){
      console.log($(this).html());
      BusquedaFechaActividades($(this).html());
    });

    $('#calendar-homo').click(function(){
      $('.bs-Calendar').modal('show');
      $('#homologacionHidID').val($('#homologacionID').val());
    });
    $('.close').click(function(){
      $('.bs-Calendar').modal('hide');
    });
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

  function ListaFechaActividades(){
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
        if(res[1] == <?php echo $y; ?>){
          if(MesxNumero(res[0]) == <?php echo $m; ?>){
            if($(this).html() == <?php echo $d; ?>){
              $(this).addClass('active');
            }
          }
        }
        <?php } ?>
      });
  }

  function BusquedaFechaActividades(i){
    var str = $('.datepicker-switch').html();
    var res = str.split(" ");
    var d = i;
    $('#valProgramDate').val(res[1]+'-'+MesxNumero(res[0])+'-'+d);
    $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_fecha_homologacion.php?d='+ d +'&m='+MesxNumero(res[0])+'&y='+res[1], function(data) {
      if(data.retval==1){
        $('.list-homologacion').empty();
        $('.list-homologacion').append(data.msg);
      }else{
        $('.list-homologacion').empty();
        $('.list-homologacion').append(data.msg);
      }
    });
  }
</script>


<!-- Inicio Modal Contacto  -->
<div id="myModalcalendar" class="modal bs-Calendar" tabindex="-1" role="dialog" data-focus-on="input:first">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Calendario de Auditores</h4>
        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
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
                        <th width="35"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
                      </tr>
                    </thead>
                    <tbody class="list-homologacion"><?php $list=CrmHomologacion::getListInProcess(); foreach ($list as $oItem) { $oUser = AdmUser::getItem($oItem->userID);
                      ?>
                      <tr> 
                        <td><?php echo $oItem->homologacionID; ?></td>
                        <td><?php echo $oUser->firstName.' '.$oUser->lastName; ?></td>
                        <td align="center"><?php echo $oItem->programDate.' '.$oItem->hourDate;?></td>
                        <td align="center"><?php echo CrmHomologacion::getState($oItem->state);?></td>
                        </tr><?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <label>Fecha</label>
                    <input name="valProgramDate" type="text" class="form-control" id="valProgramDate"  placeholder="Ingrese Fecha" maxlength="100" readOnly value="<?php echo $oItem->programDate; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label>Hora de Inicio </label>
                    <input name="valHourDate" type="text" class="form-control" id="valHourDate" placeholder="Ingrese Hora" maxlength="100" value="<?php echo $oItem->hourDate; ?>"> 
                  </div>
                  <div class="col-sm-3">
                    <label>Hora de Fin </label>
                    <input name="valHourEndDate" type="text" class="form-control" id="valHourEndDate" placeholder="Ingrese Hora" maxlength="100" value="<?php echo $oItem->hourEndDate; ?>"> 
                  </div>
                  <div class="col-sm-3">
                    <label>Auditor</label>
                    <select name="valUserID" id="valUserID" class="form-control">
                      <option value="0">Seleccione</option><?php $list= AdmUser::getListHomologador(); foreach ($list as $obj) { echo "<option value=\"".$obj->userID."\""; if($obj->userID == $oItem->userID){ echo 'selected'; } echo ">".$obj->firstName.' '.$obj->lastName."</option>";}?>
                    </select>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-sm-5">
              <div class="btn btn-primary btn-block" name="btnAddProgramacion" id="btnAddProgramacion"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Programar</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function(){
      $( "#btnAddProgramacion" ).click(function() {
        var homologacionID  = $("#homologacionHidID").val();
        var valProgramDate  = $("#valProgramDate").val(); 
        var valHourDate     = $("#valHourDate").val();
        var valHourEndDate  = $("#valHourEndDate").val();
        var valUserID       = $("#valUserID").val();

        $.getJSON('<?php echo $URL_ROOT;?>ajax/programa_homologacion.php?homologacionID='+homologacionID+'&programDate='+valProgramDate+'&hourDate='+valHourDate+'&hourEndDate='+valHourEndDate+'&userID='+valUserID, function(data) {
          if(data.retval==1){
            alertify.success('Homologacion Programada Correctamente');
            $('.bs-Calendar').modal('hide');
            $('#programDate').val('');
            $('#hourDate').val('');
            $('#hourEndDate').val('');
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
    });
  </script>
<!-- Fin Modal Contacto  -->