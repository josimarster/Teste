<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class banners extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_banners');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';

		$lista = $this->model_banners->listAll();
		$data['lista'] = $lista;
		$arr_banners_local		= array('Início', 'Lateral');
		$data['arr_banners_local']	= $arr_banners_local;
		$this->load->view('banners_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('banners_id', 'Código', 'required');
		$this->form_validation->set_rules('banners_Link', 'Link', 'callback_check_true');
		$this->form_validation->set_rules('banners_banners_titulo', 'Título', 'required');
		$this->form_validation->set_rules('banners_imagem', 'Imagem', 'callback_check_true');
		$this->form_validation->set_rules('banners_Texto', 'Texto', 'required');
		$this->form_validation->set_rules('banners_local', 'Local', 'callback_check_true');
		$this->form_validation->set_rules('banners_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['banners_Link'] = $this->input->post('banners_Link');
			$_data['banners_banners_titulo'] = $this->input->post('banners_banners_titulo');
			$_data['banners_Texto'] = $this->input->post('banners_Texto');
			$_data['banners_local'] = $this->input->post('banners_local');
			$_data['banners_status'] = $this->input->post('banners_status');

			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '0';
			$config['max_width']  		= '0';
			$config['max_height']  		= '0';
			$config['encrypt_name'] 	= true;
			
			$upload_data = array();
			$this->load->library('upload', $config);
			
			if ( $this->upload->do_upload('banners_imagem')){
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
			    $_data['banners_imagem'] 			= $upload_data['file_name'];
			}

			$banners_id = $this->model_banners->insert($_data);
			$this->session->set_flashdata('success','banners cadastrado com sucesso');
			redirect(base_url("banners"));
		}

		$arr_banners_local		= array('Início', 'Lateral');
		$data['arr_banners_local']	= $arr_banners_local;
		$data['arr_banners_status'] = array('1' => 'Ativo');
		$data['arr_defaults_banners_status'] = array();
		$data['banners'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('banners_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('banners_id', 'Código', 'required');
		$this->form_validation->set_rules('banners_Link', 'Link', 'callback_check_true');
		$this->form_validation->set_rules('banners_banners_titulo', 'Título', 'required');
		$this->form_validation->set_rules('banners_imagem', 'Imagem', 'callback_check_true');
		$this->form_validation->set_rules('banners_Texto', 'Texto', 'required');
		$this->form_validation->set_rules('banners_local', 'Local', 'callback_check_true');
		$this->form_validation->set_rules('banners_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['banners_id'] = $this->input->post('banners_id');
			$_data['banners_Link'] = $this->input->post('banners_Link');
			$_data['banners_banners_titulo'] = $this->input->post('banners_banners_titulo');
			$_data['banners_Texto'] = $this->input->post('banners_Texto');
			$_data['banners_local'] = $this->input->post('banners_local');
			$_data['banners_status'] = $this->input->post('banners_status');

			$config['upload_path'] 		= './uploads/';
			$config['allowed_types'] 	= '*';
			$config['max_size']			= '0';
			$config['max_width']  		= '0';
			$config['max_height']  		= '0';
			$config['encrypt_name'] 	= true;
			
			$upload_data = array();
			$this->load->library('upload', $config);
			
			if ( $this->upload->do_upload('banners_imagem')){
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
			    $_data['banners_imagem'] 			= $upload_data['file_name'];
			}

			$banners_id = $this->model_banners->update($_data);
			$this->session->set_flashdata('success','banners cadastrado com sucesso');
			redirect(base_url("banners"));
		}

		$arr_banners_local		= array('Início', 'Lateral');
		$data['arr_banners_local']	= $arr_banners_local;
		$data['arr_banners_status'] = array('1' => 'Ativo');
		$data['arr_defaults_banners_status'] = array();
		$data['banners'] = $this->model_banners->getbanners($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('banners_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['banners_id'] = $id;
		if($this->model_banners->delete($data)){
			$this->session->set_flashdata('success','banners excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o banners.');
		}
		redirect(base_url('banners'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['banners_id'] = $id;
		if($this->model_banners->active($data)){
			$this->session->set_flashdata('success','banners ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o banners.');
		}
		redirect(base_url('banners'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['banners_id'] = $id;
		if($this->model_banners->deactive($data)){
			$this->session->set_flashdata('success','banners desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o banners.');
		}
		redirect(base_url('banners'));
	}

	function removerimagem($id, $field){
	    $id = is_numeric($id)? $id : 0;
	    $projeto = $this->model_banners->getbanners($id);
	
	    $path = get_file_info( './uploads/'.$projeto->$field, 'server_path');
	    @unlink( $path['server_path']);
	
	    $data['banners_id'] = $id;
	    $data[$field] = '';
	    if($this->model_banners->removerimagem($data)){
	        $this->session->set_flashdata('success','A foto foi removida com sucesso!');
	    }else{
	        $this->session->set_flashdata('error','Não foi possível remover a foto!');
	
	    }
	    redirect(base_url("banners/edit/$id"));
	}

	function check_true(){
		return true;
	}

}


