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
                    <input name="title" autocomplete="off" type="text" id="title" class="form-control" value="<?php echo $oItem->title; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">CC</label>
                  <div class="col-sm-10">
                    <input name="desde" autocomplete="off" type="text" id="desde" class="form-control" value="<?php echo $oItem->desde; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Asunto</label>
                  <div class="col-sm-10">
                    <input name="subject" autocomplete="off" type="text" id="subject" class="form-control" value="<?php echo $oItem->subject; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Message</label>
                  <div class="col-sm-10">
                    <textarea  name="message" class="ckeditor" id="message"><?php echo $oItem->message; ?></textarea>
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
