<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imoveis extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_imoveis');
		$this->load->model('model_dadosimovel');
		$this->load->model('model_categorias');
		$this->load->model('model_caracteristicas');
		$this->load->model('model_dependencias');
		$this->load->model('model_valores');
		$this->load->model('model_tipos');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';

		$limit 		= 30;
		$offset 	= $this->uri->segment(4);
		$offset 	= is_numeric($offset)? $offset : 0;
		$this->model_imoveis->addLimit($limit, $offset);
		$lista 		= $this->model_imoveis->listAll();
		$qtotal 	= $this->db->query('SELECT FOUND_ROWS() as total;')->row();
		$total 		= $qtotal->total;

		$data['total'] 	= $total;
		$data['start'] 	= $offset+1;
		$data['end'] 	= $total > $limit? (($offset+$limit) < $total? $offset+$limit : $total) : $limit;

		$q = isset($q)? $q : "";

		$this->load->library('pagination');
		$config['base_url'] 		= site_url('imoveis/index/'.$q."/");
		$config['total_rows'] 		= $total ;
		$config['per_page'] 		= $limit;
		$config['uri_segment'] 		= 4;
		$config['full_tag_open'] 	= '';
		$config['full_tag_close']	= '';
		$config['cur_tag_open'] 	= '<span class="active">';
		$config['cur_tag_close'] 	= '</span>';
		$config['last_link'] 		= 'Último »';
		$config['first_link']		= '« Primeiro';
		$this->pagination->initialize($config);
		$data['lista'] = $lista;


		$this->load->view('imoveis_list', $data);
	}

	function add(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('imoveis_id', 'Código', 'required');
		$this->form_validation->set_rules('imoveis_titulo', 'Título', 'required');
		$this->form_validation->set_rules('imoveis_referencia', 'Referência', 'required');
		$this->form_validation->set_rules('imoveis_Fotos', 'Fotos', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_dados', 'Dados do imóvel', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_categorias', 'Categorias', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_dependencias', 'Dependências', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_valores', 'Valores', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_caracteristicas', 'Características', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['imoveis_titulo'] 		= $this->input->post('imoveis_titulo');
			$_data['imoveis_referencia'] 		= $this->input->post('imoveis_referencia');
			$_data['imoveis_pontosfortes'] 	= $this->input->post('imoveis_pontosfortes');
			$_data['imoveis_mapa'] 			= $this->input->post('imoveis_mapa');
			$_data['imoveis_tipo'] 			= $this->input->post('imoveis_tipo');
			$_data['imoveis_categorias'] 	= $this->input->post('imoveis_categorias');
			$_data['imoveis_status'] 		= $this->input->post('imoveis_status');

			$datainfo['imoveis_dados'] 				= $this->input->post('imoveis_dados');
			$datainfo['imoveis_caracteristicas'] 	= $this->input->post('imoveis_caracteristicas');
			$datainfo['imoveis_valores'] 			= $this->input->post('imoveis_valores');
			$datainfo['imoveis_dependencias'] 		= $this->input->post('imoveis_dependencias');

			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '0';
			$config['max_width']  		= '0';
			$config['max_height']  		= '0';
			$config['encrypt_name'] 	= true;

			$upload_data = array();
			$this->load->library('upload', $config);

			if ( $this->upload->do_upload('imoveis_imagem')){
				$upload_data = $this->upload->data();

				$cnf['image_library'] 	= 'gd2';
				$cnf['source_image']	= './uploads/'.$upload_data['file_name'];
				$cnf['maintain_ratio'] 	= TRUE;
				$cnf['width']			= 0;
				$cnf['height']			= 0;

				$this->load->library('image_lib', $cnf);
				$this->image_lib->fit();

			}

			if(array_key_exists('file_name', $upload_data)){
				$_data['imoveis_imagem'] 			= $upload_data['file_name'];
			}


			$imoveis_id = $this->model_imoveis->insert($_data);

			$this->model_imoveis->remove_imoveis_dados($imoveis_id);
			$this->model_imoveis->add_imoveis_dados($imoveis_id, $datainfo['imoveis_dados']);

			#$this->model_imoveis->remove_imoveis_categorias($imoveis_id);
			#$this->model_imoveis->add_imoveis_categorias($imoveis_id, $datainfo['imoveis_categorias']);

			$this->model_imoveis->remove_imoveis_caracteristicas($imoveis_id);
			$this->model_imoveis->add_imoveis_caracteristicas($imoveis_id, $datainfo['imoveis_caracteristicas']);

			$this->model_imoveis->remove_imoveis_valores($imoveis_id);
			$this->model_imoveis->add_imoveis_valores($imoveis_id, $datainfo['imoveis_valores']);

			$this->model_imoveis->remove_imoveis_dependencias($imoveis_id);
			$this->model_imoveis->add_imoveis_dependencias($imoveis_id, $datainfo['imoveis_dependencias']);

			$this->session->set_flashdata('success','imoveis cadastrado com sucesso');
			redirect(base_url("imoveis"));

		}

		//dados do imóvel
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_dadosimovel->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_dados($field_id);
		$arr = array();
		$ar2 		= array();
		foreach($selecteds as $l){
			$arr[]=$l->imoveis_dadosimovel_dadosimovel;
			$ar2[$l->imoveis_dadosimovel_dadosimovel] = $l;
		}
		$data['arr_imoveis_dados'] 			= $list;
		$data['arr_defaults_imoveis_dados'] = $arr;
		$data['arr_defaults_imoveis_dados2'] = $ar2;


		//categorias do imóvel
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_categorias->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_categorias($field_id);
		$arr 		= array();
		foreach($selecteds as $l){
			$arr[]=$l->imoveis_categorias_categorias;
		}
		$data['arr_imoveis_categorias'] = $list;
		$data['arr_defaults_imoveis_categorias'] = $arr;

		//dependências do imóvel
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_dependencias->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_dependencias($field_id);
		$arr 		= array();
		foreach($selecteds as $l){
			$arr[]=$l->imoveis_dependencias_dependencias;
		}
		$data['arr_imoveis_dependencias'] = $list;
		$data['arr_defaults_imoveis_dependencias'] = $arr;


		//valores do imóvel
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_valores->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_valores($field_id);
		$arr 		= array();
		foreach($selecteds as $l){
			$arr[]=$l->imoveis_valores_valores;
		}
		$data['arr_imoveis_valores'] = $list;
		$data['arr_defaults_imoveis_valores'] = $arr;


		//características do imóvel
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_caracteristicas->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_caracteristicas($field_id);
		$arr 		= array();
		foreach($selecteds as $l){
			$arr[]=$l->imoveis_caracteristicas_caracteristicas;
		}
		$data['arr_imoveis_caracteristicas'] = $list;
		$data['arr_defaults_imoveis_caracteristicas'] = $arr;

		//tipo do imóvel
		$tipos			= $this->model_tipos->listAll();
		$_tipo 				= array();
		foreach($tipos as $c){
			$_tipo[$c->tipos_id] = $c->tipos_titulo;
		}
		$data['tipos'] 		= $_tipo;


		$data['arr_imoveis_status'] = array('1' => 'Ativo');
		$data['arr_defaults_imoveis_status'] = array();
		$data['imoveis'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('imoveis_form', $data);
	}


	function edit($field_id = 0){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('imoveis_id', 'Código', 'required');
		$this->form_validation->set_rules('imoveis_titulo', 'Título', 'required');
		$this->form_validation->set_rules('imoveis_referencia', 'Referência', 'required');
		$this->form_validation->set_rules('imoveis_Fotos', 'Fotos', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_dados', 'Dados do imóvel', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_categorias', 'Categorias', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_dependências', 'Dependências', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_valores', 'Valores', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_características', 'Características', 'callback_check_true');
		$this->form_validation->set_rules('imoveis_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['imoveis_id'] 			= $this->input->post('imoveis_id');
			$_data['imoveis_titulo'] 		= $this->input->post('imoveis_titulo');
			$_data['imoveis_referencia'] 		= $this->input->post('imoveis_referencia');
			$_data['imoveis_pontosfortes'] 	= $this->input->post('imoveis_pontosfortes');
			$_data['imoveis_mapa'] 			= $this->input->post('imoveis_mapa');
			$_data['imoveis_tipo'] 			= $this->input->post('imoveis_tipo');
			$_data['imoveis_categorias'] 	= $this->input->post('imoveis_categorias');
			$_data['imoveis_status'] 		= $this->input->post('imoveis_status');

			$datainfo['imoveis_dados'] 				= $this->input->post('imoveis_dados');
			$datainfo['imoveis_caracteristicas'] 	= $this->input->post('imoveis_caracteristicas');
			$datainfo['imoveis_valores'] 			= $this->input->post('imoveis_valores');
			$datainfo['imoveis_dependencias'] 		= $this->input->post('imoveis_dependencias');


			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '0';
			$config['max_width']  		= '0';
			$config['max_height']  		= '0';
			$config['encrypt_name'] 	= true;

			$upload_data = array();
			$this->load->library('upload', $config);

			if ( $this->upload->do_upload('imoveis_imagem')){
				$upload_data = $this->upload->data();

				$cnf['image_library'] 	= 'gd2';
				$cnf['source_image']	= './uploads/'.$upload_data['file_name'];
				$cnf['maintain_ratio'] 	= TRUE;
				$cnf['width']			= 0;
				$cnf['height']			= 0;

				$this->load->library('image_lib', $cnf);
				$this->image_lib->fit();

			}

			if(array_key_exists('file_name', $upload_data)){
				$_data['imoveis_imagem'] 			= $upload_data['file_name'];
			}


			$this->model_imoveis->update($_data);
			$imoveis_id = $_data['imoveis_id'];

			$this->model_imoveis->remove_imoveis_dados($imoveis_id);
			$this->model_imoveis->add_imoveis_dados($imoveis_id, $datainfo['imoveis_dados']);

			#$this->model_imoveis->remove_imoveis_categorias($imoveis_id);
			#$this->model_imoveis->add_imoveis_categorias($imoveis_id, $datainfo['imoveis_categorias']);

			$this->model_imoveis->remove_imoveis_caracteristicas($imoveis_id);
			$this->model_imoveis->add_imoveis_caracteristicas($imoveis_id, $datainfo['imoveis_caracteristicas']);

			$this->model_imoveis->remove_imoveis_valores($imoveis_id);
			$this->model_imoveis->add_imoveis_valores($imoveis_id, $datainfo['imoveis_valores']);

			$this->model_imoveis->remove_imoveis_dependencias($imoveis_id);
			$this->model_imoveis->add_imoveis_dependencias($imoveis_id, $datainfo['imoveis_dependencias']);

			$this->session->set_flashdata('success','imoveis alterado com sucesso');
			redirect(base_url("imoveis/edit/$imoveis_id"));
		}


		//dados do imovel
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_dadosimovel->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_dados($field_id);
		$arr 		= array();
		$ar2 		= array();

		foreach($selecteds as $l){
			$arr[]=$l->imoveis_dadosimovel_dadosimovel;
			$ar2[$l->imoveis_dadosimovel_dadosimovel] = $l;
		}

		$data['arr_imoveis_dados'] = $list;
		$data['arr_defaults_imoveis_dados'] = $arr;
		$data['arr_defaults_imoveis_dados2'] = $ar2;


		//categorias
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_categorias->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_categorias($field_id);
		$arr = array();
		foreach($selecteds as $l){
			$arr[$l->imoveis_categorias_categorias]=$l;
		}
		$data['arr_imoveis_categorias'] = $list;
		$data['arr_defaults_imoveis_categorias'] = $arr;

		//caracteristicas
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_caracteristicas->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_caracteristicas($field_id);
		$arr = array();
		foreach($selecteds as $l){
			$arr[$l->imoveis_caracteristicas_caracteristicas]=$l;
		}
		$data['arr_imoveis_caracteristicas'] = $list;
		$data['arr_defaults_imoveis_caracteristicas'] = $arr;

		//valores
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_valores->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_valores($field_id);
		$arr = array();
		foreach($selecteds as $l){
			$arr[$l->imoveis_valores_valores]=$l;
		}
		$data['arr_imoveis_valores'] = $list;
		$data['arr_defaults_imoveis_valores'] = $arr;

		//dependencias
		$field_id 	= isset($field_id)? $field_id : 0;
		$list 		= $this->model_dependencias->listall(TRUE);
		$selecteds	= $this->model_imoveis->listar_imoveis_dependencias($field_id);
		$arr = array();
		foreach($selecteds as $l){
			$arr[$l->imoveis_dependencias_dependencias]=$l;
		}
		$data['arr_imoveis_dependencias'] = $list;
		$data['arr_defaults_imoveis_dependencias'] = $arr;

		//tipo do imóvel
		$tipos			= $this->model_tipos->listAll();
		$_tipo 				= array();
		foreach($tipos as $c){
			$_tipo[$c->tipos_id] = $c->tipos_titulo;
		}
		$data['tipos'] 		= $_tipo;

		$data['arr_imoveis_status'] = array('1' => 'Ativo');
		$data['arr_defaults_imoveis_status'] = array();

		$data['galeria_fotos313'] = $this->model_imoveis->getFotos($field_id, 313);
		$data['imoveis'] = $this->model_imoveis->getimoveis($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('imoveis_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['imoveis_id'] = $id;
		if($this->model_imoveis->delete($data)){
			$this->session->set_flashdata('success','imoveis excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o imoveis.');
		}
		redirect(base_url('imoveis'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['imoveis_id'] = $id;
		if($this->model_imoveis->active($data)){
			$this->session->set_flashdata('success','imoveis ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o imoveis.');
		}
		redirect(base_url('imoveis'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['imoveis_id'] = $id;
		if($this->model_imoveis->deactive($data)){
			$this->session->set_flashdata('success','imoveis desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o imoveis.');
		}
		redirect(base_url('imoveis'));
	}


	function upload(){

		$config['upload_path'] 		= './uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png|JPG|GIF|PNG';
		$config['max_size']			= '5000';
		$config['max_width']  		= '5000';
		$config['max_height']  		= '5000';
		$config['encrypt_name'] 	= true;

		$this->load->library('upload', $config);
		$this->load->library('image_lib');

		$data = array();
		$data['foto_imoveis'] = $this->input->post('foto_imoveis');
		$data['foto_galeria'] = $this->input->post('form_galeria');

		foreach($_FILES as $field => $file){
			$config_imglib = array();
          	if($file['error'] == 0){
				if ( ! $this->upload->do_upload($field)){
					$this->session->set_flashdata('error','Erro ao cadastrar a imagem'.$this->upload->display_errors());
				}else{
					$upload_data = $this->upload->data();
					//alteração para colocar todas as galerias do mesmo tamanho
					$config_imglib['width']	 	= 110;
					$config_imglib['height']	= 110;
					$config_imglib['image_library'] = 'gd2';
					$config_imglib['source_image']	= './uploads/'.$upload_data['file_name'];
					$config_imglib['create_thumb'] 	= TRUE;
					$this->image_lib->initialize($config_imglib);
					$this->image_lib->fit();
					$this->image_lib->clear();
					$config_imglib['width']			= 0;
					$config_imglib['height']		= 0;
					$config_imglib['image_library'] = 'gd2';
					$config_imglib['source_image']	= './uploads/'.$upload_data['file_name'];
					$config_imglib['create_thumb'] 	= FALSE;
					$config_imglib['new_image']   	= './uploads/0x0image.'.end(explode('.',$upload_data['file_name']));;
					$this->image_lib->initialize($config_imglib);
					$this->image_lib->fit();
					$this->image_lib->clear();
					$data['foto_path'] = $upload_data['file_name'];
					$data['foto_thumb_path'] = current(explode('.',$upload_data['file_name'])).'_thumb.'.end(explode('.',$upload_data['file_name']));
					$data['foto_status'] = 1;
					$data['foto_desc'] = $this->input->post($field.'_desc');
					$this->model_imoveis->addfotos($data);
					$this->session->set_flashdata('success','Imagem(s) enviada(s) com sucesso!');
				}
			}
		}

		redirect(base_url("imoveis/edit/{$data['foto_imoveis']}/#gallery"));
	}


	function removerfoto($id, $imoveis_id){
		$id = is_numeric($id)? $id : 0;
		$imoveis_id = is_numeric($imoveis_id)? $imoveis_id : 0;
		$data['foto_id'] = $id;

		if($this->model_imoveis->removerfoto($id, $imoveis_id)){
			
			$this->session->set_flashdata('success','A foto foi removida com sucesso');
		}else{
			$this->session->set_flashdata('error','Não foi possível remover a foto.');
		}

		redirect(base_url("imoveis/edit/$imoveis_id/#gallery"));

	}

	function updatefoto(){

		if($this->model_imoveis->updatefoto($_POST)){
			echo 'true';
		}else{
			echo 'false';
		}

	}

	function update_desc(){

		$imoveis_id = 0;
		if($_POST){
			$imoveis_id = $_POST['foto_imoveis'];
			foreach($_POST['foto'] as $key=>$value){
				$data['foto_id'] = $key;
				$data['foto_desc'] = $value;
				$this->model_imoveis->updatefoto($data);
			}
			$this->session->set_flashdata('success','As legendas foram atualizadas com sucesso.');
		}

		if($imoveis_id == 0){
			redirect(base_url("imoveis"));
		}else{
			redirect(base_url("imoveis/edit/$imoveis_id"));

		}
	}

	function removerimagem($id, $field){
		$id		 = is_numeric($id)? $id : 0;
		$projeto = $this->model_imoveis->getimoveis($id);

		if( $projeto->$field != "" && file_exists('./uploads/'.$projeto->$field)){
			$path = get_file_info( './uploads/'.$projeto->$field, 'server_path');
			unlink( $path['server_path']);
		}

		$data['imoveis_id'] 	= $id;
		$data[$field] 			= '';
		if($this->model_imoveis->removerimagem($data)){
			$this->session->set_flashdata('success','A foto foi removida com sucesso!');
		}else{
			$this->session->set_flashdata('error','Não foi possível remover a foto!');

		}
		redirect(base_url("imoveis/edit/$id"));
	}
	
	public function imagem($width = 0, $height = 0, $file = ''){
		$config['image_library'] = 'gd2';
		$config['source_image']	= './uploads/'.$file;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = TRUE;
		$config['width']	= $width;
		$config['height']	= $height;
		$config['dynamic_output']	= TRUE;
	
		$this->load->library('image_lib', $config);
	
		if ( ! $this->image_lib->fit()){
			echo $this->image_lib->display_errors();
		}
	}

	function check_true(){
		return true;
	}

}
