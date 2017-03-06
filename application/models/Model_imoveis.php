<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_imoveis extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    var $limit 	= -1;
    var $offset = -1;

	function listall($dtvs = false){
		if(!$dtvs){
			$this->db->where('imoveis_status',1);
		}
		
		if($this->limit > -1 && $this->offset > -1){
			$this->db->limit($this->limit, $this->offset);
		}
		
		$this->db->select('SQL_CALC_FOUND_ROWS *', false);
		return $this->db->get('tbl_imoveis')->result();
		
	}

	function addLimit($limit =-1, $offset=-1){
		if(is_numeric($limit) && $limit > -1 && is_numeric($offset) && $offset > -1){
			$this->limit	= $limit;
			$this->offset 	= $offset;
		}
	}	
	
	function addFilter($campo, $value){
		if(is_numeric($value)){
			$this->db->or_where($campo, $value);
		}else{
			$this->db->or_like($campo, $value);
		}
		
	}
	
	
	function listarVendas($destaque, $limit = 0){
		if(is_numeric($limit) && $limit > 0){
			$this->db->limit($limit);
		}
		$this->db->where('imoveis_categorias', 1);
		return $this->listall();
	}
	
	function listarLocacao($destaque, $limit = 0){
		if(is_numeric($limit) && $limit > 0){
			$this->db->limit($limit);
		}
		$this->db->where('imoveis_categorias', 2);
		return $this->listall();
	}
	
	function listarBusca($destaque, $categoria=0, $tipo=0, $cidade ='', $bairro='', $valor=0){
		

		$sql = " SELECT SQL_CALC_FOUND_ROWS im.*  FROM tbl_imoveis im ";
		
		if($cidade != ""  && $cidade != '0'){ 
			$sql .= " INNER JOIN tbl_imoveis_dadosimovel as cid ON (
				cid.imoveis_dadosimovel_imoveis = im.imoveis_id 
			    AND cid.imoveis_dadosimovel_dadosimovel = 2
			    AND cid.imoveis_dadosimovel_valor LIKE '%$cidade%' 
			)";
		}
		
		if($bairro != "" && $bairro != '0'){
			$sql .= " INNER JOIN tbl_imoveis_dadosimovel as bai ON ( 		 
			    bai.imoveis_dadosimovel_imoveis = im.imoveis_id 
				AND bai.imoveis_dadosimovel_dadosimovel = 3
			  	AND bai.imoveis_dadosimovel_valor LIKE '%$bairro%'
			 )";
		}
		
			if($valor != "" && is_numeric($valor) && $valor > 0){
				if($categoria == 1){
					$sql .= " INNER JOIN tbl_imoveis_valores vl  ON (
				    vl.imoveis_valores_imoveis = im.imoveis_id
				    AND vl.imoveis_valores_valores = 1
				    AND cast(vl.imoveis_valores_valor as unsigned) <= $valor
				    )";
				}else{
					$sql .= " INNER JOIN tbl_imoveis_valores vl  ON (
					vl.imoveis_valores_imoveis = im.imoveis_id
					AND vl.imoveis_valores_valores = 4
					AND cast(vl.imoveis_valores_valor as unsigned) <= $valor
					)";
				}
			}
		
		$sql .= " where 1=1 ";
		
		if(is_numeric($categoria) && $categoria > 0){
			$sql .= " and im.imoveis_categorias = '$categoria' ";
		}
		
		if(is_numeric($tipo) && $tipo > 0){
			$sql .= " and im.imoveis_tipo = '$tipo' ";
		}
		
		$sql .= " LIMIT ".$this->offset.",".$this->limit;

		
		return $this->db->query($sql)->result();
	}

	function getImovel($id){
		$objeto = new stdClass();
		$this->db->where('imoveis_id', $id);
		
		$query = $this->db->get('tbl_imoveis');
		if($query->num_rows() > 0){
			$objeto = $query->row();
		}
		return $objeto;
	}
	
	function getdados($id){
		$this->db->where('imoveis_dadosimovel_imoveis', $id);
		$this->db->join('tbl_dadosimovel','imoveis_dadosimovel_dadosimovel = dadosimovel_id' );
		return $this->db->get('tbl_imoveis_dadosimovel')->result();
	}
	
	function getvalor($id){
		$this->db->where('imoveis_valores_imoveis', $id);
		$this->db->join('tbl_valores','imoveis_valores_valores = valores_id' );
		return $this->db->get('tbl_imoveis_valores')->result();
	}
	
	function getDependencias($id){
		$this->db->where('imoveis_dependencias_imoveis', $id);
		$this->db->join('tbl_dependencias','imoveis_dependencias_dependencias = dependencias_id' );
		return $this->db->get('tbl_imoveis_dependencias')->result();
	}
	
	function getCaracteristicas($id){
		$this->db->where('imoveis_caracteristicas_imoveis', $id);
		$this->db->join('tbl_caracteristicas','imoveis_caracteristicas_caracteristicas = caracteristicas_id' );
		return $this->db->get('tbl_imoveis_caracteristicas')->result();
	}


	function getFotos($imoveis_id, $galeria_id){
		$this->db->where('foto_imoveis', $imoveis_id);
		$this->db->where('foto_galeria', $galeria_id);
		return $this->db->get('tbl_fotos')->result();
	}


	function listar_imoveis_dados($imoveis_id){
		$this->db->where('imoveis_dadosimovel_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_dadosimovel')->result();
	}
	
	
	function listar_imoveis_categorias($imoveis_id){
		$this->db->where('imoveis_categorias_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_categorias')->result();
	}
	
	
	function listar_imoveis_características($imoveis_id){
		$this->db->where('imoveis_caracteristicas_imoveis', $imoveis_id );
		return $this->db->get('tbl_imoveis_caracteristicas')->result();
	}
	
	function listarCidades(){
		$this->db->distinct();
		$this->db->select('imoveis_dadosimovel_valor');
		$this->db->where('imoveis_dadosimovel_dadosimovel', 2);
		$this->db->order_by('imoveis_dadosimovel_valor', 'ASC');
		$query = $this->db->get('tbl_imoveis_dadosimovel');
		return $query->result();
	}
	
	function listarBairros($valor = 3){
		$this->db->distinct();
		$this->db->select('imoveis_dadosimovel_valor');
		$this->db->where('imoveis_dadosimovel_dadosimovel', $valor);
		$this->db->order_by('imoveis_dadosimovel_valor', 'ASC');
		$query = $this->db->get('tbl_imoveis_dadosimovel');
		return $query->result();
	}


}
