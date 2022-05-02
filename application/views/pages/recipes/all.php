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
		  <h2>Recetarios</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item active">Lista de recetarios</li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo recipe_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agregar recetario</a>
		</div>
</div>

<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de recetarios
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<table id="recipe-list" class="table responsive">
                		<thead>
                			<tr>
                				<td>Paciente</td>
								<td>Fecha</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($recipes != false) {
                					foreach ($recipes as $r) {
?>
										<tr>
											<td style="width: 400px;"><span id="<?php echo $r['id_recetario'] ?>"><?php echo $r['paciente_recetario'] ?></span></td>
											<td><?php echo date('d M, Y', strtotime($r['fecha_recetario'])) ?></td>
											<td class="text-center">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
													<a target="_blank" href="<?php echo recipe_file_link($r['id_recetario']) ?>" class="btn btn-xs btn-info">
															<input type="radio" name="options" id="option1" autocomplete="off" checked> 
															<i class="fa fa-file"></i> Imprimir
													</a>
												  	<a target="self" href="<?php echo recipe_update_link($r['id_recetario']) ?>" class="btn btn-xs btn-warning">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-pencil"></i> Modificar
												  	</a>
												  	<a r-id="<?php echo $r['id_recetario'] ?>" class="btn btn-xs btn-danger btn-delete-recipe">
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