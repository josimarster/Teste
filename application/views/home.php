<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	
		<!--Topo-->
			<?php include 'head.php'; ?>
		<!--Fim Topo-->
		<!--Banner-->
		<div class="clear"></div>
		<div id="slides">
			<div class="slides-container">
				<?php foreach($banners as $banner): ?>
				<div>
					<img src="<?php echo base_url('admin/uploads/'.$banner->banners_imagem)?>" alt="">
					<div class="wrapper">
						<a href="<?php echo  $banner->banners_Link ?>" class="detalhe_home">
							<h1><?php echo $banner->banners_banners_titulo?></h1>
							<p><?php echo strip_tags($banner->banners_Texto)?></p>
							<span class="botao_amarelo">Ver imóvel</span>
						</a>
					</div>
				</div>
				<?php endforeach;?>
				<!--Inicio da segunda imagem do slider-->
			<!-- <div>
					<img src="images/banner/1.jpg" alt="">
					<div class="wrapper">
						<a href="#" class="detalhe_home">
							<h1>Últimas unidades</h1>
							<p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. FUSCE SEMPER NISI EX, ET BIBENDUM DUI PORTTITOR SED. PHASELLUS CONSEQUAT EFFICITUR VOLUTPAT.</p>
							<span class="botao_amarelo">Ver empreendimento</span>
						</a>
					</div> 
				</div>-->
				<!--Fim da segunda imagem do slider-->
			</div>
		</div>
		<!--Fim Banner-->
		<!--Busca-->
		<?php include 'busca.php';?>
		<!--Fim busca-->
		
		<!--Topo-->
		
		<!--Servicos-->
		<div class="servicos">
			<div class="wrapper">
				<h2><?php echo $titulo_venda ?></h2>
				<?php $ct = 0;?>
				<?php foreach($lista_venda as $item): ?>	
						
				<?php 
				$valor =  (array_key_exists(1, $item->imovel_valores)? $item->imovel_valores[1]->imoveis_valores_valor : 0);
				$valor = str_replace(",", ".", str_replace(".", "", $valor));
				
				?>
				
				
				<a href="<?php echo site_url('detalhes/'.$item->imoveis_id); ?>" class="item <?php echo $ct == 0? 'mg0':''?>">
				<?php $img = $item->imoveis_imagem != ""? $item->imoveis_imagem : "default.jpg";	?>
					<img src="<?php echo base_url("site/imagem/220/150/".$img) ?>" alt="">
					
					<?php if( array_key_exists(1, $item->imovel_valores) ): ?>
					<span class="valor">R$ <?php echo number_format($valor, 2,',','.')?></span>
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
				
				<h2><?php echo $titulo_locacao ?></h2>
								
				<?php $ct = 0;?>
				<?php foreach($lista_locacao as $item): ?>			
				<a href="<?php echo site_url('detalhes/'.$item->imoveis_id); ?>" class="item <?php echo $ct == 0? 'mg0':''?>">
				<?php $img = $item->imoveis_imagem != ""? $item->imoveis_imagem : "15344856989_449794889d_b.jpg"; ?>
					<img src="<?php echo base_url("site/imagem/220/150/".$img) ?>" alt="">
					
					<?php if( array_key_exists(1, $item->imovel_valores) ): ?>
					<span class="valor">R$ <?php echo number_format((array_key_exists(1, $item->imovel_valores)? $item->imovel_valores[1]->imoveis_valores_valor : 0), 2,',','.')?></span>
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
				
			</div>
			<div class="clear"></div>
		</div>
		<!--Fim Servicos-->
		
		<!--Sobre-->
		<div class="sobre">
			<div class="wrapper">
				<div class="item">
					<img src="<?php echo base_url('images/pexinxa_disabled.png')?>" class="parceiro" alt=""/>
					<img src="<?php echo base_url('images/cvi.jpg')?>" class="parceiro" alt=""/>
					<img src="<?php echo base_url('images/secovi.jpg')?>" class="parceiro" alt=""/>
					<img src="<?php echo base_url('images/scriptbuilder_dark.png')?>" class="right" alt=""/>
				</div>		
			</div>		
		</div>
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
