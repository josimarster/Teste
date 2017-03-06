<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
		<link rel="icon" href="<?php echo base_url('images/favicon.ico'); ?>" type="'image/x-icon"/>	
	</head>
	<body>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
			<tr>
				<td align="center" bgcolor="#ffffff" style="">
					<img src="<?php echo base_url('images/topo_email.png'); ?>" alt="" style="" />
				</td>
			</tr>
			<tr>
				<td bgcolor="#696969" height="70" style="color:#ffffff; font-family:arial; font-size:20px; padding:0 20px 0 20px;">
					<p>Seu amigo <b style="color:#fdcb1d;"><?php echo $nome ?></b> lembrou de você ao ver esse im&oacute;vel.</p>
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" style="color:#333333; font-family:arial; font-size:14px; padding:0 20px 0 20px;">
					<p><b><?php echo $mensagem ?></b></p>
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" style="color:#333333; font-family:arial; font-size:14px; padding:0 20px 0 20px;">
					<p style="font-size:20px;"><b style="color:#1370c0;"><?php echo $imovel->imoveis_titulo?> - </b> <span style="color:#666666;"> Refer&ecirc;ncia <?php echo $imovel->imoveis_id?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="40" valign="top" style="padding:0 0 0 20px;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td>
<?php if($imovel->imoveis_imagem != ""): ?>
	<?php $img = $imovel->imoveis_imagem != ""? $imovel->imoveis_imagem : "15344856989_449794889d_b.jpg"; ?>
	<img src="<?php echo base_url("site/imagem/110/110/".$img) ?>" alt="" style="display: block;">
<?php endif;?>
										</td>
									</tr>
									
								</table>
							</td>
							<td width="460" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td style="font-family:arial; padding:25px 20px 0 0;">
<?php echo $imovel->imoveis_pontosfortes?>.<br />
<?php foreach($imovel->dependencias as $dep): ?>
	<?php echo $dep->imoveis_dependencias_valor?>  <?php echo $dep->dependencias_titulo?>  
 <?php endforeach;?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td height="80" style="color:#333333; font-family:arial; font-size:14px; padding:0 20px 0 20px; text-align:center;">
					<a href="<?php echo site_url('detalhes/'.$imovel->imoveis_id)?>" style="background:#fdcb1d; color:#333; display:block; font-family:oswald; font-size:20px; height:80px; line-height:80px; text-decoration:none;">CLIQUE PARA MAIS DETALHES DESTE IM&Oacute;VEL</a>
				</td>
			</tr>
		</table>
	</body>
</html>