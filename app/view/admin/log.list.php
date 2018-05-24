<?php
$userName = OWASP::RequestString('userName');
$startDate = OWASP::RequestString('startDate');
$endDate = OWASP::RequestString('endDate');
if($startDate==NULL) $startDate=date('Y-m-d');
if($endDate==NULL) $endDate=date('Y-m-d');
$date=date_create($startDate);
$startDatex = date_format($date,"m/d/Y");
$date=date_create($endDate);
$endDatex = date_format($date,"m/d/Y");
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#daterange').daterangepicker({
      "startDate": "<?php echo $startDatex; ?>",
      "endDate": "<?php echo $endDatex; ?>"
    }, function(start, end, label) {
      $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      $('#startDate').val(start.format('YYYY-MM-DD'));
      $('#endDate').val(end.format('YYYY-MM-DD'));
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
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
                <div class="col-sm-5">
                  <div class="form-group padding-right-10">
                    <label>Usuario:</label>        
                    <input name="userName" type="text" value="<?php echo $userName?>" class="form-control" maxlength="20">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group padding-right-10">
                    <label>Rango de Fechas:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input id="daterange" class="form-control pull-right" type="text">          
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <label>&nbsp;</label>
                  <div class="form-group">
                    <input name="btnSearch" type="button" class="btn btn-primary" value="Buscar" onclick="Search(this.form)">

                  </div>
                </div>
                <input id="startDate" name="startDate" type="hidden" value="<?php echo $startDate?>">
                <input id="endDate" name="endDate" type="hidden" value="<?php echo $endDate?>">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>&nbsp;</th>
                      <th><?php echo $MODULE->getSortingHeader("logDate", "Fecha");?></th>
                      <th><?php echo $MODULE->getSortingHeader("userID", "Usuario");?></th>
                      <th><?php echo $MODULE->getSortingHeader("eventID", "Evento");?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $list=AdmLog::getList_Paging($userName, $startDate, $endDate.' 23:59:59');
                    foreach ($list as $oItem){
                      ?>
                      <tr>
                        <td nowrap="nowrap">
                          <a href="<?php echo "javascript:View('".$oItem->logDate.",".$oItem->eventID.",".$oItem->userID."');"; ?>"><i class="fa fa-eye"></i></a>
                          <a href="<?php echo "javascript:Delete('".$oItem->logDate.",".$oItem->eventID.",".$oItem->userID."');"; ?>"><i class="fa fa-remove"></i></a>
                        </td>
                        <td><?php echo $oItem->logDate; ?></td>
                        <td><?php echo $oItem->userName;?></td>
                        <td><?php echo $oItem->eventName;?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="row voffset2">
                  <div class="box-footer">
                    <input type="button" class="btn btn-primary" value="exportar" name="btnNew" onClick="Export(this.form)">
                    <?php echo $MODULE->getPaging();?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>