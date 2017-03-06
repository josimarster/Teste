<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_auth extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function checkLogin(){
    	if(  !$this->session->userdata('logado') ){
    		redirect(base_url('auth/login'));
    	}    	
    }        function isLogged(){    	return $this->session->userdata('logado');    }
    
    function login($email, $senha){
    	$this->db->select();
    	$this->db->from('tbl_acesso');
    	$this->db->where('acesso_email',$email);
    	$rs = $this->db->get();
    	
    	$msg = array();
    	
    	if( $rs->num_rows() == 0){
    		$msg ='<p>Login ou senha inválidos</p>';
    	}else{
    		$acesso = $rs->row();
    		if($acesso->acesso_senha == md5(trim($senha))){ 
    			$this->session->set_userdata('logado',true);
    			$this->session->set_userdata('acesso_id',$acesso->acesso_id);
				$this->session->set_userdata('acesso_nome',$acesso->acesso_nome);
    			redirect(base_url());
    		}else{
	    		$msg ='<p>Login ou senha inválidos</p>';
    		}
    	}
    	
    	$this->session->set_flashdata('msg',$msg);
    	redirect(base_url('auth/login'));
    }
    
    function logout(){
    	$this->session->unset_userdata('logado');
    	$this->session->unset_userdata('acesso_id');
        $this->session->unset_userdata('acesso_nome');
    	$this->session->sess_destroy();
    }
    
}