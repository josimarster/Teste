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
				<div class="h_title">Gerenciar paginas - <?php echo $action ?></div>
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



<?php echo form_hidden('paginas_id',set_value('paginas_id', property_exists($paginas, 'paginas_id')? $paginas->paginas_id : ''))?>


<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('paginas_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_paginas_status as $k => $v): ?>
	<?php echo form_checkbox('paginas_status', $k ,set_checkbox('paginas_status', $k, (property_exists($paginas, 'paginas_status')? $paginas->paginas_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_paginas" value="1" />
						<input type="hidden" id="name" name="paginas_id" class="text" value="<?php echo property_exists($paginas, 'paginas_id')? $paginas->paginas_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('paginas');?>">Cancelar</a>
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
