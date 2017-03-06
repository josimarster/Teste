<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" href="style/style.css" type="text/css" media="screen"/>
		<link rel="icon" href="images/favicon.ico" type="'image/x-icon"/>	
	</head>
	<body>
		<div class="impressao wrap">
			<div class="topo">
				<img src="images/impressao/topo.jpg" alt="" style="" />
			</div>
			<div class="titulo">
				<h1>Título do Imovel <span>- Ref. 15003.589</span></h1>
				<div class="valor">
					<h2>VALOR: <strong>R$ 650.000,00</strong></h2>
					<p>Valor do Condomínio: R$ 700,00</p>
				</div>
			</div>
			<div class="clear"></div>
			<p>
				<strong>Ótimo Apartamento no Alto da Rua XV.</strong>
				Com 3 dormitorios sendo 1 suite com closet, sala em L com 1 lavabo, sala de tv, cozinha, área de serviço completa, sacada com bela vista para a cidade. 
				Acabamento de muito bom gosto, 1 vaga de garagem. (Tem um projeto para construção de mais 1 vaga de garagem para cada apartamento). 
			</p>
			<div class="servicos">
				<hr>
				<h2 class="mgt20 mgb-none">Dependências</h2>
					<table border="0">
					<?php 
						$ct = count( $imovel->imovel_dependencias );
						$tb = floor( $ct / 3 );
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
				<h2 class="mgt20 mgb-none">Dependências</h2>
				<table border="0">
					<tr>
						<td>Quarto</td>
						<td class="qnt">1</td>
					</tr>
					<tr>
						<td>BWC social</td>
						<td class="qnt">Lorem ipsum dolor sit</td>
					</tr>
				</table>
				<table border="0">
					<tr>
						<td>Quarto</td>
						<td class="qnt">1</td>
					</tr>
					<tr>
						<td>BWC social</td>
						<td class="qnt">Lorem ipsum dolor sit</td>
					</tr>
				</table>
				<div class="clear"></div>
				<div class="img_imp">	
					<img src="images/impressao/img_teste.jpg"/>
					<img src="images/impressao/img_teste.jpg"/>
					<img src="images/impressao/img_teste.jpg"/>
				</div>	
				<div class="clear"></div>
				<h2 class="mgt20 mgb-none">Localização</h2>
				<p>
					<strong>Rua Visconde Rio Branco, 279 - Ap. 501 - Merces - Curitiba / PR</strong><br/>
					Entre Ruas: Padre Agostinho e Av. Manoel Ribas
				</p>
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14411.16639486212!2d-49.268087!3d-25.44523!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dce4614391efc3%3A0xce76b57229dfdbc6!2sR.+Engenheiros+Rebou%C3%A7as%2C+2337+-+Rebou%C3%A7as%2C+Matriz%2C+Curitiba+-+PR%2C+80230-040%2C+Brasil!5e0!3m2!1spt-BR!2sus!4v1443750680148" width="800" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>			
			</div>		
		</div>
	</body>
</html>