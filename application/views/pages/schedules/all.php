<?php
$this->load->view('templates/header.php');
$this->load->view('templates/top-bar.php');
$this->load->view('templates/right-bar.php');
$this->load->view('templates/navigation.php');
?>

<link href='<?php echo base_url() ?>assets/lib/fullcalendar/fullcalendar.css' rel="stylesheet">   

<div class="modal fade" id="scheduleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
            <h5 class="modal-title" id="exampleModalLabel">Cita</h5>
            </div>
            <div class="modal-body">
                <form id="form-schedule" role="form">
                    <input type="hidden" name="id_agenda" id="s-id-agenda" value="null">
                    <div class="form-group">
                        <label>Nombre del paciente</label>
                        <input type="text" id="s-paciente-agenda" class="form-control required" name="paciente_agenda" placeholder="Nombre del paciente">
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                    <div class="form-group hidde-update">
                        <label>Fecha de la agenda</label>
                        <input type="text" id="s-fecha-agenda" name="fecha_agenda" class="form-control date-picker required" placeholder="Fecha de la agenda">
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                    <div class="form-group hidde-update">
                        <label>Hora de la agenda</label>
                        <input type="text" id="s-hora-agenda" name="hora_agenda" class="form-control hour-picker required" placeholder="Hora de la agenda">
                        <span class="input-error">Este campo es requerido</span>
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea name="observaciones_agenda" id="s-observaciones-agenda" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Estado de la agenda</label>
                        <select name="estado_agenda" id="s-estado-agenda"  class="form-control">
                            <?php 
                                if ($states != false) {
                                    foreach ($states as $s) {
                                       ?>
                                            <option value="<?php echo $s['id_estado_consulta'] ?>"><?php echo $s['descripcion_estado_consulta'] ?></option>
                                       <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="clearfix">
                        <button type="button" id="BtnNewSchedule" class="btn  btn-primary float-right">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- 						Content Start	 						-->
<!-- ============================================================== -->
<div class="row page-header">
	<div class="col-lg-6 align-self-center ">
		<h2>Agenda</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
			<li class="breadcrumb-item active">Lista de agendas</li>
		</ol>
	</div>
	<div class="col-lg-6 align-self-center text-right">
		<a data-toggle="modal" data-target="#scheduleModal" class="btn btn-success box-shadow btn-icon btn-rounded btn-new-schedule"><i class="fa fa-plus"></i> Agendar</a>
	</div>
</div>
<a style="position: fixed; z-index: 99;right: 15px;bottom: 25px;" data-toggle="modal" data-target="#scheduleModal" class="btn btn-success box-shadow btn-icon btn-rounded btn-new-schedule"><i class="fa fa-plus"></i> Agendar</a>
<section class="main-content">
    <div class="row w-no-padding margin-b-30">
		<div class="col-sm-12">
            <div class="card margin-b-0">
                <div class="card-header card-default">
                    Agenda
                    <div style="float: right">
                        seleccionar dia
                        <select name="" id="day-select">
                                <option <?php echo ($day["valor_configuracion"] == 0) ? "selected" : "" ?> value="0">Domingo</option>
                                <option <?php echo ($day["valor_configuracion"] == 1) ? "selected" : "" ?> value="1">Lunes</option>
                                <option <?php echo ($day["valor_configuracion"] == 2) ? "selected" : "" ?> value="2">Martes</option>
                                <option <?php echo ($day["valor_configuracion"] == 3) ? "selected" : "" ?> value="3">Miercoles</option>
                                <option <?php echo ($day["valor_configuracion"] == 4) ? "selected" : "" ?> value="4">Jueves</option>
                                <option <?php echo ($day["valor_configuracion"] == 5) ? "selected" : "" ?> value="5">Viernes</option>
                                <option <?php echo ($day["valor_configuracion"] == 6) ? "selected" : "" ?> value="6">Sabado</option>
                        </select>
                    </div>
                    <hr class="margin-b-0">
                </div>
                <div class="card-body">
                	<div class="row">
                        <div class="col-md-2">
                            <table class="table browser no-border">
                                <tbody>
                                    <?php
                                        if ($states != null) {
                                            foreach ($states as $s) {
                                    ?>
                                                <tr>
                                                    <td><?php echo $s['descripcion_estado_consulta'] ?></td>
                                                    <td class="text-right"><span class="label label-<?php echo $s['color_class'] ?>"></span></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-10">
                            <div id="fc-external-drag"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('templates/footer.php'); ?>
<!-- Full Calendar -->
<script src="<?php echo base_url() ?>assets/lib/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/lib/momentJs/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/lib/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/fullcalendar.js"></script>

<script src="<?php echo base_url() ?>assets/js/schedule.js"></script>