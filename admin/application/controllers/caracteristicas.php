<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class caracteristicas extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_caracteristicas');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_caracteristicas->listAll();
		$data['lista'] = $lista;
		$this->load->view('caracteristicas_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('caracteristicas_id', 'Código', 'required');
		$this->form_validation->set_rules('caracteristicas_titulo', 'Título', 'required');
		$this->form_validation->set_rules('caracteristicas_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['caracteristicas_titulo'] = $this->input->post('caracteristicas_titulo');
			$_data['caracteristicas_status'] = $this->input->post('caracteristicas_status');
			$caracteristicas_id = $this->model_caracteristicas->insert($_data);
			$this->session->set_flashdata('success','caracteristicas cadastrado com sucesso');
			redirect(base_url("caracteristicas"));
		}

		$data['arr_caracteristicas_status'] = array('1' => 'Ativo');
		$data['arr_defaults_caracteristicas_status'] = array();
		$data['caracteristicas'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('caracteristicas_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('caracteristicas_id', 'Código', 'required');
		$this->form_validation->set_rules('caracteristicas_titulo', 'Título', 'required');
		$this->form_validation->set_rules('caracteristicas_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['caracteristicas_id'] = $this->input->post('caracteristicas_id');
			$_data['caracteristicas_titulo'] = $this->input->post('caracteristicas_titulo');
			$_data['caracteristicas_status'] = $this->input->post('caracteristicas_status');
			$caracteristicas_id = $this->model_caracteristicas->update($_data);
			$this->session->set_flashdata('success','caracteristicas cadastrado com sucesso');
			redirect(base_url("caracteristicas"));
		}
		
		$data['arr_caracteristicas_status'] = array('1' => 'Ativo');
		$data['arr_defaults_caracteristicas_status'] = array();
		$data['caracteristicas'] = $this->model_caracteristicas->getcaracteristicas($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('caracteristicas_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['caracteristicas_id'] = $id;
		if($this->model_caracteristicas->delete($data)){
			$this->session->set_flashdata('success','caracteristicas excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o caracteristicas.');
		}
		redirect(base_url('caracteristicas'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['caracteristicas_id'] = $id;
		if($this->model_caracteristicas->active($data)){
			$this->session->set_flashdata('success','caracteristicas ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o caracteristicas.');
		}
		redirect(base_url('caracteristicas'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['caracteristicas_id'] = $id;
		if($this->model_caracteristicas->deactive($data)){
			$this->session->set_flashdata('success','caracteristicas desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o caracteristicas.');
		}
		redirect(base_url('caracteristicas'));
	}

	function check_true(){
		return true;
	}

}


