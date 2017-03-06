<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		
		<!--Topo-->
			<?php include 'head.php';?>
		<!--Fim Topo-->
		
		<div class="clear"></div>
		
		<!--Busca-->
		<?php include 'busca.php';?>
		<!--Fim busca-->
		
		<!--Topo-->
		
		<!--Servicos-->
		<div class="servicos">
			<div class="wrapper">
				<h2><?php echo $titulo_pagina ?></h2>
				<?php $ct = 0;?>
				<?php foreach($lista as $item): ?>			
				<a href="<?php echo site_url('detalhes/'.$item->imoveis_id); ?>" class="item <?php echo $ct == 0? 'mg0':''?>">
				<?php $img = $item->imoveis_imagem != ""? $item->imoveis_imagem : "15344856989_449794889d_b.jpg"; ?>
					<img src="<?php echo base_url("site/imagem/220/150/".$img) ?>" alt="">
					
					<?php if( array_key_exists(1, $item->imovel_valores) ): ?>
					<span class="valor">R$ <?php echo number_format( doubleval((array_key_exists(1, $item->imovel_valores)? $item->imovel_valores[1]->imoveis_valores_valor : 0)), 2,',','.')?></span>
					<?php endif; ?>
					
					<h3><?php echo $item->imoveis_titulo?></h3>
					
					<p>
					<?php if( array_key_exists(2, $item->imovel_dados) ||  array_key_exists(3, $item->imovel_dados) ): ?>
						<?php $val = array_key_exists(2, $item->imovel_dados)? $item->imovel_dados[2]->imoveis_dadosimovel_valor : ''?>
						<?php $val .= array_key_exists(3, $item->imovel_dados)? ' - '.$item->imovel_dados[3]->imoveis_dadosimovel_valor : ''?>
						<?php echo substr($val, 0, 25) ?>
					<?php else: ?>
					 	&nbsp;
					<?php endif; ?>
					</p>

										
					<p>
					<?php if( array_key_exists(1, $item->imovel_dependencias) ): ?>
						<?php if( $item->imovel_dependencias[1]->imoveis_dependencias_valor != ""): ?>
						 	<?php echo $item->imovel_dependencias[1]->dependencias_titulo ?> <span><?php echo $item->imovel_dependencias[1]->imoveis_dependencias_valor ?></span>
						<?php else: ?>
						 	&nbsp;
						<?php endif; ?>
					<?php else: ?>
						 	&nbsp;
					<?php endif; ?>
					</p>
					
					
					<p>
					<?php if( array_key_exists(6, $item->imovel_dados) ): ?>
						<?php if( $item->imovel_dados[6]->imoveis_dadosimovel_valor != ""): ?>
						 	Metragem <span><?php echo array_key_exists(6, $item->imovel_dados)? '  '.$item->imovel_dados[6]->imoveis_dadosimovel_valor : ''?></span>
						<?php else: ?>
						 	&nbsp;
						<?php endif; ?>
					<?php else: ?>
						 	&nbsp;
					<?php endif; ?>
					</p>
					
					<span class="link_mais">Veja mais detalhes<span>
				</a>
				
				<?php $ct++;?>
				<?php if($ct%4==0){$ct=0;}?>
				<?php endforeach;?>
				
				<div class="clear"></div>
				<!--Paginacao-->
				<div class="paginacao">
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<!--Fim paginacao-->
				
			</div>
			<div class="clear"></div>
		</div>
		<!--Fim Servicos-->
		
		<!--Sobre-->
		<?php $this->load->view('parceiros');?>
		<!--Fim X-->
		<!--Rodape-->
			<?php include 'footer.php';?>
		<!--Fim Rodape-->
		
		
	</body>
	<!--Scripts-->
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo base_url('slider/javascripts/jquery.superslides.js')?>" type="text/javascript" charset="utf-8"></script>
	<script>
		$(function() {
			$('#slides').superslides({
				inherit_height_from	:	'#slides',
				inherit_width_from	:	window,
				hashchange: true,
 				animation_easing: 'swing',
    				animation: 'slide',
				play: false,
    				animation_speed: 1600
			});
		});					
	</script>
	
</html>
