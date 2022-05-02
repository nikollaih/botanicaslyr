<?php
	$this->load->view('templates/header.php');
	$this->load->view('templates/top-bar.php');
	$this->load->view('templates/right-bar.php');
	$this->load->view('templates/navigation.php');
	$date_format = "m/d/Y";
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
        <div class="row">
            <div class="col-lg-6 col-md-12 align-self-center ">
            <h2>Recetario</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo recipe_list_link(true) ?>">Recetarios</a></li>
                    <li class="breadcrumb-item active"><?php echo !isset($recipe['id_recetario']) ? 'Nuevo recetario' : 'Modificar recetario' ?></li>
                </ol>
            </div>
            <div class="col-lg-6 col-md-12 align-self-center text-right">
                <?php 
                    if (isset($recipe['id_recetario'])) {
                ?>
                    <a href="<?php echo recipe_file_link($recipe['id_recetario']) ?>" target="blank" class="btn btn-info box-shadow btn-icon btn-rounded"><i class="fa fa-file"></i> Imprimir</a>
                <?php
                    }
                ?>
                <a href="<?php echo recipe_list_link(true) ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Ver recetarios</a>
            </div>
        </div>
</div>

<section class="main-content">
    <?php
        if (($this->session->flashdata('type'))) {
    ?>
            <div class="alert-form alert alert-dismissible margin-b-30 <?php echo $this->session->flashdata('type') ?>" role="alert"> <strong><?php echo $this->session->flashdata('title') ?></strong> <span><?php echo $this->session->flashdata('text') ?></span> </div>
    <?php
        }
    ?>
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    <?php echo !isset($recipe['id_recetario']) ? 'Nuevo recetario' : 'Datos del recetario' ?>
                    <p>A continuaci&oacute;n encontrar&aacute; la lista de datos necesarios para un nuevo recetario, los campos marcados con * son obligatorios.</p>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                    <form id="" method="post" class="form-horizontal" action="<?php echo base_url() ?>Recipes/save">
                        <input type="hidden" id="id-recetario" name="id_recetario" class="val-null" value="<?php echo isset($recipe['id_recetario']) ? $recipe['id_recetario'] : 'null' ?>">
                        <input type="hidden" id="id-consulta" name="id_consulta" value="<?php echo isset($recipe['id_consulta']) ? $recipe['id_consulta'] : 'null' ?>">

                        <div class="form-group">
                            <label for="nombre">Nombre paciente</label>
                            <input type="text" class="form-control required" id="nombre" name="paciente_recetario" value="<?php echo isset($recipe['paciente_recetario']) ? $recipe['paciente_recetario'] : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div>

                        <div class="form-group">
                            <label for="correo">Fecha recetario</label>
                            <input type="text" class="form-control date-picker" id="fecha" name="fecha_recetario" value="<?php echo isset($recipe['fecha_recetario']) ? date($date_format, strtotime($recipe['fecha_recetario'])) : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div>

                        <div class="form-group">
                            <label for="text">Descripción del recetario</label>
                            <textarea name="texto_recetario" class="summernote"><?php
                                    if (isset($recipe['texto_recetario'])) {
                                        echo $recipe['texto_recetario'];
                                    }
                            ?></textarea>
                        </div>

                        <div class="form-group">
                            <label><strong>Agregar medicamento</strong></label>     
                            <div class="input-group recipe-product">
                                <input id="input-search-products" type="text" class="form-control" placeholder="Nombre del producto o referencia">
                                <span class="input-group-btn">
                                    <button id="btn-search-products" type="button" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <label><strong>Lista de productos encontrados</strong></label><br>
                                <!-- <em class="text-muted">Los campos en las casillas <mark>Precio</mark> y <mark>Cantidad</mark> pueden ser modificados antes de ser agregados a la lista de productos del recetario.</em> -->
                                <table id="search-products" class="table table-striped table-input">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <hr>
                            <a href="<?php echo base_url() ?>" class="btn btn-default btn-icon"><i class="fa fa-times"></i> Cancelar</a>
                            <button class="btn btn-primary btn-icon"><i class="fa fa-save"></i>Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Wysihtml5 and Summernote -->
<link href="<?php echo base_url() ?>assets/lib/wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/lib/summernote/summernote.css" rel="stylesheet">

<?php
$this->load->view('templates/footer.php');