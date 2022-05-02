<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_AppointmentProducts extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$this->sync = $this->load->database('sync', TRUE);
	}

    function addAppointmentProduct($data){
        $this->db->insert('productos_consulta', $data);
        return $this->getAppointmentProduct($this->db->insert_id());
	}

	function deleteAppointmentProduct($p){
		$this->db->where('id_producto_consulta', $p);
        return  $this->db->delete('productos_consulta');
	}

	function getAppointmentProduct($id){
		$this->db->from('productos_consulta pc');
		$this->db->join('productos p', 'p.id_producto = pc.id_producto');
		$this->db->where('pc.id_producto_consulta', $id);
        
        $ap = $this->db->get();

        if($ap->num_rows() > 0)
        {
            return $ap->row_array();
        }
        else{
            return false;
        }
	}

	function getOnlyAppointmentProduct($id){
		$this->db->from('productos_consulta pc');
		$this->db->where('pc.id_producto_consulta', $id);
        
        $ap = $this->db->get();

        if($ap->num_rows() > 0)
        {
            return $ap->row_array();
        }
        else{
            return false;
        }
	}

	function getAppointmentProducts($a){
		$this->db->from('productos_consulta pc');
		$this->db->join('productos p', 'p.id_producto = pc.id_producto');
		$this->db->where('pc.id_consulta', $a);
        
        $ap = $this->db->get();

        if($ap->num_rows() > 0)
        {
            return $ap->result_array();
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
		$s = $this->getSync($id);
		$p = $this->getOnlyAppointmentProduct($id);

		if($p != false){
			if ($s == false) {
				return $this->addSync($p);
			}
			else{
				return $this->updateSync($p);
			}
		}
		else{
			return true;
		}
	}

	/**
	* [addPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $data [description]
	*/
	function updateSync($data){
		$this->sync->where('id_producto_consulta', $data['id_producto_consulta']);
		$this->sync->update('productos_consulta', $data);
		return $this->getSync($data['id_producto_consulta']);
	}

	/**
	* [addPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $data [description]
	*/
	function addSync($data){
		$this->sync->insert('productos_consulta', $data);
		return $this->getSync($this->sync->insert_id());
	}

	/**
	* [getInfoPerson description]
	* @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
	* @param  [type] $id [description]
	* @return [type]     [description]
	*/
	function getSync($id){
		$this->sync->from('productos_consulta');
		$this->sync->where('id_producto_consulta', $id);

		$a = $this->sync->get();

		if ($a->num_rows() > 0) {
			return $a->row_array();
		}
		else{
			return false;
		}
	}

	/**
	 * 
	 */
	function deleteSync($p){
		$this->sync->where('id_producto_consulta', $p);
        return  $this->sync->delete('productos_consulta');
	}
}