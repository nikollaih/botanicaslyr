<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Invoices extends CI_Model{

	function __construct(){
		parent::__construct();
		//Cargamos la base de datos que se encuentra en local
		$this->load->database();
    }


    function all(){
        $this->db->from('facturas');
        $this->db->order_by('fecha_factura', 'desc');
        $i = $this->db->get();

        if ($i->num_rows() > 0) {
            return $i->result_array();
        }
        else{
            return false;
        }
    }

    function add($data){
        $this->db->insert('facturas', $data);
        return $this->get($this->db->insert_id());
    }

    function update($data){
        $this->db->where('id_factura', $data['id_factura']);
        $this->db->update('facturas', $data);
        return $this->get($data['id_factura']);
    }

    function get($id){
        $this->db->from('facturas');
        $this->db->where('id_factura', $id);

        $inv = $this->db->get();
        if ($inv->num_rows() > 0) {
            return $inv->row_array();
        }
        else{
            return false;
        }
    }

    function addProduct($data){
        $this->db->insert('productos_factura', $data);
        return $this->getProduct($this->db->insert_id());
    }

    function getProduct($id){
        $this->db->from('productos_factura pf');
        $this->db->join('productos p', 'pf.id_producto = p.id_producto');
        $this->db->where('id_productos_factura', $id);

        $p = $this->db->get();

        if ($p->num_rows() > 0) {
            return $p->row_array();
        } else {
            return $this->db->last_query();
        }
        
    }

    function getProducts($id){
        $this->db->from('productos_factura pf');
        $this->db->join('productos p', 'pf.id_producto = p.id_producto');
        $this->db->where('id_factura', $id);

        $p = $this->db->get();
        if ($p->num_rows() > 0) {
            return $p->result_array();
        } else {
            return false;
        }
        
    }

    function deleteProduct($id){
        $this->db->where('id_productos_factura', $id);
        return $this->db->delete('productos_factura');
    }

    function invoiceDelete($id){
		$this->db->where('id_factura', $id);
        $this->db->delete('productos_factura');

        $this->db->where('id_factura', $id);
        return $this->db->delete('facturas');
	}
}