<section class="tables">   
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="box box-default">
            <!-- /.box-header -->
            <div class="card-body">
              <div class="box-body">
                <table class="table table-bordered table-hover" width='100%' id="dataTables-example">
                  <thead>
                    <tr>
                      <th width="35">&nbsp;</th>
                      <th width="120"><?php echo $MODULE->getSortingHeader("description", "Descripcion");?></th>
                      <th width="120"><?php echo $MODULE->getSortingHeader("registerDate", "Fecha");?></th>
                      <th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $list=CrmConcepto::getList_Paging();
                    foreach ($list as $oItem) {
                      ?>
                      <tr> 
                        <td><a href="<?php echo "javascript:Edit(".$oItem->conceptoID.");"; ?>"><i class="fa fa-edit"></i></a>
                          <a href="<?php echo "javascript:Delete(".$oItem->conceptoID.");"; ?>"><i class="fa fa-remove"></i></a></td>
                          <td><?php echo $oItem->description; ?></td>
                          <td><?php echo $oItem->registerDate; ?></td>
                          <td align="center"><?php echo CrmConcepto::getState($oItem->state);?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="box-footer">
                    <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
                    <button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">exportar</button>
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
        $('#dataTables-example').DataTable({
          responsive: true,
          dom: "<'row'<'col-sm-6'f><'col-sm-6'>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-4'l><'col-sm-2'i><'col-sm-6'p>>"
        });
      });
    </script>