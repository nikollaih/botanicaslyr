<!-- ============================================================== -->
<!-- 						Topbar Start 							-->
<!-- ============================================================== -->
<div class="top-bar primary-top-bar">
<div class="container-fluid">
	<div class="row">
		<div class="col">
			<a class="admin-logo" href="index-2.html">
				<h1>
					<!-- <img alt="" src="<?php echo base_url() ?>assets/img/icon.png" class="logo-icon margin-r-10"> -->
				</h1>
			</a>				
			<div class="left-nav-toggle" >
				<a  href="#" class="nav-collapse"><i class="fa fa-bars"></i></a>
			</div>
			<div class="left-nav-collapsed" >
				<a  href="#" class="nav-collapsed"><i class="fa fa-bars"></i></a>
			</div>
			<div class="search-form hidden-xs">
				<form>
					<input id="input-search" class="form-control" placeholder="Buscar..." type="text" value="<?php echo isset($q) ? $q : '' ?>"> <button class="btn-search" type="button"><i class="fa fa-search"></i></button>
				</form>
			</div>
			<ul class="list-inline top-right-nav">
				<li class="dropdown">
					<a class="right-sidebar-toggle d-none-m" href="javascript:%20void(0);"><i class="fa fa-align-right"></i> Consultas del día</a>
				</li>
				<li class="dropdown avtar-dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<img alt="" class="rounded-circle" src="<?php echo base_url() ?>assets/img/avtar-0.png" width="30">
						Hola, <?php echo $this->session->userdata('nombre_persona') ?>
					</a>
					<ul class="dropdown-menu top-dropdown">
						<li>
							<a class="dropdown-item" href="<?php echo logout_link() ?>"><i class="icon-logout"></i> Cerrar sesión</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
</div>
<!-- ============================================================== -->
<!--                        Topbar End                              -->
<!-- ============================================================== -->