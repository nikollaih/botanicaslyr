<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Asclepios extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model(array('Mdl_Asclepio', 'Mdl_Appointments'));
    }

    function index($limit = false){
        isLogin();
        $data['nav'] = 'asclepio';
        $data['asclepios'] = $this->Mdl_Asclepio->all($limit);
        $this->load->view('pages/asclepios/all', $data);
    }

    function add(){
        isLogin();
        $data['nav'] = 'asclepios';
        $this->load->view('pages/asclepios/add', $data);
    }

    function get($id){
        isLogin(null, 1);
        $asclepio = $this->Mdl_Asclepio->get($id);
        if($asclepio){
            responder($asclepio, true, "Información del asclepio");
        }else{
            responder(null, false, "No se ha encontrado el asclepio");
        }
    }

    function update($id){
        isLogin();
        $data['asclepio'] = $this->Mdl_Asclepio->get($id);

        if ( $data['asclepio'] != false) {
            $data['nav'] = 'asclepio';
            $this->load->view('pages/asclepios/add', $data);
        }
        else{
            redirect(base_url().'asclepios/add');
        }
    }

    function save(){
        isLogin();

        if ($this->input->post()) {
            $data = $this->input->post();
            unset($data["files"]);
            $asclepio = $this->Mdl_Asclepio->get($data['id_asclepio']);

            if ($asclepio == false) {
                $asclepio = $this->Mdl_Asclepio->add($data);
                $this->session->set_flashdata('text', 'Asclepio agregado exitosamente');
            }
            else{
                $asclepio = $this->Mdl_Asclepio->update($data);
                $this->session->set_flashdata('text', 'Asclepio modificado exitosamente');
            }

            $this->session->set_flashdata('type', 'bg-success');
            $this->session->set_flashdata('title', 'Exito!');

			redirect(base_url().'Asclepios/update/'.$asclepio['id_asclepio']);
        }
        else{
            responder(0, false, 'Acceso denegado');
        }
    }


    function asclepioDelete(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$asclepio = $this->Mdl_Asclepio->get($id);

			if ($asclepio === false) {
				responder(false, false, "No se ha encontrado el asclepio");
			}
			else{
				if ($this->Mdl_Asclepio->delete($id)) {
					responder($id, true, "Registro eliminado exitosamente");
				}
				else{
					responder($asclepio, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
				}
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}
}