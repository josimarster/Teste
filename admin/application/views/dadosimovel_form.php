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
				<div class="h_title">Gerenciar dadosimovel - <?php echo $action ?></div>
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

				<?php echo form_hidden('dadosimovel_id',set_value('dadosimovel_id', property_exists($dadosimovel, 'dadosimovel_id')? $dadosimovel->dadosimovel_id : ''))?>


<div class="element">
	<label for="name">Título <span>(obrigatório)</span>
	<?php $er = form_error('dadosimovel_titulo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('dadosimovel_titulo',set_value('dadosimovel_titulo', property_exists($dadosimovel, 'dadosimovel_titulo')? $dadosimovel->dadosimovel_titulo : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('dadosimovel_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_dadosimovel_status as $k => $v): ?>
	<?php echo form_checkbox('dadosimovel_status', $k ,set_checkbox('dadosimovel_status', $k, (property_exists($dadosimovel, 'dadosimovel_status')? $dadosimovel->dadosimovel_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_dadosimovel" value="1" />
						<input type="hidden" id="name" name="dadosimovel_id" class="text" value="<?php echo property_exists($dadosimovel, 'dadosimovel_id')? $dadosimovel->dadosimovel_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('dadosimovel');?>">Cancelar</a>
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
