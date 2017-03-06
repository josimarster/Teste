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
				<h1><?php echo $imovel->imoveis_titulo?> <span>- Ref. <?php echo $imovel->imoveis_referencia?></span></h1>
				<p>
				<?php echo nl2br($imovel->imoveis_pontosfortes)?>
				</p>
				<br />
				<p><?php echo array_key_exists(6,$imovel->imovel_dados)? $imovel->imovel_dados[6]->dadosimovel_titulo : ''; ?>:<?php echo array_key_exists(6,$imovel->imovel_dados)? $imovel->imovel_dados[6]->imoveis_dadosimovel_valor: ''?></p>
				<br />
				<p><?php echo $imovel->imovel_dados[8]->dadosimovel_titulo?>:<?php echo $imovel->imovel_dados[8]->imoveis_dadosimovel_valor?></p>
				<div class="cont640 left" style="max-width: 675px !important ;">
					<h2 class="mgt20">Dependências</h2>
					<table border="0" class="table_details">
					<?php 
						$ct = count( $imovel->imovel_dependencias );
						$tb = floor( $ct / 3 );
						$tb = $tb == 0? 1 : $tb;
						$i = 1;
					?>
					<?php foreach($imovel->imovel_dependencias as $k => $dep): ?>
						<tr>
							<td><?php echo $dep->dependencias_titulo?></td>
							<td class="qnt"><?php echo $dep->imoveis_dependencias_valor ?></td>
						</tr>
						
					<?php if($i % $tb == 0): ?>
						</table>
						<table border="0" class="table_details">
					<?php endif; ?>
					
					<?php $i++; ?>
					<?php endforeach; ?>
					</table> 
				</div>
				<div class="cont300 right">
					<h2 class="mgt20">Localização</h2>
					<p>
						<strong>
						<span style="white-space: nowrap; font-weight: normal"><?php echo $imovel->imovel_dados[1]->imoveis_dadosimovel_valor?> -
						<?php echo array_key_exists(9,$imovel->imovel_dados)? $imovel->imovel_dados[9]->imoveis_dadosimovel_valor : ''?> -</span></strong><strong>
						<?php echo array_key_exists(3,$imovel->imovel_dados)? $imovel->imovel_dados[3]->imoveis_dadosimovel_valor : ''?> -
						<?php echo array_key_exists(2,$imovel->imovel_dados)? $imovel->imovel_dados[2]->imoveis_dadosimovel_valor : ''?> /
 						<?php echo array_key_exists(4,$imovel->imovel_dados)? $imovel->imovel_dados[4]->imoveis_dadosimovel_valor : ''?></strong><br/>
						Entre Ruas: <strong> <?php echo $imovel->imovel_dados[7]->imoveis_dadosimovel_valor ?> </strong><br />
						Ponto de Referência: <strong> <?php echo array_key_exists(5,$imovel->imovel_dados)? $imovel->imovel_dados[5]->imoveis_dadosimovel_valor: ''; ?></strong>
					</p>

					<a href="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode(
		$imovel->imovel_dados[1]->imoveis_dadosimovel_valor.' - '.
		$imovel->imovel_dados[3]->imoveis_dadosimovel_valor.' - '.
		$imovel->imovel_dados[2]->imoveis_dadosimovel_valor.' / '.
		$imovel->imovel_dados[4]->imoveis_dadosimovel_valor) ?>
