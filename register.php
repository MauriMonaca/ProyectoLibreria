<?php
session_start();
require('./include/header.php');
require_once('./include/connect.php');
?>

 <div class="container">
 		<?php
			if (isset($_SESSION['message_register']) && ($_SESSION['message_register']) ) {
			      printf("<div class='row d-flex justify-content-center'><div class='alert alert-success text-center mt-3'><b>%s</b></div></div>", $_SESSION['message_register']);
			      unset($_SESSION['message_register']);
			    }
		?>
	    <div class="row">
	      <div class="col-sm-9 col-md-8 col-lg-6 mx-auto">
	        <div class="card card-signin my-5">
	          <div class="card-body p-0">
	            <form class="form-account py-4 px-3 pb-lg-2" method="POST" action="validateregister.php">
	              <h3 class="mb-3">Creación de cuenta</h3>
		             <div class="form-group">
					    <label for="username" class="text-dark control-label"><b>Ingrese un Nombre de Usuario: </b></label>
						<div class="input-group mb-3 flex-nowrap">
							<div class="input-group-prepend">
			    	    		<span class="input-group-text">
			    	    			<i class="fas fa-user-circle"></i>
			    	    		</span>
			    	    	</div>    
			    	    	<input type="text" class="form-control" name="username" id="usernamereg" placeholder="Usuario" pattern="[a-zA-Z0-9]+" minlength="6" maxlength="20" title="El nombre de usuario debe contener entre 6 y 20 caracteres, sin simbolos especiales ni espacios, solo letras o dígitos" autofocus required>
			    	    </div>
				  	</div>
		             <div class="form-group">
					    <label for="email" class="text-dark"><b>E-mail: </b></label>
						<div class="input-group mb-1 flex-nowrap">
							<div class="input-group-prepend">
			    	    		<span class="input-group-text">
			    	    			<i class="fas fa-envelope"></i>
			    	    		</span>
			    	    	</div> 
					    	<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Su E-mail" required>
					    </div>
					    <small id="emailHelp" class="form-text text-muted">No compartimos sus datos con nadie.</small>
				  	</div>
				  	<div class="form-group">
					    <label for="pass1"><b>Ingrese una Contraseña:</b></label>
						<div class="input-group mb-3 flex-nowrap">
							<div class="input-group-prepend">
			    	    		<span class="input-group-text">
			    	    			<i class="fas fa-key"></i>
			    	    		</span>
			    	    	</div>    
			    	    	<input type="password" class="form-control" name="pass1" id="pass1" pattern="[a-zA-Z0-9]+" minlength="6" maxlength="15" title="La contraseña debe contener entre 6 y 15 caracteres, sin simbolos especiales, solo letras o dígitos." required>
							<div class="input-group-append eye">
			    	    		<span class="input-group-text">
			    	    			<i class="fas fa-eye-slash" id="eye"></i>
			    	    		</span>
			    	    	</div>
			    	    </div>
				  	</div>
				  	<div class="form-group">
					    <label for="pass2"><b>Repita esa misma Contraseña:</b></label>
						<div class="input-group mb-3 flex-nowrap">
							<div class="input-group-prepend">
			    	    		<span class="input-group-text">
			    	    			<i class="fas fa-key"></i>
			    	    		</span>
			    	    	</div>    
			    	    	<input type="password" class="form-control" id="pass2" name="pass2" pattern="[a-zA-Z0-9]+" minlength="6" maxlength="15" title="La contraseña debe contener entre 6 y 15 caracteres, sin simbolos especiales, solo letras o dígitos." required>
			    	    </div>
				  	</div>
					<div class="row">
						<div class="form-check d-flex offset-md-1 col-md-4">
							<legend class="col-form-label  pt-0 mr-2">Sexo:</legend>
							<div class="d-flex">
								<div class="form-check mr-3">
									<?php $gender = ""; ?>
								  <input class="form-check-input" type="radio" name="gender" id="male" value="Masculino" <?php if ($gender == "Masculino" || $gender == "" ) echo "checked"; ?> required>
								  <label class="form-check-label" for="male">
								    Masculino
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="gender" id="female" value="Femenino" <?php if ($gender == "Femenino" ) echo "checked"; ?> required>
								  <label class="form-check-label" for="female">
								    Femenino
								  </label>
								</div>
							</div>
						</div>
					</div>
	                <div class="custom-control custom-checkbox my-2 priv">
		                <input type="checkbox" class="custom-control-input" id="priv" name="priv" required>
		                <label class="custom-control-label" for="priv">He leído las <a href="./priv.php">Políticas de privacidad.*</a></label>
	                </div>
				  	<div class="d-flex mt-2">
				  		<input type="submit" class="btn btn-dark btn-block text-uppercase mt-2 mr-2" name="account" value="Crear Cuenta">
				  		<input type="reset" class="btn btn-secondary btn-block text-uppercase mt-2" value="Limpiar campos">
				  	</div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
  </div>
<?php
require('./include/footer.php');
?>
