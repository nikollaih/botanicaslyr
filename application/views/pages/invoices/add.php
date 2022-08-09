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
		  <h2>Factura</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
				<li class="breadcrumb-item"><a href="<?php echo invoice_list_link() ?>">Facturas</a></li>
				<li class="breadcrumb-item active"><?php echo !isset($invoice['id_factura']) ? 'Nueva factura' : 'Modificar factura' ?></li>
			</ol>
		</div>
		<div class="col-lg-6 align-self-center text-right">
            <?php 
                if (isset($invoice['id_factura'])) {
            ?>
                <a href="<?php echo invoice_file_link($invoice['id_factura']) ?>" target="blank" class="btn btn-info box-shadow btn-icon btn-rounded"><i class="fa fa-file"></i> Imprimir</a>
            <?php
                }
            ?>
			<a href="<?php echo invoice_list_link() ?>" class="btn btn-success box-shadow btn-icon btn-rounded"><i class="fa fa-plus"></i> Ver facturas</a>
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
                    <?php echo !isset($invoice['id_factura']) ? 'Nueva factura' : 'Datos de la factura' ?>
                    <p>A continuaci&oacute;n encontrar&aacute; la lista de datos necesarios para una factura, los campos marcados con * son obligatorios.</p>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                    <form id="" method="post" class="form-horizontal" action="<?php echo base_url() ?>Invoices/save">
                        <input type="hidden" id="id-factura" name="id_factura" class="val-null" value="<?php echo isset($invoice['id_factura']) ? $invoice['id_factura'] : 'null' ?>">
                        <input type="hidden" id="id-consulta" name="id_consulta" class="val-null" value="<?php echo isset($invoice['id_consulta']) ? $invoice['id_consulta'] : 'null' ?>">

                        <div class="form-group">
                            <label for="documento">Documento paciente</label>
                            <input type="number" class="form-control" id="documento" name="documento_factura" value="<?php echo isset($invoice['documento_factura']) ? $invoice['documento_factura'] : '' ?>" />
                            <span class="input-error">Este campo es requerido</span>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre paciente</label>
                            <input type="text" class="form-control required" id="nombre" name="paciente_factura" value="<?php echo isset($invoice['paciente_factura']) ? $invoice['paciente_factura'] : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div>

                        <!-- <div class="form-group">
                            <label for="apellidos">Apellidos persona *</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos_persona" value="<?php echo isset($invoice['apellidos_persona']) ? $invoice['apellidos_persona'] : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div> -->

                        <div class="form-group">
                            <label for="telefono">Telefono paciente</label>
                            <input type="number" class="form-control" id="telefono" name="telefono_factura" value="<?php echo isset($invoice['telefono_factura']) ? $invoice['telefono_factura'] : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div>

                        <div class="form-group">
                            <label>Fecha factura</label>
                            <input type="text" class="form-control date-picker" name="fecha_factura" value="<?php echo isset($invoice['fecha_factura']) ? date('m/d/Y', strtotime($invoice['fecha_factura'])) : '' ?>"/>
                            <span class="input-error">Este campo es requerido</span>
                        </div>
                        
                        <div class="form-group">
                            <label>Descuento cliente especial paciente crónico</label>
                            <select name="descuento" class="form-control" id="">
                                <option value="0">No aplica</option>
                                <option <?= (isset($invoice["envio"]) && $invoice["descuento"] == 5) ? "selected" : "" ?>  value="5">5%</option>
                                <option <?= (isset($invoice["envio"]) && $invoice["descuento"] == 10) ? "selected" : "" ?> value="10">10%</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Incluir valor de envío ($12.000)</label>
                            <select name="envio" class="form-control" id="">
                                <option value="0">No</option>
                                <option <?= (isset($invoice["envio"]) && $invoice["envio"] == 1) ? "selected" : "" ?> value="1">Si</option>
                            </select>
                        </div>

                        <?php
                            if (isset($invoice['id_factura'])) {
                        ?>
                            <hr style="margin: 40px 0;">
                            <div class="products" style="background: #f6f6f6;padding: 20px; border: 1px solid #ccc;">
                                <h4>Productos a facturar</h4>
                                <hr>
                                <div class="form-group">
                                    <label>Buscar producto</label>     
                                    <div class="input-group invoice-product">
                                        <input id="input-search-products" type="text" class="form-control" placeholder="Nombre del producto o referencia">
                                        <span class="input-group-btn">
                                            <button id="btn-search-products-invoice" type="button" class="btn btn-primary">Buscar</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <label><strong>Lista de productos encontrados</strong></label><br>
                                        <em class="text-muted">Los campos en las casillas <mark>Precio</mark> y <mark>Cantidad</mark> pueden ser modificados antes de ser agregados a la lista de productos a facturar.</em>
                                        <table id="search-products" class="table table-striped table-input">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Stock</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <label><strong>Lista de productos agregados</strong></label><br>
                                        <em class="text-muted">A continuaci&oacute;n se muestra la lista de productos agregados a la factura</em>
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
                                                    if (isset($products) && $products != false) {
                                                        foreach ($products as $p) {
                                                ?>
                                                            <tr id="spa-<?php echo $p['id_productos_factura'] ?>">
                                                                <td><input type="hidden" class="sp-ap" value="<?php echo $p['id_productos_factura'] ?>"><?php echo $p['nombre_producto'] ?></td>
                                                                <td><input class="sp-price" type="hidden" value="<?php echo $p['valor_productos_factura'] ?>">$<?php echo $p['valor_productos_factura'] ?></td>
                                                                <td><input class="sp-count" type="hidden" value="<?php echo $p['cantidad_productos_factura'] ?>"><?php echo $p['cantidad_productos_factura'] ?></td>
                                                                <td data-p="<?php echo $p['id_producto'] ?>" data-type="delete" data-id="<?php echo $p['id_productos_factura'] ?>" class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-danger btn-spi-delete"><i class="fa fa-trash"></i></button>
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
                        <?php
                            }
                        ?>

                        

                        <div class="form-group text-right">
                            <hr>
                            <a href="<?php echo base_url() ?>" class="btn btn-default btn-icon"><i class="fa fa-times"></i> Cancelar</a>
                            <button class="btn btn-primary btn-icon"><i class="fa fa-save"></i> <?php echo isset($invoice['id_factura']) ? 'Guardar' : 'Guadar y agregar productos' ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

$this->load->view('templates/footer.php');