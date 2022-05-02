<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Config extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
	}

/**
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @return [type] [description]
 */
	function getConfig($name){
        $this->db->from('configuracion');
        $this->db->where("nombre_configuracion", $name);

		$doc = $this->db->get();

		if ($doc->num_rows() > 0) {
			return $doc->row_array();
		}
		else{
			return false;
		}
    }
    
    function setConfig($data){
        $this->db->where("nombre_configuracion", $data["nombre_configuracion"]);
        return $this->db->update('configuracion', $data);
    }

}