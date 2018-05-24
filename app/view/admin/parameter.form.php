<?php

//if(!isset($oItem->attribute['icono'])) $oItem->attribute['icono']=null;
?>
<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<?php //include('../app/include/admin/galleries.php');?>
<script type="text/javascript">
  function on_submit(xform){
   if($("#parameterName").val() ==""){
    alertify.error("Por favor, ingrese el campo [Nombre]");
    $("#parameterName").focus();
    return false;
  }

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
                <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->parameterName:$MODULE->moduleName; ?></h2>
              </div>
            </div>
            <div class="card-body">
              <div class="box-body">
                <input type="hidden" name="groupID" value="<?php echo $oItem->groupID;?>">
                <input type="hidden" name="langID" value="1">
                
                <input type="hidden" name="parentParameterID" value="'.$oItem->parentParameterID.'" />
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Nombre</label>
                  <div class="col-sm-10">
                    <input name="parameterName" type="text" class="form-control" class="text" id="parameterName" value="<?php echo $oItem->parameterName; ?>" maxlength="255">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label ">Descripci&oacute;n</label>
                  <div class="col-sm-10">
                    <textarea name="description" id="description" class="form-control" rows="4"><?php echo $oItem->description; ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label ">Estado</label>
                  <div class="col-sm-10">
                    <?php 
                    if($MODULE->FormView!="edit"){
                      ?>
                      <input type="checkbox" class="checkbox-template" name="active" value="1" checked> &nbsp;&nbsp;Activo
                      <?php 
                    }else{
                      ?>
                      <input type="checkbox" class="checkbox-template" name="active" value="1" <?php if($oItem->active==1) print "checked";?>> &nbsp;&nbsp;Activo
                      <?php 
                    } ?>
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