<?php
$userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
  function on_submit(xform){
    xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
    xform.submit();
  }
  $(function(){
    $("#department").change(function(event){ 
      var id = $("#department").find(':selected').val();
      $("#province").load('<?php echo $URL_ROOT;?>ajax/select-provincia.php?id='+id); 
    });

    $("#province").change(function(event){ 
      var idDep = $("#department").find(':selected').val();
      var idProv = $("#province").find(':selected').val();
      $("#district").load('<?php echo $URL_ROOT;?>ajax/select-distrito.php?idDep='+idDep+'&idProv='+idProv); 
    });

    $("#ruc").change(function(event){ 
      var ruc = $("#ruc").val();
      $("#user").val(ruc);
    });

    $(".getNewPass").click(function(){
      var pass = $("#pass");
      $('#pass').val(randString(pass));
      console.log(randString(pass));
    });
    
  });
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
                <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->ruc:$MODULE->moduleName; ?></h2>
              </div>
            </div>
            <div class="card-body">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label ">RUC</label>
                  <div class="col-sm-10">
                    <?php
                    if($MODULE->FormView=="edit"){
                      echo '<strong>'.$oItem->ruc.'</strong>';
                      echo '<input type="hidden" name="ruc" value="'.$oItem->ruc.'" />';
                    }
                    else{
                      echo '<input name="ruc" class="form-control" type="text" id="ruc" value="'.$oItem->ruc.'" size="20" maxlength="15">';
                    }
                    ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Raz&oacute;n Social</label>
                  <div class="col-sm-10">
                    <input name="businessName" autocomplete="off" type="text" id="businessName" class="form-control" value="<?php echo $oItem->businessName; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Direcci&oacute;n</label>
                  <div class="col-sm-10">
                    <input name="address" autocomplete="off" type="text" id="address" class="form-control" value="<?php echo $oItem->address; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Departamento</label>
                  <div class="col-sm-10">
                    <select name="department" id="department" class="form-control">
                      <option value="0">Seleccione</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
                      <option value="<?php echo $obj->cod_dpto; ?>" <?php if($MODULE->FormView=="edit"){ if($obj->cod_dpto==$oItem->department) echo 'selected="true"';} ?>><?php echo $obj->nombre; ?></option><?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Provincia</label>
                  <div class="col-sm-10">
                    <select name="province" id="province" class="form-control">
                      <option value="0">Seleccione</option><?php if($MODULE->FormView=="edit"){ $lProv=CrmUbigeo::getProvincia_List($oItem->department);foreach ($lProv as $obj) {?>  
                      <option value="<?php echo $obj->cod_prov; ?>" <?php if($obj->cod_prov==$oItem->province) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option><?php }} ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Distrito</label>
                  <div class="col-sm-10">
                    <select name="district" id="district" class="form-control">
                      <option value="0">Seleccione</option><?php if($MODULE->FormView=="edit"){ $lDist=CrmUbigeo::getDistrito_List($oItem->department,$oItem->province);foreach ($lDist as $obj) {?>  
                      <option value="<?php echo $obj->cod_dist; ?>" <?php if($obj->cod_dist==$oItem->district) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option><?php }} ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Tel&eacute;fono</label>
                  <div class="col-sm-10">
                    <input name="phone" autocomplete="off" type="text" id="phone" class="form-control" value="<?php echo $oItem->phone; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Fax</label>
                  <div class="col-sm-10">
                    <input name="fax" autocomplete="off" type="text" id="fax" class="form-control" value="<?php echo $oItem->fax; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">E-mail</label>
                  <div class="col-sm-10">
                    <input name="email" autocomplete="off" type="text" id="email" class="form-control" value="<?php echo $oItem->email; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Sectorista</label>
                  <div class="col-sm-10">
                    <select name="sectorist" id="sectorist" class="form-control" autocomplete="off">
                      <option value="0">Seleccione</option><?php $list= CmsParameterLang::getWebList(1, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\"";if($MODULE->FormView=="edit"){ if($obj->parameterID==$oItem->sectorist) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?> 
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Observacion</label>
                  <div class="col-sm-10">
                    <textarea name="observation" id="observation" class="form-control"><?php echo $oItem->observation; ?></textarea>
                  </div>
                </div>
                <div class="line"></div>

                <div class="form-group">
                  <label class="col-sm-2 control-label ">Usuario</label>
                  <div class="col-sm-10">
                    <input name="user" autocomplete="off" type="text" id="user" class="form-control" value="<?php echo $oItem->user; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label ">Password</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input name="pass" style="z-index:1 " data-size="10" data-character-set="a-z,A-Z" autocomplete="off" type="text" id="pass" readOnly class="form-control" value="<?php echo $oItem->pass; ?>"><span class="input-group-btn"><button type="button" class="btn btn-default getNewPass"><span class="fa fa-refresh"></span></button></span>
                    </div>
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