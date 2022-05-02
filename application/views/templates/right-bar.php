<!-- ============================================================== -->
<!--                        Right Side Start                        -->
<!-- ============================================================== -->
<nav class="toggle-sidebar" id="right-sidebar-toggle">
	<div class="nano">
		<div class="nano-content">
			<div>
				<ul class="list-inline nav-tab-card clearfix" role="tablist">
					<li style="width: 100%;" class="active" role="presentation">
						<a aria-controls="friends" data-toggle="tab" href="#friends" role="tab">Consultas del día</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="friends" role="tabcard">
						<ul class="list-unstyled sidebar-contact-list">
							<?php
								$ap = appointmentsDay(date('Y-m-d'));

								if ($ap != false) {
									foreach ($ap as $a) {
							?>
										<li class="clearfix">
											<a class="media-box" href="#"><!-- <span class="float-right"><span class="circle circle-success circle-lg"></span></span> --> <span class="float-left">
											 <img alt="user" class="media-box-object rounded-circle" src="<?php echo base_url() ?>assets/img/avtar-<?php echo  $a['genero_persona'] ?>.png" width="50"></span>
											 <span class="media-box-body"><span class="media-box-heading"><strong><?php echo $a['nombre_persona'].' '.$a['apellidos_persona'] ?></strong><br>
											<small style="color: #29a7d8;" class="text-muted"><i class="fa fa-phone"></i> <?php echo $a['telefono_persona'] ?></small><br>
											<small class="text-muted"><?php echo date('d M, Y - h:i a', strtotime($a['fecha_hora_consulta'])) ?></small></span></span></a>
										</li>
							<?php
									}
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
<!-- ============================================================== -->
<!--                        Right Side End                          -->
<!-- ============================================================== -->