<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="title" content="<?php echo $PAGE->metaTag['title']; ?>">
	<meta name="keywords" content="<?php echo $PAGE->metaTag['keywords']; ?>">
	<meta name="description" content="<?php echo $PAGE->metaTag['description']; ?>">
	<meta name="distribution" content="Global">
	<meta name="city" content="Lima">
	<meta name="country" content="Peru">
	<meta property="og:title" content="<?php echo $PAGE->metaTag['title']; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo SEO::get_HTTPAssets();?>images/logo.png" />
	<meta property="og:description" content="<?php echo $PAGE->metaTag['description']; ?>" />
	<title><?php echo $PAGE->pageTitle;?></title>
	<link href='<?php echo $URL_BASE;?>images/favicon.ico' rel='shortcut icon' type='image/x-icon'>
	<script src="<?php echo $URL_BASE;?>../admin/admin-plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Custom Fonts en Web-->
	<link href="<?php echo $URL_BASE;?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- JPages -->
	<link href="<?php echo $URL_BASE;?>css/jPages.css" rel="stylesheet"><!--paginado-->
	<link href="<?php echo $URL_BASE;?>css/bootstrap-datepicker.min.css" rel="stylesheet">  <!-- datepicker -->
	<!-- CSS  alertas --> 
	<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/alertify.min.css"/>
	
	<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap.min.css">


	
	<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap-modal.css"> 

	<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/dataTables.responsive.css">
	<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/buttons.bootstrap4.min.css">
	<link href="<?php echo $URL_BASE;?>css/custom.css" rel="stylesheet"><!--paginado-->
	<link type="text/css" href="<?php echo $URL_BASE;?>css/main.css" rel="stylesheet">
</head>
<body id="page-top" class="index">
	<div class="sombra"> <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></div>
	<img src="<?php echo $URL_BASE; ?>images/dama-bureau-veritas.png" class="img-dama">
	<div id="skipnav"><a href="#maincontent"></a></div>
	<?php
	include '../app/view/website/panel_top.php';
	?>

	<?php
	if(isset($oContentLang))
		include '../app/view/website/panel_content.php';
	else{
		if(isset($oSectionLang))
			include '../app/view/website/panel_section.php';
		else
			include '../app/view/website/panel_home.php';
	}
	?>

	<?php
	include '../app/view/website/panel_footer.php';
	?>   
	<?php
	$msgErr=$PAGE->getErrorMessage();
	if($msgErr!="" && $WEBSITE["DEBUG_MODE"]) echo '<div style="color: #FF0000; padding:10px; background-color: #FFFAB5; font: 10px tahoma;">Error:<br />'.$msgErr.'</div>';
		?>
		<script type="text/javascript">
			URL_BASE='<?php echo $URL_BASE;?>';
		</script>
		<script type="text/javascript">

			$(function () {
				$("input[class*='only_float']").keydown(function (event) {


					if (event.shiftKey == true) {
						event.preventDefault();
					}

					if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

					} else {
						event.preventDefault();
					}

					if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
						event.preventDefault();

				});
			});

		</script>
		<script src="<?php echo $URL_BASE;?>js/bootstrap.min.js"></script> 
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script> -->

		<!-- Contact Form JavaScript -->
		<script src="<?php echo $URL_BASE;?>js/jqBootstrapValidation.js"></script>
		<script src="<?php echo $URL_BASE;?>js/contact_me.js"></script>
		<script src="<?php echo $URL_BASE;?>js/jquery.maskMoney.js"></script>

		<script src="<?php echo $URL_BASE;?>js/jquery.dataTables.js"></script>
		<script src="<?php echo $URL_BASE;?>js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/dataTables.responsive.js"></script>


		<script src="<?php echo $URL_BASE;?>js/dataTables.buttons.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/buttons.bootstrap4.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/jszip.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/pdfmake.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/vfs_fonts.js"></script>
		<script src="<?php echo $URL_BASE;?>js/buttons.html5.min.js"></script>
		<!-- Jpages -->
		<script src="<?php echo $URL_BASE;?>js/jPages.js"></script>
		<script src="<?php echo $URL_BASE;?>js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/bootbox.min.js"></script>
		<script src="<?php echo $URL_BASE;?>js/responsive-tabs.js"></script>


		<!-- JavaScript -->
		<script src="<?php echo $URL_BASE;?>js/alertify.min.js"></script> 


	</body>
	</html>