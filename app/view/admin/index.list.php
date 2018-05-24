<?php
$userAdmin=AdmLogin::getUserSession();
?>
<section class="dashboard-counts no-padding-bottom">
  <div class="container-fluid">
    <div class="row bg-white has-shadow">
      <div class="row visible-md visible-lg">
        <div class="col-xs-12">
          <div class="callout callout-info">
            <h4>Info</h4>
            <p>
              En la siguiente lista se muestran todos los m&oacute;dulos del sistema. Estas opciones tambi&eacute;n estar&aacute;n disponibles en el men&uacute; superior.
              Recuerde que en las p&aacute;ginas interiores s&oacute;lo se podr&aacute; acceder usando el menu superior.
            </p>
          </div>
        </div>
      </div>
      
      <div class="row col-md-12">
        <?php
        $lMenu=AdmMenu::getList_ParentMenu(0, $userAdmin->userMenu );
        foreach($lMenu as $oMenu){
          $menuID=$oMenu->menuID;
          $menuName=$oMenu->menuName;
          $lSMenu=AdmMenu::getList_ParentMenu($menuID, $userAdmin->userMenu );
          if($lSMenu->getLength()==0) continue;
          ?>
          <div class="col-xs-12 col-md-6">
            <div class="recent-updates card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
                </div>
              </div>

              <?php
              foreach($lSMenu as $oSMenu){
                $submenuID=$oSMenu->menuID;
                $menuName =$oSMenu->menuName;
                $lModulo=AdmModule::getList_UserModule($submenuID, $userAdmin->userModule );
                if($lModulo->getLength()==0) continue;
                ?>
                <div class="card-header">
                  <h3 ><i class="fa <?php echo ($oMenu->menuIcon=='')?"fa-circle-o":$oMenu->menuIcon; ?>"></i> <?php echo $menuName;?></h3>
                </div>
                <div class="card-body no-padding">
                 <table class="table">
                  <tr>
                    <td>
                      <?php
                      foreach($lModulo as $oModule){
                        $moduleID=$oModule->moduleID;
                        $moduleName=$oModule->moduleName;
                        $moduleURL =$URL_ADMIN."?moduleID=$moduleID".($oModule->moduleParams!="" ? ("&".$oModule->moduleParams) : "");
                        ?>
                        <div>
                          <a href="<?php echo $moduleURL;?>"><i class="fa <?php echo ($oModule->moduleIcon=='')?"fa-list":$oModule->moduleIcon; ?>"></i> <?php echo $moduleName;?></a>
                        </div>
                        <?php
                      }
                      ?>
                    </td></tr>
                  </table>
                </div>
                
                <?php
              }
              ?>
            </div>
          </div>
          <div class="clear"></div>
          <?php
        }
        ?>

      </div>
    </div>
  </div>
</section>