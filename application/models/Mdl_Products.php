<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mdl_Products extends CI_Model
	{
		
	    function __construct(){
			parent::__construct();
			// Cargamos la base de datos que se encuentra en local
			$this->load->database();
			// Cargamos la base de datos que se encuentra en linea
			//$this->sync = $this->load->database('sync', TRUE);
        }
        
        function add($data){
            $this->db->insert('productos', $data);
            return $this->get($this->db->insert_id());
        }
	    
	    function all($state = null){
            $this->db->from('productos p');
            $this->db->join('estado_productos ep', 'p.estado_producto = ep.id_estado_productos');
            $this->db->join('producto_categorias pc', 'pc.id_producto_categorias = p.categoria_producto', 'left outer');
            $this->db->order_by('pc.descripcion_producto_categorias', 'asc');
            $this->db->order_by('p.nombre_producto', 'asc');
            if ($state != null){
                $this->db->where_in('p.estado_producto', $state);
            }

            $p = $this->db->get();

            if ($p->num_rows() > 0) {
                return $p->result_array();
            } else {
                return false;
            }
        }
        
        function get($id){
            $this->db->from('productos p');
            $this->db->join('estado_productos ep', 'p.estado_producto = ep.id_estado_productos');
            $this->db->where('p.id_producto', $id);

            $p = $this->db->get();

            if ($p->num_rows() > 0) {
                return $p->row_array();
            } else {
                return false;
            }
        }

        function getOnlyProduct($id){
            $this->db->from('productos p');
            $this->db->where('p.id_producto', $id);

            $p = $this->db->get();

            if ($p->num_rows() > 0) {
                return $p->row_array();
            } else {
                return false;
            }
        }
        
        function update($data){
            $this->db->where('id_producto', $data['id_producto']);
            $this->db->update('productos', $data);
            return $data;
        }

        function delete($id){
            $this->db->where('id_producto', $id);
            return $this->db->update('productos', array('estado_producto' => 3));
        }

        function search($q)
        {
            $this->db->from('productos p');
            $this->db->join('estado_productos ep', 'p.estado_producto = ep.id_estado_productos');
            $this->db->where('p.estado_producto != 3');
            $this->db->where('p.nombre_producto LIKE "%'.$q.'%"');
            $this->db->or_where('p.referencia_producto LIKE "%'.$q.'%"');

            $p = $this->db->get();

            if ($p->num_rows() > 0) {
                return $p->result_array();
            } else {
                return false;
            }
        }


// ! =================  Syncronization functions ==================

/**
 * 
 */
	function sync($id){
		$s = $this->getSync($id);
		$p = $this->getOnlyProduct($id);

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
		$this->sync->where('id_producto', $data['id_producto']);
		$this->sync->update('productos', $data);
		return $this->getSync($data['id_producto']);
	}

/**
 * [addPerson description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  [type] $data [description]
 */
	function addSync($data){
		$this->sync->insert('productos', $data);
		return $this->getSync($this->sync->insert_id());
	}
    
/**
 * 
 */
    function getSync($id){
        $this->sync->from('productos p');
        $this->sync->where('p.id_producto', $id);

        $p = $this->sync->get();

        if ($p->num_rows() > 0) {
            return $p->row_array();
        } else {
            return false;
        }
    }
}