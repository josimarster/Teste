<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class emails extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_emails');

    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';

		$lista = $this->model_emails->listAll();
		$data['lista'] = $lista;
		$this->load->view('emails_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emails_id', 'Código', 'required');
		$this->form_validation->set_rules('emails_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['emails_status'] = $this->input->post('emails_status');
			$emails_id = $this->model_emails->insert($_data);
			$this->session->set_flashdata('success','emails cadastrado com sucesso');
			redirect(base_url("emails"));
		}
		
		$data['arr_emails_status'] = array('1' => 'Ativo');
		$data['arr_defaults_emails_status'] = array();
		$data['emails'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('emails_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emails_id', 'Código', 'required');
		$this->form_validation->set_rules('emails_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['emails_id'] = $this->input->post('emails_id');
			$_data['emails_status'] = $this->input->post('emails_status');
			$emails_id = $this->model_emails->update($_data);
			$this->session->set_flashdata('success','emails cadastrado com sucesso');
			redirect(base_url("emails"));
		}

		$data['arr_emails_status'] = array('1' => 'Ativo');
		$data['arr_defaults_emails_status'] = array();
		$data['emails'] = $this->model_emails->getemails($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('emails_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['emails_id'] = $id;
		if($this->model_emails->delete($data)){
			$this->session->set_flashdata('success','emails excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o emails.');
		}
		redirect(base_url('emails'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['emails_id'] = $id;
		if($this->model_emails->active($data)){
			$this->session->set_flashdata('success','emails ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o emails.');
		}
		redirect(base_url('emails'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['emails_id'] = $id;
		if($this->model_emails->deactive($data)){
			$this->session->set_flashdata('success','emails desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o emails.');
		}
		redirect(base_url('emails'));
	}

	function check_true(){
		return true;
	}

}


