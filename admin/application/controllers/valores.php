<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class valores extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_valores');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';

		$lista = $this->model_valores->listAll();
		$data['lista'] = $lista;
		$this->load->view('valores_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('valores_id', 'Código', 'required');
		$this->form_validation->set_rules('valores_status', 'Status', 'callback_check_true');
		$this->form_validation->set_rules('valores_titulo', 'Título', 'required');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['valores_status'] = $this->input->post('valores_status');
			$_data['valores_titulo'] = $this->input->post('valores_titulo');
			$valores_id = $this->model_valores->insert($_data);
			$this->session->set_flashdata('success','valores cadastrado com sucesso');
			redirect(base_url("valores"));
		}

		$data['arr_valores_status'] = array('1' => 'Ativo');
		$data['arr_defaults_valores_status'] = array();
		$data['valores'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('valores_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('valores_id', 'Código', 'required');
		$this->form_validation->set_rules('valores_status', 'Status', 'callback_check_true');
		$this->form_validation->set_rules('valores_titulo', 'Título', 'required');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['valores_id'] = $this->input->post('valores_id');
			$_data['valores_status'] = $this->input->post('valores_status');
			$_data['valores_titulo'] = $this->input->post('valores_titulo');
			$valores_id = $this->model_valores->update($_data);
			$this->session->set_flashdata('success','valores cadastrado com sucesso');
			redirect(base_url("valores"));
		}

		$data['arr_valores_status'] = array('1' => 'Ativo');
		$data['arr_defaults_valores_status'] = array();
		$data['valores'] = $this->model_valores->getvalores($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('valores_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['valores_id'] = $id;
		if($this->model_valores->delete($data)){
			$this->session->set_flashdata('success','valores excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o valores.');
		}
		redirect(base_url('valores'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['valores_id'] = $id;
		if($this->model_valores->active($data)){
			$this->session->set_flashdata('success','valores ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o valores.');
		}
		redirect(base_url('valores'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['valores_id'] = $id;
		if($this->model_valores->deactive($data)){
			$this->session->set_flashdata('success','valores desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o valores.');
		}
		redirect(base_url('valores'));
	}

	function check_true(){
		return true;
	}

}


