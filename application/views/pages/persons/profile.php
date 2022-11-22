<?php
$this->load->view('templates/header.php');
$this->load->view('templates/top-bar.php');
$this->load->view('templates/right-bar.php');
$this->load->view('templates/navigation.php');
$date_format = "d M, Y";
$time_format = "H:i a";
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
		<div class="col-lg-6 align-self-center ">
		  <h2>Perfil</h2>
			<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo person_list_link(true) ?>">Pacientes</a></li>
				<li class="breadcrumb-item active"><?php echo $person['nombre_persona'].' '.$person['apellidos_persona'] ?></li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
            <a href="<?php echo appointment_add_link($person['id_persona']) ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-folder"></i> Agregar consulta</a>
			<a href="<?php echo person_modify_link($person['id_persona']) ?>" class="btn btn-warning box-shadow btn-icon btn-rounded"><i class="fa fa-pencil"></i> Editar paciente</a>
		</div>
</div>

<section class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class='widget white-bg friends-group clearfix'>
                <div class="padding-20 text-center">
                    <p class="lead font-500 margin-b-0"><?php echo $person['nombre_persona'].' '.$person['apellidos_persona'] ?></p>
                    <hr>
                </div>
                <div class="row person-container">
                    <div class="col-md-3 col-sm-12">
                        <i class="fa fa-credit-card"></i><br>
                        <label><?php echo $person['descripcion_tipo_documento'] ?></label><br>
                        <?php echo $person['numero_documento'] ?>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <i class="fa fa-phone"></i><br>
                        <label for="">Teléfono</label><br>
                        <?php echo $person['telefono_persona'] ?>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <i class="fa fa-gift"></i><br>
                        <label for="">Edad</label><br>
                        <?php echo $person['peso_persona'] ?>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <i class="fa fa-user"></i><br>
                        <label for="">Acudiente</label><br>
                        <?php echo $person['acudiente_persona'] ?>
                    </div>
                </div>
                <table class="table browser no-border">
                    <tbody>
                        <!-- <tr>
                            <td class="text-center"><i class="fa fa-gift"></i></td>
                            <td>Fecha de nacimiento<br><?php echo ($person['fecha_nacimiento_persona']); ?></td>
                        </tr> 
                        <tr>
                            <td class="text-center"><i class="fa fa-phone"></i></td>
                            <td>Teléfono<br><?php echo $person['telefono_persona'] ?></td>
                        </tr>
                         <tr>
                            <td class="text-center"><i class="fa fa-envelope"></i></td>
                            <td>Correo electronico<br><?php echo $person['correo_persona'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fa fa-map-marker"></i></td>
                            <td>Dirección<br><?php echo $person['direccion_persona'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fa fa-gift"></i></td>
                            <td>Edad<br><?php echo $person['peso_persona']; ?></td>
                        </tr> 
                        <tr>
                            <td class="text-center"><i class="fa fa-user"></i></td>
                            <td>Acudiente<br><?php echo $person['acudiente_persona']; ?></td>
                        </tr> 
                         <tr>
                            <td class="text-center"><i class="fa fa-balance-scale"></i></td>
                            <td>Peso<br><?php echo $person['peso_persona']; ?> Kg</td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fa fa-child"></i></td>
                            <td>Estatura<br><?php echo $person['estatura_persona']; ?> Mts</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Historia clínica
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                    <h5>Alergias</h5>
                    <div class="container-historia-clinica">
                        <?= (is_array($historiaClinica)) ? $historiaClinica["alergias"] : "" ?>
                    </div>

                    <h5>Medicamentos que consume</h5>
                    <div class="container-historia-clinica">
                        <?= (is_array($historiaClinica)) ? $historiaClinica["medicamentos"] : "" ?>
                    </div>


                    <h5>Motivo de consulta</h5>
                    <div class="container-historia-clinica">
                        <?= (is_array($historiaClinica)) ? $historiaClinica["motivo_consulta"] : "" ?>
                    </div>

                    <h5>Factores de riesgo y antecedentes</h5>
                    <div class="container-historia-clinica">
                        <?= (is_array($historiaClinica)) ? $historiaClinica["factores_riesgo"] : "" ?>
                    </div>

                    <h5>signos vitales</h5>
                    <div class="container-historia-clinica">
                        <label style="margin-bottom:0;"> <strong>Saturación: </strong> <?= (is_array($historiaClinica)) ? $historiaClinica["saturacion"] : "" ?></label><br>
                        <label style="margin-bottom:0;"> <strong>Frecuencia Cardiaca: </strong> <?= (is_array($historiaClinica)) ? $historiaClinica["frecuencia_cardiaca"] : "" ?></label><br>
                        <label style="margin-bottom:0;"> <strong>Frecuencia Respiratoria: </strong> <?= (is_array($historiaClinica)) ? $historiaClinica["frecuencia_respiratoria"] : "" ?></label><br>
                        <label style="margin-bottom:0;"> <strong>Tensión Arterial: </strong> <?= (is_array($historiaClinica)) ? $historiaClinica["tension_arterial"] : "" ?></label><br>
                        <label style="margin-bottom:0;"> <strong>Temperatura: </strong> <?= (is_array($historiaClinica)) ? $historiaClinica["temperatura"] : "" ?></label><br>
                        <label style="margin-bottom:0;"> <strong>Dolor EVA: </strong> <?= (is_array($historiaClinica)) ? $historiaClinica["dolor_eva"] : "" ?></label><br>
                    </div>

                    <h5>I.D.D.</h5>
                    <div class="container-historia-clinica">
                        <?= (is_array($historiaClinica)) ? $historiaClinica["idd"] : "" ?>
                    </div>

                    <h5>Análisis, plan de manejo y recomendaciones generales</h5>
                    <div class="container-historia-clinica">
                        <?= (is_array($historiaClinica)) ? $historiaClinica["analisis_manejo_recomendaciones"] : "" ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Consultas del paciente
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                    <table id="patient-appointment" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Fecha</td>
                                <td>Hora</td>
                                <td>Recetario</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($appointments != false){
                                    foreach ($appointments as $a) {
                                        $a_full_date = explode(' ', $a['fecha_hora_consulta']);
										$a_date = date($date_format, strtotime($a_full_date[0]));
                                        $a_time = date($time_format, strtotime($a_full_date[1]));
                            ?>
                                        <tr>
                                            <td><?php echo $a_date ?></td>
                                            <td><?php echo $a_time ?></td>
                                            <td><?php echo strip_tags($a['detalles_recetario']) ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo appointment_show_link($a['id_consulta']) ?>">
												    <button style="width:40px" type="button" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
												</a>
                                                <?php 
                                                    if($a['id_factura'] != "" && $a['id_factura'] != null){
                                                ?>
                                                    <a href="<?php echo invoice_update_link($a['id_factura']) ?>">
                                                        <button style="width:40px;margin-top:5px" type="button" class="btn btn-sm btn-danger"><i class="fa fa-dollar"></i></button>
                                                    </a>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <a href="<?php echo invoice_add_link($a['id_persona'], $a['id_consulta']) ?>">
                                                            <button style="width:40px;" type="button" class="btn btn-sm btn-danger"><i class="fa fa-dollar"></i></button>
                                                        </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php

$this->load->view('templates/footer.php');