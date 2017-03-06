<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categorias extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_categorias');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_categorias->listAll();
		$data['lista'] = $lista;
		$this->load->view('categorias_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categorias_id', 'Código', 'required');
		$this->form_validation->set_rules('categorias_titulo', 'Título', 'required');
		$this->form_validation->set_rules('categorias_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['categorias_titulo'] = $this->input->post('categorias_titulo');
			$_data['categorias_status'] = $this->input->post('categorias_status');
			$categorias_id = $this->model_categorias->insert($_data);
			$this->session->set_flashdata('success','categorias cadastrado com sucesso');
			redirect(base_url("categorias"));
		}
		
		$data['arr_categorias_status'] = array('1' => 'Ativo');
		$data['arr_defaults_categorias_status'] = array();
		$data['categorias'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('categorias_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categorias_id', 'Código', 'required');
		$this->form_validation->set_rules('categorias_titulo', 'Título', 'required');
		$this->form_validation->set_rules('categorias_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['categorias_id'] = $this->input->post('categorias_id');
			$_data['categorias_titulo'] = $this->input->post('categorias_titulo');
			$_data['categorias_status'] = $this->input->post('categorias_status');
			$categorias_id = $this->model_categorias->update($_data);
			$this->session->set_flashdata('success','categorias cadastrado com sucesso');
			redirect(base_url("categorias"));
		}

		$data['arr_categorias_status'] = array('1' => 'Ativo');
		$data['arr_defaults_categorias_status'] = array();
		$data['categorias'] = $this->model_categorias->getcategorias($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('categorias_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['categorias_id'] = $id;
		if($this->model_categorias->delete($data)){
			$this->session->set_flashdata('success','categorias excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o categorias.');
		}
		redirect(base_url('categorias'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['categorias_id'] = $id;
		if($this->model_categorias->active($data)){
			$this->session->set_flashdata('success','categorias ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o categorias.');
		}
		redirect(base_url('categorias'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['categorias_id'] = $id;
		if($this->model_categorias->deactive($data)){
			$this->session->set_flashdata('success','categorias desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o categorias.');
		}
		redirect(base_url('categorias'));
	}

	function check_true(){
		return true;
	}

}


