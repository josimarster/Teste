<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class paginas extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_paginas');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_paginas->listAll();
		$data['lista'] = $lista;
		$this->load->view('paginas_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('paginas_id', 'Código', 'required');
		$this->form_validation->set_rules('paginas_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['paginas_status'] = $this->input->post('paginas_status');
			$paginas_id = $this->model_paginas->insert($_data);
			$this->session->set_flashdata('success','paginas cadastrado com sucesso');
			redirect(base_url("paginas"));
		}

		$data['arr_paginas_status'] = array('1' => 'Ativo');
		$data['arr_defaults_paginas_status'] = array();
		$data['paginas'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('paginas_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('paginas_id', 'Código', 'required');
		$this->form_validation->set_rules('paginas_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['paginas_id'] = $this->input->post('paginas_id');
			$_data['paginas_status'] = $this->input->post('paginas_status');
			$paginas_id = $this->model_paginas->update($_data);
			$this->session->set_flashdata('success','paginas cadastrado com sucesso');
			redirect(base_url("paginas"));
		}
		
		$data['arr_paginas_status'] = array('1' => 'Ativo');
		$data['arr_defaults_paginas_status'] = array();
		$data['paginas'] = $this->model_paginas->getpaginas($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('paginas_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['paginas_id'] = $id;
		if($this->model_paginas->delete($data)){
			$this->session->set_flashdata('success','paginas excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o paginas.');
		}
		redirect(base_url('paginas'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['paginas_id'] = $id;
		if($this->model_paginas->active($data)){
			$this->session->set_flashdata('success','paginas ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o paginas.');
		}
		redirect(base_url('paginas'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['paginas_id'] = $id;
		if($this->model_paginas->deactive($data)){
			$this->session->set_flashdata('success','paginas desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o paginas.');
		}
		redirect(base_url('paginas'));
	}

	function check_true(){
		return true;
	}

}


