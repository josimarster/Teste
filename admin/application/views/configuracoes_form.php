<?php include('header.php');?>
<script type="text/javascript">
    $(function(){
		CKEDITOR.replace( 'configuracoes_Keywords', {removeButtons: 'Source',} );		CKEDITOR.replace( 'configuracoes_Metatags', {removeButtons: 'Source',} );
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
				<div class="h_title">Gerenciar configuracoes - <?php echo $action ?></div>
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



<?php echo form_hidden('configuracoes_id',set_value('configuracoes_id', property_exists($configuracoes, 'configuracoes_id')? $configuracoes->configuracoes_id : ''))?>


<div class="element">
	<label for="name">Titulo do site <span>(obrigatório)</span>
	<?php $er = form_error('configuracoes_Título','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('configuracoes_Título',set_value('configuracoes_Título', property_exists($configuracoes, 'configuracoes_Título')? $configuracoes->configuracoes_Título : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
    <label for="content">Keywords  <span></span> 
    <?php $er = form_error('configuracoes_Keywords','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <?php echo form_textarea(array('name'=>'configuracoes_Keywords', 'id'=>'configuracoes_Keywords', 'value'=>set_value('configuracoes_Keywords', property_exists($configuracoes, 'configuracoes_Keywords')? $configuracoes->configuracoes_Keywords : ''), 'class'=>"textarea $class"))?>
</div>

<div class="element">
    <label for="content">Metatags  <span></span> 
    <?php $er = form_error('configuracoes_Metatags','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <?php echo form_textarea(array('name'=>'configuracoes_Metatags', 'id'=>'configuracoes_Metatags', 'value'=>set_value('configuracoes_Metatags', property_exists($configuracoes, 'configuracoes_Metatags')? $configuracoes->configuracoes_Metatags : ''), 'class'=>"textarea $class"))?>
</div>

<div class="element">
	<label for="name">Google Analytics  <span></span>
	<?php $er = form_error('configuracoes_Analytics','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('configuracoes_Analytics',set_value('configuracoes_Analytics', property_exists($configuracoes, 'configuracoes_Analytics')? $configuracoes->configuracoes_Analytics : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">SMTP Host <span>(obrigatório)</span>
	<?php $er = form_error('configuracoes_smtphost','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('configuracoes_smtphost',set_value('configuracoes_smtphost', property_exists($configuracoes, 'configuracoes_smtphost')? $configuracoes->configuracoes_smtphost : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">SMTP User <span>(obrigatório)</span>
	<?php $er = form_error('configuracoes_smtpuser','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('configuracoes_smtpuser',set_value('configuracoes_smtpuser', property_exists($configuracoes, 'configuracoes_smtpuser')? $configuracoes->configuracoes_smtpuser : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">SMTP Senha <span>(obrigatório)</span>
	<?php $er = form_error('configuracoes_smtpsenha','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('configuracoes_smtpsenha',set_value('configuracoes_smtpsenha', property_exists($configuracoes, 'configuracoes_smtpsenha')? $configuracoes->configuracoes_smtpsenha : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('configuracoes_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_configuracoes_status as $k => $v): ?>
	<?php echo form_checkbox('configuracoes_status', $k ,set_checkbox('configuracoes_status', $k, (property_exists($configuracoes, 'configuracoes_status')? $configuracoes->configuracoes_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_configuracoes" value="1" />
						<input type="hidden" id="name" name="configuracoes_id" class="text" value="<?php echo property_exists($configuracoes, 'configuracoes_id')? $configuracoes->configuracoes_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('configuracoes');?>">Cancelar</a>
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
