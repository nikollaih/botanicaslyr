<?php
	$this->load->view('templates/header.php');
	$this->load->view('templates/top-bar.php');
	$this->load->view('templates/right-bar.php');
	$this->load->view('templates/navigation.php');

	$date_format = "d M, Y";
	$time_format = "h:i a";
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
		<div class="col-lg-6 align-self-center ">
		  <h2>Escritorio</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="">Inicio</a></li>
				<li class="breadcrumb-item active">Escritorio</li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo appointment_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agendar cita</a>
		</div>
</div>

<section class="main-content">
    <div class="row ">

		<div class="col-md-6 col-lg-4 col-xlg-2">
			<a href="<?php echo person_list_link() ?>">
				<div class="widget card-info">
					<div class="box bg-info text-center">
						<h1 class="font-light text-white"><?php echo count_patients(); ?></h1>
						<h6 class="text-white">Pacientes</h6>
					</div>
				</div>
			</a>
		</div>

		<div class="col-md-6 col-lg-4 col-xlg-2">
			<a href="<?php echo product_list_link() ?>">
				<div class="widget card-danger">
					<div class="box bg-danger text-center">
						<h1 class="font-light text-white"><?php echo count_products() ?></h1>
						<h6 class="text-white">Productos</h6>
					</div>
				</div>
			</a>
		</div>
		
        <div class="col-md-6 col-lg-4 col-xlg-2">
			<a href="<?php echo appointment_list_link() ?>">
				<div class="widget card-warning">
					<div class="box bg-warning text-center">
						<h1 class="font-light text-white"><?php echo count_appointments(); ?></h1>
						<h6 class="text-white">Consultas</h6>
					</div>
				</div>
			</a>
		</div>

		<div class="col-md-6 col-lg-4 col-xlg-2">
			<a href="<?php echo schedule_list_link() ?>">
				<div class="widget card-success">
					<div class="box bg-success text-center">
						<h1 class="font-light text-white"><?php echo count_shedules(); ?></h1>
						<h6 class="text-white">Agendas</h6>
					</div>
				</div>
			</a>
		</div>

		<div class="col-md-6 col-lg-4 col-xlg-2">
			<a href="<?php echo recipe_list_link() ?>">
				<div class="widget card-primary">
					<div class="box bg-primary text-center">
						<h1 class="font-light text-white"><?php echo count_recipes(); ?></h1>
						<h6 class="text-white">Recetarios</h6>
					</div>
				</div>
			</a>
		</div>

		<div class="col-md-6 col-lg-4 col-xlg-2">
			<a href="<?php echo invoice_list_link() ?>">
				<div class="widget card-indigo">
					<div class="box bg-indigo text-center">
						<h1 class="font-light text-white"><?php echo count_invoices(); ?></h1>
						<h6 class="text-white">Facturas</h6>
					</div>
				</div>
			</a>
		</div>
    </div>

    <div class="row w-no-padding margin-b-30" style="box-shadow: 0 0 0;">
		<div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de pacientes
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<!-- <table id="appointments-list" class="table responsive">
                		<thead>
                			<tr>
                				<td>Documento</td>
                				<td>Paciente</td>
                				<td>Hora</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
								$ap = appointmentsDay(date('Y-m-d'));
                				if ($ap != false) {
                					foreach ($ap as $a) {
                						$a_full_date = explode(' ', $a['fecha_hora_consulta']);
										$a_date = date($date_format, strtotime($a_full_date[0]));
										$a_time = date($time_format, strtotime($a_full_date[1]));
?>
										<tr>
											<td><span id="<?php echo $a['id_consulta'] ?>"><?php echo $a['numero_documento'] ?></span></td>
											<td>
												<?php echo $a['nombre_persona'].' '.$a['apellidos_persona'] ?>
												<br>
												<span style="color: #29a7d8;"><i class="fa fa-phone"></i> <?php echo $a['telefono_persona'] ?> </span>
											</td>
											<td><?php echo $a_time ?></td>
											<td class="text-center">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
													<a target="self" href="<?php echo appointment_show_link($a['id_consulta']) ?>" class="btn btn-xs btn-info">
												    	<input type="radio" name="options" id="option2" autocomplete="off">
												    	<i class="fa fa-eye"></i> Ver
												  	</a>
												  	<a target="self" href="<?php echo appointment_update_link($a['id_consulta']) ?>" class="btn btn-xs btn-warning">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-pencil"></i> Modificar
												  	</a>
												</div>
											</td>
										</tr>
<?php
                					}
                				}
?>
                		</tbody>
					</table> -->
					<table id="persons-list" class="table table-striped nowrap dataTable no-footer dtr-inline">
                		<thead>
                			<tr>
                				<td>Documento</td>
                				<td>Nombre</td>
                				<td>Edad</td>
                				<td>Tel&eacute;fono</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($persons != false) {
                					foreach ($persons as $p) {
?>
										<tr>
											<td><span id="<?php echo $p['id_persona'] ?>"><?php echo $p['numero_documento'] ?></span></td>
											<td>
												<img alt="user" class="media-box-object rounded-circle mr-2" src="<?php echo base_url() ?>assets/img/avtar-<?php echo $p['genero_persona'] ?>.png" width="30"> 
												<?php echo $p['nombre_persona'].' '.$p['apellidos_persona'] ?>
											</td>
											<td><?php echo $p['peso_persona'] ?></td>
											<td><?php echo $p['telefono_persona'] ?></td>
											<td class="text-center">
												<a title="Agregar consulta" href="<?php echo appointment_add_link($p['id_persona']) ?>" target="blank">
													<button type="button" class="btn btn-sm btn-success"><i class="fa fa-folder"></i></button>
												</a>
												<a title="Agregar factura" href="<?php echo invoice_add_link($p['id_persona']) ?>" target="blank">
													<button type="button" class="btn btn-sm btn-danger"><i class="fa fa-dollar"></i></button>
												</a>
												<a title="Ver paciente" href="<?php echo person_profile_link($p['id_persona']) ?>">
												<button type="button" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
												</a>
												<a title="Modificar paciente" target="self" href="<?php echo person_modify_link($p['id_persona']) ?>">
													<button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
												</a>
												<button title="Eliminar paciente" p-id="<?php echo $p['id_persona'] ?>" type="button" class="btn btn-sm btn-danger btn-delete-person"><i class="fa fa-trash"></i></button>
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