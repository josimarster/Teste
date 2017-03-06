<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
<title><?php echo $this->config->item('admin_header')?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/login.css" media="screen" />
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
			<div class="full_w">
				<?php if( $this->session->flashdata('msg') ): ?>
				<div class="n_error"><?php echo $this->session->flashdata('msg'); ?></div>
				<?php endif; ?>
				<form action="" method="post">
					<label for="login">E-mail:</label>
					<input id="login" name="login_email" class="text" />
					<label for="pass">Senha:</label>
					<input id="pass" name="login_senha" type="password" class="text" />
					<div class="sep"></div>
					<button type="submit" class="ok">Login</button> <?php /*?><a class="button" href="<?php echo base_url('auth/recuperar_senha') ?>">Esqueceu a senha?</a><? */?>
				</form>
			</div>
			<div class="footer">&raquo; <a href="<?php echo $this->config->item('site_url');?>"><?php echo $this->config->item('site_name');?></a>  | <a href="<?php echo base_url()?>">Admin Panel</a>l</div>
		</div>
	</div>
</div>

</body>
</html>