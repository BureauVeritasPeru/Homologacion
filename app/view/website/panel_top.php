<?php if (WebLogin::isLoggedCliente() || WebLogin::isLoggedProveedor() || WebLogin::isLoggedAdmin() ){ 
	$oCliente=WebLogin::getClienteSession(); 
	$oProveedor=WebLogin::getProveedorSession(); 
	$oAdmin=WebLogin::getAdminSession(); 
	?>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<?php
		include("../app/include/website/toolbar.php");
		?>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<?php
				if(isset($oProveedor)){
					include("../app/include/website/menu.php");
				}
				?>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<?php if(isset($oProveedor)){ ?>
				<a class="mr-sm-2" style="margin-right:1.5rem!important;" href="<?php echo SEO::get_URLHome();?>">Bienvenido <?php echo $oProveedor->businessName; ?> </a>
				<?php }else if(isset($oCliente)){ ?>
				<a class="mr-sm-2" style="margin-right:1.5rem!important;" href="<?php echo SEO::get_URLHome();?>">Bienvenido <?php echo $oCliente->businessName; ?> </a>
				<?php }else if(isset($oAdmin)){ ?>
				<a class="mr-sm-2" style="margin-right:1.5rem!important;" href="<?php echo SEO::get_URLHome();?>">Bienvenido <?php echo $oAdmin->userName; ?> </a>
				<?php } ?>
				<a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo SEO::get_URLHome();?>?cmd=logoff">Cerrar Sesion</a>
			</form>
			
		</div>
		<!-- /.navbar-collapse -->
	</nav>
	<?php } ?>






