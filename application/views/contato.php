<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		<!--Topo-->
		<?php include 'head.php';?>
		<!--Fim topo-->
		
		<!--Busca-->
		<?php include 'busca.php';?>
		<!--Fim busca-->
		
		<!--Conteudo-->
		<div class="conteudo_internas">
			<div class="wrapper">
				<div class="cont_destaque">
					<h2>ENTRE EM CONTATO CONOSCO</h2>
					<div class="borda_baixo">
						<div class="left"></div>
						<div class="right"></div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="cont680 left">
					<h1>Preencha o formulário</h1>
					<div class="contato_form">
						<form method="post" name="cadastro" id="contato_form" action="<?php echo site_url('fale-conosco')?>">
							<input name="nomeremetente" type="text" placeholder="Nome"/>
							<input name="emailremetente" type="text" placeholder="E-mail"/>
							<input name="telefone" class="telefone erro_contato" type="text" placeholder="Telefone (  )"/><br/>
							<input name="assunto" class="telefone" type="text" placeholder="Assunto"/><br/>
							<textarea name="mensagem" placeholder="Mensagem..."></textarea><br/>
						
							<div class="sucesso left" style="display: none">SUA MENSAGEM FOI ENVIADA COM SUCESSO!</div>
							<div class="erro left" style="display: none">NÃO FOI POSSÍVEL ENVIAR SUA MENSAGEM, POR FAVOR TENTE NOVAMENTE.</div>
							
							<button type="submit" class="botao_amarelo right"><span></span>ENVIAR INFORMAÇÕES</button>
						</form>
						
					</div>
				</div>	
				<div class="right outros_contatos">
					<h1>ENDEREÇO</h1>
					<p><strong>A Imobiliária Demo está localizada na </strong>
					Rua Rio Iguatemi, Nº 200
					Iguaçú - Fazenda Rio Grande - Paraná - Cep: 83.833-218</p>
					<a href="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode(
		"Rua Rio Iguatemi, Nº 200 - Iguaçú - Fazenda Rio Grande - Paraná ") ?>
&key=AIzaSyDnsw5Jjy-QY3uU16xoy_xfnjkB5XAWb8s" class="botao_amarelo menor iframe" data-fancybox-type="iframe">
					<span class="icone_mapa"></span>Ver mapa</a>
					<br/>
					<br/>
					<h1>TELEFONES</h1>
					<?php /*?><p><strong>Fixo: </strong>(41) 3352.9010<br/> <?php */?>
					<strong>Celular: </strong>(41) 99804-9684</p>
					
					<br/>
				</div>
				
				<div class="clear"></div>
			</div>		
		</div>
		<!--Fim Conteudo-->
		
		<!--Rodape-->
		<?php include 'footer.php';?>		
		<!--Fim Rodape-->

		
		
	</body>
	<!--Scripts-->
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo base_url('slider/javascripts/jquery.superslides.js')?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('javascript/jquery.waypoints.min.js')?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('javascript/sticky.min.js')?>" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('source/helpers/jquery.fancybox-thumbs.css?v=2.1.5')?>" />
	<script type="text/javascript" src="<?php echo base_url('source/helpers/jquery.fancybox-thumbs.js?v=2.1.5')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('source/jquery.fancybox.pack.js?v=2.1.5')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('source/jquery.fancybox.css?v=2.1.5')?>" media="screen" />

	<script>
		$(function() {
			$('#slides').superslides({
				inherit_height_from	:	window,
				inherit_width_from	:	window,
				hashchange: true,
				play	:	false
			});


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
			
			//$('.menu').waypoint('sticky');
		  
			setTimeout(function () {
				$('#divdesaparecer').fadeOut(10).css("display","none");
			}, 1);

			$('#contato_form').submit(function(e){
				e.preventDefault();
				var action 		= $(this).attr('action');
				var parameters 	= $(this).serialize();
				$.post(action,  parameters,  function( data ) {

					if(data == 'ok'){
						$('.sucesso').show();
						$('.erro').hide();
					}else{
						$('.erro').show();
						$('.sucesso').hide();
					}
						
				});
				
			});
		});					
	</script>
	
</html>
