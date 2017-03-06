
<div id="top">
	<div class="left">
		<img src="<?php echo base_url('img/logo_scriptbuilder.png');?>">
	</div>
	<div class="right">
		<div class="align-right">
			<?php if($this->model_auth->isLogged()):?>
				<p>
				Bem Vindo, <strong><?php echo $this->session->userdata('acesso_nome') ?></strong>
				[ <a href="<?php echo base_url('auth/logout') ?>">Sair</a> ]
				</p>					
			<?php else: ?>						
				<p>
				Olá <strong>Visitante [ </strong><a	href="<?php echo base_url('auth/login')?>"> Entrar</a> ]
				</p>					
			<?php endif;?>				
		</div>
	</div>
</div>
