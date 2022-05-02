<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Appointments extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$this->sync = $this->load->database('sync', TRUE);
	}


	function appointmentAdd($data){
		$this->db->insert('consultas', $data);
		return $this->appointmentGetId($this->db->insert_id());
	}

	function appointmentGetId($id){
		$this->db->select('c.*, p.*, ec.*, f.id_factura');
		$this->db->from('consultas c');
		$this->db->join('personas p', 'p.id_persona = c.id_persona');
		$this->db->join('estado_consultas ec', 'c.estado_consulta = ec.id_estado_consulta');
		$this->db->join('facturas f', 'c.id_consulta = f.id_consulta', 'left outer');
		$this->db->where('c.id_consulta', $id);

		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->row_array();
		}
		else{
			return false;
		}
	}

	function appointmentOnlyId($id){
		$this->db->from('consultas c');
		$this->db->where('c.id_consulta', $id);

		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->row_array();
		}
		else{
			return false;
		}
	}

	function appointmentsGetPatient($id){
		$this->db->select('c.*, p.*, ec.*, f.id_factura');
		$this->db->from('consultas c');
		$this->db->join('personas p', 'p.id_persona = c.id_persona');
		$this->db->join('estado_consultas ec', 'c.estado_consulta = ec.id_estado_consulta');
		$this->db->join('facturas f', 'c.id_consulta = f.id_consulta', 'left outer');
		$this->db->where('c.id_persona', $id);
		$this->db->order_by('c.fecha_hora_consulta', 'desc');

		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->result_array();
		}
		else{
			return false;
		}
	}

	function appointmentGet($status = 0, $limit = false){
		$this->db->from('consultas c');
		$this->db->join('personas p', 'p.id_persona = c.id_persona');
		$this->db->join('estado_consultas ec', 'c.estado_consulta = ec.id_estado_consulta');
		if ($status != 0) {
			$this->db->where_in('c.estado_consulta', $status);
		}
		$this->db->order_by('c.fecha_hora_consulta', 'desc');
		
if($limit != false){
		    $this->db->limit(250);
		}
		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->result_array();
		}
		else{
			return false;
		}
	}

	function appointmentCount($status = 0){
		$this->db->from('consultas c');
		if ($status != 0) {
			$this->db->where_in('c.estado_consulta', $status);
		}

		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->result_array();
		}
		else{
			return false;
		}
	}

	function appointmentUpdate($data){
		$this->db->where('id_consulta', $data['id_consulta']);
		$this->db->update('consultas', $data);
		return $this->appointmentGetId($data['id_consulta']);
	}

	function appointmentDelete($id){
		$data['estado_consulta'] = 4;
		$data['id_consulta'] = $id;
		return $this->appointmentUpdate($data);
	}

	function appointmentDate($init, $end, $status = 0){
		$this->db->from('consultas c');
		$this->db->join('personas p', 'p.id_persona = c.id_persona');
		$this->db->join('estado_consultas ec', 'c.estado_consulta = ec.id_estado_consulta');
		$this->db->where('(c.fecha_hora_consulta BETWEEN "'.$init.'" AND "'.$end.'")');
		if ($status != 0) {
			$this->db->where_in('c.estado_consulta', $status);
		}
		$this->db->order_by('c.fecha_hora_consulta', 'asc');

		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->result_array();
		}
		else{
			return false;
		}
	}

	function appointmentValidateDate($dateTime){
		$duration = 1;
		$init = date('Y-m-d H:i:s', strtotime ( '-'.$duration.' minute' , strtotime ( $dateTime ) ) );
		$end = date('Y-m-d H:i:s', strtotime ( '+'.$duration.' minute' , strtotime ( $dateTime ) ) );
		$this->db->from('consultas c');
		$this->db->join('personas p', 'p.id_persona = c.id_persona');
		$this->db->join('estado_consultas ec', 'c.estado_consulta = ec.id_estado_consulta');
		$this->db->where('c.fecha_hora_consulta BETWEEN "'.$init.'" AND "'.$end.'"');
		$this->db->where_in('c.estado_consulta', array(1, 2));

		$a = $this->db->get();

		if ($a->num_rows() > 0) {
			return $a->result_array();
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
		$s = $this->getAppointmentSync($id);
		$p = $this->appointmentOnlyId($id);
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
		$this->sync->where('id_consulta', $data['id_consulta']);
		$this->sync->update('consultas', $data);
		return $this->getAppointmentSync($data['id_consulta']);
	}

	/**
	* [addPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $data [description]
	*/
	function addSync($data){
		$this->sync->insert('consultas', $data);
		return $this->getAppointmentSync($this->sync->insert_id());
	}

	/**
	* [getInfoPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $id [description]
	* @return [type]     [description]
	*/
	function getAppointmentSync($id){
		$this->sync->from('consultas');
		$this->sync->where('id_consulta', $id);

		$a = $this->sync->get();

		if ($a->num_rows() > 0) {
			return $a->row_array();
		}
		else{
			return false;
		}
	}

}