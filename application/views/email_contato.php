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
					<p>Contato atrav&eacute;s do site</p>
				</td>
			</tr>
			<tr>
				<td bgcolor="#ffffff" style="color:#333333; font-family:arial; font-size:14px; padding:0 20px 0 20px;">
					<p>
Assunto: <?php echo $assunto;?> <br />
Nome: <?php echo $nome;?> <br />
E-mail: <?php echo $email;?> <br />
Telefone: <?php echo $telefone;?> <br />
Mensagem: <?php echo $mensagem;?> <br />
					</p>
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
					
				</td>
			</tr>
		</table>
	</body>
</html>