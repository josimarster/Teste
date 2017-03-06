<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url('style/style.css')?>" type="text/css"
	media="screen" />
<link rel="icon" href="<?php echo base_url('images/favicon.ico')?>" type="'image/x-icon" />
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
	<div class="servicos recomendar">
		<h2>Recomende este imóvel</h2>
		<ul>
			<li><strong><?php echo $imovel->imoveis_titulo?></strong></li>
			<li>Referência <?php echo $imovel->imoveis_id?></li>
		</ul>
		<div class="sucesso left" style="display: none">SUA RECOMENDAÇÃO FOI ENVIADA COM SUCESSO!</div>
		<div class="erro left" style="display: none">NÃO FOI POSSÍVEL ENVIAR SUA RECOMENDAÇÃO, POR FAVOR TENTE NOVAMENTE.</div>
		<form id="form_recomendar" action="<?php echo site_url('recomendar/'.$imovel->imoveis_id)?>" method="post">
			<input type="text" name="nome"  placeholder="Seu nome..." /> 
			<input type="text" name="email"	placeholder="Seu e-mail..." /> 
			<input type="text" name="nomeamigo"  placeholder="Nome do amigo..." /> 
			<input type="text" name="emailamigo"  placeholder="E-mail do amigo..." />
			<textarea name="mensagem" placeholder="Deixe sua mensagem..."></textarea>
			<label for="copia"> <input type="checkbox" id="copia" value="1" name="copia" /> <span>Desejo
					receber uma cópia do e-mail.</span>
			</label>
			<input type="hidden" name="imovle"  value="<?php echo $imovel->imoveis_id?>" />
			<button type="submit"  class="botao_amarelo right">Enviar Recomendação</button>
			<div class="clear"></div>
		</form>
	</div>
</body>
<script>
$('#form_recomendar').submit(function(e){
	e.preventDefault();
	var action 		= $(this).attr('action');
	var parameters 	= $(this).serialize();
	$.post(action,  parameters,  function( data ) {
		$('#form_recomendar').hide();
		
		if(data == 'ok'){
			$('.sucesso').show();
			$('.erro').hide();
		}else{
			$('.erro').show();
			$('.sucesso').hide();
		}
			
	});
	
});
</script>
</html>