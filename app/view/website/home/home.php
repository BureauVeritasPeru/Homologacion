<script type="text/javascript">
	$(function(){
		$('body').css('background-color','#e9ecef');
	});
</script>
<div class="cnt-wrapper">
	<div class="wrapper">
		<section class="b3">
			<div class="b3-content">
				<div class="b3-ctn-items active" id="tab-sede-2">
					<a href="#" class="b3-item" id="modal1">
						<div class="b3-img" style="background-image:url(<?php echo $URL_BASE; ?>images/registro-proveedor.jpg);">
						</div>
						<div class="b3-info">
							<div class="b3-info-content">
								<div class="b3-title-info">
									<h3>&nbsp;
									</h3>
									<div class="b3-linea">
									</div>
								</div>
								<div class="b3-table">
									<div class="b3-middle">
										<strong>Registro de Proveedor
										</strong>
									</div>
								</div>

							</div>
						</div>
					</a>
					<a href="#" class="b3-item" id="modal2">
						<div class="b3-img" style="background-image:url(<?php echo $URL_BASE; ?>images/voucher.jpg);">
						</div>
						<div class="b3-info">
							<div class="b3-info-content">
								<div class="b3-title-info">
									<h3>&nbsp;
									</h3>
									<div class="b3-linea">
									</div>
								</div>
								<div class="b3-table">
									<div class="b3-middle">
										<strong>Confirmación de Pago
										</strong>
									</div>
								</div>

							</div>
						</div>
					</a>
					<a href="#" class="b3-item">
						<div class="b3-img">
						</div>
						<div class="b3-info">
							<div class="b3-info-content">
								<div class="b3-title-info">
									<h3>&nbsp;
									</h3>
									<div class="b3-linea">
									</div>
								</div>
								<div class="b3-table">
									<div class="b3-middle">
										<img src="<?php echo $URL_BASE; ?>images/logo.png" >
										<strong>Ingresar / Sign In
										</strong>
										<br>
										<div class="container">
											<form class="form-signin" name="login" id="login_homo" novalidate="novalidate" spellcheck="false" method="post" target="_top" autocomplete="off">
												<label for="usuario_login" class="sr-only">Usuario</label>
												<input type="text" id="usuario_login" class="form-control form-control-sm" placeholder="usuario" required="" autofocus="" name="usuario_login">
												<br>
												<label for="inputPassword" class="sr-only">Password</label>
												<input type="password" id="inputPassword" class="form-control form-control-sm" placeholder="Contraseña" name="password_login">
												<br>
												<div class="btn btn-sm btn-danger btn-block" id="send-login" style="border:1px solid #dd3345">Ingresar</div>

											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#modal1').click(function(){
			$('.bs-proveedor').modal('show');
		});
		$('#modal2').click(function(){
			$('.bs-voucher').modal('show');
		});
		$('#inputPassword').keypress(function(event){
			if ( event.which == 13 ) {
				event.preventDefault();
				var fields2=$('#login_homo').serialize();
				console.log('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2);
				$.getJSON('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2, function(data) {
					if(data.retval==1){
						location.href='<?php echo SEO::get_URLHome();?>';
					}else{
						alertify.error(data.message);
					}
				});
			}
		});
		$('#send-login').click(function(){
			var fields2=$('#login_homo').serialize();
			console.log('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2);
			$.getJSON('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2, function(data) {
				if(data.retval==1){
					console.log('entro');
					location.href='<?php echo SEO::get_URLHome();?>';
				}else{
					alertify.error(data.message);
				}
			});
		});
	});
</script>


<?php include("../app/view/website/home/provider.php"); ?>

<?php include("../app/view/website/home/voucher.php"); ?> 