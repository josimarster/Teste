<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tipos extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_tipos');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_tipos->listAll();
		$data['lista'] = $lista;
		$this->load->view('tipos_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tipos_id', 'Código', 'required');
		$this->form_validation->set_rules('tipos_titulo', 'Título', 'required');
		$this->form_validation->set_rules('tipos_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['tipos_titulo'] = $this->input->post('tipos_titulo');
			$_data['tipos_status'] = $this->input->post('tipos_status');
			$tipos_id = $this->model_tipos->insert($_data);
			$this->session->set_flashdata('success','tipos cadastrado com sucesso');
			redirect(base_url("tipos"));
		}

		$data['arr_tipos_status'] = array('1' => 'Ativo');
		$data['arr_defaults_tipos_status'] = array();
		$data['tipos'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('tipos_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tipos_id', 'Código', 'required');
		$this->form_validation->set_rules('tipos_titulo', 'Título', 'required');
		$this->form_validation->set_rules('tipos_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['tipos_id'] = $this->input->post('tipos_id');
			$_data['tipos_titulo'] = $this->input->post('tipos_titulo');
			$_data['tipos_status'] = $this->input->post('tipos_status');
			$tipos_id = $this->model_tipos->update($_data);
			$this->session->set_flashdata('success','tipos cadastrado com sucesso');
			redirect(base_url("tipos"));
		}

		$data['arr_tipos_status'] = array('1' => 'Ativo');
		$data['arr_defaults_tipos_status'] = array();
		$data['tipos'] = $this->model_tipos->gettipos($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('tipos_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['tipos_id'] = $id;
		if($this->model_tipos->delete($data)){
			$this->session->set_flashdata('success','tipos excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o tipos.');
		}
		redirect(base_url('tipos'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['tipos_id'] = $id;
		if($this->model_tipos->active($data)){
			$this->session->set_flashdata('success','tipos ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o tipos.');
		}
		redirect(base_url('tipos'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['tipos_id'] = $id;
		if($this->model_tipos->deactive($data)){
			$this->session->set_flashdata('success','tipos desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o tipos.');
		}
		redirect(base_url('tipos'));
	}

	function check_true(){
		return true;
	}

}


