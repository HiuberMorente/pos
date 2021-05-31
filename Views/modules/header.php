
<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  
  <div class="navbar-custom-menu ml-auto">
    <ul class="nav navbar-nav ">

     
      <li class="nav-item dropdown  user user-menu">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">


          <?php 

              if($_SESSION["foto"] != ""){
                echo '<img src="'.$_SESSION["foto"].'" class=" user-image" alt="User Image">';
              }else{
                echo '<img src="Views/img/usuarios/default/anonymous.png" class=" user-image" alt="User Image">';
              }
            
          ?>

          <span class="hidden-xs text-white">         
              <?php 
                echo $_SESSION["nombre"]." ".$_SESSION["apellido"];
              ?>
          </span>
        </a>

        

        <ul class="dropdown-menu">
          <li class="user-body dropdown-item">
            <div class="">
              <a href="salir" class="btn btn-light">Salir</a>
            </div>
          </li>

        </ul>
      </li>
    </ul>
  </div>
 
</nav>
