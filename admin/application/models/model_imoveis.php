<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_imoveis extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    var $limit 	= -1;
    var $offset = -1;

	function listall($dtvs = false){
		if($dtvs){
			$this->db->where('imoveis_status',1);
		}
		
		if($this->limit > -1 && $this->offset > -1){
			$this->db->limit($this->limit, $this->offset);
		}
		
		$this->db->select('SQL_CALC_FOUND_ROWS *', false);
		
		
		return $this->db->get('tbl_imoveis')->result();
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

	function getImoveis($id){
		$objeto = new stdClass();
		$this->db->where('imoveis_id', $id);
		
		$query = $this->db->get('tbl_imoveis');
		if($query->num_rows() > 0){
			$objeto = $query->row();
		}
		return $objeto;
	}
	function insert($data){
		$this->db->insert('tbl_imoveis',$data);
		return $this->db->insert_id();
	}
	function update($data){
		$this->db->where('imoveis_id',$data['imoveis_id']);
		return $this->db->update('tbl_imoveis',$data);
	}
	function delete($data){
		$this->db->where('imoveis_id',$data['imoveis_id']);
		return $this->db->delete('tbl_imoveis',$data);
	}
	function active($data){
		$data['imoveis_status'] = 1;
		$this->db->where('imoveis_id',$data['imoveis_id']);
		return $this->db->update('tbl_imoveis',$data);
	}
	function deactive($data){
		$data['imoveis_status'] = 0;
		$this->db->where('imoveis_id',$data['imoveis_id']);
		return $this->db->update('tbl_imoveis',$data);
	}

	function removerimagem($data){
		$this->db->where('imoveis_id',$data['imoveis_id']);
		return $this->db->update('tbl_imoveis',$data);
	}

	function addfotos($data){
		return $this->db->insert('tbl_fotos',$data);
	}

	function getFotos($imoveis_id, $galeria_id){
		$this->db->where('foto_imoveis', $imoveis_id);
		$this->db->where('foto_galeria', $galeria_id);
		return $this->db->get('tbl_fotos')->result();
	}

	function updatefoto($data){
		$this->db->where('foto_id',$data['foto_id']);
		return $this->db->update('tbl_fotos', $data) > 0;
	}
	
	function removerfoto($foto_id, $imoveis_id){
		$this->db->where('foto_id', $foto_id);
		$this->db->where('foto_imoveis', $imoveis_id);
		return $this->db->delete('tbl_fotos');
	}

	
	function remove_imoveis_dados($imoveis_id){
		$this->db->where('imoveis_dadosimovel_imoveis', $imoveis_id );
		$this->db->delete('tbl_imoveis_dadosimovel');
	}

	function add_imoveis_dados($imoveis_id, $array){
		
		foreach($array as $key => $value){
			if( trim( $value ) != ""){
				$d['imoveis_dadosimovel_imoveis'] = $imoveis_id;
				$d['imoveis_dadosimovel_dadosimovel'] = $key;
				$d['imoveis_dadosimovel_valor'] = $value;
				$this->db->insert('tbl_imoveis_dadosimovel', $d);
			}
		}
		
	}
	
	function listar_imoveis_dados($imoveis_id){
		$this->db->where('imoveis_dadosimovel_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_dadosimovel')->result();
	}

	function listar_imoveis_categorias($imoveis_id){
		$this->db->where('imoveis_categorias_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_categorias')->result();
	}
	
	function remove_imoveis_dependencias($imoveis_id){
		$this->db->where('imoveis_dependencias_imoveis', $imoveis_id );
		$this->db->delete('tbl_imoveis_dependencias');
	}

	function add_imoveis_dependencias($imoveis_id, $array){
		foreach($array as $key => $value){
			if( trim( $value ) != ""){
				$d['imoveis_dependencias_imoveis'] = $imoveis_id;
				$d['imoveis_dependencias_dependencias'] = $key;
				$d['imoveis_dependencias_valor'] = $value;
				$this->db->insert('tbl_imoveis_dependencias', $d);
			}
		}
	}
	
	function listar_imoveis_dependencias($imoveis_id){
		$this->db->where('imoveis_dependencias_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_dependencias')->result();
	}
	
	function remove_imoveis_valores($imoveis_id){
		$this->db->where('imoveis_valores_imoveis', $imoveis_id );
		$this->db->delete('tbl_imoveis_valores');
	}
	
	function add_imoveis_valores($imoveis_id, $array){
		foreach($array as $key => $value){
			if( trim( $value ) != ""){
				$d['imoveis_valores_valores'] = $key;
				$d['imoveis_valores_imoveis'] = $imoveis_id;
				$d['imoveis_valores_valor'] = $value;
				$this->db->insert('tbl_imoveis_valores', $d);
			}
		}
	}

	function listar_imoveis_valores($imoveis_id){
		$this->db->where('imoveis_valores_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_valores')->result();
	}
	
	function remove_imoveis_caracteristicas($imoveis_id){
		$this->db->where('imoveis_caracteristicas_imoveis', $imoveis_id );
		$this->db->delete('tbl_imoveis_caracteristicas');
	}
	
	function add_imoveis_caracteristicas($imoveis_id, $array){
		foreach($array as $key => $value){
			if( trim( $value ) != ""){
				$d['imoveis_caracteristicas_imoveis'] = $imoveis_id;
				$d['imoveis_caracteristicas_caracteristicas'] = $key;
				$d['imoveis_caracteristicas_valor'] = $value;
				$this->db->insert('tbl_imoveis_caracteristicas', $d);
			}
		}
	}
	
	function listar_imoveis_caracteristicas($imoveis_id){
		$this->db->where('imoveis_caracteristicas_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_caracteristicas')->result();
	}

}
