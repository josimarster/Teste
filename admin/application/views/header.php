<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<meta name="author" content="ScriptBuilder" />
			<title><?php echo $this->config->item('admin_header')?></title>
			<link rel="stylesheet" type="text/css"	href="<?php echo base_url('css/style.css')?>" media="screen" />
			<link rel="stylesheet" type="text/css" 	href="<?php echo base_url('css/navi.css')?>" media="screen" />
			<link rel="stylesheet" type="text/css" 	href="<?php echo base_url('css/smoothness/jquery-ui-1.10.4.custom.min.css')?>" 	media="screen" />
			<script type="text/javascript" 	src="<?php echo base_url('js/jquery-2.1.0.min.js')?>"></script>
			<script type="text/javascript" 	src="<?php echo base_url('js/jquery-ui-1.10.4.custom.min.js')?>"></script>
			<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
			<script type="text/javascript">
			$(function(){
				
				//$(".box .h_title").not(this).next("ul").hide("normal");	
				//$(".box .h_title").not(this).next("#home").show("normal");	
				//$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });	
				
				$( "input[rel=date]" ).datepicker({
					 dateFormat: 'dd/mm/yy',			    
					dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],			    
					dayNamesMin: ['D','S','T','Q','Q','S','S','D'],			    
					dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],			    
					monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],			    
					monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],			    
					nextText: 'Próximo',			    
					prevText: 'Anterior'			
				});
				
				$('.foto_desc').keyup(function(e) {		
					if(e.which == 13 || e.keyCode == 13){			
						var obj = new Object();			
						obj.foto_id = $(this).attr('rel');			
						obj.foto_desc = $(this).val();			
						$.post('<?php echo base_url('imoveis/updatefoto')?>', obj,  function(data) {
							if(data == 'true'){					
								alert('A descrição foi atualizada com sucesso');				
							}else{					
								alert('Não foi possível atualizar a descrição');				
							}			
						});					
					}	
				});
			});
			</script>
</head>
<body>