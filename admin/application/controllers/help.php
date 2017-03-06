<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {
	private $_version = '';
	private $_moduleName = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->_version = $this->config->item('admin_version');
        $this->_moduleName = 'Sobre';
    }
    
    function index(){
    	$data['moduleName'] =  $this->_moduleName;
    	$this->load->view('about', $data);
    }

    function about(){
    	$data['moduleName'] =  $this->_moduleName;
    	$this->load->view('about', $data);
    }
    

}