<?php include('header.php');?>
<script type="text/javascript">
    $(function(){
		CKEDITOR.replace( 'banners_Texto', {removeButtons: 'Source',} );
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
				<div class="h_title">Gerenciar banners - <?php echo $action ?></div>
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

<?php echo form_hidden('banners_id',set_value('banners_id', property_exists($banners, 'banners_id')? $banners->banners_id : ''))?>


<div class="element">
	<label for="name">Link <span></span>
	<?php $er = form_error('banners_Link','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('banners_Link',set_value('banners_Link', property_exists($banners, 'banners_Link')? $banners->banners_Link : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">
	<label for="name">Título <span>(obrigatório)</span>
	<?php $er = form_error('banners_banners_titulo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
	<?php echo form_input('banners_banners_titulo',set_value('banners_banners_titulo', property_exists($banners, 'banners_banners_titulo')? $banners->banners_banners_titulo : ''),"class='text $class' style = '' ")?>
</div>

<div class="element">

    <?php if( property_exists($banners, 'banners_imagem') && $banners->banners_imagem != "" ) : ?>
    <label for="attach">Imagem Principal <span></span> </label>
    <div id="thumbs">
        <div class="thumb">
            <img  src="<?php echo base_url("uploads/$banners->banners_imagem")?>" />
            <div class="control">
                <a href="<?php echo base_url("banners/removerimagem/$banners->banners_id/banners_imagem")?>" onclick="return confirm('Tem certeza de que deseja excluir esta imagem?');">excluir</a>
            </div>
        </div>
    </div>

    <?php else: ?>

    <label for="attach">Imagem <span></span>
    <?php $er = form_error('banners_imagem','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <input type="file" name="banners_imagem" />

    <?php endif; ?>

</div>


<div class="element">
    <label for="content">Texto <span>(obrigatório)</span> 
    <?php $er = form_error('banners_Texto','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <?php echo form_textarea(array('name'=>'banners_Texto', 'id'=>'banners_Texto', 'value'=>set_value('banners_Texto', property_exists($banners, 'banners_Texto')? $banners->banners_Texto : ''), 'class'=>"textarea $class"))?>
</div>

<div class="element">
	<label for="comments"> Local <span></span>  </label>
	<?php echo form_dropdown('banners_local', $arr_banners_local, set_value('banners_local', property_exists($banners, 'banners_local')? $banners->banners_local : '')
    ); ?>
</div>

<div class="element">
	<label for="comments">Status <span></span> 
	<?php $er = form_error('banners_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
	</label>
	
	
<?php foreach($arr_banners_status as $k => $v): ?>
	<?php echo form_checkbox('banners_status', $k ,set_checkbox('banners_status', $k, (property_exists($banners, 'banners_status')? $banners->banners_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
	
<?php endforeach; ?>
	
	
</div>

					<div class="entry">
						<input type="hidden" name="form_banners" value="1" />
						<input type="hidden" id="name" name="banners_id" class="text" value="<?php echo property_exists($banners, 'banners_id')? $banners->banners_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('banners');?>">Cancelar</a>
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
