<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Recipes extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model(array('Mdl_Recipes', 'Mdl_Appointments'));
    }

    function index($limit = false){
        isLogin();

        $data['nav'] = 'recipe';
        $data['recipes'] = $this->Mdl_Recipes->all($limit);

        $this->load->view('pages/recipes/all', $data);
    }

    function add(){
        isLogin();

        $data['nav'] = 'recipe';
        $this->load->view('pages/recipes/add', $data);
    }

    function update($id){
        isLogin();

        $data['recipe'] = $this->Mdl_Recipes->get($id);

        if ( $data['recipe'] != false) {
            $data['nav'] = 'recipe';
            $this->load->view('pages/recipes/add', $data);
        }
        else{
            redirect(base_url().'Recipes/add');
        }
    }

    function save(){
        isLogin();

        if ($this->input->post()) {
            $data = $this->input->post();
            if (isset($data['files'])) {
                unset($data['files']);
            }

            $data['fecha_recetario'] = date('Y-m-d', strtotime($data['fecha_recetario']));

            $r = $this->Mdl_Recipes->get($data['id_recetario']);

            if ($r == false) {
                $r = $this->Mdl_Recipes->add($data);
                $this->session->set_flashdata('text', 'Recetario agregado exitosamente');
            }
            else{
                $r = $this->Mdl_Recipes->update($data);
                $this->session->set_flashdata('text', 'Recetario modificado exitosamente');
                $this->updateAppoinment($data);
            }

            $this->session->set_flashdata('type', 'bg-success');
            $this->session->set_flashdata('title', 'Exito!');

			redirect(base_url().'Recipes/update/'.$r['id_recetario']);
        }
        else{
            responder(0, false, 'Acceso denegado');
        }
    }

    function updateAppoinment($data){
        if($data['id_consulta']){
            $new['detalles_recetario'] = $data['texto_recetario'];
            $new['id_consulta'] = $data['id_consulta'];
            $this->Mdl_Appointments->appointmentUpdate($new);
        } 
    }

    function recipeDelete(){
		isLogin(1);

		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			$recipe = $this->Mdl_Recipes->get($id);

			if ($recipe === false) {
				responder(false, false, "No se ha encontrado el recetario");
			}
			else{
				if ($this->Mdl_Recipes->delete($id)) {
					responder($id, true, "Registro eliminado exitosamente");
				}
				else{
					responder($recipe, true, "Ha ocurrido un error, por favor intente de nuevo más tarde");
				}
			}
		}
		else{
			responder(false, false, "Acceso denegado");
		}
	}
}