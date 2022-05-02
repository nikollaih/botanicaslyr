<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Schedules extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
		//Cargamos la base de datos que se encuentra en linea
		//$sync = $this->load->database('sync', TRUE);
	}

    function all($limit = false)
    {
		$this->db->from('agenda');
		$this->db->where('estado_agenda != 4');
		if($limit != false){
		    $this->db->limit($limit);
		}
		$this->db->order_by('fecha_hora_agenda', 'desc');

		$s = $this->db->get();

		if ($s->num_rows() > 0) {
			return $s->result_array();
		}
		else{
			return false;
		}
    }
    
    function add($data)
    {
        $this->db->insert('agenda', $data);
        return $this->get($this->db->insert_id());
	}
	
	function update($data)
    {
		$this->db->where('id_agenda', $data['id_agenda']);
        $this->db->update('agenda', $data);
        return $this->get($data['id_agenda']);
    }

    function get($id)
    {
        $this->db->from('agenda');
		$this->db->where('id_agenda', $id);

		$s = $this->db->get();

		if ($s->num_rows() > 0) {
			return $s->row_array();
		}
		else{
			return false;
		}  
	}
	
	function search($q)
    {
        $this->db->from('agenda a');
		$this->db->where('a.paciente_agenda LIKE "%'.$q.'%"');
		$this->db->join('estado_consultas c', 'a.estado_agenda = c.id_estado_consulta');

		$s = $this->db->get();

		if ($s->num_rows() > 0) {
			return $s->result_array();
		}
		else{
			return false;
		}  
    }

}