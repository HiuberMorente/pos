
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!--    <a href="inicio" class="brand-link logo-switch">-->
<!---->
<!---->
<!--    <img src="Views/img/plantilla/imagelog.jpg" alt="Logo1" class="brand-image-xs logo-xs">-->
<!--   -->
<!--    <img src="Views/img/plantilla/imagelog.jpg" alt="Logo2" class="brand-image-xs logo-xl" style="left: 12px">-->
<!--    -->
<!--    -->
<!---->
<!--    </a>-->

  <a href="inicio" class="brand-link">
    <img src="Views/img/plantilla/imagelog.jpg" alt="Logo1" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-bold">La Casa</span>
  </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
              <?php
              
              if($_SESSION['perfil'] === 'Administrador'){
                
                 echo '<li class="nav-item">
                  <a href="inicio" class="nav-link">
                    <i class="nav-icon fa fa-home"></i>
                    <p>
                      Inicio
                    </p>
                  </a>
                 </li>
  
                  <li class="nav-item">
                      <a href="usuarios" class="nav-link">
                          <i class="nav-icon fa fa-user"></i>
                          <p>
                              Usuarios
                          </p>
                      </a>
                  </li>';
                
              }

              if($_SESSION['perfil'] === 'Administrador' || $_SESSION['perfil'] === 'Especial'){
              
            
                echo '<li class="nav-item">
                    <a href="categorias" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Categorías
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="productos" class="nav-link">
                        <i class=" nav-icon fas fa-tools"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>';
                
                
              }


              if($_SESSION['perfil'] === 'Administrador' || $_SESSION['perfil'] === 'Vendedor'){

                 echo '<li class="nav-item">
                        <a href="clientes" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>';
                  
              }

              if($_SESSION['perfil'] === 'Administrador' || $_SESSION['perfil'] === 'Vendedor'){
                
                echo '  <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-list-ul "></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
  
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ventas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar ventas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear_venta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear venta</p>
                            </a>
                        </li>';
                
                  

                  if($_SESSION['perfil'] === 'Administrador'){
      
      
                    echo '<li class="nav-item">
                                <a href="reportes" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reporte de ventas</p>
                                </a>
                            </li>;';
                  }
  
  
                  echo '</ul >
                    </li >';
                
              }
              ?>
            </ul>
        </nav>
    </div>

</aside>