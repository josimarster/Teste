<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class configuracoes extends CI_Controller {
	private $_version = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
		$this->model_auth->checkLogin();
		$this->load->model('model_configuracoes');
    }

	function index(){
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Listar';
		$lista = $this->model_configuracoes->listAll();
		$data['lista'] = $lista;
		$this->load->view('configuracoes_list', $data);
	}

	function add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('configuracoes_id', 'Código', 'required');
		$this->form_validation->set_rules('configuracoes_Título', 'Titulo do site', 'required');
		$this->form_validation->set_rules('configuracoes_Keywords', 'Keywords ', 'callback_check_true');
		$this->form_validation->set_rules('configuracoes_Metatags', 'Metatags ', 'callback_check_true');
		$this->form_validation->set_rules('configuracoes_Analytics', 'Google Analytics ', 'callback_check_true');
		$this->form_validation->set_rules('configuracoes_smtphost', 'SMTP Host', 'required');
		$this->form_validation->set_rules('configuracoes_smtpuser', 'SMTP User', 'required');
		$this->form_validation->set_rules('configuracoes_smtpsenha', 'SMTP Senha', 'required');
		$this->form_validation->set_rules('configuracoes_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['configuracoes_Título'] = $this->input->post('configuracoes_Título');
			$_data['configuracoes_Keywords'] = $this->input->post('configuracoes_Keywords');
			$_data['configuracoes_Metatags'] = $this->input->post('configuracoes_Metatags');
			$_data['configuracoes_Analytics'] = $this->input->post('configuracoes_Analytics');
			$_data['configuracoes_smtphost'] = $this->input->post('configuracoes_smtphost');
			$_data['configuracoes_smtpuser'] = $this->input->post('configuracoes_smtpuser');
			$_data['configuracoes_smtpsenha'] = $this->input->post('configuracoes_smtpsenha');
			$_data['configuracoes_status'] = $this->input->post('configuracoes_status');
			$configuracoes_id = $this->model_configuracoes->insert($_data);
			$this->session->set_flashdata('success','configuracoes cadastrado com sucesso');
			redirect(base_url("configuracoes"));
		}

		$data['arr_configuracoes_status'] = array('1' => 'Ativo');
		$data['arr_defaults_configuracoes_status'] = array();
		$data['configuracoes'] = new StdClass();
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Cadastrar';
		$this->load->view('configuracoes_form', $data);
	}


	function edit($field_id = 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('configuracoes_id', 'Código', 'required');
		$this->form_validation->set_rules('configuracoes_Título', 'Titulo do site', 'required');
		$this->form_validation->set_rules('configuracoes_Keywords', 'Keywords ', 'callback_check_true');
		$this->form_validation->set_rules('configuracoes_Metatags', 'Metatags ', 'callback_check_true');
		$this->form_validation->set_rules('configuracoes_Analytics', 'Google Analytics ', 'callback_check_true');
		$this->form_validation->set_rules('configuracoes_smtphost', 'SMTP Host', 'required');
		$this->form_validation->set_rules('configuracoes_smtpuser', 'SMTP User', 'required');
		$this->form_validation->set_rules('configuracoes_smtpsenha', 'SMTP Senha', 'required');
		$this->form_validation->set_rules('configuracoes_status', 'Status', 'callback_check_true');

		if ( !($this->form_validation->run() == FALSE)){
			$_data['configuracoes_id'] = $this->input->post('configuracoes_id');
			$_data['configuracoes_Título'] = $this->input->post('configuracoes_Título');
			$_data['configuracoes_Keywords'] = $this->input->post('configuracoes_Keywords');
			$_data['configuracoes_Metatags'] = $this->input->post('configuracoes_Metatags');
			$_data['configuracoes_Analytics'] = $this->input->post('configuracoes_Analytics');
			$_data['configuracoes_smtphost'] = $this->input->post('configuracoes_smtphost');
			$_data['configuracoes_smtpuser'] = $this->input->post('configuracoes_smtpuser');
			$_data['configuracoes_smtpsenha'] = $this->input->post('configuracoes_smtpsenha');
			$_data['configuracoes_status'] = $this->input->post('configuracoes_status');
			$configuracoes_id = $this->model_configuracoes->update($_data);
			$this->session->set_flashdata('success','configuracoes cadastrado com sucesso');
			redirect(base_url("configuracoes"));
		}

		$data['arr_configuracoes_status'] = array('1' => 'Ativo');
		$data['arr_defaults_configuracoes_status'] = array();
		$data['configuracoes'] = $this->model_configuracoes->getconfiguracoes($field_id);
		$data['page_head'] = 'Sistema administrativo Amilton Peres';
		$data['action'] = 'Editar';
		$this->load->view('configuracoes_form', $data);
	}

	function delete($id){
		$id = is_numeric($id)? $id : 0;
		$data['configuracoes_id'] = $id;
		if($this->model_configuracoes->delete($data)){
			$this->session->set_flashdata('success','configuracoes excluido com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível excluir o configuracoes.');
		}
		redirect(base_url('configuracoes'));
	}

	function active($id){
		$id = is_numeric($id)? $id : 0;
		$data['configuracoes_id'] = $id;
		if($this->model_configuracoes->active($data)){
			$this->session->set_flashdata('success','configuracoes ativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o configuracoes.');
		}
		redirect(base_url('configuracoes'));
	}

	function deactive($id){
		$id = is_numeric($id)? $id : 0;
		$data['configuracoes_id'] = $id;
		if($this->model_configuracoes->deactive($data)){
			$this->session->set_flashdata('success','configuracoes desativado com sucesso.');
		}else{
			$this->session->set_flashdata('error','Não foi possível desativar o configuracoes.');
		}
		redirect(base_url('configuracoes'));
	}

	function check_true(){
		return true;
	}

}


