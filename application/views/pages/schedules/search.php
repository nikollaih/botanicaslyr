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
                    Lista de pacientes
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<table id="persons-list" class="table table-striped nowrap dataTable no-footer dtr-inline">
                		<thead>
                			<tr>
                				<td>Paciente</td>
                				<td>Fecha</td>
                				<td>Estado</td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($search != false) {
                					foreach ($search as $s) {
?>
										<tr>
											<td><span id="<?php echo $s['id_agenda'] ?>"><?php echo $s['paciente_agenda'] ?></span></td>
											<td><?php echo date('d M, Y - h:ia', strtotime($s['fecha_hora_agenda'])) ?></td>
											<td><?php echo $s['descripcion_estado_consulta'] ?></td>
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