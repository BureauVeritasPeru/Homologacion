<script type="text/javascript">
	$(function(){
		$('body').css('background-color','#e9ecef');
		$('.nav-item').hide();
		$('footer').hide();
	});
</script>
<style type="text/css">
.starter-template {
	padding: 3rem 1.5rem;
	text-align: center;
}
.btn-outline-success {
	color: #dc3545;
	background-color: transparent;
	background-image: none;
	border-color: #dc3545;
}
.btn-outline-success:hover {
	color: #fff;
	background-color: #d1d0b5;
	border-color: #d1d0b5;
}
</style>
<?php
$oProveedor=WebLogin::getProveedorSession();
?>
<?php if($oProveedor->state != 0){ ?>
	<main role="main" style="height:100% !important;">
		<section class="b2">
			<div class="b2-box-content">
				<div class="b2-box" style="background-image:url(<?php echo $URL_BASE; ?>images/datos-generales.jpg);background-size: cover;">
					<a href="/scs/homologacion/datos-generales.html"></a> 
					<!-- <a href="/homologacion/datos-generales.html"></a> -->
					<div class="b2-box-e">
						<p class="active">
						</p>
					</div>
					<div class="b2-box-title">
						<h4>Datos Generales
						</h4>
					</div>
					<div class="b2-box-link">

					</div>
				</div>
				<div class="b2-box" style="background-image:url(<?php echo $URL_BASE; ?>images/nueva-homologacion.jpg);background-size: cover;">
					<a href="/scs/homologacion/nueva-homologacion.html"></a> 
					<!-- <a href="/homologacion/nueva-homologacion.html"></a> -->
					<div class="b2-box-e">
						<p class="active">
						</p>
					</div>
					<div class="b2-box-title">
						<h4>Nueva Homologación
						</h4>
					</div>
					<div class="b2-box-link">

					</div>
				</div>
				<div class="b2-box" style="background-image:url(<?php echo $URL_BASE; ?>images/relacion-homologacion.jpg);background-size: cover;">
					<a href="/scs/homologacion/relacion-homologacion.html"></a> 
					<!-- <a href="/homologacion/relacion-homologacion.html"></a> -->
					<div class="b2-box-e">
						<p class="active">
						</p>
					</div>
					<div class="b2-box-title">
						<h4>Relación de Homologaciones
						</h4>
					</div>
					<div class="b2-box-link">

					</div>
				</div>
			</div>
		</section>
	</main>
	<?php }else{ ?>
		<script type="text/javascript">
			$(function(){
				location.href = '/scs/homologacion/datos-generales.html';
			});
		</script>
		<?php } ?>