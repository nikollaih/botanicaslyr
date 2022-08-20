<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_AppointmentHistory extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$this->sync = $this->load->database('sync', TRUE);
    }
    
    function add($data)
    {
        $this->db->insert('historias_clinicas', $data);
        return $this->all($data['id_consulta']);
    }

    function update($data)
    {
        $this->db->where('id_consulta', $data['id_consulta']);
        $this->db->update('historias_clinicas', $data);
        return $this->all($data['id_consulta']);
    }

	function all($id){
        $this->db->from('historias_clinicas');
        $this->db->where('id_consulta', $id);

		$c = $this->db->get();

		if ($c->num_rows() > 0) {
			return $c->row_array();
		}
		else{
			return false;
		}
	}

	function get($id){
        $this->db->from('historias_clinicas');
        $this->db->where('id_historia_clinica', $id);

		$c = $this->db->get();

		if ($c->num_rows() > 0) {
			return $c->row_array();
		}
		else{
			return false;
		}
	}

	function getByPerson($id_persona){
		$this->db->from('historia_clinica');
        $this->db->where('id_persona', $id_persona);
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row_array() : false;
	}

	function addHistoriaClinica($data){
		return $this->db->insert("historia_clinica", $data);
	}

	function updateHistoriaClinica($data){
		$this->db->where("id_historia_clinica", $data["id_historia_clinica"]);
		return $this->db->update("historia_clinica", $data);
	}

	// ! =================  Syncronization functions ==================

	/**
	 * 
	 */
	function sync($id){
		$s = $this->getSync($id);
		$p = $this->get($id);
		if ($s == false) {
			return $this->addSync($p);
		}
		else{
			return $this->updateSync($p);
		}
	}

	/**
	* [addPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $data [description]
	*/
	function updateSync($data){
		$this->sync->where('id_historia_clinica', $data['id_historia_clinica']);
		$this->sync->update('historias_clinicas', $data);
		return $this->getSync($data['id_historia_clinica']);
	}

	/**
	* [addPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $data [description]
	*/
	function addSync($data){
		$this->sync->insert('historias_clinicas', $data);
		return $this->getSync($this->sync->insert_id());
	}

	/**
	* [getInfoPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $id [description]
	* @return [type]     [description]
	*/
	function getSync($id){
		$this->sync->from('historias_clinicas');
		$this->sync->where('id_historia_clinica', $id);

		$a = $this->sync->get();

		if ($a->num_rows() > 0) {
			return $a->row_array();
		}
		else{
			return false;
		}
	}
}