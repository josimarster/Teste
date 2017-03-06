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
				<div class="h_title">Gerenciar tipos - <?php echo $action ?></div>
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



<?php echo form_hidden('tipos_id',set_value('tipos_id', property_exists($tipos, 'tipos_id')? $tipos->tipos_id : ''))?>


<div class="element">
	<label for="name">Título <span>(obrigatório)</span>
	<?php $er = form_error('tipos_titulo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('tipos_titulo',set_value('tipos_titulo', property_exists($tipos, 'tipos_titulo')? $tipos->tipos_titulo : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('tipos_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_tipos_status as $k => $v): ?>
	<?php echo form_checkbox('tipos_status', $k ,set_checkbox('tipos_status', $k, (property_exists($tipos, 'tipos_status')? $tipos->tipos_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_tipos" value="1" />
						<input type="hidden" id="name" name="tipos_id" class="text" value="<?php echo property_exists($tipos, 'tipos_id')? $tipos->tipos_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('tipos');?>">Cancelar</a>
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
