<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo base_url('style/style.css');?>" type="text/css" media="screen"/>
		<link rel="icon" href="<?php echo base_url('images/favicon.ico');?>" type="'image/x-icon"/>	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	</head>
	<body>
		<!--<div class="topo">
			<div class="wrapper">
				<a href="index.php" class="left mgt20"><img src="images/logo_menu.png"  class="logo_menu" alt=""></a>
				<div class="right">
					<img src="images/entre_contato.jpg"  class="logo_menu" alt="">
				</div>
			</div>	
		</div>-->
		<div class="menu" id="menu">		
			<div class="wrapper">
				<a href="index.php" class="left logo_menu">
					<img src="<?php echo site_url('images/logo_menu.png');?>" alt="">
				</a>
				<ul>
					<li><a href="<?php echo site_url()?>"  class="item_menu home"></a></li>
					<li><a href="<?php echo site_url('quem-somos')?>"  class="item_menu">Quem somos</a></li>
					<li><a href="<?php echo site_url('vendas')?>" class="item_menu">Vendas</a></li>
					<li><a href="<?php echo site_url('locacao')?>" class="item_menu">Locação</a></li>
					<li><a href="<?php echo site_url('avalie')?>" class="item_menu">Avalie seu imóvel</a></li>
					<li><a href="<?php echo site_url('fale-conosco')?>" class="">Fale conosco</a></li>
					<li><a href="javascript:;" class="item_menu topo_atendimento"></a></li>
				</ul>
			</div>	
		</div>		