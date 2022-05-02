<?php
	$this->load->view('templates/header.php');
	$this->load->view('templates/top-bar.php');
	$this->load->view('templates/right-bar.php');
	$this->load->view('templates/navigation.php');
	$date_format = "m/d/Y";
	$time_format = "H:i";

	if (isset($appointment['fecha_hora_consulta'])) {
		$a_full_date = explode(' ', $appointment['fecha_hora_consulta']);
		$a_date = date($date_format, strtotime($a_full_date[0]));
		$a_time = date($time_format, strtotime($a_full_date[1]));
	}

	$this->load->view('modals/appointment_persons');
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
	<div class="col-lg-6 align-self-center ">
		<h2>Consulta</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
			<li class="breadcrumb-item"><a href="<?php echo appointment_list_link() ?>">Consultas</a></li>
			<li class="breadcrumb-item active"><?php echo !isset($appointment['id_persona']) ? 'Nueva consulta' : 'Modificando consulta' ?></li>
		</ol>
	</div>
	<div class="col-lg-6 align-self-center text-right">
		<a href="<?php echo appointment_list_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-list"></i> Lista de consultas</a>
	</div>
</div>

<section class="main-content">
	<div style="display: none;" class="alert-form alert alert-dismissible margin-b-30" role="alert"> <strong></strong> <span></span> </div>
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    <?php echo !isset($appointment['id_persona']) ? 'Nueva consulta' : 'Datos de la consulta' ?>
                    <p>A continuación encontrará la lista de datos necesarios para una consulta, los campos marcados con * son obligatorios.</p>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<div class="row">
                		<div class="col-md-3"></div>
                		<div class="col-md-6">
                			<div class="form-group">
		                        <label>Documento ó nombre del paciente</label>
		                        <div class="input-group m-b">
		                            <input id="pat-id" type="text" class="form-control" value="<?php echo isset($appointment['numero_documento']) ? $appointment['numero_documento'] : '' ?>">
		                            <span class="input-group-btn">
		                                <button data-call="" id="search-patient" type="button" class="btn btn-default">Buscar</button>
		                            </span>
		                        </div>
		                    </div>
                		</div>
                		<div class="col-md-12">
                			<hr class="margin-b-30">
                		</div>
                	</div> 
                	<div class="row">
						<div class="col-md-6">
							<h4 class="subtitle-text margin-b-20">Datos del paciente</h4>	
							<div class="<?php echo isset($appointment['numero_documento']) ? 'hide' : '' ?> alert bg-info alert-dismissible response-patient" role="alert"><strong>Nota!</strong> <span>La información del paciente será cargada al buscarlo por el número de documento </span></div>

							<table class="table <?php echo isset($appointment['numero_documento']) ? '' : 'hide' ?>">
								<tr>
									<td>
										<strong>Nombres</strong>
									</td>
									<td id="p-name"><?php echo $appointment['nombre_persona'] ?></td>
								</tr>
								<tr>
									<td>
										<strong>Apellidos</strong>
									</td>
									<td id="p-last-name"><?php echo $appointment['apellidos_persona'] ?></td>
								</tr>
								<tr>
									<td>
										<strong>Teléfono</strong>
									</td>
									<td id="p-phone"><?php echo $appointment['telefono_persona'] ?></td>
								</tr>
								<tr>
									<td>
										<strong>Correo</strong>
									</td>
									<td id="p-email"><?php echo $appointment['correo_persona'] ?></td>
								</tr>
								<tr>
									<td>
										<strong>Dirección</strong>
									</td>
									<td id="p-address"><?php echo $appointment['direccion_persona'] ?></td>
								</tr>
							</table>
						</div>
						<form id="appointmentForm" method="post" class="form-horizontal col-md-6" action="#">
	                    	<h4 class="subtitle-text margin-b-20">Datos de la consulta</h4>
		                    <input type="hidden" id="p-person" name="id_persona" class="val-null" value="<?php echo isset($appointment['id_persona']) ? $appointment['id_persona'] : 'null' ?>">
		                    <input type="hidden" value="<?php echo isset($appointment['id_consulta']) ? $appointment['id_consulta'] : 'null' ?>" name="id_consulta">

							<div class="form-group">
								<label for="nacimiento">Fecha de la consulta *</label>
								<input type="text" class="form-control date-picker required" id="nacimiento" name="fecha_consulta" value="<?php echo isset($appointment['fecha_hora_consulta']) ? $a_date : date($date_format) ?>"/>
								<span class="input-error">Este campo es requerido</span>
							</div>

							<div class="form-group">
								<label for="nacimiento">Hora de la consulta *</label>
								<input type="text" class="form-control hour-picker required" id="nacimiento" name="hora_consulta" value="<?php echo isset($appointment['fecha_hora_consulta']) ? $a_time : date($time_format) ?>"/>
								<span class="input-error">Este campo es requerido</span>
							</div>

							<div class="form-group">
								<label for="nacimiento">Valor de la consulta</label>
								<input type="number" class="form-control" id="nacimiento" name="valor_consulta" value="<?php echo isset($appointment['valor_consulta']) ? $appointment['valor_consulta'] : '0' ?>"/>
								<span class="input-error">Este campo es requerido</span>
							</div>

							<div class="form-group text-right">
								<hr>
								<a href="<?php echo base_url() ?>" class="btn btn-default btn-icon"><i class="fa fa-times"></i> Cancelar</a>
								<a class="btn btn-primary btn-icon" id="save-appointment"><i class="fa fa-save"></i> Guardar</a>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
<?php

$this->load->view('templates/footer.php');