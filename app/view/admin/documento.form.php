<?php
$userAdmin  =AdmLogin::getUserSession();
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->basePath;
?>
<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript">
  $(document).ready(function(){
    CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
    CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';

    $("#Command").val('<?php echo ($MODULE->FormView=='edit')? 'update': 'insert';?>');
  });
</script>


<script type="text/javascript">
  function on_submit(xform){
    xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
    xform.submit();
  }
</script>
<script type="text/javascript">
 $(function () {
  $('#datetimepicker1').datetimepicker({
    sideBySide: true,
    format: 'YYYY-MM-DD HH:mm:ss'
  });
});
</script>

<section class="tables">   
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="box box-default">
            <div class="card-body">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Titulo</label>
                  <div class="col-sm-10">
                    <input name="title" autocomplete="off" type="text" id="title" class="form-control" value="<?php echo $oItem->title; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Resumen</label>
                  <div class="col-sm-10">
                   <textarea class="ckeditor" name="resumen" id="resumen"><?php echo $oItem->resumen; ?></textarea>
                 </div>
               </div>
               <div class="form-group">
                <label class="col-sm-2 control-label ">Descripcion</label>
                <div class="col-sm-10">
                  <textarea class="ckeditor" name="description" id="description"><?php echo $oItem->description; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 col-lg-1 control-label " for="date">Fecha</label>
                <div class="col-sm-9 col-lg-11">
                  <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="dateDocumento" value="<?php echo $oItem->dateDocumento; ?>" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-1 control-label " for="imagen">Archivo</label>
                <div class="col-sm-9 col-lg-11">
                  <div class="input-group">
                    <input name="fileDocumento" id="imagen" value="<?php echo $oItem->fileDocumento;?>" class="form-control fmanager" rel="<?php echo $media_group["noticia_imagen"];?>" required="true" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label ">Estado</label>
                <div class="col-sm-10">
                  <label for="radio1">
                    <input type="radio" class="flat-blue" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>
                    Activo
                  </label>
                  <label for="radio2">
                    <input type="radio" class="flat-blue" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>
                    Bloqueado
                  </label>
                  <label for="radio3">
                    <input type="radio" class="flat-blue" id="radio3" name="state" value="0" <?php if($oItem->state==0) echo "checked";?>>
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