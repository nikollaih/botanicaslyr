<?php
	$this->load->view('templates/header.php');
	$this->load->view('templates/top-bar.php');
	$this->load->view('templates/right-bar.php');
	$this->load->view('templates/navigation.php');
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="page-header">
    <div class="row">
        <div class="col-lg-6 col-md-12 align-self-center ">
        <h2>Asclepio</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo asclepio_list_link(false) ?>">Asclepios</a></li>
                <li class="breadcrumb-item active"><?php echo !isset($asclepio['id_asclepio']) ? 'Nuevo asclepio' : 'Modificar asclepio' ?></li>
            </ol>
        </div>
        <div class="col-lg-6 col-md-12 align-self-center text-right">
            <a href="<?php echo asclepio_list_link(true) ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Ver asclepios</a>
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
                    <?php echo !isset($asclepio['id_asclepio']) ? 'Nuevo asclepio' : 'Datos del asclepio' ?>
                    <p>A continuaci&oacute;n encontrar&aacute; la lista de datos necesarios para un nuevo asclepio, los campos marcados con * son obligatorios.</p>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                    <form id="" method="post" class="form-horizontal" action="<?php echo base_url() ?>Asclepios/save">
                        <input type="hidden" id="id-asclepio" name="id_asclepio" class="val-null" value="<?php echo isset($asclepio['id_asclepio']) ? $asclepio['id_asclepio'] : 'null' ?>">
                        <div class="form-group">
                            <label for="nombre">Titulo asclepio</label>
                            <input type="text" class="form-control required" id="nombre" name="titulo_asclepio" value="<?php echo isset($asclepio['titulo_asclepio']) ? $asclepio['titulo_asclepio'] : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div>

                        <div class="form-group">
                            <label for="text">Descripción del asclepio</label>
                            <textarea rows="10" name="descripcion_asclepio" class="summernote"><?php
                                    if (isset($asclepio['descripcion_asclepio'])) {
                                        echo $asclepio['descripcion_asclepio'];
                                    }
                            ?></textarea>
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
</section>

<!-- Wysihtml5 and Summernote -->
<link href="<?php echo base_url() ?>assets/lib/wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/lib/summernote/summernote.css" rel="stylesheet">

<?php
$this->load->view('templates/footer.php');