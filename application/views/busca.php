			<div class="busca">
			<div class="wrapper">
				<h2>Busca de imóveis</h2>
				<form action="<?php echo site_url('site/search'); ?>" method="post">
					<?php echo form_dropdown('busca_categoria', $categorias, $busca_categoria);?>
					<?php echo form_dropdown('busca_tipo', $tipos, $busca_tipo);?>
					<?php echo form_dropdown('busca_cidade', $cidades, $busca_cidade);?>
					<?php echo form_dropdown('busca_bairro', $bairros, $busca_bairro);?>
					<?php echo form_dropdown('busca_preco', $precos, $busca_precos);?>
					<input type="submit" class="botao_amarelo" value="Buscar"/>
				</form>
			</div>
		</div>