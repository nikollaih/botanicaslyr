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
		  <h2>Facturas</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item active">Lista de facturas</li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo invoice_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agregar factura</a>
		</div>
</div>

<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de facturas
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<table id="invoice-list" class="table responsive">
                		<thead>
                			<tr>
                				<td>Paciente</td>
								<td>Fecha</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($inv != false) {
                					foreach ($inv as $i) {
?>
										<tr>
											<td><span id="<?php echo $i['id_factura'] ?>"><?php echo $i['paciente_factura'] ?></span></td>
											<td><?php echo date('d M, Y', strtotime($i['fecha_factura'])) ?></td>
											<td class="text-center">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
													<a target="_blank" href="<?php echo invoice_file_link($i['id_factura']) ?>" class="btn btn-xs btn-primary">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-file"></i> Imprimir
												  	</a>
													<a target="self" href="<?php echo invoice_update_link($i['id_factura']) ?>" class="btn btn-xs btn-warning">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-pencil"></i> Modificar
												  	</a>
												  	<a i-id="<?php echo $i['id_factura'] ?>" class="btn btn-xs btn-danger btn-delete-invoice">
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