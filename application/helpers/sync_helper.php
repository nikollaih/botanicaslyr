<?php

function addSync($id, $type, $action = null){
    $data['id_sync'] = 'null';
    $data['id_data_sync'] = $id;
    $data['tipo_sync'] = $type;
    $data['action_sync'] = $action;

    $CI = & get_instance();  //get instance, access the CI superobject
    $CI->load->model('Mdl_Sync');
    $p = $CI->Mdl_Sync->add($data);
}

function sync(){
    $CI = & get_instance();  //get instance, access the CI superobject
    $CI->load->model(array('Mdl_Sync','Mdl_Persons', 'Mdl_Products', 'Mdl_Appointments', 'Mdl_AppointmentHistory', 'Mdl_AppointmentProducts'));
    $sync = $CI->Mdl_Sync->all();

    if ($sync == false) {
        responder(0, false, 'No se han encontrado datos para sincronizar');
    }
    else{
        foreach ($sync as $s) {
            switch ($s['tipo_sync']) {
                // ! Sync persons
                case 'person':
                    if ($CI->Mdl_Persons->sync($s['id_data_sync']) != false){
                        $CI->Mdl_Sync->delete($s['id_sync']);
                    }
                break;
                
                // ! Sync products
                case 'product':
                    if ($CI->Mdl_Products->sync($s['id_data_sync']) != false){
                        $CI->Mdl_Sync->delete($s['id_sync']);
                    }
                break;

                // ! Sync appointments
                case 'appointment':
                    if ($CI->Mdl_Appointments->sync($s['id_data_sync']) != false){
                        $CI->Mdl_Sync->delete($s['id_sync']);
                    }
                break;

                // ! Sync histories
                case 'history':
                    if ($CI->Mdl_AppointmentHistory->sync($s['id_data_sync']) != false){
                        $CI->Mdl_Sync->delete($s['id_sync']);
                    }
                break;

                // ! Sync Products Appointment
                case 'product_appointment':
                    if ($s['action_sync'] == 'add') {
                        if ($CI->Mdl_AppointmentProducts->sync($s['id_data_sync']) != false){
                            $CI->Mdl_Sync->delete($s['id_sync']);
                        }
                    }
                    else{
                        if ($CI->Mdl_AppointmentProducts->deleteSync($s['id_data_sync']) != false){
                            $CI->Mdl_Sync->delete($s['id_sync']);
                        }
                    }
                break;
                
                default:
                    # code...
                    break;
            }
        }

        responder(0, true, 'Sincronización terminada exitosamente');
    }
}