<div id="asclepios-modal" class="modal bd-example-modal-xl" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lista de asclepios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="asclepios-tabla-modal" class="table table-condensed table-hovered">
            <thead>
                <tr>
                    <td>Titulo</td>
                    <td>Descripción</td>
                    <td style="text-align: center;width:100px;"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $asclepios = get_asclepios();
                    if($asclepios){
                        foreach ($asclepios as $asclepio) {
                            $html_code = $asclepio["descripcion_asclepio"];
                            ?>
                                <tr>
                                    <td><?= $asclepio["titulo_asclepio"] ?></td>
                                    <td><?= substr($asclepio["descripcion_asclepio"], 0, -1) ?></td>
                                    <td class="button-container"><a onClick="addAsclepioToSummernote('<?= $asclepio["id_asclepio"] ?>')" class="btn-primary btn-small btn">Insertar</a></td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<style>
    #asclepios-tabla-modal{
        width: 100% !important;
    }

    #asclepios-modal .modal-xl{
        width: 80%;
        max-width: 80%;
    }

    .button-container{
        max-width: 0px !important;
    }
</style>