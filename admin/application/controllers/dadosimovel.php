<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dadosimovel extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_dadosimovel');
    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_dadosimovel->listAll();
		$data['lista'] = $lista;
		$this->load->view('dadosimovel_list', $data);
	}

	function add(){
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('dadosimovel_id', 'Código', 'required');
		$this->form_validation->set_rules('dadosimovel_titulo', 'Título', 'required');
		$this->form_validation->set_rules('dadosimovel_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['dadosimovel_titulo'] = $this->input->post('dadosimovel_titulo');
			$_data['dadosimovel_status'] = $this->input->post('dadosimovel_status');
			$dadosimovel_id = $this->model_dadosimovel->insert($_data);
			$this->session->set_flashdata('success','dadosimovel cadastrado com sucesso');
			redirect(base_url("dadosimovel"));
		}
		
		$data['arr_dadosimovel_status'] = array('1' => 'Ativo');
		$data['arr_defaults_dadosimovel_status'] = array();
		$data['dadosimovel'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('dadosimovel_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('dadosimovel_id', 'Código', 'required');
		$this->form_validation->set_rules('dadosimovel_titulo', 'Título', 'required');
		$this->form_validation->set_rules('dadosimovel_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['dadosimovel_id'] = $this->input->post('dadosimovel_id');
			$_data['dadosimovel_titulo'] = $this->input->post('dadosimovel_titulo');
			$_data['dadosimovel_status'] = $this->input->post('dadosimovel_status');
			$dadosimovel_id = $this->model_dadosimovel->update($_data);
			$this->session->set_flashdata('success','dadosimovel cadastrado com sucesso');
			redirect(base_url("dadosimovel"));
		}
		
		$data['arr_dadosimovel_status'] = array('1' => 'Ativo');
		$data['arr_defaults_dadosimovel_status'] = array();
		$data['dadosimovel'] = $this->model_dadosimovel->getdadosimovel($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('dadosimovel_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['dadosimovel_id'] = $id;
		if($this->model_dadosimovel->delete($data)){
			$this->session->set_flashdata('success','dadosimovel excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o dadosimovel.');
		}
		redirect(base_url('dadosimovel'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['dadosimovel_id'] = $id;
		if($this->model_dadosimovel->active($data)){
			$this->session->set_flashdata('success','dadosimovel ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o dadosimovel.');
		}
		redirect(base_url('dadosimovel'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['dadosimovel_id'] = $id;
		if($this->model_dadosimovel->deactive($data)){
			$this->session->set_flashdata('success','dadosimovel desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o dadosimovel.');
		}
		redirect(base_url('dadosimovel'));
	}


	function check_true(){
		return true;
	}

}


