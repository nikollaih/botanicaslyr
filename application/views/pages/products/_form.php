<form enctype="multipart/form-data" id="product-form" method="post" onsubmit="formValidate('#product-form')" action="<?php echo base_url() ?>products/save">
    <input type="hidden" name="p[id_producto]" value="<?php echo (isset($p['id_producto'])) ? $p['id_producto'] : 'null' ; ?>"></input>
    <div class="row">
        <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="id_tipo_docuemnto">Nombre *</label>
                        <input required="" type="text" name="p[nombre_producto]" class="form-control required" placeholder="Nombre del producto" value="<?php echo (isset($p['nombre_producto'])) ? $p['nombre_producto'] : '' ; ?>">
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_tipo_docuemnto">Precio $ *</label>
                        <input required="" type="number" name="p[precio_producto]" class="form-control required" placeholder="$0" value="<?php echo (isset($p['precio_producto'])) ? $p['precio_producto'] : '' ; ?>">
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_tipo_docuemnto">Stock *</label>
                        <input required="" type="number" name="p[stock_producto]" class="form-control required" placeholder="0" value="<?php echo (isset($p['stock_producto'])) ? $p['stock_producto'] : '' ; ?>">
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_tipo_docuemnto">Referencia</label>
                        <input type="text" name="p[referencia_producto]" class="form-control" placeholder="Referencia del producto" value="<?php echo (isset($p['referencia_producto'])) ? $p['referencia_producto'] : '' ; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_tipo_docuemnto">Estado *</label>
                        <select required="" name="p[estado_producto]" class="form-control required">
                            <!-- product_states_options() -> helpers/dom_helper -->
                            <?php product_states_options((isset($p['estado_producto'])) ? $p['estado_producto'] : '1'); ?>
                        </select>
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Imagen del producto</label>
                <div class="fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview" data-trigger="fileinput" style="min-height:213px;">
                        <img src="<?php echo (isset($p['imagen_producto']) && !empty($p['imagen_producto'])) ? base_url().'uploads/products/'.$p['id_producto'].'/'.$p['imagen_producto'] : base_url().'assets/img/no_image.jpg'; ?>"></img>
                    </div>
                    <span class="btn btn-primary  btn-file">
                        <span class="fileinput-new">Seleccionar</span>
                        <span class="fileinput-exists">Cambiar</span>
                        <input type="file" id="image" name="image">
                    </span>
                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-right">
                <hr>
                <a href="<?php echo base_url() ?>" class="btn btn-default btn-icon"><i class="fa fa-times"></i> Cancelar</a>
                <button class="btn btn-primary btn-icon"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</form>