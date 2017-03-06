<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dependencias extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_dependencias');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';

		$lista = $this->model_dependencias->listAll();
		$data['lista'] = $lista;
		$this->load->view('dependencias_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('dependencias_id', 'Código', 'required');
		$this->form_validation->set_rules('dependencias_titulo', 'Título', 'required');
		$this->form_validation->set_rules('dependencias_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['dependencias_titulo'] = $this->input->post('dependencias_titulo');
			$_data['dependencias_status'] = $this->input->post('dependencias_status');
			$dependencias_id = $this->model_dependencias->insert($_data);
			$this->session->set_flashdata('success','dependencias cadastrado com sucesso');
			redirect(base_url("dependencias"));
		}

		$data['arr_dependencias_status'] = array('1' => 'Ativo');
		$data['arr_defaults_dependencias_status'] = array();
		$data['dependencias'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('dependencias_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('dependencias_id', 'Código', 'required');
		$this->form_validation->set_rules('dependencias_titulo', 'Título', 'required');
		$this->form_validation->set_rules('dependencias_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['dependencias_id'] = $this->input->post('dependencias_id');
			$_data['dependencias_titulo'] = $this->input->post('dependencias_titulo');
			$_data['dependencias_status'] = $this->input->post('dependencias_status');
			$dependencias_id = $this->model_dependencias->update($_data);
			$this->session->set_flashdata('success','dependencias cadastrado com sucesso');
			redirect(base_url("dependencias"));
		}

		$data['arr_dependencias_status'] = array('1' => 'Ativo');
		$data['arr_defaults_dependencias_status'] = array();
		$data['dependencias'] = $this->model_dependencias->getdependencias($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('dependencias_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['dependencias_id'] = $id;
		if($this->model_dependencias->delete($data)){
			$this->session->set_flashdata('success','dependencias excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o dependencias.');
		}
		redirect(base_url('dependencias'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['dependencias_id'] = $id;
		if($this->model_dependencias->active($data)){
			$this->session->set_flashdata('success','dependencias ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o dependencias.');
		}
		redirect(base_url('dependencias'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['dependencias_id'] = $id;
		if($this->model_dependencias->deactive($data)){
			$this->session->set_flashdata('success','dependencias desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o dependencias.');
		}
		redirect(base_url('dependencias'));
	}


	function check_true(){
		return true;
	}

}


