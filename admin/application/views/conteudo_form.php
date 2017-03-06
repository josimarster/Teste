<?php include('header.php');?>
<script type="text/javascript">
    $(function(){
		CKEDITOR.replace( 'conteudo_texto' );
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
				<div class="h_title">Gerenciar conteudo - <?php echo $action ?></div>
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



<?php echo form_hidden('conteudo_id',set_value('conteudo_id', property_exists($conteudo, 'conteudo_id')? $conteudo->conteudo_id : ''))?>


<div class="element">
	<label for="name">Título <span>(obrigatório)</span>
	<?php $er = form_error('conteudo_titulo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('conteudo_titulo',set_value('conteudo_titulo', property_exists($conteudo, 'conteudo_titulo')? $conteudo->conteudo_titulo : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">URL <span>(obrigatório)</span>
	<?php $er = form_error('conteudo_url','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('conteudo_url',set_value('conteudo_url', property_exists($conteudo, 'conteudo_url')? $conteudo->conteudo_url : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
    <label for="content">Texto <span>(obrigatório)</span> 
    <?php $er = form_error('conteudo_texto','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <?php echo form_textarea(array('name'=>'conteudo_texto', 'id'=>'conteudo_texto', 'value'=>set_value('conteudo_texto', property_exists($conteudo, 'conteudo_texto')? $conteudo->conteudo_texto : ''), 'class'=>"textarea $class"))?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('conteudo_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_conteudo_status as $k => $v): ?>
	<?php echo form_checkbox('conteudo_status', $k ,set_checkbox('conteudo_status', $k, (property_exists($conteudo, 'conteudo_status')? $conteudo->conteudo_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_conteudo" value="1" />
						<input type="hidden" id="name" name="conteudo_id" class="text" value="<?php echo property_exists($conteudo, 'conteudo_id')? $conteudo->conteudo_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('conteudo');?>">Cancelar</a>
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
