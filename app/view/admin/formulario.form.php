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
                <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->title:$MODULE->moduleName; ?></h2>
              </div>
            </div>
            <div class="card-body">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Titulo de Formulario</label>
                  <div class="col-sm-10">
                    <input name="title" autocomplete="off" type="text" id="title" class="form-control" value="<?php echo $oItem->title; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Descripcion</label>
                  <div class="col-sm-10">
                    <input name="description" autocomplete="off" type="text" id="description" class="form-control" value="<?php echo $oItem->description; ?>">
                  </div>
                </div>
                <div class="line"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Estado</label>
                  <div class="col-sm-10">
                    <label for="radio1">
                      <input type="radio" class="radio-template" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>
                      Activo
                    </label>&nbsp;&nbsp;
                    <label for="radio2">
                      <input type="radio" class="radio-template" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>
                      Bloqueado
                    </label>&nbsp;&nbsp;
                    <label for="radio3">
                      <input type="radio" class="radio-template" id="radio3" name="state" value="0" <?php if($oItem->state==0) echo "checked";?>>
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