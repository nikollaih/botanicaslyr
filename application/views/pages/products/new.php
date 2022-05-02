<?php
	$this->load->view('templates/header.php');
	$this->load->view('templates/top-bar.php');
	$this->load->view('templates/right-bar.php');
	$this->load->view('templates/navigation.php');
	$date_format = "m/d/Y";
	$time_format = "H:i";
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
		<div class="col-lg-6 align-self-center ">
		  <h2>Nuevo producto</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item"><a href="<?php echo product_list_link() ?>">Productos</a></li>
				<li class="breadcrumb-item active"><?php echo !isset($product['id_producto']) ? 'Nuevo producto' : 'Modificando producto' ?></li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<a href="<?php echo product_list_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-list"></i> Ver productos</a>
		</div>
</div>

<section class="main-content">
	<div style="display: none;" class="alert-form alert alert-dismissible margin-b-30" role="alert"> <strong></strong> <span></span> </div>
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Datos del producto
                    <p>A continuación encontrará la lista de datos necesarios para un nuevo producto, los campos marcados con * son obligatorios.</p>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<div class="row">
						<div class="col-md-12">
                            <?php
                                $this->load->view('pages/products/_form');
                            ?>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
<?php

$this->load->view('templates/footer.php');