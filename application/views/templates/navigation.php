<!-- ============================================================== -->
<!-- 						Navigation Start 						-->
<!-- ============================================================== -->
<div class="main-sidebar-nav default-navigation">
    <div class="nano">
        <div class="nano-content sidebar-nav">
		
			<div class="card-body border-bottom text-center nav-profile">
				<div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                <img alt="profile" class="margin-b-10  " src="<?php echo base_url() ?>assets/img/logo.png" width="80">
                <p class="lead margin-b-0 toggle-none"><?php echo $this->session->userdata('nombre_persona') ?></p>
                <p class="text-muted mv-0 toggle-none">Bienvenido</p>						
            </div>
			
            <ul class="metisMenu nav flex-column" id="menu">
				<li class="nav-item <?php echo ($nav == 'dashboard') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>"><i class="fa fa-home"></i> <span class="toggle-none">Escritorio</span></a></li>

                <li class="nav-item <?php echo ($nav == 'patient') ? 'active' : '' ?>">
                    <a class="nav-link"  href="javascript: void(0);" aria-expanded="false"><i class="fa fa-users"></i> <span class="toggle-none">Pacientes <span class="fa arrow"></span></span></a>
                    <ul class="nav-second-level nav flex-column <?php echo ($nav == 'patient') ? 'collapse in' : '' ?>" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?php echo person_list_link("true") ?>">Ver ultimos</a></li>
                         <li class="nav-item"><a class="nav-link" href="<?php echo person_list_link() ?>">Ver todos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo person_add_link() ?>">Agregar nuevo</a></li>
                    </ul>
                </li>

                <li class="nav-item <?php echo ($nav == 'appointment') ? 'active' : '' ?>">
                    <a class="nav-link"  href="javascript: void(0);" aria-expanded="false"><i class="fa fa-folder"></i> <span class="toggle-none">Consultas <span class="fa arrow"></span></span></a>
                    <ul class="nav-second-level nav flex-column <?php echo ($nav == 'appointment') ? 'collapse in' : '' ?>" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?php echo appointment_list_link(true) ?>">Ver ultimas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo appointment_list_link() ?>">Ver todas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo appointment_add_link() ?>">Agregar nueva</a></li> 
                    </ul>
                </li>

                <li class="nav-item <?php echo ($nav == 'product') ? 'active' : '' ?>">
                    <a class="nav-link"  href="javascript: void(0);" aria-expanded="false"><i class="fa fa-truck"></i> <span class="toggle-none">Productos <span class="fa arrow"></span></span></a>
                    <ul class="nav-second-level nav flex-column <?php echo ($nav == 'product') ? 'collapse in' : '' ?>" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?php echo product_list_link() ?>">Ver todos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo product_add_link() ?>">Agregar nuevo</a></li>
                    </ul>
                </li>

                <li class="nav-item <?php echo ($nav == 'schedule') ? 'active' : '' ?>">
                    <a class="nav-link"  href="<?php echo schedule_list_link() ?>" aria-expanded="false"><i class="fa fa-calendar"></i> <span class="toggle-none">Agenda</span></a>
                </li>

                <li class="nav-item <?php echo ($nav == 'invoice') ? 'active' : '' ?>">
                    <a class="nav-link"  href="javascript: void(0);" aria-expanded="false"><i class="fas fa-file-invoice-dollar"></i> <span class="toggle-none">Facturas <span class="fa arrow"></span></span></a>
                    <ul class="nav-second-level nav flex-column <?php echo ($nav == 'invoice') ? 'collapse in' : '' ?>" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?php echo invoice_list_link() ?>">Ver todas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo invoice_add_link() ?>">Agregar nueva</a></li>
                    </ul>
                </li>

                <li class="nav-item <?php echo ($nav == 'recipe') ? 'active' : '' ?>">
                    <a class="nav-link"  href="javascript: void(0);" aria-expanded="false"><i class="fas fa-file"></i> <span class="toggle-none">Recetarios <span class="fa arrow"></span></span></a>
                    <ul class="nav-second-level nav flex-column <?php echo ($nav == 'recipe') ? 'collapse in' : '' ?>" aria-expanded="false">
                        <li class="nav-item"><a class="nav-link" href="<?php echo recipe_list_link(true) ?>">Ver ultimos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo recipe_list_link() ?>">Ver todas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo recipe_add_link() ?>">Agregar nueva</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- 						Navigation End	 						-->
<!-- ============================================================== -->