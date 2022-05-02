<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Sync extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$sync = $this->load->database('sync', TRUE);
	}

	function add($data){
        $this->db->insert('sync', $data);
    }

    function delete($id){
        $this->db->where('id_sync', $id);
        $this->db->delete('sync');
    }

    function all(){
        $this->db->from('sync');
        $this->db->order_by('id_sync', 'asc');

        $s = $this->db->get();

        if ($s->num_rows() > 0) {
            return $s->result_array();
        }
        else{
            return false;
        }
    }

}