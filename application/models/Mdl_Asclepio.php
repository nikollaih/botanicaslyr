<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Asclepio extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
    }

    function add($data){
        $this->db->insert('asclepios', $data);
        return $this->get($this->db->insert_id());
    }

    function all($limit = false){
        $this->db->from('asclepios');
        $this->db->order_by('titulo_asclepio', 'asc');
        if($limit != false){
		    $this->db->limit(250);
		}
        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        else return false;
    }

    function get($id){
        $this->db->from('asclepios');
        $this->db->where('id_asclepio', $id);

        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        else{
            return false;
        }
    }

    function update($data){
        $this->db->where('id_asclepio', $data['id_asclepio']);
        $this->db->update('asclepios', $data);
        return $this->get($data['id_asclepio']);
    }


    function delete($id){
        $this->db->where('id_asclepio', $id);
        return $this->db->delete('asclepios');
    }
}