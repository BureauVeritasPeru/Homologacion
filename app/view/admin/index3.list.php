<style type="text/css">
a.full {
  width: 100%;
  height: 100%;
  background: url(assets/admin/images/bg-a.png);
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1000;
}
</style>

<?php 
function getMonth($m){
  switch ($m) {
    case 01:
    return 'Ene';
    break;
    case 02:
    return 'Feb';
    break;
    case 03:
    return 'Mar';
    break;
    case 04:
    return 'Abr';
    break;
    case 05:
    return 'May';
    break;
    case 06:
    return 'Jun';
    break;
    case 07:
    return 'Jul';
    break;
    case 08:
    return 'Ago';
    break;
    case 09:
    return 'Sep';
    break;
    case 10:
    return 'Oct';
    break;
    case 11:
    return 'Nov';
    break;
    case 12:
    return 'Dic';
    break;
  }
}
?>
<section class="dashboard-counts no-padding-bottom">
  <div class="container-fluid">
    <div class="row bg-white has-shadow">
      <?php $ListIndicador = CrmIndicador::getList(); $count=0; foreach ($ListIndicador as $oItem) {  
        $count++;
        switch($count){
          case '1': $var = 'violet';
          break;
          case '2': $var = 'red';
          break;
          case '3': $var = 'green';
          break;
          case '4': $var = 'orange';
          break;
        }
        ?>
        <div class="col-xl-3 col-sm-6">
          <a href="#" class="full"  data-toggle="modal" data-target="#myModalInd<?php echo $oItem->indicadorID; ?>"></a>
          <div class="item d-flex align-items-center">
            <div class="icon bg-<?php echo $var; ?>"><i class="fa <?php echo $oItem->icon; ?> fa-2x" style="margin-top: 25px"></i></div>
            <div class="title"><span><?php echo $oItem->title; ?></span>
              <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-<?php echo $var; ?>"></div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <section class="dashboard-header">
    <div class="container-fluid">
      <div class="row">
        <div class="statistics col-lg-3 col-12">
          <?php $ListBloque = CrmBloque::getList(); $count=0; foreach ($ListBloque as $oItem) {  
            $count++;
            switch($count){
              case '1': $var = 'violet';
              break;
              case '2': $var = 'red';
              break;
              case '3': $var = 'green';
              break;
            }
            ?>
            <div class="statistic d-flex align-items-center bg-white has-shadow">
              <?php if($oItem->fileBloque != ''){ ?>
              <a href="<?php echo 'userfiles/'.$oItem->fileBloque; ?>"  download class="full"></a>
              <?php }else{ ?>
              <a href="#" class="full"  data-toggle="modal" data-target="#myModalBloque<?php echo $oItem->bloqueID; ?>"></a>
              <?php } ?>
              <div class="icon bg-<?php echo $var; ?>"><i class="fa <?php echo $oItem->icon; ?>"></i></div>
              <div class="text"><strong><?php echo $oItem->subtitle; ?></strong><?php if($oItem->resumen!= null){ ?><br><small><?php echo $oItem->resumen; ?></small><?php } ?><br><strong><?php echo $oItem->title; ?></strong></div>
            </div>
            <?php } ?>
          </div>
          <div class="col-lg-6 col-12">
            <div class="recent-updates card">
              <div class="card-close">
                <div class="dropdown">
                  <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                  <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
                </div>
              </div>
              <div class="card-header">
                <h3 class="h4">Novedades / Noticias</h3>
              </div>
              <div class="card-body no-padding"><?php $ListNovedad = CrmNovedad::getList(); foreach ($ListNovedad as $oItem) { $dd = date("d", strtotime($oItem->dateNovedad)); $mm = date("m", strtotime($oItem->dateNovedad)); ?>
                <div class="item d-flex justify-content-between">
                  <a href="#" class="full"  data-toggle="modal" data-target="#myModal<?php echo $oItem->novedadID; ?>"></a>
                  <div class="info d-flex">
                    <div class="icon"><i class="icon-rss-feed"></i></div>
                    <div class="title">
                      <h5><?php echo $oItem->title; ?></h5>
                      <p><?php echo $oItem->resumen; ?></p>
                    </div>
                  </div>
                  <div class="date text-right"><strong><?php echo $dd; ?></strong><span><?php echo getMonth($mm); ?></span></div>
                </div><?php } ?>
              </div>
            </div>
          </div>
          <div class="chart col-lg-3 col-12">
            <div class="calendar"></div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
       $(function(){

        $('.calendar').datepicker({
          keyboardNavigation: false,
          todayHighlight: true
        });
        ListaFechaActividades();

        $('.day').click(function(){
          console.log($(this).html());
          BusquedaFechaActividades($(this).html());
        });
      });

       function MesxNumero(i){
        switch (i) {
          case 'Enero':
          mes = "01";
          break;
          case 'Febrero':
          mes = "02";
          break;
          case 'Marzo':
          mes = "03";
          break;
          case 'Abril':
          mes = "04";
          break;
          case 'Mayo':
          mes = "05";
          break;
          case 'Junio':
          mes = "06";
          break;
          case 'Julio':
          mes = "07";
          break;
          case 'Agosto':
          mes = "08";
          break;
          case 'Septiembre':
          mes = "09";
          break;
          case 'Octubre':
          mes = "10";
          break;
          case 'Noviembre':
          mes = "11";
          break;
          case 'Diciembre':
          mes = "12";
          break;
        }
        return mes;
      }

      function ListaFechaActividades(){
        var str = $('.datepicker-switch').html();
        var res = str.split(" ");
        $('.old').removeClass('new-day');
        $('.new').removeClass('new-day');
        $.each( $('.new-day'), function( i, val) {
          <?php $ListActividad = CrmActividad::getList(); 
          foreach ($ListActividad as $oItem) { 
            $d = date("d", strtotime($oItem->dateActividad)); 
            $m = date("m", strtotime($oItem->dateActividad));
            $y = date("Y", strtotime($oItem->dateActividad));
            ?>
            if(res[1] == <?php echo $y; ?>){
              if(MesxNumero(res[0]) == <?php echo $m; ?>){
                if($(this).html() == <?php echo $d; ?>){
                  $(this).addClass('active');
                }
              }
            }
            <?php } ?>
          });
      }

      function BusquedaFechaActividades(i){
        var str = $('.datepicker-switch').html();
        var res = str.split(" ");
        var d = i;
        $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_actividad.php?d='+ d +'&m='+MesxNumero(res[0])+'&y='+res[1], function(data) {
          if(data.retval==1){
            $('.card-actividad').empty();
            $('.lista-Actividad').empty();
            $('.card-actividad').append(data.msg);
            $('.lista-Actividad').append(data.msg2);
          }else{
            $('.card-actividad').empty();
            $('.lista-Actividad').empty();
            $('.card-actividad').append(data.msg);
          }
        });
      }
    </script>
  </section>
  <section class="updates no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 resp-act">
          <div class="recent-activities card">
            <div class="card-close">
              <div class="dropdown">
                <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
              </div>
            </div>
            <div class="card-header">
              <h3 class="h4">Actividades</h3>
            </div>
            <div class="card-body no-padding card-actividad"><?php $ListActividad = CrmActividad::getList(); foreach ($ListActividad as $oItem) { $date = date("d/m/Y", strtotime($oItem->dateActividad)); $hour = date("H", strtotime($oItem->dateActividad)); $minute = date("i", strtotime($oItem->dateActividad)); ?>
              <div class="item">
                <div class="row">
                  <a href="#" class="full"  data-toggle="modal" data-target="#myModalActividad<?php echo $oItem->actividadID; ?>"></a>
                  <div class="col-4 date-holder text-right">
                    <div class="icon"><i class="icon-clock"></i></div>
                    <div class="date"> <span><?php echo $hour.':'.$minute; ?></span><br><span class="text-info"><?php echo $date; ?></span></div>
                  </div>
                  <div class="col-8 content">
                    <h5><?php echo $oItem->title; ?></h5>
                    <p><?php echo $oItem->resumen; ?></p>
                  </div>
                </div>
              </div><?php } ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 ">
          <div class="daily-feeds card"> 
            <div class="card-close">
              <div class="dropdown">
                <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
              </div>
            </div>
            <div class="card-header">
              <h3 class="h4">Documentos / Normas</h3>
            </div>
            <div class="card-body no-padding">
              <?php $ListDocumento = CrmDocumento::getList(); foreach ($ListDocumento as $oItem) { $date = date("d/m/Y", strtotime($oItem->dateDocumento)); $hour = date("H", strtotime($oItem->dateDocumento));$minute = date("i", strtotime($oItem->dateDocumento));?>
              <div class="item">
                <div class="feed d-flex justify-content-between">
                  <a href="<?php echo 'userfiles/'.$oItem->fileDocumento; ?>"  download class="full"></a>
                  <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src="<?php echo $URL_BASE;?>images/avatar.jpg" alt="person" class="img-fluid rounded-circle"></a>
                    <div class="content">
                      <h5><?php echo $oItem->title; ?></h5><span><?php echo $oItem->resumen; ?></span>
                      <div class="full-date"><small><?php echo $hour.':'.$minute; ?> - <?php echo $date; ?></small></div>
                    </div>
                  </div>
                  <div class="date text-right"><small><?php echo $date; ?></small></div>
                </div>
              </div><?php } ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="daily-feeds card"> 
            <div class="card-close">
              <div class="dropdown">
                <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
              </div>
            </div>
            <div class="card-header">
              <h3 class="h4">Lecciones Aprendidas</h3>
            </div>
            <div class="card-body no-padding"><?php $ListLeccion = CrmLeccion::getList(); foreach ($ListLeccion as $oItem) {$date = date("d/m/Y", strtotime($oItem->dateLeccion));$hour = date("H", strtotime($oItem->dateLeccion));$minute = date("i", strtotime($oItem->dateLeccion)); ?>
              <div class="item">
                <div class="feed d-flex justify-content-between">
                  <a href="<?php echo 'userfiles/'.$oItem->fileLeccion; ?>" download class="full"></a>
                  <div class="feed-body d-flex justify-content-between"><a href="#" class="feed-profile"><img src="<?php echo $URL_BASE;?>images/avatar2.jpg" alt="person" class="img-fluid rounded-circle"></a>
                    <div class="content">
                      <h5><?php echo $oItem->title; ?></h5><span><?php echo $oItem->resumen; ?></span>
                      <div class="full-date"><small><?php echo $hour.':'.$minute; ?> - <?php echo $date; ?></small></div>
                    </div>
                  </div>
                  <div class="date text-right"><small><?php echo $date; ?></small></div>
                </div>
              </div><?php } ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 resp-act-web">
          <div class="recent-activities card">
            <div class="card-close">
              <div class="dropdown">
                <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
              </div>
            </div>
            <div class="card-header">
              <h3 class="h4">Actividades</h3>
            </div>
            <div class="card-body no-padding card-actividad"><?php $ListActividad = CrmActividad::getList(); foreach ($ListActividad as $oItem) { $date = date("d/m/Y", strtotime($oItem->dateActividad)); $hour = date("H", strtotime($oItem->dateActividad)); $minute = date("i", strtotime($oItem->dateActividad)); ?>
              <div class="item">
                <div class="row">
                  <a href="#" class="full"  data-toggle="modal" data-target="#myModalActividad<?php echo $oItem->actividadID; ?>"></a>
                  <div class="col-4 date-holder text-right">
                    <div class="icon"><i class="icon-clock"></i></div>
                    <div class="date"> <span><?php echo $hour.':'.$minute; ?></span><br><span class="text-info"><?php echo $date; ?></span></div>
                  </div>
                  <div class="col-8 content">
                    <h5><?php echo $oItem->title; ?></h5>
                    <p><?php echo $oItem->resumen; ?></p>
                  </div>
                </div>
              </div><?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>






  <?php $ListNovedad = CrmNovedad::getList(); foreach ($ListNovedad as $oItem) { $dd = date("d", strtotime($oItem->dateNovedad)); $mm = date("m", strtotime($oItem->dateNovedad)); ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $oItem->novedadID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $oItem->title; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo $oItem->description; ?>
        </div>
        <div class="modal-footer">
          <a href="<?php echo 'userfiles/'.$oItem->fileNovedad; ?>" download class="btn btn-danger">Descargar Archivo</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <div class="lista-Actividad">
    <?php $ListActividad = CrmActividad::getList(); foreach ($ListActividad as $oItem) { $date = date("d/m/Y", strtotime($oItem->dateActividad)); $hour = date("H", strtotime($oItem->dateActividad)); $minute = date("i", strtotime($oItem->dateActividad)); ?>
    <!-- Modal -->
    <div class="modal fade" id="myModalActividad<?php echo $oItem->actividadID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo $oItem->title; ?> - <?php echo $date.' - '.$hour.':'.$minute; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo $oItem->description; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>

  <?php $ListIndicador = CrmIndicador::getList(); foreach ($ListIndicador as $oItem) { ?>
  <!-- Modal -->
  <div class="modal fade" id="myModalInd<?php echo $oItem->indicadorID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $oItem->title; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo $oItem->description; ?>
        </div>
        <div class="modal-footer">
          <a href="<?php echo 'userfiles/'.$oItem->fileIndicador; ?>" download class="btn btn-danger">Descargar Archivo</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php $ListBloque = CrmBloque::getList(); foreach ($ListBloque as $oItem) { 
    if($oItem->fileBloque == ''){
      ?>
      <!-- Modal -->
      <div class="modal fade" id="myModalBloque<?php echo $oItem->bloqueID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php echo $oItem->title; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo $oItem->description; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <?php } }?>




