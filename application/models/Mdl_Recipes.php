<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Recipes extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
    }

    function add($data){
        $this->db->insert('recetario', $data);
        return $this->get($this->db->insert_id());
    }

    function all($limit = false){
        $this->db->from('recetario');
        $this->db->order_by('fecha_recetario', 'desc');
if($limit != false){
		    $this->db->limit(250);
		}
        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        else{
            return false;
        }
    }

    function get($id){
        $this->db->from('recetario');
        $this->db->where('id_recetario', $id);

        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        else{
            return false;
        }
    }

    function getByAppointment($id){
        $this->db->from('recetario');
        $this->db->where('id_consulta', $id);

        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        else{
            return false;
        }
    }

    function update($data){
        $this->db->where('id_recetario', $data['id_recetario']);
        $this->db->update('recetario', $data);
        return $this->get($data['id_recetario']);
    }

    function updateAppointment($data){
        $this->db->where('id_consulta', $data['id_consulta']);
        $this->db->update('recetario', $data);
        return $this->get($data['id_consulta']);
    }

    function delete($id){
        $this->db->where('id_recetario', $id);
        return $this->db->delete('recetario');
    }
}