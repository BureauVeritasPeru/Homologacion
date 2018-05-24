<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" dir="ltr" lang="es"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" dir="ltr" lang="es" style="height: 100%;">
<!--<![endif]-->
<head>
    <title><?php echo $MODULE->moduleName;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo $URL_BASE;?>favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo $URL_BASE;?>favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/font-awesome.min.css">

    
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>admin-plugins/daterangepicker/daterangepicker-bs3.css">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- <link rel="stylesheet" href="<?php echo $URL_BASE;?>dist/css/AdminLTE.min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo $URL_BASE;?>dist/css/skins/skin-black-light.min.css"> -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/fileinput.css">
    
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/alertify.min.css"/>    
    

    
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>admin-plugins/iCheck/all.css">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap-datetimepicker.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/custom.css">

    

    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/dataTables.responsive.css">

    <!-- <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css"> -->


    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/iCheck/icheck.min.js"></script>
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap-modal.css"> 
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo $URL_BASE;?>admin-plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <!-- <script src="<?php echo $URL_BASE;?>dist/js/app.min.js"></script> -->
    <!-- Slimscroll -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script src="<?php echo $URL_BASE;?>js/navigate.js" type="text/javascript"></script>
    <!-- <script src="<?php echo $URL_BASE;?>js/custom.js" type="text/javascript"></script> -->
    <script src="<?php echo $URL_BASE;?>js/fileinput.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.validation.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <!-- <script src="<?php echo $URL_BASE;?>bootstrap/js/bootstrap.min.js"></script> -->
    <!-- JavaScript -->
    <script src="<?php echo $URL_BASE;?>js/alertify.min.js"></script>

    <script src="<?php echo $URL_BASE;?>js/moment-with-locales.js"></script>

    <script src="<?php echo $URL_BASE;?>js/bootstrap-datetimepicker.js"></script>

    <script src="<?php echo $URL_BASE;?>js/jquery.dataTables.js"></script>

    <script src="<?php echo $URL_BASE;?>js/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo $URL_BASE;?>js/dataTables.responsive.js"></script>

    <script type="text/javascript">
        <?php echo $MODULE->clientScript; ?>
    </script>
</head>
<body>
    <div class="sombra"> <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></div>
    <div class="page home-page">
        <header class="header">
            <?php require_once('../app/include/admin/panel_head.php'); ?>
        </header>
        <div class="page-content d-flex align-items-stretch" style="height:1189px;">
            <!-- Left side column. contains the logo and sidebar -->
            <nav class="side-navbar">
                <?php require_once('../app/include/admin/menu_main.php'); ?>
            </nav>
            <div class="content-inner">
                <div class="content-wrapper">
                    <?php require_once('../app/include/admin/content_header.php'); ?>
                    <!-- Main content -->
                    <?php $file_view="../app/view/admin/".$MODULE->getFormView(); if(!file_exists($file_view)) $MODULE->addError("No se puede localizar el archivo: ".$file_view); ?><?php  if($MODULE->msgError!=""){ ?>
                        <div class="box box-danger box-solid" style="margin-bottom: -17px;">
                            <div class="box-body">
                                <ul class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $MODULE->msgError;?>

                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($MODULE->msgAlert!=""){ ?>
                            <div class="box box-success box-solid">
                                <div class="box-body"><ul class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?php echo $MODULE->msgAlert;?></ul></div>
                            </div>
                            <?php }?>

                            <form name="frmMain" id="frmMain" class="form-horizontal" action="<?php echo $MODULE->getURL();?>" method="post" autocomplete="off">
                                <input type="hidden" name="Command" id="Command" />
                                <input type="hidden" name="moduleID" id="moduleID" value="<?php echo $MODULE->moduleID; ?>" />
                                <input type="hidden" name="FormView" id="FormView" value="<?php echo $MODULE->FormView; ?>" />
                                <input type="hidden" name="kID" id="kID" value="<?php echo $kID;?>" />
                                <input type="hidden" name="Page" id="Page" value="<?php echo $MODULE->Page;?>" />
                                <input type="hidden" name="OrderBy" id="OrderBy" value="<?php echo $MODULE->OrderBy;?>" />
                                <?php
                                $file_view="../app/view/admin/".$MODULE->getFormView();
                                if(file_exists($file_view))
                                    include($file_view.'');
                                ?>
                            </form>
                            <!-- Modal de Importacion -->
                            <div class="modal bs-modal_import" id="ModalImport" tabindex="-1" role="dialog"  data-focus-on="input:first">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4>Seleccione un archivo de csv (csv):</h4>
                                        </div>
                                        <form id="myForm">
                                            <div class="modal-body">
                                                <input type="file" name="fleImport" id="fleImport" class="form-control-file" />
                                            </div>

                                            <div class="modal-footer">
                                                <a href="/scs/homologacion/userfiles/modelo-importacion-proveedor.csv" download id="btnDemo" name="btnDemo" class="btn btn-primary" />demo</a>
                                                <input type="button" value="continuar" id="btnSelect" name="btnSelect" class="btn btn-success" />
                                                <input type="button" value="cerrar" id="btnClose" name="btnClose" class="btn btn-primary" data-dismiss="modal" />
                                            </div>
                                        </form>
                                        <div class="modal-footer FiltroImport" style="text-align:left !important;overflow-y: scroll;height:auto;display: block;overflow-x: scroll;">
                                            <section class="content" style="margin-right: 95px;">
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4>Respuesta</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="RespuestaImport"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3 pull-right">
                                                        <div class="btn btn-primary" id="ready_import">Iniciar la Importacion</div>        
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal de Importacion -->
                        </div>
                        <footer class="main-footer">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-sm-6">
                                    <p>Bureau Veritas &copy; 2017</p>
                                </div>
                                <div class="col-sm-6 text-right">
                                  <p>Copyright © <a href="https://bootstrapious.com/admin-templates" class="external">Bureau Veritas</a></p>
                              </div>
                          </div>
                      </div>
                  </footer>
              </div>
          </div>
      </div>


      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
      <script src="<?php echo $URL_BASE;?>js/tether.min.js"></script>
      <script src="<?php echo $URL_BASE;?>js/bootstrap.min.js"></script> 
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
      <script src="<?php echo $URL_BASE;?>js/jquery.cookie.js"> </script>
      <script src="<?php echo $URL_BASE;?>js/jquery.validate.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="<?php echo $URL_BASE;?>js/charts-home.js"></script> -->
    <script src="<?php echo $URL_BASE;?>js/front.js"></script>
    <script src="<?php echo $URL_BASE;?>js/jquery.maskMoney.js"></script>
    <script src="<?php echo $URL_BASE;?>js/jquery.mask.min.js"></script>
    <script src="<?php echo $URL_BASE;?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo $URL_BASE;?>js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo $URL_BASE;?>js/bootstrap-modalmanager.js"></script>
    <script src="<?php echo $URL_BASE;?>js/bootstrap-modal.js"></script>
    <script src="<?php echo $URL_BASE;?>js/bootbox.min.js"></script>
    <script src="<?php echo $URL_BASE;?>js/custom.js"></script>

</body>
</html>