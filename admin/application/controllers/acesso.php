<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acesso extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_acesso');
    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_acesso->listAll();
		$data['lista'] = $lista;
		$this->load->view('acesso_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('acesso_id', 'Código', 'required');
		$this->form_validation->set_rules('acesso_nome', 'Nome', 'required');
		$this->form_validation->set_rules('acesso_email', 'E-mail', 'required');
		$this->form_validation->set_rules('acesso_senha', 'Senha', 'required');
		$this->form_validation->set_rules('acesso_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['acesso_nome'] = $this->input->post('acesso_nome');
			$_data['acesso_email'] = $this->input->post('acesso_email');
			$_data['acesso_senha'] = $this->input->post('acesso_senha');
			$_data['acesso_status'] = $this->input->post('acesso_status');
			$acesso_id = $this->model_acesso->insert($_data);
			$this->session->set_flashdata('success','acesso cadastrado com sucesso');
			redirect(base_url("acesso"));
		}

		$data['arr_acesso_status'] = array('1' => 'Ativo');
		$data['arr_defaults_acesso_status'] = array();
		$data['acesso'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('acesso_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('acesso_id', 'Código', 'required');
		$this->form_validation->set_rules('acesso_nome', 'Nome', 'required');
		$this->form_validation->set_rules('acesso_email', 'E-mail', 'required');
		$this->form_validation->set_rules('acesso_senha', 'Senha', 'required');
		$this->form_validation->set_rules('acesso_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['acesso_id'] = $this->input->post('acesso_id');
			$_data['acesso_nome'] = $this->input->post('acesso_nome');
			$_data['acesso_email'] = $this->input->post('acesso_email');
			$_data['acesso_senha'] = $this->input->post('acesso_senha');
			$_data['acesso_status'] = $this->input->post('acesso_status');
			$acesso_id = $this->model_acesso->update($_data);
			$this->session->set_flashdata('success','acesso cadastrado com sucesso');
			redirect(base_url("acesso"));
		}
		
		$data['arr_acesso_status'] = array('1' => 'Ativo');
		$data['arr_defaults_acesso_status'] = array();
		$data['acesso'] = $this->model_acesso->getacesso($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('acesso_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['acesso_id'] = $id;
		if($this->model_acesso->delete($data)){
			$this->session->set_flashdata('success','acesso excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o acesso.');
		}
		redirect(base_url('acesso'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['acesso_id'] = $id;
		if($this->model_acesso->active($data)){
			$this->session->set_flashdata('success','acesso ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o acesso.');
		}
		redirect(base_url('acesso'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['acesso_id'] = $id;
		if($this->model_acesso->deactive($data)){
			$this->session->set_flashdata('success','acesso desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o acesso.');
		}
		redirect(base_url('acesso'));
	}

	function check_true(){
		return true;
	}

}


