<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Schedules extends CI_Controller
{
function __construct()
	{
		parent::__construct();
        $this->load->model(array('Mdl_AppointmentStates', 'Mdl_Schedules', "Mdl_Config"));
	}

    function index()
    {
        isLogin();

        $data['nav'] = "schedule";
        $data['states'] = $this->Mdl_AppointmentStates->getAppointmentStates();
        $data['day'] = $this->Mdl_Config->getConfig("schedule_day");
        $this->load->view('pages/schedules/all', $data);
    }

    function saveSchedule()
    {
        isLogin(1);

        if ($this->input->post()) {
            $data = $this->input->post();

            $sc = $this->Mdl_Schedules->get($data['id_agenda']);

            if ($sc != false) {
                unset($data['fecha_agenda']);
                unset($data['hora_agenda']);

                $s = $this->Mdl_Schedules->update($data);
                $state = 'updated';
            }
            else{
                $data['fecha_hora_agenda'] = date('Y-m-d', strtotime($data['fecha_agenda'])).' '.date('H:i:s', strtotime($data['hora_agenda'].':00'));
                unset($data['fecha_agenda']);
                unset($data['hora_agenda']);

                $s = $this->Mdl_Schedules->add($data);
                $state = 'added';
            }

            if ($s != false) {
                responder($s, $state, 0);
            }
            
            responder($data, false, 0);
           
        }
        else{
            responder(0, false, 'Acceso denegado');
        }
        
    }

    function all()
    {
        isLogin(1);
        $s = $this->Mdl_Schedules->all(200);
        responder($s, true, 'Lista de agenda');
    }

    function get($id)
    {
        isLogin(1);
        $s = $this->Mdl_Schedules->get($id);
        responder($s, true, 'Info de agenda');
    }
}