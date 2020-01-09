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
			if (isset($_SESSION['message_forget']) && $_SESSION['message_forget']) {
			      printf("<div class='row d-flex justify-content-center'><div class='alert alert-info text-center mt-3'><b>%s</b></div></div>", $_SESSION['message_forget']);
			      unset($_SESSION['message_forget']);
			    }
		?>
	    <div class="row">
	      <div class="col-sm-9 col-md-7 mx-auto">
	        <div class="card card-signin my-5">
	          <div class="card-body p-0">
	            <form class="form-signin p-4 pb-lg-2" method="POST" action="./validateforget.php">
	              <h3 class="mb-3 forget-title">Olvido de contraseña</h3>
		             <div class="form-group">
					    <label for="email" class="text-light mb-2 mb-lg-4 forget-text"><b>Por favor ingrese su E-mail para poder enviarle una nueva contraseña: </b></label>
						<div class="input-group mb-1 flex-nowrap">
							<div class="input-group-prepend">
			    	    		<span class="input-group-text">
			    	    			<i class="fas fa-envelope"></i>
			    	    		</span>
			    	    	</div> 
					    	<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Su E-mail" required="">
					    </div>					    
				  	</div>
	              <input type="submit" class="btn btn-dark btn-block text-uppercase" value="Aceptar">
	              <p class="mb-0 mt-2"><label>¿No tienes cuenta?&nbsp</label><a href="register.php">Regístrate</a></p>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
  </div>
<?php
require('./include/footer.php');
?> 