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
		  <h2>Consultas</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item active">Lista de consultas</li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo appointment_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agregar consulta</a>
		</div>
</div>

<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de consultas (<?php echo count($appointments) ?>)
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<table id="appointments-list" class="table responsive">
                		<thead>
                			<tr>
                				<td>Documento</td>
                				<td>Paciente</td>
                				<td>Fecha</td>
                				<td>Hora</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($appointments != false) {
                					foreach ($appointments as $a) {
                						$a_full_date = explode(' ', $a['fecha_hora_consulta']);
										$a_date = date($date_format, strtotime($a_full_date[0]));
										$a_time = date($time_format, strtotime($a_full_date[1]));
?>
										<tr>
											<td><span id="<?php echo $a['id_consulta'] ?>"><?php echo $a['numero_documento'] ?></span></td>
											<td><?php echo $a['nombre_persona'].' '.$a['apellidos_persona'] ?></td>
											<td><?php echo $a_date ?></td>
											<td><?php echo $a_time ?></td>
											<td class="text-center">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
													<a href="<?php echo appointment_show_link($a['id_consulta']) ?>" class="btn btn-xs btn-info">
												    	<input type="radio" name="options" id="option2" autocomplete="off">
												    	<i class="fa fa-eye"></i> Ver
												  	</a>
												  	<a target="self" href="<?php echo appointment_update_link($a['id_consulta']) ?>" class="btn btn-xs btn-warning">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-pencil"></i> Modificar
												  	</a>
												  	<a a-id="<?php echo $a['id_consulta'] ?>" class="btn btn-xs btn-danger btn-delete-appointment">
												   		<input type="radio" name="options" id="option3" autocomplete="off"> 
												   		<i class="fa fa-trash"></i> Eliminar
												  	</a>
												</div>
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