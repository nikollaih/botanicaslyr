<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_AppointmentStates extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$sync = $this->load->database('sync', TRUE);
	}

/**
 * [getAppointmentStates description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function getAppointmentStates(){
		$this->db->from('estado_consultas');
		$this->db->order_by('descripcion_estado_consulta', 'asc');

		$doc = $this->db->get();

		if ($doc->num_rows() > 0) {
			return $doc->result_array();
		}
		else{
			return false;
		}
	}

}