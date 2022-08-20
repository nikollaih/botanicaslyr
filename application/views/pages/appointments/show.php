<?php
$this->load->view('templates/header.php');
$this->load->view('templates/top-bar.php');
$this->load->view('templates/right-bar.php');
$this->load->view('templates/navigation.php');
$this->load->view('modals/asclepios');
$date_format = "d M, Y";
$time_format = "H:i a";
?>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
		<div class="col-lg-4 align-self-center ">
		  <h2>Consulta Gerontológica</h2>
			<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo appointment_list_link() ?>">Consultas</a></li>
				<li class="breadcrumb-item active"><?php echo $person['nombre_persona'].' '.$person['apellidos_persona'] ?></li>
			</ol>
		</div>
		<div class="col-lg-8 align-self-center text-right">
            <h4>$ <?php echo number_format($ap['valor_consulta'],0,',','.') ?></h4>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card margin-b-30 ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h4><i class="fa fa-calendar"></i> <?php echo date('d M, Y', strtotime($ap['fecha_hora_consulta'])) ?></h4>
                            <h4><i class="fa fa-clock-o"></i> <?php echo date('h:i a', strtotime($ap['fecha_hora_consulta'])) ?></h4>
                        </div>
                        <div class="col-md-9 text-right">
                            <!-- <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-icon dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file"></i> Generar factura <span class="caret"></span></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <li class="dropdown-item"><a target="_blank" href="<?php echo invoice_general_link($ap['id_consulta']) ?>">General</a></li>
                                    <li class="dropdown-item"><a target="_blank" href="<?php echo invoice_appointment_link($ap['id_consulta']) ?>">Consulta</a></li>
                                    <li class="dropdown-item"><a target="_blank" href="<?php echo invoice_products_link($ap['id_consulta']) ?>">Recetario</a></li>
                                </ul>
                            </div> -->
                            <?php
                                if($ap['id_factura'] != "" && $ap['id_factura'] != null){
                            ?>
                                <a href="<?php echo invoice_update_link($ap['id_factura']) ?>" target="_blank" class="btn box-shadow btn-rounded btn-danger btn-icon"><i class="fa fa-dollar"></i> Ver factura</a>
                            <?php
                                }
                                else{
                            ?>
                                <a href="<?php echo invoice_add_link($ap['id_persona']) ?>" target="_blank" class="btn box-shadow btn-rounded btn-danger btn-icon"><i class="fa fa-dollar"></i> Generar factura</a>
                            <?php
                                }
                            ?>
                            <a href="<?php echo recipe_book_products_link($ap['id_consulta']) ?>" target="_blank" class="btn box-shadow btn-rounded btn-info btn-icon"><i class="fa fa-list"></i> Imprimir recetario</a>
                            <a href="<?php echo evolution_link($ap['id_consulta']) ?>" target="_blank" class="btn box-shadow btn-rounded btn-success btn-icon"><i class="fa fa-list"></i> Imprimir evolucion</a>
                            <a href="<?php echo historia_clinica_link($ap['id_persona']) ?>" target="_blank" class="btn box-shadow btn-rounded btn-warning btn-icon"><i class="fa fa-list"></i> Imprimir Historia Clínica</a>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class='widget white-bg friends-group clearfix'>
                        <div class="padding-20 text-center">
                            <p class="lead font-500 margin-b-0"><?php echo $person['nombre_persona'].' '.$person['apellidos_persona'] ?></p>
                            <hr>
                        </div>
                        <table class="table browser no-border">
                             <tbody>
                        <tr>
                            <td class="text-center"><i class="fa fa-credit-card"></i></td>
                            <td>Tipo Documento<br><?php echo $person['descripcion_tipo_documento'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fa fa-credit-card"></i></td>
                            <td>Número documento<br><?php echo $person['numero_documento'] ?></td>
                        </tr>
                        <!-- <tr>
                            <td class="text-center"><i class="fa fa-gift"></i></td>
                            <td>Fecha de nacimiento<br><?php echo ($person['fecha_nacimiento_persona']); ?></td>
                        </tr> -->
                        <tr>
                            <td class="text-center"><i class="fa fa-phone"></i></td>
                            <td>Teléfono<br><?php echo $person['telefono_persona'] ?></td>
                        </tr>
                        <!-- <tr>
                            <td class="text-center"><i class="fa fa-envelope"></i></td>
                            <td>Correo electronico<br><?php echo $person['correo_persona'] ?></td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fa fa-map-marker"></i></td>
                            <td>Dirección<br><?php echo $person['direccion_persona'] ?></td>
                        </tr>-->
                        <tr>
                            <td class="text-center"><i class="fa fa-gift"></i></td>
                            <td>Edad<br><?php echo $person['peso_persona']; ?></td>
                        </tr> 
                        <tr>
                            <td class="text-center"><i class="fa fa-user"></i></td>
                            <td>Acudiente<br><?php echo $person['acudiente_persona']; ?></td>
                        </tr> 
                        <!-- <tr>
                            <td class="text-center"><i class="fa fa-balance-scale"></i></td>
                            <td>Peso<br><?php echo $person['peso_persona']; ?> Kg</td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fa fa-child"></i></td>
                            <td>Estatura<br><?php echo $person['estatura_persona']; ?> Mts</td>
                        </tr> -->
                    </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-8">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>Appointments/saveAllPatientAppoinmentInformation">
                <input type="hidden" name="id_consulta" value="<?php echo $ap['id_consulta'] ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card margin-b-30">
                            <div class="card-header card-default">
                                Historia Clínica Gerontológica
                                <div class="float-right">
                                    <i class="cursor-pointer close-body-card fa fa-arrow-up"></i>
                                </div>
                                <hr class="margin-b-0">
                            </div>
                            <div class="card-body">
                                <!--<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <em class="text-muted">En el siguiente espacio incluya la información de la nueva actualización de la historia clínica:</em>
                                            <textarea name="detalles_historia_clinica" class="summernote hc"><?php
                                                    if (isset($h['detalles_historia_clinica'])) {
                                                        echo $h['detalles_historia_clinica'];
                                                    }
                                            ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                                if (!empty($h['documento_historia_clinica'])) {
                                                    echo '<a style="text-decoration:underline;" target="_blank" href="'.base_url().'uploads/history/'.$h['id_consulta'].'/'.$h['documento_historia_clinica'].'"><p>'.$h['documento_historia_clinica'].'</p></a>';
                                                }
                                            ?>
                                            <br>
                                            <label><?php echo (!empty($h['documento_historia_clinica'])) ? 'Cambiar archivo' : 'Subir archivo' ?></label><br>
                                            <em class="text-muted">Seleccione o cambie el archivo que desea adjuntar a la historia clínica.</em>
                                            <div class="fileinput fileinput-new input-group col-md-12" data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"><span class="fileinput-filename"></span></div>
                                                <span class="input-group-addon btn btn-warning btn-file ">
                                                <?php
                                                    if (!empty($h['documento_historia_clinica'])) {
                                                ?>
                                                        <span class="fileinput-new">Cambiar</span>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <span class="fileinput-new">Seleccionar</span>
                                                <?php
                                                    }
                                                ?>
                                                <span class="fileinput-exists">Cambiar</span>
                                                <input type="file"  name="file">
                                                </span>
                                                <a href="#" class="input-group-addon btn btn-danger  hover fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <?php $this->load->view("pages/appointments/_formHistoriaClinica", array("historia_clinica" => $historia_clinica)) ?>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card margin-b-30">
                            <div class="card-header card-default">
                                Recetario
                                <div class="float-right">
                                    <i class="cursor-pointer close-body-card fa fa-arrow-up"></i>
                                </div>
                                <hr class="margin-b-0">
                            </div>
                            <div class="card-body">
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <label><strong>Lista de productos agregados</strong></label><br>
                                        <em class="text-muted">A continuación se muestra la lista de productos agregados al recetario</em>
                                        <table id="search-added-products" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if ($products != false) {
                                                        foreach ($products as $p) {
                                                ?>
                                                            <tr id="spa-<?php echo $p['id_producto_consulta'] ?>">
                                                                <td><input type="hidden" class="sp-ap" value="<?php echo $p['id_producto_consulta'] ?>"><?php echo $p['nombre_producto'] ?></td>
                                                                <td><input class="sp-price" type="hidden" value="<?php echo $p['precio_producto_pc'] ?>">$<?php echo $p['precio_producto_pc'] ?></td>
                                                                <td><input class="sp-count" type="hidden" value="<?php echo $p['cantidad_producto_pc'] ?>"><?php echo $p['cantidad_producto_pc'] ?></td>
                                                                <td data-p="<?php echo $p['id_producto'] ?>" data-type="delete" data-id="<?php echo $p['id_producto_consulta'] ?>" class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-danger btn-sp-delete"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>Recomendaciones del recetario:</strong></label><br>
                                            <em class="text-muted">A continuación escriba cada una de las recomendaciones necesarias para el consumo de los productos recetados.</em>
                                            <textarea id="detalles-recetario" name="detalles_recetario" class="summernote rc"><?php
                                                if (isset($ap['detalles_recetario'])) {
                                                    echo $ap['detalles_recetario'];
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
                                            <a data-toggle="modal" data-target="#asclepios-modal" class="btn btn-success btn-icon" onclick="setAsclepioId('detalles-recetario')"><i class="fa fa-list"></i> Insertar asclepio</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card margin-b-30">
                            <div class="card-header card-default">
                                Hoja de evolución
                                <div class="float-right">
                                    <i class="cursor-pointer close-body-card fa fa-arrow-up"></i>
                                </div>
                                <hr class="margin-b-0">
                            </div>
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <em class="text-muted">En el siguiente espacio incluya la información que considere pertienente recordar:</em>
                                            <textarea id="observaciones" name="observaciones" class="summernote he"><?php
                                                    if (isset($ap['observaciones'])) {
                                                        echo $ap['observaciones'];
                                                    }
                                            ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <hr>
                                            <a data-toggle="modal" data-target="#asclepios-modal" class="btn btn-success btn-icon" onclick="setAsclepioId('observaciones')"><i class="fa fa-list"></i> Insertar asclepio</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-icon float-save-button"><i class="fa fa-save"></i> Actualizar</button>
            </form>
        </div>
    </div>
<?php
$this->load->view('templates/footer.php');
?>

<script>
 var id_consulta = '<?php echo $ap['id_consulta']; ?>';
 jQuery(document).ready(function(){
    $('#alergias').summernote({
        focus: true
    })
 })
</script>
<!-- Wysihtml5 and Summernote -->
<link href="<?php echo base_url() ?>assets/lib/wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/lib/summernote/summernote.css" rel="stylesheet">