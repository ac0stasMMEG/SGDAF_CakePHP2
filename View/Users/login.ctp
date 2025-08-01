<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div class="container-xxl"><?php //phpinfo(); 
							?>
	<div class="authentication-wrapper authentication-basic container-p-y">
		<div class="authentication-inner">
			<!-- Register -->
			<div class="card">
				<div class="card-body">
					<!-- Logo -->
					<div class="app-brand justify-content-center">
						<div class="login-logo ">
							<span class="app-brand-text demo text-body fw-bolder">
								<!-- Sneat-->
							</span>
							<h4 class="mb-2">
								<b><?php echo __('System'); ?></b> <?php echo __('Gestion DAF '); ?>
							</h4>
						</div>
					</div>
					<!-- /.login-logo -->
					<div class="login-box-body">
						<p class="login-box-msg"></p>
						<form action="login" method="post" id="login">
							<label for="email" class="form-label">Nombre de Usuario</label>
							<input name="data[User][username]" type="user" class="form-control icon-user" placeholder="<?php echo __('username'); ?>" required><br>
							<label class="form-label" for="password">Contraseña</label>
							<input name="data[User][password]" id="password" type="password" class="form-control icon-lock" placeholder="<?php echo __('use the same password on your computer'); ?>" required><br>
							<?php $this->Captcha->render(array('type' => 'image')); ?>
							<!-- <span><a href="javascript:window.location.href=window.location.href">Recargar</a></span> -->
							<div class="form-group has-feedback">
								<!-- /.col -->
								<div class="col-xs-6 col-xs-offset-3"><br>
									<button type="submit" class="btn btn-primary d-grid w-100"> <!-- btn-block btn-flat">-->
										<i class="glyphicon glyphicon-send"></i> <?php echo __('Sign In'); ?>
									</button>
								</div>
								<!-- /.col -->
								<?php echo $this->Session->flash(); ?>
							</div>
						</form>
					</div>
					<div style="text-align:center">
						<br>
						<?php echo __('¿Necesitas ayuda? - '); ?>
						<!-- <?php echo $this->Html->link(__('Ingresa aquí'), 'https://soporte.minmujeryeg.gob.cl/upload/login.php', array('target' => '_blank')); ?> -->

						<?php echo $this->Html->link(
							'Click Aquí',
							'mailto:' . "ticket@minmujeryeg.gob.cl?subject=Sistema SGDAF"

						); ?>
						<!-- <a href="mailto:ticket@minmujeryeg.cl?Subject=Solicito ayuda desde SGDAF">Click aquí</a> -->

					</div>
					<hr>
					<?php echo $this->Html->image("mmeg.png", array("width" => "100%")); ?>
				</div>
				<!-- /.login-box-body -->
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		localStorage.clear();
	});

	jQuery('.creload').on('click', function() {
		var mySrc = $(this).prev().attr('src');
		var glue = '?';
		if (mySrc.indexOf('?') != -1) {
			glue = '&';
		}
		$(this).prev().attr('src', mySrc + glue + new Date().getTime());
		return false;
	});

	localStorage.removeItem("counter");

	$(document).ready(function() {
		$('#change_password').click(function() {

			var pass = $(this).attr('class');

			if (pass.indexOf('fa-eye-slash') > -1) {
				$('#password').attr('type', 'text');
				$("#change_password").removeClass("fa-eye-slash");
				$("#change_password").addClass('fa-eye');
			} else {
				$('#password').attr('type', 'password');
				$("#change_password").removeClass("fa-eye");
				$("#change_password").addClass('fa-eye-slash');
			}
		});
	});
</script>