<?php include('header.php');?>
<script type="text/javascript">
    $(function(){
		CKEDITOR.replace( 'contato_telefones', {removeButtons: 'Source',} );		CKEDITOR.replace( 'contato_emails', {removeButtons: 'Source',} );
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
				<div class="h_title">Gerenciar contato - <?php echo $action ?></div>
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



<?php echo form_hidden('contato_id',set_value('contato_id', property_exists($contato, 'contato_id')? $contato->contato_id : ''))?>


<div class="element">
    <label for="content">Telefones <span></span> 
    <?php $er = form_error('contato_telefones','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <?php echo form_textarea(array('name'=>'contato_telefones', 'id'=>'contato_telefones', 'value'=>set_value('contato_telefones', property_exists($contato, 'contato_telefones')? $contato->contato_telefones : ''), 'class'=>"textarea $class"))?>
</div>

<div class="element">
	<label for="name">Endereço <span></span>
	<?php $er = form_error('contato_endereco','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('contato_endereco',set_value('contato_endereco', property_exists($contato, 'contato_endereco')? $contato->contato_endereco : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
    <label for="content">E-mails <span></span> 
    <?php $er = form_error('contato_emails','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <?php echo form_textarea(array('name'=>'contato_emails', 'id'=>'contato_emails', 'value'=>set_value('contato_emails', property_exists($contato, 'contato_emails')? $contato->contato_emails : ''), 'class'=>"textarea $class"))?>
</div>

<div class="element">
	<label for="name">E-mail de Contato <span></span>
	<?php $er = form_error('contato_email','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('contato_email',set_value('contato_email', property_exists($contato, 'contato_email')? $contato->contato_email : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('contato_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_contato_status as $k => $v): ?>
	<?php echo form_checkbox('contato_status', $k ,set_checkbox('contato_status', $k, (property_exists($contato, 'contato_status')? $contato->contato_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_contato" value="1" />
						<input type="hidden" id="name" name="contato_id" class="text" value="<?php echo property_exists($contato, 'contato_id')? $contato->contato_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('contato');?>">Cancelar</a>
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
