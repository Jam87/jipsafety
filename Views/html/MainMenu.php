<div class="app-menu navbar-menu">
  <!-- LOGO -->
  <div class="navbar-brand-box">
    <!-- Dark Logo-->
    <a href="index.html" class="logo logo-dark">
      <span class="logo-sm">
        <img src="<?= base_url(); ?>public/images/logo-sm.png" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="<?= base_url(); ?>public/images/logo-dark.png" alt="" height="17">
      </span>
    </a>
    <!-- Light Logo-->
    <a href="index.html" class="logo logo-light">
      <span class="logo-sm">
        <img src="<?= base_url(); ?>public/images/logo-sm.svg" alt="" height="22">
      </span>
      <span class="logo-lg">
        <img src="<?= base_url(); ?>public/images/logo-light-.svg" alt="" height="50">
      </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
      <i class="ri-record-circle-line"></i>
    </button>
  </div>

  <div id="scrollbar">
    <div class="container-fluid">

      <div id="two-column-menu">
      </div>
      <ul class="navbar-nav" id="navbar-nav">
        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
        <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Inicio</span>
          </a>
         
         <!-- CLIENTES --> 
        <li class="nav-item"><!-- Modulo: Clientes -->
          <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
            <i class="ri-apps-2-line"></i> <span data-key="t-apps">Clientes</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarApps">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="<?= base_url(); ?>cliente" class="nav-link" data-key="t-calendar"> Agregar ciente </a>
              </li>

            </ul>
          </div>
        </li><!-- /Modulo: Clientes -->

        <!-- COMPRAS -->
        <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
            <i class="ri-compasses-2-line"></i> <span data-key="t-icons">Compras</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarIcons">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="<?= base_url(); ?>proveedores" class="nav-link" data-key="t-remix">Proveedores</a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>Compras" class="nav-link" data-key="t-boxicons">Compras</a>
              </li>

        </li>
      </ul>
    </div>
    </li>


    <!-- INVENTARIOS -->
     <li class="nav-item">
      <a class="nav-link menu-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCharts">
        <i class="ri-pie-chart-line"></i> <span data-key="t-charts">Inventario</span>
      </a>
      <div class="collapse menu-dropdown" id="sidebarCharts">
        <ul class="nav nav-sm flex-column">
          <li class="nav-item">        
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>kardex" class="nav-link" data-key="t-chartjs"> Kardex </a>
          </li>
          <!--<li class="nav-item">
            <a href="charts-echarts.html" class="nav-link" data-key="t-echarts"> Echarts </a>
          </li>-->
        </ul>
      </div>
    </li>

    <!-- CATALOGOS -->
    <li class="nav-item">
      <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
        <i class="ri-booklet-line"></i> <span data-key="t-landing">Catálogos</span>
      </a>
      <div class="collapse menu-dropdown" id="sidebarLanding">
        <ul class="nav nav-sm flex-column">
          <li class="nav-item">
            <a href="<?= base_url(); ?>banco" class="nav-link" data-key="t-one-page">Bancos</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>colores" class="nav-link" data-key="t-nft-landing">Colores</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>contacto" class="nav-link" data-key="t-nft-landing">Contacto</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>pago" class="nav-link" data-key="t-nft-landing">Forma de pago</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>moneda" class="nav-link" data-key="t-nft-landing">Moneda</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>pais" class="nav-link" data-key="t-nft-landing">Pais</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>presentacion" class="nav-link" data-key="t-nft-landing">Presentación</a>
          </li>
        </ul>
      </div>
    </li>
    <!-- USUARIOS -->
    <li class="nav-item">
      <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
        <i class="ri-pages-line"></i> <span data-key="t-pages">Usuarios</span>
      </a>
      <div class="collapse menu-dropdown" id="sidebarPages">
        <ul class="nav nav-sm flex-column">
          <li class="nav-item">
            <a href="<?= base_url(); ?>usuarios" class="nav-link" data-key="t-starter">Usuarios</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>tipos" class="nav-link" data-key="t-team">Tipos de usuarios</a>
          </li>
        </ul>
      </div>
    </li>


    </ul>
  </div>
  <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>
</div>