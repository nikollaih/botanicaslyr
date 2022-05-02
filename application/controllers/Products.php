<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Products extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(array('Mdl_Products', 'Mdl_ProductCategories'));
    }

/**
 * 
 */
    function index()
    {
        isLogin();
        $data['nav'] = 'product';
        $data['products'] = $this->Mdl_Products->all(array(1,2));
        $data['categories'] = $this->Mdl_ProductCategories->all();
        $this->load->view('pages/products/list', $data);
    }

    function add()
    {
        isLogin();
        $data['nav'] = 'product';
        $this->load->view('pages/products/new', $data);
    }

    function update($id)
    {
        isLogin();
        $data['nav'] = 'product';
        $data['p'] = $this->Mdl_Products->get($id);
        $this->load->view('pages/products/update', $data);
    }

    function save()
    {
        isLogin();

        if($this->input->post()){
            $data = $this->input->post()['p'];
            $p = $this->Mdl_Products->get($data['id_producto']);

            if ($p === false) {
                $p = $this->Mdl_Products->add($data);
                $this->session->set_flashdata('text', 'Producto agregado exitosamente.');
            }
            else{
                $p = $this->Mdl_Products->update($data);
                $this->session->set_flashdata('text', 'Producto modificado exitosamente.');
            }

            if($p != false){
                // Add new patient to sync list
				addSync($p['id_producto'], 'product');
            }

            $path = './uploads/products/'.$p['id_producto'].'/';
            $img = upload_image_file($_FILES['image'], $path, 'product-image', array(150));
            if ($img != false){
                $data['imagen_producto'] = $img;
                $data['id_producto'] = $p['id_producto'];
                $p = $this->Mdl_Products->update($data);
            }

            $this->session->set_flashdata('type', 'bg-success');
            $this->session->set_flashdata('title', 'Exito!');
        }

        redirect(base_url().'products/update/'.$p['id_producto']);
    }

    function delete(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$p = $this->Mdl_Products->get($id);

			if ($p === false) {
				responder(false, false, "No se ha encontrado el producto");
			}
			else{
				if ($this->Mdl_Products->delete($id)) {
                    // Add new patient to sync list
				    addSync($p['id_producto'], 'product');
					responder($id, true, "Registro eliminado exitosamente");
				}
				else{
					responder($p, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
				}
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
    }
    
    function search()
    {
        isLogin(1);

        $q = $this->input->post('q');
        $p = $this->Mdl_Products->search($q);

        responder($p, true, 'Lista de productos');
    }
}