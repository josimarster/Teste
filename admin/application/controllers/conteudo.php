<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class conteudo extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_conteudo');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_conteudo->listAll();
		$data['lista'] = $lista;

		$this->load->view('conteudo_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('conteudo_id', 'Código', 'required');
		$this->form_validation->set_rules('conteudo_titulo', 'Título', 'required');
		$this->form_validation->set_rules('conteudo_url', 'URL', 'required');
		$this->form_validation->set_rules('conteudo_texto', 'Texto', 'required');
		$this->form_validation->set_rules('conteudo_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['conteudo_titulo'] = $this->input->post('conteudo_titulo');
			$_data['conteudo_url'] = $this->input->post('conteudo_url');
			$_data['conteudo_texto'] = $this->input->post('conteudo_texto');
			$_data['conteudo_status'] = $this->input->post('conteudo_status');
			$conteudo_id = $this->model_conteudo->insert($_data);
			$this->session->set_flashdata('success','conteudo cadastrado com sucesso');
			redirect(base_url("conteudo"));
		}

		$data['arr_conteudo_status'] = array('1' => 'Ativo');
		$data['arr_defaults_conteudo_status'] = array();
		$data['conteudo'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('conteudo_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('conteudo_id', 'Código', 'required');
		$this->form_validation->set_rules('conteudo_titulo', 'Título', 'required');
		$this->form_validation->set_rules('conteudo_url', 'URL', 'required');
		$this->form_validation->set_rules('conteudo_texto', 'Texto', 'required');
		$this->form_validation->set_rules('conteudo_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['conteudo_id'] = $this->input->post('conteudo_id');
			$_data['conteudo_titulo'] = $this->input->post('conteudo_titulo');
			$_data['conteudo_url'] = $this->input->post('conteudo_url');
			$_data['conteudo_texto'] = $this->input->post('conteudo_texto');
			$_data['conteudo_status'] = $this->input->post('conteudo_status');
			$conteudo_id = $this->model_conteudo->update($_data);
			$this->session->set_flashdata('success','conteudo cadastrado com sucesso');
			redirect(base_url("conteudo"));
		}

		$data['arr_conteudo_status'] = array('1' => 'Ativo');
		$data['arr_defaults_conteudo_status'] = array();
		$data['conteudo'] = $this->model_conteudo->getconteudo($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('conteudo_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['conteudo_id'] = $id;
		if($this->model_conteudo->delete($data)){
			$this->session->set_flashdata('success','conteudo excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o conteudo.');
		}
		redirect(base_url('conteudo'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['conteudo_id'] = $id;
		if($this->model_conteudo->active($data)){
			$this->session->set_flashdata('success','conteudo ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o conteudo.');
		}
		redirect(base_url('conteudo'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['conteudo_id'] = $id;
		if($this->model_conteudo->deactive($data)){
			$this->session->set_flashdata('success','conteudo desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o conteudo.');
		}
		redirect(base_url('conteudo'));
	}

	function check_true(){
		return true;
	}

}


