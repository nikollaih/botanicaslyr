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
		<div class="col-lg-6 align-self-center ">
		  <h2>Paciente</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item"><a href="<?php echo person_list_link() ?>">Pacientes</a></li>
				<li class="breadcrumb-item active"><?php echo !isset($person['id_persona']) ? 'Agregar paciente' : 'Modificar paciente' ?></li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
			<?php 
				if(isset($person['id_persona'])){
			?>
				<a href="<?php echo appointment_add_link($person['id_persona']) ?>" class="btn btn-primary box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Nueva consulta</a>
			<?php
				}
			?>
			<a href="<?php echo person_list_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Lista de pacientes</a>
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
                    <?php echo !isset($person['id_persona']) ? 'Crear paciente' : 'Datos del paciente' ?>
                    <p>A continuación encontrará la lista de datos necesarios para un paciente, los campos marcados con * son obligatorios.</p>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                    <form id="personForm" method="post" class="form-horizontal" action="#">
                    <input type="hidden" name="id_persona" class="val-null" value="<?php echo isset($person['id_persona']) ? $person['id_persona'] : 'null' ?>">
                    <input data-val="2" type="hidden" class="data-val" name="id_tipo_usuario" value="2">
                    <div class="form-group">
						<label for="id_tipo_docuemnto">Tipo de documento</label>
						<select name="id_tipo_documento" class="form-control required">
							<?php
								isset($person['id_tipo_documento']) ? $doc = $person['id_tipo_documento'] : $doc = '1';
								document_types_options($doc); // dom_helper.php
							?>
						</select>
						<span class="input-error">Este campo es requerido</span>
					</div>

					<div class="form-group">
						<label for="documento">Número de documento *</label>
						<input type="number" class="form-control required" id="documento" name="numero_documento" value="<?php echo isset($person['numero_documento']) ? $person['numero_documento'] : '' ?>" />
						<span class="input-error">Este campo es requerido</span>
					</div>

					<div class="form-group">
						<label for="nombre">Nombre completo *</label>
						<input type="text" class="form-control required" id="nombre" name="nombre_persona" value="<?php echo isset($person['nombre_persona']) ? $person['nombre_persona'] : '' ?>"/>
						<span class="input-error">Este campo es requerido</span>
					</div>

					<!-- <div class="form-group">
						<label for="apellidos">Apellidos persona *</label>
						<input type="text" class="form-control" id="apellidos" name="apellidos_persona" value="<?php echo isset($person['apellidos_persona']) ? $person['apellidos_persona'] : '' ?>"/>
						<span class="input-error">Este campo es requerido</span>
					</div> -->

					<div class="form-group">
						<label for="telefono">Número Celular</label>
						<input type="number" class="form-control" id="telefono" name="telefono_persona" value="<?php echo isset($person['telefono_persona']) ? $person['telefono_persona'] : '' ?>"/>
						<span class="input-error">Este campo es requerido</span>
					</div>

					<!-- <div class="form-group">
						<label for="correo">Correo electronico</label>
						<input type="mail" class="form-control" id="correo" name="correo_persona" value="<?php echo isset($person['correo_persona']) ? $person['correo_persona'] : '' ?>"/>
						<span class="input-error">Este campo es requerido</span>
					</div>

					<div class="form-group">
						<label for="direccion">Dirección</label>
						<input type="text" class="form-control" id="direccion" name="direccion_persona" value="<?php echo isset($person['direccion_persona']) ? $person['direccion_persona'] : '' ?>"/>
					</div> -->

					<!-- <div class="form-group">
						<label for="nacimiento">Fecha de nacimiento *</label>
						<input type="text" class="form-control" id="nacimiento" name="fecha_nacimiento_persona" value="<?php echo isset($person['fecha_nacimiento_persona']) ? date($date_format, strtotime($person['fecha_nacimiento_persona'])) : '' ?>"/>
						<span class="input-error">Este campo es requerido</span>
					</div> -->

					<div class="form-group">
						<label for="peso">Edad</label>
						<input type="number" class="form-control" id="peso" name="peso_persona" value="<?php echo isset($person['peso_persona']) ? $person['peso_persona'] : '' ?>"/>
					</div>

					<!-- <div class="form-group">
						<label for="estatura">Estatura (Mts)</label>
						<input type="number" step="0.1" class="form-control" id="estatura" name="estatura_persona" value="<?php echo isset($person['estatura_persona']) ? $person['estatura_persona'] : '' ?>"/>
					</div> -->

					<div class="form-group">
						<label for="estatura">Acudiente y parentesco</label>
						<input type="text" class="form-control" id="acudiente" name="acudiente_persona" value="<?php echo isset($person['acudiente_persona']) ? $person['acudiente_persona'] : '' ?>"/>
					</div>

					<div class="form-group text-right">
						<hr>
						<a href="<?php echo base_url() ?>" class="btn btn-default btn-icon"><i class="fa fa-times"></i> Cancelar</a>
						<a class="btn btn-primary btn-icon" id="save-patient"><i class="fa fa-save"></i> Guardar</a>
					</div>
				</form>
                </div>
            </div>
        </div>
    </div>
<?php

$this->load->view('templates/footer.php');