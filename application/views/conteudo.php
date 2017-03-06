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
		<div class="conteudo_internas">
			<div class="wrapper">
				<h2><?php echo $conteudo->conteudo_titulo?></h2>
				<?php echo $conteudo->conteudo_texto ?>
				<?php /*?>
				<a class="fancybox galeria" rel="gallery1" href="http://farm6.staticflickr.com/5612/15344856989_449794889d_b.jpg">
					<img src="http://farm6.staticflickr.com/5612/15344856989_449794889d_m.jpg" alt="" />
					<span  class="hover"><i class="icone_lupa"></i> Ampliar foto</span>
				</a>
				<a class="fancybox galeria" rel="gallery1" href="http://farm6.staticflickr.com/5444/17679973232_568353a624_b.jpg">
					<img src="http://farm6.staticflickr.com/5444/17679973232_568353a624_m.jpg" alt="" />
					<span  class="hover"><i class="icone_lupa"></i> Ampliar foto</span>
				</a>
				<a class="fancybox galeria" rel="gallery1" href="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_b.jpg" title="">
					<img src="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_m.jpg" alt="" />
					<span  class="hover"><i class="icone_lupa"></i> Ampliar foto</span>
				</a>
				<a class="fancybox galeria mg0" rel="gallery1" href="http://farm1.staticflickr.com/313/19831416459_5ddd26103e_b.jpg" title="">
					<img src="http://farm1.staticflickr.com/313/19831416459_5ddd26103e_m.jpg" alt="" />
					<span  class="hover"><i class="icone_lupa"></i> Ampliar foto</span>
				</a>
				<?php */ ?>
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
		});		
	</script>
	
	
</html>
