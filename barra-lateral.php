<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.php" class="site_title"><i class="fa fa-phone"></i> <span><small>Call Analyzer</small></span></a>
    </div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_info">
        <span>Bem-vindo,</span>
        <h2><?=$nomeUsuario?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <div class="clearfix"></div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="formulario-numero.php"><i class="fa fa-search"></i> Pesquisar Número</a></li>
          <li><a><i class="fa fa-phone"></i> Ligações Recebidas<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><span class="fa fa-exclamation-triangle"></span><a href="formulario-naoatendidas.php"> Não Atendidas</a></li>
              <li><span class="fa fa-exclamation"></span><a href="formulario-abandonadas.php"> Abandonadas</a></li>
              <li><span class="fa fa-check"></span><a href="formulario-atendidas.php"> Atendidas</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart-o"></i> Estatísticas <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="estatistica-agents.php"> Agents</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout">
        <a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>


    <nav>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?=$nomeUsuario?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:;"> Profile</a></li>
            <li>
              <a href="javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
              </a>
            </li>
            <li><a href="javascript:;">Help</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
