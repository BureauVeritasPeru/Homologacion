<?php
$lLang=CmsLang::getList_Active();
if(CmsLang::getErrorMsg()!="") $MODULE->addError(CmsLang::getErrorMsg());
  ?>
  <section class="tables">   
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="box box-default">

              <div class="card-body">
                <div class="box-body">
                  <table class="table table-bordered table-hover" id="dataTables-example">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th><?php echo $MODULE->getSortingHeader("parameterName", "Nombre");?></th>
                        <th><?php echo $MODULE->getSortingHeader("active", "Estado");?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      if($oItem->groupID == 9 || $oItem->groupID == 12){
                        $list = CmsParameterLang::getListParent_Paging($oItem->groupID, $oItem->parentParameterID, $langID);
                      }
                      else{
                        $list = CmsParameterLang::getList_Paging($groupID, $langID);
                      }
                      foreach($list as $oItem){
                        ?>
                        <tr>
                          <td><a href="<?php echo "javascript:Edit(".$oItem->parameterID.");"; ?>"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo "javascript:Delete(".$oItem->parameterID.");"; ?>"><i class="fa fa-remove"></i></a>
                          </td>
                          <td><?php echo $oItem->parameterName; ?></td>
                          <td><?php echo CmsParameterLang::getActive($oItem->active);?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="box-footer">
                    <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">Nuevo(a) <?php echo $MODULE->moduleName; ?></button>

                    <?php echo $MODULE->getPaging();?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <script type="text/javascript">
      $(document).ready(function() {
        $('#btn-formI').hide();
        $('#btn-formU').hide();
        $('#dataTables-example').DataTable({
          responsive: true,
          dom:"<'col-sm-12'f><'col-sm-12'>"+
          "<'col-sm-12'tr>" +
          "<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>"
        });
      });
    </script>