<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contato extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_contato');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_contato->listAll();
		$data['lista'] = $lista;
		$this->load->view('contato_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contato_id', 'Código', 'required');
		$this->form_validation->set_rules('contato_telefones', 'Telefones', 'callback_check_true');
		$this->form_validation->set_rules('contato_endereco', 'Endereço', 'callback_check_true');
		$this->form_validation->set_rules('contato_emails', 'E-mails', 'callback_check_true');
		$this->form_validation->set_rules('contato_email', 'E-mail de Contato', 'callback_check_true');
		$this->form_validation->set_rules('contato_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['contato_telefones'] = $this->input->post('contato_telefones');
			$_data['contato_endereco'] = $this->input->post('contato_endereco');
			$_data['contato_emails'] = $this->input->post('contato_emails');
			$_data['contato_email'] = $this->input->post('contato_email');
			$_data['contato_status'] = $this->input->post('contato_status');
			$contato_id = $this->model_contato->insert($_data);
			$this->session->set_flashdata('success','contato cadastrado com sucesso');
			redirect(base_url("contato"));
		}

		$data['arr_contato_status'] = array('1' => 'Ativo');
		$data['arr_defaults_contato_status'] = array();
		$data['contato'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('contato_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contato_id', 'Código', 'required');
		$this->form_validation->set_rules('contato_telefones', 'Telefones', 'callback_check_true');
		$this->form_validation->set_rules('contato_endereco', 'Endereço', 'callback_check_true');
		$this->form_validation->set_rules('contato_emails', 'E-mails', 'callback_check_true');
		$this->form_validation->set_rules('contato_email', 'E-mail de Contato', 'callback_check_true');
		$this->form_validation->set_rules('contato_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['contato_id'] = $this->input->post('contato_id');
			$_data['contato_telefones'] = $this->input->post('contato_telefones');
			$_data['contato_endereco'] = $this->input->post('contato_endereco');
			$_data['contato_emails'] = $this->input->post('contato_emails');
			$_data['contato_email'] = $this->input->post('contato_email');
			$_data['contato_status'] = $this->input->post('contato_status');
			$contato_id = $this->model_contato->update($_data);
			$this->session->set_flashdata('success','contato cadastrado com sucesso');
			redirect(base_url("contato"));
		}

		$data['arr_contato_status'] = array('1' => 'Ativo');
		$data['arr_defaults_contato_status'] = array();
		$data['contato'] = $this->model_contato->getcontato($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('contato_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['contato_id'] = $id;
		if($this->model_contato->delete($data)){
			$this->session->set_flashdata('success','contato excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o contato.');
		}
		redirect(base_url('contato'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['contato_id'] = $id;
		if($this->model_contato->active($data)){
			$this->session->set_flashdata('success','contato ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o contato.');
		}
		redirect(base_url('contato'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['contato_id'] = $id;
		if($this->model_contato->deactive($data)){
			$this->session->set_flashdata('success','contato desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o contato.');
		}
		redirect(base_url('contato'));
	}

	function check_true(){
		return true;
	}

}


