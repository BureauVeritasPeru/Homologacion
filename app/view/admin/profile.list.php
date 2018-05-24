<section class="tables">   
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
         <div class="box box-default">
          <!-- /.box-header -->
          <div class="card-body">
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th><?php echo $MODULE->getSortingHeader("profileName", "Perfil");?></th>
                  </tr>
                </thead>
                <?php
                $lAdmProfile=AdmProfile::getList_Paging();
                foreach ($lAdmProfile as $oItem){
                  ?>
                  <tr>
                    <td nowrap="nowrap"><?php if($oItem->isDefault==0){ ?>
                      <a href="<?php echo "javascript:Edit(".$oItem->profileID.");"; ?>"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo "javascript:Delete(".$oItem->profileID.");"; ?>"><i class="fa fa-remove"></i></a>
                      <?php } else {?>
                      <a href="<?php echo "javascript:View(".$oItem->profileID.");"; ?>"><i class="fa fa-edit"></i></a>
                      <?php } ?>
                    </td>
                    <td><?php echo $oItem->profileName; ?> <?php if($oItem->isDefault==1) echo '<small><i class="fa fa-lock text-primary"></i></small>'; ?></td>
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