&key=AIzaSyDnsw5Jjy-QY3uU16xoy_xfnjkB5XAWb8s" class="botao_amarelo menor mgt20 iframe" data-fancybox-type="iframe"> <span class="icone_mapa"></span> Ver mapa</a>
				</div>
				<div class="clear"></div>
			</div>

			<div class="destaque">
				<div class="wrapper">
					<div class="cont440 left">
						<?php foreach($imovel->imovel_valores as $valor): ?>
							<?php if($valor->valores_id == 1): ?>
								<h2><?php echo $valor->valores_titulo?>: <strong>R$ <?php echo number_format($valor->imoveis_valores_valor, 2, ',','.')?></strong></h2>
							<?php else: ?>
								<p><?php echo $valor->valores_titulo?>: R$ <?php echo number_format($valor->imoveis_valores_valor, 2, ',','.')?></p>
							<?php endif;?>
						<?php endforeach; ?>

					</div>
					<div class="botoes_detalhe">
						<a href="<?php echo site_url('fale-conosco/'.$imovel->imoveis_id)?>" class="botao_azul"> <span class="icone_carta"></span> Contato</a>
						<a href="<?php echo site_url('recomendar/'.$imovel->imoveis_id)?>" class="botao_azul recomendar_fancy" data-fancybox-type="iframe"> <span class="icone_curtir"></span> Recomendar</a>
						<a href="<?php echo site_url('imprimir/'.$imovel->imoveis_id)?>" class="botao_azul" > <span class="icone_imprimir"></span> Imprimir</a>
					</div>
					<div class="clear"></div>

					<?php if($imovel->imoveis_imagem != ""): ?>
						<?php $img = $imovel->imoveis_imagem != ""? $imovel->imoveis_imagem : "15344856989_449794889d_b.jpg"; ?>
						<a class="fancybox galeria" rel="gallery1" href="<?php echo base_url("site/imagem/600/400/".$img) ?>">
							<img src="<?php echo base_url("site/imagem/110/110/".$img) ?>" alt="">
							<span  class="hover"><i class="icone_lupa"></i> Ampliar</span>
						</a>
					<?php endif;?>

					<?php foreach($imovel->imovel_fotos as $foto): ?>
						<?php $img = $foto->foto_path != ""? $foto->foto_path : "15344856989_449794889d_b.jpg"; ?>
						<a class="fancybox galeria" rel="gallery1" href="<?php echo base_url("site/imagem/600/400/".$img) ?>">
							<img src="<?php echo base_url("site/imagem/110/110/".$img) ?>" alt="">
							<span  class="hover"><i class="icone_lupa"></i> Ampliar</span>
						</a>
					<?php endforeach; ?>

					<div class="clear"></div>
				</div>
			</div>
			<div class="wrapper">
				<h2 class="mgt20">Características</h2>
				
				<table border="0" >
					<?php 
						$ct = count( $imovel->imovel_caracteristicas );
						$tb = ceil( $ct / 3 );
						$tb = $tb == 0? 1 : $tb;
						$i = 1; 
					?>
					<?php foreach($imovel->imovel_caracteristicas as $k => $dep): ?>
						<tr>
							<td><?php echo $dep->caracteristicas_titulo?></td>
							<td class="qnt"><?php echo $dep->imoveis_caracteristicas_valor ?></td>
						</tr>
						
					<?php if($i % $tb == 0): ?>
						</table>
						<table border="0">
					<?php endif; ?>
					
					<?php $i++; ?>
					<?php endforeach; ?>
				</table>
					
					
				<div class="clear"></div>
				<h2 class="mgt20 " >Imóveis relacionados</h2>
				<?php $ct = 0;?>
				<?php foreach($relacionados as $item): ?>
				<a href="<?php echo site_url('detalhes/'.$item->imoveis_id); ?>" class="item <?php echo $ct == 0? 'mg0':''?>">
				<?php $img = $item->imoveis_imagem != ""? $item->imoveis_imagem : "15344856989_449794889d_b.jpg"; ?>
					<img src="<?php echo base_url("site/imagem/220/150/".$img) ?>" alt="">

					<?php if( array_key_exists(1, $item->imovel_valores) ): ?>
					<span class="valor">R$ <?php echo number_format( doubleval( (array_key_exists(1, $item->imovel_valores)? $item->imovel_valores[1]->imoveis_valores_valor : 0)), 2,',','.')?></span>
					<?php endif; ?>

					<h3><?php echo $item->imoveis_titulo?></h3>

					<p>
					<?php if( array_key_exists(2, $item->imovel_dados) ||  array_key_exists(3, $item->imovel_dados) ): ?>
						<?php echo array_key_exists(2, $item->imovel_dados)? $item->imovel_dados[2]->imoveis_dadosimovel_valor : ''?>
						<?php echo array_key_exists(3, $item->imovel_dados)? ' - '.$item->imovel_dados[3]->imoveis_dadosimovel_valor : ''?>
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
			</div>

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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('source/helpers/jquery.fancybox-thumbs.css?v=2.1.5')?>" />
	<script type="text/javascript" src="<?php echo base_url('source/helpers/jquery.fancybox-thumbs.js?v=2.1.5')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('source/jquery.fancybox.pack.js?v=2.1.5')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('source/jquery.fancybox.css?v=2.1.5')?>" media="screen" />
	<script>
		$(document).ready(function() {
			$(".fancybox").fancybox({
				openEffect	: 'none',
				closeEffect	: 'none',
				padding		: 0
			});

			$(".iframe").fancybox({
				maxWidth	: 800,
				maxHeight	: 600,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});

			$(".recomendar_fancy").fancybox({
				maxWidth	: 430,
				maxHeight	: 500,
				padding		: 0,
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});

		});
	</script>

</html>
