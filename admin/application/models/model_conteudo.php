<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_conteudo extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    var $limit 	= -1;
    var $offset = -1;

	function listall($dtvs = false){
		if($dtvs){
			$this->db->where('conteudo_status',1);
		}
		
		if($this->limit > -1 && $this->offset > -1){
			$this->db->limit($this->limit, $this->offset);
		}
		
		$this->db->select('SQL_CALC_FOUND_ROWS *', false);
		
		
		return $this->db->get('tbl_conteudo')->result();
	}
	
	function addLimit($limit =-1, $offset=-1){
		if(is_numeric($limit) && $limit > 0 && is_numeric($offset) && $offset > 0){
			$this->limit	= $limit;
			$this->offset 	= $offset;
		}
	}	
	
	function addFilter($campo, $value){
		$this->db->or_like($campo, $value); 
	}

	function getConteudo($id){
		$objeto = new stdClass();
		$this->db->where('conteudo_id', $id);
		
		$query = $this->db->get('tbl_conteudo');
		if($query->num_rows() > 0){
			$objeto = $query->row();
		}
		return $objeto;
	}
	function insert($data){
		$this->db->insert('tbl_conteudo',$data);
		return $this->db->insert_id();
	}
	function update($data){
		$this->db->where('conteudo_id',$data['conteudo_id']);
		return $this->db->update('tbl_conteudo',$data);
	}
	function delete($data){
		$this->db->where('conteudo_id',$data['conteudo_id']);
		return $this->db->delete('tbl_conteudo',$data);
	}
	function active($data){
		$data['conteudo_status'] = 1;
		$this->db->where('conteudo_id',$data['conteudo_id']);
		return $this->db->update('tbl_conteudo',$data);
	}
	function deactive($data){
		$data['conteudo_status'] = 0;
		$this->db->where('conteudo_id',$data['conteudo_id']);
		return $this->db->update('tbl_conteudo',$data);
	}

}
