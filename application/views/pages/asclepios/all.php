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
		  <h2>Asclepios</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item active">Lista de asclepios</li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo asclepio_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agregar asclepios</a>
		</div>
</div>

<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de asclepios
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<table id="asclepios-list" class="table responsive">
                		<thead>
                			<tr>
                				<td>Titulo</td>
								<td>Descripción</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($asclepios != false) {
                					foreach ($asclepios as $a) {
?>
										<tr>
											<td style="width: 400px;"><span id="<?php echo $a['id_asclepio'] ?>"><?php echo $a['titulo_asclepio'] ?></span></td>
											<td><?php echo $a["descripcion_asclepio"] ?></td>
											<td class="text-center">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  	<a target="self" href="<?php echo asclepio_update_link($a['id_asclepio']) ?>" class="btn btn-xs btn-warning">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-pencil"></i> Modificar
												  	</a>
												  	<a a-id="<?php echo $a['id_asclepio'] ?>" class="btn btn-xs btn-danger btn-delete-asclepio">
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