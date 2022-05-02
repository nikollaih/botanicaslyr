<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_ProductCategories extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$sync = $this->load->database('sync', TRUE);
	}

	function all(){
		$this->db->from('producto_categorias');
		$this->db->order_by('descripcion_producto_categorias', 'asc');

		$c = $this->db->get();

		if ($c->num_rows() > 0) {
			return $c->result_array();
		}
		else{
			return false;
		}
	}

}