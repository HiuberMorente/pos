 <div class="login-page">
   <div class="login-box">
     <div class="login-logo">
       <img src="Views/img/plantilla/logo-blanco-bloque.png" alt="logo login" class="img-fluid" style="padding: 30px 100px 0px 100px">
     </div>

     <div class="card">
       <div class="card-body login-card-body">
         <p class="login-box-msg text-gray">
           <strong>Ingresar al sistema</strong>
         </p>

         <form method="post">

           <div class="input-group mb-3">
             <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>

             <div class="input-group-append">
               <div class="input-group-text">
                 <span class="fas fa-user"></span>
               </div>
             </div>
           </div>

           <div class="input-group mb-3">
             <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword">

             <div class="input-group-append">
               <div class="input-group-text">
                 <span class="fas fa-lock"></span>
               </div>
             </div>
           </div>


           <div class="col-4">
             <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
           </div>

           <?php

            $login = new UsuariosController();
            $login->controllerUsuarioIngreso();

            ?>

         </form>


       </div>


     </div>

   </div>
 </div>