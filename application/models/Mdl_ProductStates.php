<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_ProductStates extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$sync = $this->load->database('sync', TRUE);
	}

	function all(){
		$this->db->from('estado_productos');
		$this->db->order_by('descripcion_estado_productos', 'asc');

		$s = $this->db->get();

		if ($s->num_rows() > 0) {
			return $s->result_array();
		}
		else{
			return false;
		}
	}

}