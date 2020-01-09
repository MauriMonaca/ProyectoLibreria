<?php
session_start();
if ( (isset($_SESSION['user'])) || (isset($_SESSION['admin'])) ) {
 header("location: ./index.php");
} 
require('./include/header.php');
require_once('./include/connect.php');
?>

   <div class="container">
		<?php
			if (isset($_SESSION['message_register']) && $_SESSION['message_register']) {
			      printf("<div class='row d-flex justify-content-center'><div class='alert alert-info text-center mt-3'><b>%s</b></div></div>", $_SESSION['message_register']);
			      unset($_SESSION['message_register']);
			    }
			if (isset($_SESSION['message_login']) && $_SESSION['message_login']) {
			      printf("<div class='row d-flex justify-content-center'><div class='alert alert-info text-center mt-3'><b>%s</b></div></div>", $_SESSION['message_login']);
			      unset($_SESSION['message_login']);
			    }	
			if (isset($_SESSION['message_forget']) && $_SESSION['message_forget']) {
			      printf("<div class='row d-flex justify-content-center'><div class='alert alert-info text-center mt-3'><b>%s</b></div></div>", $_SESSION['message_forget']);
			      unset($_SESSION['message_forget']);
			    }
		?>
	    <div class="row">
	      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
	        <div class="card card-signin my-5">
	          <div class="card-body p-0">
	            <form class="form-signin p-4 pb-lg-2" method="POST" action="validatelogin.php">
	              <h3 class="mb-3">Mi Perfil</h3>
	              <div class="form-label-group mb-4">
					<div class="input-group mb-3 flex-nowrap">
						<div class="input-group-prepend">
		    	    		<span class="input-group-text">
		    	    			<i class="fas fa-user-circle"></i>
		    	    		</span>
		    	    	</div>    
		    	    	<input type="text" name="user" id="userlog" class="form-control" placeholder="Usuario..." required autofocus  pattern="[a-zA-Z0-9]+">
		    	    </div>
	              </div>
	              <div class="form-label-group mb-4">
					<div class="input-group mb-1 flex-nowrap">
						<div class="input-group-prepend">
		    	    		<span class="input-group-text">
		    	    			<i class="fas fa-key"></i>
		    	    		</span>
		    	    	</div> 
				    	 <input type="password" name="password" id="pass1" class="form-control" placeholder="Contraseña" required>
						<div class="input-group-append eye">
		    	    		<span class="input-group-text">
		    	    			<i class="fas fa-eye-slash" id="eye"></i>
		    	    		</span>
		    	    	</div>
				    </div>
	              </div>
	              <div class="custom-control custom-checkbox mb-3">
	                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
	                <label class="custom-control-label mt-1" for="remember">Recordar Usuario y Contraseña</label>
	              </div>
	              <input type="submit" class="btn btn-dark btn-block text-uppercase" value="Iniciar Sesión">	
	              <p class="mt-3 my-lg-1 mb-1"><a href="./forgetpassword.php">¿Olvidaste tu contraseña?</a></p>
	              <p class="mb-0"><label>¿No tienes cuenta?&nbsp</label><a href="register.php">Regístrate</a></p>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
  </div>
<?php
require('./include/footer.php');
?> 