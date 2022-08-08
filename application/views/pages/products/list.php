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
		  <h2>Productos</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item active">Lista de productos</li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo product_add_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Agregar producto</a>
		</div>
</div>

<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Lista de productos
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<table id="products-list" class="table responsive">
                		<thead>
                			<tr>
								<td></td>
                				<td style="width: 180px">Nombre</td>
								<td style="width: 180px">Ref.</td>
                				<td>Precio</td>
                				<td>Stock</td>
                				<td>Estado</td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
<?php
                				if ($products != false) {
                					foreach ($products as $p) {
?>
										<tr>
											<td class="text-center">
												<img width="50px" src="<?php echo product_image_src($p['id_producto'], $p['imagen_producto']) ?>" alt="">
											</td>
											<td><span id="<?php echo $p['id_producto'] ?>"><?php echo $p['nombre_producto'] ?></span></td>
											<td><?php echo $p['referencia_producto'] ?></td>
											<td>$<?php echo number_format($p['precio_producto'], 0, ',', '.') ?></td>
											<td><?php echo $p['stock_producto'] ?></td>
											<td><?php echo $p['descripcion_estado_productos'] ?></td>
											<td class="text-center">
												<div class="btn-group btn-group-toggle" data-toggle="buttons">
												  	<a target="self" href="<?php echo product_update_link($p['id_producto']) ?>" class="btn btn-xs btn-warning">
												    	<input type="radio" name="options" id="option1" autocomplete="off" checked> 
												    	<i class="fa fa-pencil"></i> Modificar
												  	</a>
												  	<a p-id="<?php echo $p['id_producto'] ?>" class="btn btn-xs btn-danger btn-delete-product">
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