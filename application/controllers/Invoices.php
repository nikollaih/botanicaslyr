<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('url', 'auth'));
		$this->load->model(array('Mdl_Invoices', 'Mdl_Products', 'Mdl_Persons'));
	}

	public function index()
	{
		isLogin();

        $data['nav'] = "invoice";
        $data['inv'] = $this->Mdl_Invoices->all();
		$this->load->view('pages/invoices/all.php', $data);
    }
    
    function add($person = null, $appointment = null){
        isLogin();

		$person = $this->Mdl_Persons->getOnlyPerson($person);
		if($person){
			$data['invoice']['documento_factura'] = $person['numero_documento'];
			$data['invoice']['paciente_factura'] = $person['nombre_persona'].' '.$person['apellidos_persona'];
			$data['invoice']['telefono_factura'] = $person['telefono_persona'];
		}

		if($appointment != null){
			$data['invoice']['id_consulta'] = $appointment;
		}
		
        $data['nav'] = "invoice";
		$this->load->view('pages/invoices/add.php', $data);
	}

	function edit($id){
        isLogin();

		$data['nav'] = "invoice";
		$data['invoice'] = $this->Mdl_Invoices->get($id);
		$data['products'] = $this->Mdl_Invoices->getProducts($id);
		$this->load->view('pages/invoices/add.php', $data);
	}

	function save(){
		isLogin();

		if ($this->input->post()) {
			$data = $this->input->post();
			$data['fecha_factura'] = date('Y-m-d', strtotime($data['fecha_factura']));

			$i = $this->Mdl_Invoices->get($data['id_factura']);

			if ($i == false) {
				$inv = $this->Mdl_Invoices->add($data);
				$this->session->set_flashdata('text', 'Factura agregada exitosamente');
			} else {
				$inv = $this->Mdl_Invoices->update($data);
				$this->session->set_flashdata('text', 'Factura modificada exitosamente');
			}
			
			$this->session->set_flashdata('type', 'bg-success');
            $this->session->set_flashdata('title', 'Exito!');

			redirect(base_url().'Invoices/edit/'.$inv['id_factura']);
		}
		else{
			responder(0, false, 'Acceso denegado');
		}
	}
	
	function addProduct(){
		isLogin(1);

		$data = $this->input->post();

		$p = $this->Mdl_Products->get($data['d']['id_producto']);
		$f = $this->Mdl_Invoices->get($data['d']['id_factura']);
		if ($p != false && $f != false) 
		{
			$prod = $this->Mdl_Products->getOnlyProduct($data['d']['id_producto']);

			if($data['type'] == 'delete')
			{
				$prod['stock_producto'] = $prod['stock_producto'] + $data['d']['cantidad_productos_factura'];
				$this->Mdl_Invoices->deleteProduct($data['d']['id_productos_factura']);
				$in['id_productos_factura'] = $data['d']['id_productos_factura'];
				$status = 'deleted';
			}
			else{
				$prod['stock_producto'] = $prod['stock_producto'] - $data['d']['cantidad_productos_factura'];
				$in = $this->Mdl_Invoices->addProduct($data['d']);
				$status = 'added';
			}

			$this->Mdl_Products->update($prod);
			responder($in, $status, '');
		}
		else
		{
			responder(false, false, 'No se ha encontrado el producto');
		}
	}

	function invoiceDelete(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$invoice = $this->Mdl_Invoices->get($id);

			if ($invoice === false) {
				responder(false, false, "No se ha encontrado la factura");
			}
			else{
				$prods = $this->Mdl_Invoices->getProducts($id);

				if($prods){
					for ($i=0; $i < count($prods); $i++) { 
						$prod = $this->Mdl_Products->getOnlyProduct($prods[0]['id_producto']);
						if($prod){
							$prod['stock_producto'] += $prods[0]['cantidad_productos_factura'];
							$this->Mdl_Products->update($prod);
						}
					}
				}

				if ($this->Mdl_Invoices->invoiceDelete($id)) {
					responder($id, true, "Registro eliminado exitosamente");
				}
				else{
					responder($invoice, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
				}
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}
}
