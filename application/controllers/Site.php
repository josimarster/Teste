<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
	
	var $tipos;
	var $categorias;
	var $cidades;
	var $bairros;
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('model_imoveis');
		$this->load->model('model_tipos');
		$this->load->model('model_categorias');
		
		//tipo do imóvel
		$tipos			= $this->model_tipos->listAll();
		$_tipo 				= array();
		$_tipo[0] = 'Selecione';
		foreach($tipos as $c){
			$_tipo[$c->tipos_id] = $c->tipos_titulo;
		}
		$this->tipos = $_tipo;
		
		//categorias
		$categorias			= $this->model_categorias->listAll();
		$_categoria 		= array();
		$_categoria[0] 		= 'Selecione';
		foreach($categorias as $c){
			$_categoria[$c->categorias_id] = $c->categorias_titulo;
		}
		$this->categorias = $_categoria;
		
		//cidades
		$cidades			= $this->model_imoveis->listarCidades();
		$_cidade 			= array();
		$_cidade[0] 		= 'Selecione';
		foreach($cidades as $c){
			$_cidade[$c->imoveis_dadosimovel_valor] = $c->imoveis_dadosimovel_valor;
		}
		$this->cidades = $_cidade;
		
		//bairros
		$bairros			= $this->model_imoveis->listarBairros();
		$_bairro 			= array();
		$_bairro[0] 		= 'Selecione';
		foreach($bairros as $c){
			$_bairro[$c->imoveis_dadosimovel_valor] = $c->imoveis_dadosimovel_valor;
		}
		$this->bairros = $_bairro;

		//precos
		//$precos			= $this->model_imoveis->listarPrecos();
		$_precos 				= array(
			'0'		=> 'Selecione',
			'1000' => 1000,
			'2000' => 2000,
			'3000' =>  3000,
			'5000' =>  5000,
			'10000' =>  10000,
			'50000' =>  50000,
			'100000' =>  100000,
			'200000' =>  200000,
			'300000' =>  300000,
			'500000' =>  500000,
			'1000000' =>  1000000,
			'2000000' =>  2000000,
			'3000000' =>  3000000,
			'5000000' =>  5000000,
			'10000000' =>  10000000,
			'100000000' =>  100000000,

		);
		foreach($_precos as $k => $v){
			if( is_numeric($v)){
				$_precos[$k] = 'Até '.number_format($v, 2, ',','.');
			}else{
				$_precos[$k] = $v;
			}
		}
		
		$this->precos = $_precos;
	
	}




	public function index(){
		$this->load->model('model_banners');
		
		$this->model_banners->addFilter('banners_local', 0);
		$banners = $this->model_banners->listall(true);
		
		$lista_venda = $this->model_imoveis->listarVendas(1, 4);
		foreach($lista_venda as $k => $v){
			$dados = $this->model_imoveis->getdados($v->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
			
			$valores = $this->model_imoveis->getvalor($v->imoveis_id);
			$arrValores = array();
			foreach($valores as $kd => $d){
				$arrValores[$d->valores_id] = $d;
			}
			
			$dependencias = $this->model_imoveis->getDependencias($v->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
			
			$fotos = $this->model_imoveis->getFotos($v->imoveis_id, 313);
			
			$lista_venda[$k]->imovel_dados = $arrDados;
			$lista_venda[$k]->imovel_dependencias = $dependencias;
			$lista_venda[$k]->imovel_valores = $arrValores;
			$lista_venda[$k]->imovel_fotos = $fotos;
		}
		
		$lista_locacao = $this->model_imoveis->listarLocacao(1, 4);
		foreach($lista_locacao as $k => $v){
			$dados = $this->model_imoveis->getdados($v->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
				
			$valores = $this->model_imoveis->getvalor($v->imoveis_id);
			$arrValores = array();
			foreach($valores as $kd => $d){
				$arrValores[$d->valores_id] = $d;
			}
				
			$dependencias = $this->model_imoveis->getDependencias($v->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
				
			$fotos = $this->model_imoveis->getFotos($v->imoveis_id, 313);
				
			$lista_locacao[$k]->imovel_dados = $arrDados;
			$lista_locacao[$k]->imovel_dependencias = $dependencias;
			$lista_locacao[$k]->imovel_valores = $arrValores;
			$lista_locacao[$k]->imovel_fotos = $fotos;
		}
		
		
		$titulo_venda = 'Ofertas especiais para vendas';
		$titulo_locacao = 'Ofertas especiais para locação';
		
		if( count($lista_venda) == 0){
			$titulo_venda = "A busca não encontrou nenhum resultado para venda";
		}
		
		if( count($lista_locacao) == 0){
			$titulo_locacao = "A busca não encontrou nenhum resultado para locação";
		}
		
		
		$data['titulo_venda'] = $titulo_venda;
		$data['titulo_locacao'] = $titulo_locacao;
		
		$data['lista_venda'] = $lista_venda;
		$data['lista_locacao'] = $lista_locacao;
		
		//form de busca
		$data['tipos'] = $this->tipos;
		$data['busca_tipo'] = 0;
		$data['categorias'] = $this->categorias;
		$data['busca_categoria'] = 0;
		$data['cidades'] = $this->cidades;
		$data['busca_cidade'] = '0';
		$data['bairros'] = $this->bairros;
		$data['busca_bairro'] = '0';
		$data['precos'] = $this->precos;
		$data['busca_precos'] 	= 0;
		
		$data['banners'] = $banners;
		//fim do form de busca
		
		$this->load->view('home', $data);
	}
	

	
	public function vendas(){
		$segment 	= $this->uri->total_segments();
		$limit 		= 8;
		$offset 	= $this->uri->segment($segment);
		$offset 	= is_numeric($offset)? $offset : 0;
					  $this->model_imoveis->addLimit($limit, $offset); 
					  $this->model_imoveis->addFilter('imoveis_categorias',1);
		$lista 		= $this->model_imoveis->listAll();
		$qtotal 	= $this->db->query('SELECT FOUND_ROWS() as total;')->row();
		$total 		= $qtotal->total;
			
		foreach($lista as $k => $v){
			$dados = $this->model_imoveis->getdados($v->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
			
			$valores = $this->model_imoveis->getvalor($v->imoveis_id);
			$arrValores = array();
			foreach($valores as $kd => $d){
				$arrValores[$d->valores_id] = $d;
			}
			
			$dependencias = $this->model_imoveis->getDependencias($v->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
			
			$lista[$k]->imovel_dados = $arrDados;
			$lista[$k]->imovel_dependencias = $dependencias;
			$lista[$k]->imovel_valores = $arrValores;
		}
		$titulo = 'Ofertas especiais para vendas';
		
		if( count($lista) == 0){
			$titulo = "A busca não encontrou nenhum resultado para venda";
		}
		

		//form de busca
		$data['tipos'] 				= $this->tipos;
		$data['busca_tipo'] 		= 0;
		$data['categorias'] 		= $this->categorias;
		$data['busca_categoria'] 	= 0;
		$data['cidades'] 			= $this->cidades;
		$data['busca_cidade'] 		= 0;
		$data['bairros'] 			= $this->bairros;
		$data['busca_bairro'] 		= 0;
		$data['precos'] 			= $this->precos;
		$data['busca_precos'] 		= 0;
		//fim do form de busca
		
		
		//PAGINAÇÃO
		$data['total'] 	= $total;
		$data['start'] 	= $offset+1;
		$data['end'] 	= $total > $limit? (($offset+$limit) < $total? $offset+$limit : $total) : $limit;
		$q 				= isset($q)? $q : "";
		
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('vendas/'.$q."/");
		$config['total_rows'] 		= $total ;
		$config['per_page'] 		= $limit;
		$config['uri_segment'] 		= $segment;
		$config['full_tag_open'] 	= '<ul>';
		$config['full_tag_close']	= '</ul>';
		$config['cur_tag_open'] 	= '<li><a href="#" class="ativo_pagina" style="font-size:14px">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['last_link'] 		= 'Último »';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['first_link']		= '« Primeiro';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&raquo;';
		$config['next_tag_open'] 	= '<li  class="voltar">';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_link'] 		= '&laquo;';
		$config['prev_tag_open'] 	= '<li  class="avancar">';
		$config['prev_tag_close'] 	= '</li>';
		$this->pagination->initialize($config);
		//FIM PAGINACAO
		
		$data['titulo_pagina'] = $titulo;
		$data['lista'] = $lista;
		$this->load->view('vendas', $data);
	}
	
	public function locacao(){
		$segment 	= $this->uri->total_segments();
		$limit 		= 8;
		$offset 	= $this->uri->segment($segment);
		$offset 	= is_numeric($offset)? $offset : 0;
					  $this->model_imoveis->addLimit($limit, $offset);
					  $this->model_imoveis->addFilter('imoveis_categorias',2);
		$lista 		= $this->model_imoveis->listAll();
		$qtotal 	= $this->db->query('SELECT FOUND_ROWS() as total;')->row();
		$total 		= $qtotal->total;
		
		
		foreach($lista as $k => $v){
			$dados = $this->model_imoveis->getdados($v->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
				
			$valores = $this->model_imoveis->getvalor($v->imoveis_id);
			$arrValores = array();
			foreach($valores as $kd => $d){
				$arrValores[$d->valores_id] = $d;
			}
				
			$dependencias = $this->model_imoveis->getDependencias($v->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
				
			$lista[$k]->imovel_dados = $arrDados;
			$lista[$k]->imovel_dependencias = $dependencias;
			$lista[$k]->imovel_valores = $arrValores;
		}
		$titulo = 'Ofertas especiais para locação';
		
		if( count($lista) == 0){
			$titulo = "A busca não encontrou nenhum resultado para locação";
		}
		

		//form de busca
		$data['tipos'] = $this->tipos;
		$data['busca_tipo'] = 0;
		$data['categorias'] = $this->categorias;
		$data['busca_categoria'] = 0;
		$data['cidades'] = $this->cidades;
		$data['busca_cidade'] = 0;
		$data['bairros'] = $this->bairros;
		$data['busca_bairro'] = 0;
		$data['precos'] = $this->precos;
		$data['busca_precos'] 	= 0;
		//fim do form de busca
		
		//PAGINAÇÃO
		$data['total'] 	= $total;
		$data['start'] 	= $offset+1;
		$data['end'] 	= $total > $limit? (($offset+$limit) < $total? $offset+$limit : $total) : $limit;
		$q 				= isset($q)? $q : "";
		
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('locacao/'.$q."/");
		$config['total_rows'] 		= $total ;
		$config['per_page'] 		= $limit;
		$config['uri_segment'] 		= $segment;
		$config['full_tag_open'] 	= '<ul>';
		$config['full_tag_close']	= '</ul>';
		$config['cur_tag_open'] 	= '<li><a href="#" class="ativo_pagina" style="font-size:14px">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['last_link'] 		= 'Último »';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['first_link']		= '« Primeiro';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&raquo;';
		$config['next_tag_open'] 	= '<li  class="voltar">';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_link'] 		= '&laquo;';
		$config['prev_tag_open'] 	= '<li  class="avancar">';
		$config['prev_tag_close'] 	= '</li>';
		$this->pagination->initialize($config);
		//FIM PAGINACAO
		
		$data['titulo_pagina'] = $titulo;
		$data['lista'] = $lista;
		$this->load->view('vendas', $data);
	}
	
	public function contato($id=0){
		if($_POST){
			$this->load->library('email');
						
			$msg['nome'] 		   = $this->input->post('nomeremetente');
			$msg['email'] 		   = $this->input->post('emailremetente');
			$msg['telefone']	   = $this->input->post('telefone');
			$msg['assunto'] 	   = $this->input->post('assunto');
			$msg['mensagem']	   = $this->input->post('mensagem');
			$mensagem 			   = $this->load->view('email_contato',$msg, true);
			$config['protocol']    = 'smtp';
			$config['smtp_host']   = '';
			$config['smtp_user']   = '';
			$config['smtp_port']   = '';
			$config['smtp_pass']   = '';
			$config['charset']     = 'utf-8';
			$config['newline']     = "\n";
			$config['mailtype']    = 'html'; // or html
			$config['validation']  = TRUE; // bool whether to validate email or not
			
			$this->email->initialize($config);
			
			$this->email->from('josimar@josimar.net', $msg['nome']);
			$this->email->to('josimar@josimar.net');
			
			$this->email->subject('Contato através do site - Imobiliária Demo');
			$this->email->message($mensagem);
			
			if( $this->email->send() ){
				print 'ok';
			}else{
				print 'nok';
			}
			
			exit;
			
		}
		

		//form de busca
		$data['tipos'] = $this->tipos;
		$data['busca_tipo'] = 0;
		$data['categorias'] = $this->categorias;
		$data['busca_categoria'] = 0;
		$data['cidades'] = $this->cidades;
		$data['busca_cidade'] = 0;
		$data['bairros'] = $this->bairros;
		$data['busca_bairro'] = 0;
		$data['precos'] = $this->precos;
		$data['busca_precos'] 	= 0;
		//fim do form de busca
		
		$data['msg'] = 'Mensagem enviada com sucesso!';
		$this->load->view('contato', $data);
	}
	
	public function imprimir($codigo=0){
		if(!is_numeric($codigo)){
			redirect( base_url() );
		}
		$imovel = $this->model_imoveis->getImovel($codigo);
		
		if($imovel){
			$dados = $this->model_imoveis->getdados($imovel->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
			$mpty = new stdClass();
			$mpty->imoveis_dadosimovel_valor = '';
			
			$arrDados[1] = array_key_exists(1, $arrDados)? $arrDados[1] : $mpty;
			$arrDados[2] = array_key_exists(2, $arrDados)? $arrDados[2] : $mpty;
			$arrDados[3] = array_key_exists(3, $arrDados)? $arrDados[3] : $mpty;
			$arrDados[4] = array_key_exists(4, $arrDados)? $arrDados[4] : $mpty;
			$arrDados[7] = array_key_exists(7, $arrDados)? $arrDados[7] : $mpty;
			
			
			$imovelalores = $this->model_imoveis->getvalor($imovel->imoveis_id);
			$arrValores = array();
			foreach($imovelalores as $kd => $d){
				if(is_numeric($d->imoveis_valores_valor)){
					$arrValores[$d->valores_id] = $d;
				}
			}
			
			$dependencias = $this->model_imoveis->getDependencias($imovel->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
			
			$caracteristicas = $this->model_imoveis->getCaracteristicas($imovel->imoveis_id);
			$arrCaracteristicas = array();
			foreach($caracteristicas as $kd => $d){
				$arrCaracteristicas[$d->caracteristicas_id] = $d;
			}
			
			$fotos = $this->model_imoveis->getFotos($imovel->imoveis_id, 313);
			$fotos = is_array($fotos)? $fotos : array(0);
			
			$imovel->imovel_dados = $arrDados;
			$imovel->imovel_dependencias = $dependencias;
			$imovel->imovel_valores = $arrValores;
			$imovel->imovel_caracteristicas = $arrCaracteristicas;
			$imovel->imovel_fotos = $fotos;
		}
		
		$data['imovel'] = $imovel;
		$data['teste'] = '';
		$this->load->view('imprimir', $data);
	}
	
	public function detalhes($codigo, $titulo=''){
		if(!is_numeric($codigo)){
			redirect( base_url() );
		}
		$imovel = $this->model_imoveis->getImovel($codigo);
		
		if($imovel){
			$dados = $this->model_imoveis->getdados($imovel->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
			$mpty = new stdClass();
			$mpty->imoveis_dadosimovel_valor = '';
			
			$arrDados[1] = array_key_exists(1, $arrDados)? $arrDados[1] : $mpty;
			$arrDados[2] = array_key_exists(2, $arrDados)? $arrDados[2] : $mpty;
			$arrDados[3] = array_key_exists(3, $arrDados)? $arrDados[3] : $mpty;
			$arrDados[4] = array_key_exists(4, $arrDados)? $arrDados[4] : $mpty;
			$arrDados[7] = array_key_exists(7, $arrDados)? $arrDados[7] : $mpty;
			
			
			$imovelalores = $this->model_imoveis->getvalor($imovel->imoveis_id);
			$arrValores = array();
			foreach($imovelalores as $kd => $d){
				if(is_numeric($d->imoveis_valores_valor)){
					$arrValores[$d->valores_id] = $d;
				}
			}
			
			$dependencias = $this->model_imoveis->getDependencias($imovel->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
			
			$caracteristicas = $this->model_imoveis->getCaracteristicas($imovel->imoveis_id);
			$arrCaracteristicas = array();
			foreach($caracteristicas as $kd => $d){
				$arrCaracteristicas[$d->caracteristicas_id] = $d;
			}
			
			$fotos = $this->model_imoveis->getFotos($imovel->imoveis_id, 313);
			$fotos = is_array($fotos)? $fotos : array(0);
			
			$imovel->imovel_dados = $arrDados;
			$imovel->imovel_dependencias = $dependencias;
			$imovel->imovel_valores = $arrValores;
			$imovel->imovel_caracteristicas = $arrCaracteristicas;
			$imovel->imovel_fotos = $fotos;
		}
		
		$tipo = $imovel->imoveis_tipo;
		$categoria = $imovel->imoveis_categorias;
		
		//imóveis relacionados, mesmo tipo
		$this->model_imoveis->addFilter('imoveis_tipo', $tipo);
		if($categoria == 1){
			$lista_relacionado = $this->model_imoveis->listarVendas(1, 4);
		}else{
			$lista_relacionado = $this->model_imoveis->listarLocacao(1, 4);
		}
		
		foreach($lista_relacionado as $k => $v){
			$dados = $this->model_imoveis->getdados($v->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
				
			$valores = $this->model_imoveis->getvalor($v->imoveis_id);
			$arrValores = array();
			foreach($valores as $kd => $d){
				$arrValores[$d->valores_id] = $d;
			}
				
			$dependencias = $this->model_imoveis->getDependencias($v->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
				
			$fotos = $this->model_imoveis->getFotos($v->imoveis_id, 313);
				
			$lista_relacionado[$k]->imovel_dados = $arrDados;
			$lista_relacionado[$k]->imovel_dependencias = $dependencias;
			$lista_relacionado[$k]->imovel_valores = $arrValores;
			$lista_relacionado[$k]->imovel_fotos = $fotos;
		}
		//fim dos imoveis relacionados

		
		$titulo = 'Ofertas especiais para locação';
		
		//form de busca
		$data['tipos'] = $this->tipos;
		$data['busca_tipo'] = 0;
		$data['categorias'] = $this->categorias;
		$data['busca_categoria'] = 0;
		$data['cidades'] = $this->cidades;
		$data['busca_cidade'] = 0;
		$data['bairros'] = $this->bairros;
		$data['busca_bairro'] = 0;
		$data['precos'] = $this->precos;
		$data['busca_precos'] 	= 0;
		//fim do form de busca
		
		
		$data['titulo_pagina'] = $titulo;
		$data['imovel'] = $imovel;
		$data['relacionados'] = $lista_relacionado;
		
		$this->load->view('detalhes', $data);
	}
	
	public function ajax_contato(){
		echo "ok";
	}
	
	public function avalie(){
		
		//form de busca
		$data['tipos'] 				= $this->tipos;
		$data['busca_tipo'] 		= 0;
		$data['categorias'] 		= $this->categorias;
		$data['busca_categoria'] 	= 0;
		$data['cidades'] 			= $this->cidades;
		$data['busca_cidade']		= 0;
		$data['bairros'] 			= $this->bairros;
		$data['busca_bairro'] 		= 0;
		$data['precos'] 			= $this->precos;
		$data['busca_precos'] 		= 0;
		//fim do form de busca
		
		if($_POST){

			$this->load->library('email');
			
			$msg['imovelpara']			= $this->input->post('imovelpara');
			$msg['tipo'] 				= $this->input->post('tipoimovel');
			$msg['nome'] 				= $this->input->post('nome');
			$msg['email'] 				= $this->input->post('email');
			$msg['telefone']			= $this->input->post('telefone');
			$msg['endereco'] 			= $this->input->post('endereco');
			$msg['cidade']				= $this->input->post('cidade');
			$msg['bairro']				= $this->input->post('bairro');
			$msg['dormitorios']			= $this->input->post('dormitorios');
			$msg['garagem']				= $this->input->post('garagem');
			$msg['area']				= $this->input->post('area');
			$msg['andar']				= $this->input->post('andar');
			$msg['caracteristicas']		= $this->input->post('caracteristicas');
					
			$dt['infos'] = $msg;
			$mensagem = $this->load->view('email_avaliacao',$dt, true);
				
			$config['protocol']    = 'smtp';
			$config['smtp_host']   = '';
			$config['smtp_user']   = '';
			$config['smtp_port']   = '';
			$config['smtp_pass']   = '';
			$config['charset']     = 'utf-8';
			$config['newline']     = "\n";
			$config['mailtype']    = 'html'; 
			$config['validation']  = TRUE; 
				
			$this->email->initialize($config);
			$this->email->from('josimar@josimar.net', $msg['nome']);
			$this->email->to('josimar@josimar.net');
			$this->email->subject('Avaliação de imóvel - Imobiliária Demo');
			$this->email->message($mensagem);
				
			if( $this->email->send() ){
				print 'ok';
			}else{
				print 'nok';
			}
			exit;
			
		}
		
		$this->load->view('avalie', $data);
	}
	
	public function recomendar($codigo =0){
		if(!is_numeric($codigo)){
			redirect( base_url() );
		}
		
		$imovel = $this->model_imoveis->getImovel($codigo);
		if($_POST){
			$this->load->library('email');
						
			$msg['nome'] 		= $this->input->post('nome');
			$msg['email'] 		= $this->input->post('email');
			$msg['nomeamigo']	= $this->input->post('nomeamigo');
			$msg['emailamigo'] 	= $this->input->post('emailamigo');
			$msg['mensagem']	= $this->input->post('mensagem');
			$msg['copia']		= $this->input->post('copia');
			$msg['imovel'] 		= $imovel;
			
			$dependencias = $this->model_imoveis->getDependencias($imovel->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
			$imovel->dependencias = $arrDependencias;
			
			$mensagem = $this->load->view('email_recomendacao',$msg, true);
			
			$config['protocol']    = 'smtp';
			$config['smtp_host']   = '';
			$config['smtp_user']   = '';
			$config['smtp_port']   = '';
			$config['smtp_pass']   = '';
			$config['charset']     = 'utf-8';
			$config['newline']     = "\n";
			$config['mailtype']    = 'html'; 
			$config['validation']  = TRUE; 
			
			$this->email->initialize($config);
			
			$this->email->from('josimar@josimar.net', $msg['nome']);
			$this->email->to($msg['emailamigo']);
			if( $msg['copia'] ==1){
				$this->email->cc($msg['email']);
			}
			
			$this->email->subject('Recomendação de Imóvel - Imobiliária Demo');
			$this->email->message($mensagem);
			
			if( $this->email->send() ){
				print 'ok';
			}else{
				print 'nok';
			}
			exit;
		}
		$data['imovel'] = $imovel;
		$this->load->view('recomendar', $data);
	}
	
	
	
	function conteudo($url){
		
		if($this->uri->total_segments() < 1){
			redirect(base_url());
		}
		
		$this->load->model('model_conteudo');
		$conteudo = $this->model_conteudo->getConteudoByUrl($url);
		$data['conteudo'] = $conteudo;
		

		//form de busca
		$data['tipos'] = $this->tipos;
		$data['busca_tipo'] = 0;
		$data['categorias'] = $this->categorias;
		$data['busca_categoria'] = 0;
		$data['cidades'] = $this->cidades;
		$data['busca_cidade'] = 0;
		$data['bairros'] = $this->bairros;
		$data['busca_bairro'] = 0;
		$data['precos'] = $this->precos;
		$data['busca_precos'] 	= 0;
		//fim do form de busca
		
		$this->load->view('conteudo', $data);
	}
	
	function search(){
		$values = $this->input->post();
		foreach($values as $key=>$value){
			$values[$key] = urlencode($value);
		}
		$uri = implode('/', $values);
		redirect(base_url('busca/'.$uri));
	}
	
	function busca(){
		
		$busca_categoria 	= $this->uri->segment(2);
		$busca_tipo 		= $this->uri->segment(3);
		$busca_cidade 		= urldecode($this->uri->segment(4));
		$busca_bairro  		= urldecode($this->uri->segment(5));
		$busca_precos  		= $this->uri->segment(6);
		
		$segment 	= 7;
		$limit 		= 8;
		$offset 	= $this->uri->segment($segment);
		$offset 	= is_numeric($offset)? $offset : 0;
		
		$this->model_imoveis->addLimit($limit, $offset);
		
		
		$lista 		= $this->model_imoveis->listarBusca(1, $busca_categoria, $busca_tipo, $busca_cidade, $busca_bairro, $busca_precos);
		$qtotal 	= $this->db->query('SELECT FOUND_ROWS() as total;')->row();
		$total 		= $qtotal->total;

			
		foreach($lista as $k => $v){
								
			$dados = $this->model_imoveis->getdados($v->imoveis_id);
			$arrDados = array();
			foreach($dados as $kd => $d){
				$arrDados[$d->dadosimovel_id] = $d;
			}
							
			$valores = $this->model_imoveis->getvalor($v->imoveis_id);
			$arrValores = array();
			foreach($valores as $kd => $d){
				$arrValores[$d->valores_id] = $d;
			}
				
			$dependencias = $this->model_imoveis->getDependencias($v->imoveis_id);
			$arrDependencias = array();
			foreach($dependencias as $kd => $d){
				$arrDependencias[$d->dependencias_id] = $d;
			}
				
			$lista[$k]->imovel_dados = $arrDados;
			$lista[$k]->imovel_dependencias = $dependencias;
			$lista[$k]->imovel_valores = $arrValores;
		}
		
		$titulo = 'Resultado da busca';
	
		if( count($lista) == 0){
			$titulo = "A busca não encontrou nenhum resultado para venda";
		}
		
		
		//form de busca
		$data['tipos'] 				= $this->tipos;
		$data['busca_tipo'] 		= $busca_tipo;
		$data['categorias'] 		= $this->categorias;
		$data['busca_categoria'] 	= $busca_categoria;
		$data['cidades'] 			= $this->cidades;
		$data['busca_cidade'] 		= $busca_cidade;
		$data['bairros'] 			= $this->bairros;
		$data['busca_bairro'] 		= $busca_bairro;
		$data['precos'] 			= $this->precos;
		$data['busca_precos'] 		= $busca_precos;
		//fim do form de busca
		
		//PAGINAÇÃO
		$data['total'] 	= $total;
		$data['start'] 	= $offset+1;
		$data['end'] 	= $total > $limit? (($offset+$limit) < $total? $offset+$limit : $total) : $limit;
		$q 				= isset($q)? $q : "";
		
		$this->load->library('pagination');
		$config['base_url'] 		= base_url("busca/$busca_categoria/$busca_tipo/$busca_cidade/$busca_bairro/$busca_precos/");
		$config['total_rows'] 		= $total ;
		$config['per_page'] 		= $limit;
		$config['uri_segment'] 		= $segment;
		$config['full_tag_open'] 	= '<ul>';
		$config['full_tag_close']	= '</ul>';
		$config['cur_tag_open'] 	= '<li><a href="#" class="ativo_pagina" style="font-size:14px">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['last_link'] 		= 'Último »';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['first_link']		= '« Primeiro';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&raquo;';
		$config['next_tag_open'] 	= '<li  class="voltar">';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_link'] 		= '&laquo;';
		$config['prev_tag_open'] 	= '<li  class="avancar">';
		$config['prev_tag_close'] 	= '</li>';
		$this->pagination->initialize($config);
		//FIM PAGINACAO
	
		$data['titulo_pagina'] 		= $titulo;
		$data['lista'] 				= $lista;
		$this->load->view('vendas', $data);
	}
	
	public function imagem($width = 0, $height = 0, $file = ''){
		$config['image_library'] = 'gd2';
		$config['source_image']	= './admin/uploads/'.$file;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width']	= $width;
		$config['height']	= $height;
		$config['dynamic_output']	= FALSE;
		$config['new_image']=FCPATH."site/imagem/$width/$height/$file";
		
		if(!file_exists(FCPATH."site/imagem/$width/$height")){
			mkdir(FCPATH."site/imagem/$width/$height", 0755, true);
		}
		
		if(!file_exists($config['new_image'])){
			$this->load->library('image_lib', $config);
			$this->image_lib->fit();
			$config['dynamic_output']	= TRUE;
			$this->image_lib->initialize($config);
			$this->image_lib->fit();
		}
		
		if ( ! $this->image_lib->fit()){
			echo $this->image_lib->display_errors();
		}
		
	}
}
