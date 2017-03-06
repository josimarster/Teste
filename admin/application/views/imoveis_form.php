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
				<div class="h_title">Gerenciar imoveis - <?php echo $action ?></div>
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
					<?php echo form_hidden('imoveis_id',set_value('imoveis_id', property_exists($imoveis, 'imoveis_id')? $imoveis->imoveis_id : ''))?>

					<div class="element">
						<label for="name">Título <span>(obrigatório)</span>
						<?php $er = form_error('imoveis_titulo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
						<?php echo form_input('imoveis_titulo',set_value('imoveis_titulo', property_exists($imoveis, 'imoveis_titulo')? $imoveis->imoveis_titulo : ''),"class='text $class' style = '' ")?>
					</div>

					<div class="element">
						<label for="name">Referência <span>(obrigatório)</span>
						<?php $er = form_error('imoveis_referencia','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
						<?php echo form_input('imoveis_referencia',set_value('imoveis_referencia', property_exists($imoveis, 'imoveis_referencia')? $imoveis->imoveis_referencia : ''),"class='text $class' style = '' ")?>
					</div>

					<div class="element">
						<label for="tipos">Tipo  <?php $er = form_error('imoveis_tipo','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
						<?php echo form_dropdown('imoveis_tipo', $tipos, property_exists($imoveis, 'imoveis_tipo')? $imoveis->imoveis_tipo:'');?>
					</div>

					<div class="element">
						<label for="comments">Dados do imóvel <span></span>
						<?php $er = form_error('imoveis_dados','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
						</label>

						<table style="margin-left: 0px;">
							<tr>
								<?php $i=1; foreach($arr_imoveis_dados as $item):  ?>
									<td >
										<?php echo $item->dadosimovel_titulo; ?>
										</td>
									<td style="width: 10px; ">
										<?php
											echo form_input(
													'imoveis_dados['.$item->dadosimovel_id.']',
													set_value('imoveis_dados['.$item->dadosimovel_id.']',
															in_array( $item->dadosimovel_id,
																	array_keys($arr_defaults_imoveis_dados2) )? $arr_defaults_imoveis_dados2[$item->dadosimovel_id]->imoveis_dadosimovel_valor : ''
													),
													"class='text $class' style = 'width:500px' "
											);
										?>
										</td>
									<?php echo $i%1==0?'</tr><tr>':''?>
								<?php $i++; endforeach;?>
							</tr>
						</table>

					</div>


					<div class="element">
						<label for="comments">Categorias <span></span>
						<?php $er = form_error('imoveis_categorias','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
						</label>


						<table style="margin-left: 0px;">
							<tr>
								<?php $i=1; foreach($arr_imoveis_categorias as $item):  ?>
									<td style="width: 10px; ">
										<?php
										echo form_radio(
												'imoveis_categorias',
												$item->categorias_id,
												set_radio(
													'imoveis_categorias',
													$item->categorias_id, (property_exists($imoveis, 'imoveis_categorias')? $imoveis->imoveis_categorias : 0) == $item->categorias_id
												)
											,'style="width: 20px"'
										)?>
										</td>
										<td style="width: 200px">
										<?php echo $item->categorias_titulo; ?>
										</td>
									<?php echo $i%2==0?'</tr><tr>':''?>
								<?php $i++; endforeach;?>
							</tr>
						</table>
					</div>

<div class="element">

    <?php if( property_exists($imoveis, 'imoveis_imagem') && $imoveis->imoveis_imagem != "" ) : ?>
    <label for="attach">Imagem Principal <span></span> </label>
    <div id="thumbs">
        <div class="thumb">
            <img  src="<?php echo base_url("imoveis/imagem/110/110/".$imoveis->imoveis_imagem) ?>" />
            
            <div class="control">
                <a href="<?php echo base_url("imoveis/removerimagem/$imoveis->imoveis_id/imoveis_imagem")?>" onclick="return confirm('Tem certeza de que deseja excluir esta imagem?');">excluir</a>
            </div>
        </div>
    </div>

    <?php else: ?>

    <label for="attach">Imagem <span></span>
    <?php $er = form_error('imoveis_imagem','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
    <input type="file" name="imoveis_imagem" />

    <?php endif; ?>

</div>

					<div class="element">
						<label for="comments">Dependências <span></span>
						<?php $er = form_error('imoveis_dependencias','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
						</label>

						<table style="margin-left: 0px;">
							<tr>
								<?php $i=1; foreach($arr_imoveis_dependencias as $item):  ?>
									<td style="text-align: right;  width: 120px">
										<?php echo $item->dependencias_titulo; ?>
										</td>
									<td style="width: 10px; ">
										<?php
											echo form_input(
													'imoveis_dependencias['.$item->dependencias_id.']',
													set_value('imoveis_dependencias['.$item->dependencias_id.']',
															in_array(
																	$item->dependencias_id,
																	array_keys($arr_defaults_imoveis_dependencias)
															)? $arr_defaults_imoveis_dependencias[$item->dependencias_id]->imoveis_dependencias_valor : ''
													),
													"class='text $class' style = 'width:50px' "
											);

										?>
										</td>
									<?php echo $i%3==0?'</tr><tr>':''?>
								<?php $i++; endforeach;?>
							</tr>
						</table>
					</div>

					<div class="element">
						<label for="comments">Valores <span></span>
						<?php $er = form_error('imoveis_valores','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
						</label>

						<table style="margin-left: 0px;">
							<tr>
								<?php $i=1; foreach($arr_imoveis_valores as $item):  ?>
									<td style="text-align: right;  width: 120px">
										<?php echo $item->valores_titulo; ?>
										</td>
									<td style="width: 10px; ">
										<?php
											echo form_input(
													'imoveis_valores['.$item->valores_id.']',
													set_value('imoveis_valores['.$item->valores_id.']',
															in_array(
																	$item->valores_id,
																	array_keys($arr_defaults_imoveis_valores)
															)? $arr_defaults_imoveis_valores[$item->valores_id]->imoveis_valores_valor : ''
													),
													"class='text $class' style = 'width:50px' "
											);

										?>
										</td>
									<?php echo $i%3==0?'</tr><tr>':''?>
								<?php $i++; endforeach;?>
							</tr>
						</table>
					</div>

					<div class="element">
						<label for="comments">Características <span></span>
						<?php $er = form_error('imoveis_caracteristicas','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
						</label>

						<table style="margin-left: 0px;">
							<tr>
								<?php $i=1; foreach($arr_imoveis_caracteristicas as $item):  ?>
									<td style="text-align: right; width: 120px">
										<?php echo $item->caracteristicas_titulo; ?>
										</td>
									<td style="width: 10px; ">
										<?php
											echo form_input(
													'imoveis_caracteristicas['.$item->caracteristicas_id.']',
													set_value('imoveis_caracteristicas['.$item->caracteristicas_id.']',
															in_array(
																	$item->caracteristicas_id,
																	array_keys($arr_defaults_imoveis_caracteristicas)
															)? $arr_defaults_imoveis_caracteristicas[$item->caracteristicas_id]->imoveis_caracteristicas_valor : ''
													),
													"class='text $class' style = 'width:50px' "
											);

										?>
										</td>
									<?php echo $i%3==0?'</tr><tr>':''?>
								<?php $i++; endforeach;?>
							</tr>
						</table>
					</div>

					<div class="element">
						<label for="name">Pontos Fortes <span></span>
						<?php $er = form_error('imoveis_pontosfortes','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
						<?php echo form_textarea(array('name'=>'imoveis_pontosfortes', 'id'=>'imoveis_pontosfortes', 'value'=>set_value('imoveis_pontosfortes', property_exists($imoveis, 'imoveis_pontosfortes')? $imoveis->imoveis_pontosfortes : ''), 'class'=>"textarea $class"))?>
					</div>
	<?php /*?>
					<div class="element">
						<label for="name">Mapa <span></span>
						<?php $er = form_error('imoveis_mapa','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?></label>
						<?php echo form_textarea(array('name'=>'imoveis_mapa', 'id'=>'imoveis_mapa', 'value'=>set_value('imoveis_mapa', property_exists($imoveis, 'imoveis_mapa')? $imoveis->imoveis_mapa : ''), 'class'=>"textarea $class"))?>
					</div>
	<?php */ ?>
					<div class="element">
						<label for="comments">Status <span></span>
						<?php $er = form_error('imoveis_status','<span class="red">(',')</span>'); echo $er; $class = ($er == ""? '' :' err') ?>
						</label>

						<?php foreach($arr_imoveis_status as $k => $v): ?>
							<?php echo form_checkbox('imoveis_status', $k ,set_checkbox('imoveis_status', $k, (property_exists($imoveis, 'imoveis_status')? $imoveis->imoveis_status : 0) == $k )), ' - ', $v , '<Br />'; ?>
						<?php endforeach; ?>

					</div>

					<div class="entry">
						<input type="hidden" name="form_imoveis" value="1" />
						<input type="hidden" id="name" name="imoveis_id" class="text" value="<?php echo property_exists($imoveis, 'imoveis_id')? $imoveis->imoveis_id:0?>"/>
						<button type="submit" class="add">Salvar</button>
						<a class="button cancel" href="<?php echo base_url('imoveis');?>">Cancelar</a>
					</div>
				</form>

			<?php if( (property_exists($imoveis, 'imoveis_id')? $imoveis->imoveis_id:0 ) > 0): ?>
			<div class="full_w" >
				<div class="h_title">caption - <b>Imagem entre 930px (largura) e  490 px (altura)</b></div>
				<form action="<?php echo base_url('imoveis/upload')?>" method="post" enctype="multipart/form-data">

					<table style="width: 600px;">
					<?php for($i = 0; $i < 5; $i++): ?>
						<tr>
							<td>
								<label for="attach">Selecione a foto</label>
								<input type="file" name="attach<?php echo $i ?>" />
							</td>
							<td>
								<label for="attach<?php echo $i ?>_desc">Descrição</label>
								<?php echo form_input("attach".$i."_desc"); ?>
							</td>
						</tr>
					<?php endfor ?>
					</table>

					<div class="entry">
						<input type="hidden" name="form_galeria" value="313" />
						<input type="hidden" name="foto_imoveis" value="<?php echo property_exists($imoveis, 'imoveis_id')? $imoveis->imoveis_id:0?>" />
						<button type="submit" class="add">Adicionar</button>
					</div>
				</form>
				<div id="thumbs" >
				<a href="#" name="gallery" ></a>
				<?php if( count($galeria_fotos313) > 0): ?>
				<form action="<?php echo base_url('imoveis/update_desc')?>" method="post">
					<?php foreach($galeria_fotos313 as $foto): ?>
					<div class="thumb">
						<!-- <img  src="<?php echo base_url('/uploads/'.$foto->foto_thumb_path) ?>" /> -->
						 <img  src="<?php echo base_url("imoveis/imagem/110/110/".$foto->foto_path) ?>" />
						<div class="control">
							<a href="<?php echo base_url("/imoveis/removerfoto/{$foto->foto_id}/{$foto->foto_imoveis}") ?>" onclick="return confirm('Tem certeza de que deseja excluir esta imagem?');">excluir</a>
						</div>
						<br />
						<input type="text"  name="foto[<?php echo $foto->foto_id?>]" style="width: 100px;" value="<?php echo $foto->foto_desc?>" rel="<?php echo $foto->foto_id?>" class="foto_desc" />
					</div>
					<?php endforeach;?>
					<div class="entry" style="clear: both;">
						<input type="hidden" name="foto_imoveis" value="<?php echo property_exists($imoveis, 'imoveis_id')? $imoveis->imoveis_id:0?>" />
						<button type="submit" class="add">Salvar Legendas</button>
					</div>
				</form>
				<?php endif;?>
				</div>
			</div>
			<?php endif; ?>



			</div>

		</div>
		<div class="clear"></div>
	</div>

	<?php include('footer.php'); ?>
</div>

</body>
</html>
