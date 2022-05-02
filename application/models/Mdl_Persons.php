<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Persons extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$this->sync = $this->load->database('sync', TRUE);
	}

/**
 * Valida las credenciales para el inicio de sesion de un usuario
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [string] $username Nombre usuario
 * @param  [string] $pass     Contrase���a
 * @return [type]             integer | false
 */
	function validateUser($username, $pass){
		$this->db->select('a.id_persona');
		$this->db->from('accesos a');
		$this->db->join('personas p', 'a.id_persona = p.id_persona');
		$this->db->where('a.username', $username);
		$this->db->where('a.password', md5($pass));
		$this->db->where('p.estado_persona', 1);

		$id = $this->db->get();

		if ($id->num_rows() > 0) {
			return $id->row_array()['id_persona'];
		}
		else{
			return false;
		}
	}

/**
 * [getInfoPerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	function getPerson($id){
		$this->db->from('personas p');
		$this->db->join('tipo_documentos td', 'td.id_tipo_documento = p.id_tipo_documento');
		$this->db->where('p.id_persona', $id);

		$person = $this->db->get();

		if ($person->num_rows() > 0) {
			return $person->row_array();
		}
		else{
			return false;
		}
	}


	function getOnlyPerson($id){
		$this->db->from('personas p');
		$this->db->where('p.id_persona', $id);

		$person = $this->db->get();

		if ($person->num_rows() > 0) {
			return $person->row_array();
		}
		else{
			return false;
		}
	}

/**
 * [getPersonsType description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $type [description]
 * @return [type]       [description]
 */
	function getPersonsType($type, $limit = false){
		$this->db->from('personas p');
		$this->db->where('id_tipo_usuario', $type);
		$this->db->where('estado_persona !=', 0);
		$this->db->order_by('created_at', 'desc');
		if($limit != false){
		    $this->db->limit(250);
		}
		$person = $this->db->get();

		if ($person->num_rows() > 0) {
			return $person->result_array();
		}
		else{
			return false;
		}
	}

/**
 * [getPersonDocument description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $doc [description]
 * @return [type]      [description]
 */
	function getPersonDocument($doc){
		$this->db->from('personas p');
		$this->db->where('numero_documento', $doc);

		$person = $this->db->get();

		if ($person->num_rows() > 0) {
			return $person->row_array();
		}
		else{
			return false;
		}
	}

/**
 * [addPerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $data [description]
 */
	function addPerson($data){
		$this->db->insert('personas', $data);
		return $this->getPerson($this->db->insert_id());
	}
	
/**
 * [addPerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $data [description]
 */
	function updatePerson($data){
		$this->db->where('id_persona', $data['id_persona']);
		$this->db->update('personas', $data);
		return $this->getPerson($data['id_persona']);
	}

/**
 * [addUserAccess description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $data [description]
 */
	function addUserAccess($data){
		$this->db->insert('accesos', $data);
	}

/**
 * [personDelete description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	function personDelete($id){
		$data['estado_persona'] = 0;
		$this->db->where('id_persona', $id);
		return $this->db->update('personas', $data);
	}

	function getPersonSearch($doc, $cant = false){
		$this->db->from('personas p');
		$this->db->where('(numero_documento', $doc);
		$this->db->or_where('nombre_persona LIKE "%'.$doc.'%"');
		$this->db->or_where('apellidos_persona LIKE "%'.$doc.'%")');
		$this->db->where('id_tipo_usuario != 1');

		$person = $this->db->get();

		if ($person->num_rows() > 0) {
			if ($cant) {
				return $person->result_array();
			} else {
				return $person->row_array();
			}
		}
		else{
			return false;
		}
	}

// ! =================  Syncronization functions ==================

/**
 * 
 */
	function sync($id){
		$s = $this->getPersonSync($id);
		$p = $this->getOnlyPerson($id);

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
		$this->sync->where('id_persona', $data['id_persona']);
		$this->sync->update('personas', $data);
		return $this->getPersonSync($data['id_persona']);
	}

/**
 * [addPerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $data [description]
 */
	function addSync($data){
		$this->sync->insert('personas', $data);
		return $this->getPersonSync($this->sync->insert_id());
	}

/**
 * [getInfoPerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	function getPersonSync($id){
		$this->sync->from('personas p');
		$this->sync->where('p.id_persona', $id);

		$person = $this->sync->get();

		if ($person->num_rows() > 0) {
			return $person->row_array();
		}
		else{
			return false;
		}
	}

/**
 * [personDelete description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function personDeleteSync($id){
	$data['estado_persona'] = 0;
	$this->sync->where('id_persona', $id);
	return $this->sync->update('personas', $data);
}

}