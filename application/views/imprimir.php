<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" href="<?php echo base_url('style/style.css')?>" type="text/css" />
		<link rel="icon" href="<?php echo base_url('images/favicon.ico')?>" type="'image/x-icon"/>	
	</head>
	<body onload="window.print()">
		<div class="impressao wrap">
			<div class="topo">
				<img src="<?php echo base_url('images/impressao/topo.png')?>" alt="" style="" />
			</div>
			<div class="titulo">
				<h1><?php echo $imovel->imoveis_titulo?> <span>- Ref. <?php echo $imovel->imoveis_referencia?></span></h1>
				<div class="valor">
					<?php if( array_key_exists(1, $imovel->imovel_valores) ): ?>
					<h2 ><?php echo $imovel->imovel_valores[1]->valores_titulo?>: <strong>R$ <?php echo number_format((array_key_exists(1, $imovel->imovel_valores)? $imovel->imovel_valores[1]->imoveis_valores_valor : 0), 2,',','.')?></strong></h2>
					<?php endif; ?>
					<?php if( array_key_exists(2, $imovel->imovel_valores) ): ?>
					<p ><?php echo $imovel->imovel_valores[2]->valores_titulo?>: R$ <?php echo number_format((array_key_exists(2, $imovel->imovel_valores)? $imovel->imovel_valores[2]->imoveis_valores_valor : 0), 2,',','.')?></hp>
					<?php endif; ?>

				</div>
			</div>
			<div class="clear"></div>
			<p><?php echo nl2br($imovel->imoveis_pontosfortes)?></p>
			<div class="servicos">
				<hr>
				<h2 class="mgt20 mgb-none">Dependências</h2>
					<table border="0">
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
						<table border="0">
					<?php endif; ?>
					
					<?php $i++; ?>
					<?php endforeach; ?>
					</table>
				<div class="clear"></div>
				<hr>
				<h2 class="mgt20 mgb-none">Características</h2>
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
				<div class="img_imp">	
					<?php if($imovel->imoveis_imagem != ""): ?>
						<?php $img = $imovel->imoveis_imagem != ""? $imovel->imoveis_imagem : "15344856989_449794889d_b.jpg"; ?>
							<img src="<?php echo base_url("site/imagem/245/245/".$img) ?>" alt="">
						</a>
					<?php endif;?>
					<?php $i=1; foreach($imovel->imovel_fotos as $foto): if($i>2){ continue; }$i++; ?>
						<?php $img = $foto->foto_path != ""? $foto->foto_path : "15344856989_449794889d_b.jpg"; ?>
						<img src="<?php echo base_url("site/imagem/245/245/".$img) ?>" alt="">
					<?php endforeach; ?>
				</div>	
				<div class="clear"></div>

				
				<h2 class="mgt20 mgb-none">Localização</h2>
				<p>
						<strong>
						<?php echo $imovel->imovel_dados[1]->imoveis_dadosimovel_valor?> -
						<?php echo $imovel->imovel_dados[3]->imoveis_dadosimovel_valor?> -
						<?php echo $imovel->imovel_dados[2]->imoveis_dadosimovel_valor?> /
 						<?php echo $imovel->imovel_dados[4]->imoveis_dadosimovel_valor ?></strong><br/>
						Entre Ruas: <?php echo $imovel->imovel_dados[7]->imoveis_dadosimovel_valor ?>
				</p>
				<iframe src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode(
		$imovel->imovel_dados[1]->imoveis_dadosimovel_valor.' - '.
		$imovel->imovel_dados[3]->imoveis_dadosimovel_valor.' - '.
		$imovel->imovel_dados[2]->imoveis_dadosimovel_valor.' / '.
		$imovel->imovel_dados[4]->imoveis_dadosimovel_valor) ?>
&key=AIzaSyDnsw5Jjy-QY3uU16xoy_xfnjkB5XAWb8s" width="800" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>			
			</div>		
		</div>
	</body>
</html>