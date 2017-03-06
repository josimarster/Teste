<?php include('header.php');?>
<script type="text/javascript">
    $(function(){
__ENABLE_EDITOR__
    });
</script>
<div class="wrap">
	<div id="header">
		<?php include('top.php')?>
	</div>

	<div id="content">
		<?php include('sidebar.php')?>
		<div id="main">


			<div class="full_w">
				<div class="h_title">Gerenciar acesso - <?php echo $action ?></div>
				<h2><?php echo $page_head  ?></h2>
				<p></p>

				<?php $success = $this->session->flashdata('success')?>
				<?php $error = $this->session->flashdata('error')?>
				<?php if($success != ""):?>
				<div class="n_ok"><p><?php echo $success;?></p></div>
				<?php endif;?>
				<?php if($error != ""):?>
				<div class="n_error"><p><?php echo $error;?></p></div>
				<?php endif;?>




<div class="entry">
	<div class="sep"></div>
	<a class="button add" href="<?php echo base_url('acesso/add');?>">Novo acesso</a>
</div>
<table>
					<thead>
						<tr>
							<th scope="col" style="width: 75px">Código</th>
														<th scope="col" style="text-align: left;">Nome</th>
														<th scope="col" style="text-align: left;">E-mail</th>
														<th scope="col" style="width: 65px;">Ações</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach($lista as $item): ?>
						<tr>
							<td class="align-center"><?php echo $item->acesso_id?></td>
																					<td> <?php echo $item->acesso_nome ?>	</td>
																												<td> <?php echo $item->acesso_email ?>	</td>
																					<td>
								<a href="<?php echo base_url("acesso/edit/$item->acesso_id")?>" class="table-icon edit" title="Editar"></a>
								<?php if($item->acesso_status == 1): ?>
									<a href="<?php echo base_url("acesso/deactive/$item->acesso_id")?>" class="table-icon bullet-green " title="Ativo"></a>
								<?php else: ?>
									<a href="<?php echo base_url("acesso/active/$item->acesso_id")?>" class="table-icon bullet-red" title="Desativado"></a>
								<?php endif;?>
								<a href="<?php echo base_url("acesso/delete/$item->acesso_id")?>" class="table-icon delete" title="Excluir" onclick="return confirm('Tem certeza de que deseja excluir este item??');"></a>
							</td>
						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
				






				


			</div>

		</div>
		<div class="clear"></div>
	</div>

	<?php include('footer.php'); ?>
</div>

</body>
</html>
