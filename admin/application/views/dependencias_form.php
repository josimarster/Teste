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
				<div class="h_title">Gerenciar dependencias - <?php echo $action ?></div>
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

				<?php echo form_hidden('dependencias_id',set_value('dependencias_id', property_exists($dependencias, 'dependencias_id')? $dependencias->dependencias_id : ''))?>


<div class="element">
	<label for="name">Título <span>(obrigatório)</span>
	<?php $er = form_error('dependencias_titulo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('dependencias_titulo',set_value('dependencias_titulo', property_exists($dependencias, 'dependencias_titulo')? $dependencias->dependencias_titulo : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('dependencias_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_dependencias_status as $k => $v): ?>
	<?php echo form_checkbox('dependencias_status', $k ,set_checkbox('dependencias_status', $k, (property_exists($dependencias, 'dependencias_status')? $dependencias->dependencias_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_dependencias" value="1" />
						<input type="hidden" id="name" name="dependencias_id" class="text" value="<?php echo property_exists($dependencias, 'dependencias_id')? $dependencias->dependencias_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('dependencias');?>">Cancelar</a>
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
