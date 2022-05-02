<?php
$this->load->view('templates/header.php');
$this->load->view('templates/top-bar.php');
$this->load->view('templates/right-bar.php');
$this->load->view('templates/navigation.php');
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
	<div class="col-lg-6 align-self-center ">
		<h2>Pacientes</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="">Inicio</a></li>
			<li class="breadcrumb-item active">Lista de pacientes</li>
		</ol>
	</div>
	<div class="col-lg-6 align-self-center text-right">
		<a href="<?php echo person_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agregar paciente</a>
	</div>
</div>

<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de pacientes (<?php echo count($persons) ?>)
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
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