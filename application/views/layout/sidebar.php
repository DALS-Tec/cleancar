	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="href="<?php echo base_url('/') ?>>
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-laugh-wink"></i>
			</div>
			<div class="sidebar-brand-text mx-3">Clean Car</div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="href="<?php echo base_url('home'); ?>>
			<i class="fas fa-home"></i>
			<span>Home</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-database"></i>
			<span>Cadastros</span>
			</a>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Escolha uma opção:</h6>
					<a title="Gerenciar clientes" class="collapse-item" href="<?php echo base_url('clientes') ?>"><i class="fas fa-user-tie font-small"></i>&nbsp;Clientes</a>
					<a title="Gerenciar clientes" class="collapse-item" href="<?php echo base_url('clientes') ?>"><i class="fas fa-car-alt"></i>&nbsp;Veículos</a>
					<a title="Gerenciar clientes" class="collapse-item" href="<?php echo base_url('lavadores') ?>"><i class="fas fa-hands-wash"></i>&nbsp;Lavadores</a>
					<a title="Gerenciar clientes" class="collapse-item" href="<?php echo base_url('Fornecedores') ?>"><i class="fas fa-truck-loading"></i>&nbsp;Fornecedores</a>
				</div>
			</div>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Configurações
		</div>

		<!-- Nav Item - Tables -->
		<li class="nav-item">
			<a title="Gerenciar usuários" class="nav-link" href="<?php echo base_url('usuarios') ?>">
			<i class="fas fa-users-cog"></i>
			<span>Usuários</span></a>
		</li>

		<!-- Nav Item - Tables -->
		<li class="nav-item">
			<a title="Gerenciar dados do sistema" class="nav-link" href="<?php echo base_url('sistema') ?>">
			<i class="fas fa-cog"></i>
			<span>Sistema</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

		<!-- Sidebar Toggler (Sidebar) -->
		<div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>

	</ul>
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">	
	

