<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for=""><strong>Saturación</strong></label>
            <input type="text" name="hc[saturacion]" class="form-control" id="" value="<?= (isset($historia_clinica['saturacion'])) ? $historia_clinica['saturacion'] : "" ?>">
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for=""><strong>Frecuencia cardiaca</strong></label>
            <input type="text" name="hc[frecuencia_cardiaca]" class="form-control" id="" value="<?= (isset($historia_clinica['frecuencia_cardiaca'])) ? $historia_clinica['frecuencia_cardiaca'] : "" ?>">
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for=""><strong>Frecuencia respiratoria</strong></label>
            <input type="text" name="hc[frecuencia_respiratoria]" class="form-control" id="" value="<?= (isset($historia_clinica['frecuencia_respiratoria'])) ? $historia_clinica['frecuencia_respiratoria'] : "" ?>">
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for=""><strong>Tensión arterial</strong></label>
            <input type="text" name="hc[tension_arterial]" class="form-control" id="" value="<?= (isset($historia_clinica['tension_arterial'])) ? $historia_clinica['tension_arterial'] : "" ?>">
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for=""><strong>Temperatura</strong></label>
            <input type="text" name="hc[temperatura]" class="form-control" id="" value="<?= (isset($historia_clinica['temperatura'])) ? $historia_clinica['temperatura'] : "" ?>">
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for=""><strong>Dolor EVA</strong></label>
            <input type="text" name="hc[dolor_eva]" class="form-control" id="" value="<?= (isset($historia_clinica['dolor_eva'])) ? $historia_clinica['dolor_eva'] : "" ?>">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""><strong>Alergias</strong></label>
            <textarea autofocus="autofocus" class="form-control summernote" name="hc[alergias]" id="alergias" cols="30" rows="10">
                <?php
                    if (isset($historia_clinica['alergias'])) {
                        echo $historia_clinica['alergias'];
                    }
                ?>
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""><strong>Medicamentos que consume actualmente</strong></label>
            <textarea class="form-control summernote" name="hc[medicamentos]" id="" cols="30" rows="10">
                <?php
                    if (isset($historia_clinica['medicamentos'])) {
                        echo $historia_clinica['medicamentos'];
                    }
                ?>
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""><strong>Motivo de la consulta</strong></label>
            <textarea class="form-control summernote" name="hc[motivo_consulta]" id="" cols="30" rows="10">
                <?php
                    if (isset($historia_clinica['motivo_consulta'])) {
                        echo $historia_clinica['motivo_consulta'];
                    }
                ?>
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""><strong>I.D.D.</strong></label>
            <textarea class="form-control summernote" name="hc[idd]" id="" cols="30" rows="10">
                <?php
                    if (isset($historia_clinica['idd'])) {
                        echo $historia_clinica['idd'];
                    }
                ?>
            </textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for=""><strong>Análisis, plan de manejo y recomendaciones generales</strong></label>
            <textarea class="form-control summernote" name="hc[analisis_manejo_recomendaciones]" id="" cols="30" rows="10">
                <?php
                    if (isset($historia_clinica['analisis_manejo_recomendaciones'])) {
                        echo $historia_clinica['analisis_manejo_recomendaciones'];
                    }
                ?>
            </textarea>
        </div>
    </div>
</div>