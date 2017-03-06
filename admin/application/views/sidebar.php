		<div id="sidebar">
			<div class="box">
				<div class="h_title">&#8250; Principal</div>
				<ul id="home">
					<li class="b1"><a class="icon view_page" href="<?php echo base_url()?>">Home</a></li>
					<?php if($this->model_auth->isLogged()):?>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('imoveis')?>">imóveis</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('categorias')?>">Categorias</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('tipos')?>">Tipos</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('dadosimovel')?>">Dados do imóvel</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('dependencias')?>">Dependências</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('valores')?>">Valores</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('caracteristicas')?>">Caracteristicas</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('banners')?>">Banners</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('emails')?>">Emails</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('conteudo')?>">Conteúdo</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('configuracoes')?>">Configurações</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('contato')?>">Contato</a></li>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('acesso')?>">Acesso</a></li>

					<?php endif;?>
					<li class="b1"><a class="icon view_page" href="<?php echo base_url('help/about')?>">Sobre</a></li>
				</ul>
			</div>
		</div>