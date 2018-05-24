<section class="tables">   
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="box box-default">
            <div class="card-body">
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered table-hover">
                  <tr> 
                    <th>&nbsp;</th>
                    <th><?php echo $MODULE->getSortingHeader("title", "Titulo");?></th>
                    <th><?php echo $MODULE->getSortingHeader("resumen", "Resumen");?></th>
                    <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
                  </tr><?php $lCrmDocumento = CrmDocumento::getList_Paging(); foreach ($lCrmDocumento as $oItem) { ?>
                  <tr> 
                    <td>
                      <a href="<?php echo "javascript:Edit(".$oItem->documentoID.");"; ?>"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo "javascript:Delete(".$oItem->documentoID.");"; ?>"><i class="fa fa-remove"></i></a>
                    </td>
                    <td><?php echo $oItem->title; ?></td>
                    <td><?php echo $oItem->resumen; ?></td>
                    <td><?php echo CrmDocumento::getState($oItem->state);?></td>
                  </tr>
                  <?php } ?>
                </table>

              </div>
            </div>
            <div class="card-footer">
              <div class="box-footer">
                <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
                <?php echo $MODULE->getPaging();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


