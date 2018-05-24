<?php
?>
<section class="tables">   
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="box box-default">
            <div class="card-body">
              <div class="box-body">
                <div class="form-group">
                  <div class="col-sm-2"><strong>Fecha</strong></div>      
                  <div class="col-sm-10">
                    <?php echo $oItem->logDate; ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2"><strong>Usuario</strong></div>      
                  <div class="col-sm-10">
                    <?php echo $oItem->userName; ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2"><strong>Evento</strong></div>      
                  <div class="col-sm-10">
                    <?php echo $oItem->eventName; ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2"><strong>Comentario</strong></div>      
                  <div class="col-sm-10">
                    <?php echo $oItem->logDate; ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2"><strong>Inf. t&eacute;nica</strong></div>      
                  <div class="col-sm-10">
                    <?php echo unserialize($oItem->object);?>
                  </div>
                </div>

                <div class="form-group">      
                  <div class="col-sm-12"> 
                    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();" />

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</section>