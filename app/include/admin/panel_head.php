<?php
$oAdmUser = AdmLogin::getUserSession();

?>

<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-holder d-flex align-items-center justify-content-between">
      <!-- Navbar Header-->
      <div class="navbar-header">
        <a href="index.html" class="navbar-brand">
          <div class="brand-text brand-big hidden-lg-down"><strong>Homologación</strong></div>
          <div class="brand-text brand-small"><strong>Homo</strong></div>
        </a>
        <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
      </div>
      <!-- Navbar Menu -->
      <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
        <li class="nav-item dropdown"> 
          <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
            <i class="fa fa-bell-o"></i>
            <span class="badge bg-red">3</span>
          </a>
          <ul aria-labelledby="notifications" class="dropdown-menu">
            <li>
              <a rel="nofollow" href="http://app.bureauveritas.com.pe/scs/homologacion/admin/?moduleID=46" class="dropdown-item"> 
                <div class="notification">
                  <div class="notification-content"><i class="fa fa-envelope bg-green"></i>Tienes <?php echo '1'; ?> requerimiento vencidos </div>
                </div>
              </a>
            </li>
            <li>
              <a rel="nofollow" href="http://app.bureauveritas.com.pe/scs/homologacion/admin/?moduleID=45" class="dropdown-item"> 
                <div class="notification">
                  <div class="notification-content"><i class="fa fa-twitter bg-blue"></i>Tienes <?php echo '2'; ?> requerimientos no aprobados</div>
                </div>
              </a>
            </li>
            <li>
              <a rel="nofollow" href="http://app.bureauveritas.com.pe/scs/homologacion/admin/?moduleID=45" class="dropdown-item"> 
                <div class="notification">
                  <div class="notification-content"><i class="fa fa-upload bg-orange"></i>Tienes <?php echo '3'; ?> homologaciones por programar</div>
                </div>
              </a>
            </li>
          </ul>
        </li>
        <!-- Logout    -->
        <li class="nav-item"><a href="<?php echo $URL_ADMIN?>?Command=logoff" class="nav-link logout">Cerrar Sesión<i class="fa fa-sign-out"></i></a></li>
      </ul>
    </div>
  </div>
</nav>



