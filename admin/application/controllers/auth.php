<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	private $_version = '';
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
    }
    
    function login(){
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('login_email', 'Email', 'required');
		$this->form_validation->set_rules('login_senha', 'Senha', 'required');
		$this->form_validation->set_message('required', 'O campo %s é obrigatório');
		
		if($_POST){ 
	    	if ($this->form_validation->run() == FALSE) { 
				$this->session->set_flashdata('msg',validation_errors());
    			redirect(base_url('auth/login'));
			}
			else {
				$email = $this->input->post('login_email');
				$senha = $this->input->post('login_senha');
				$this->model_auth->login($email, $senha);
			}
		}

    	$data['title'] = $this->_version;
		$this->load->view('login',$data);
    }
    
    function logout(){ 
		$this->model_auth->logout();
    	redirect(base_url());
    }
    
    function recuperar_senha(){
    	 $data['title'] = $this->_version;
		$this->load->view('recuperar_senha',$data);
    }
	
}