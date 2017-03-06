<?php include('header.php');?>
<script type="text/javascript">
    $(function(){

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








				<form action="" method="post" enctype="multipart/form-data">



<?php echo form_hidden('acesso_id',set_value('acesso_id', property_exists($acesso, 'acesso_id')? $acesso->acesso_id : ''))?>


<div class="element">
	<label for="name">Nome <span>(obrigatório)</span>
	<?php $er = form_error('acesso_nome','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('acesso_nome',set_value('acesso_nome', property_exists($acesso, 'acesso_nome')? $acesso->acesso_nome : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">E-mail <span>(obrigatório)</span>
	<?php $er = form_error('acesso_email','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('acesso_email',set_value('acesso_email', property_exists($acesso, 'acesso_email')? $acesso->acesso_email : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">Senha <span>(obrigatório)</span>
	<?php $er = form_error('acesso_senha','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('acesso_senha',set_value('acesso_senha', property_exists($acesso, 'acesso_senha')? $acesso->acesso_senha : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('acesso_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_acesso_status as $k => $v): ?>
	<?php echo form_checkbox('acesso_status', $k ,set_checkbox('acesso_status', $k, (property_exists($acesso, 'acesso_status')? $acesso->acesso_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_acesso" value="1" />
						<input type="hidden" id="name" name="acesso_id" class="text" value="<?php echo property_exists($acesso, 'acesso_id')? $acesso->acesso_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('acesso');?>">Cancelar</a>
					</div>
				</form>
				


			</div>

		</div>
		<div class="clear"></div>
	</div>

	<?php include('footer.php'); ?>
</div>

</body>
</html>
