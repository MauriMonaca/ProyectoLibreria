<?php
session_start();
require('./include/header.php');
require_once('./include/connect.php');
?>
 <div class="container">
 		<?php
			if (isset($_SESSION['contact']) && $_SESSION['contact']) {
			      printf("<div class='row d-flex justify-content-center'><div class='alert alert-success text-center mt-3'><b>%s</b></div></div>", $_SESSION['contact']);
			      unset($_SESSION['contact']);
			    }
		?>
	    <div class="row">
	      <div class="col-sm-9 col-md-8 col-lg-6 mx-auto">
	        <div class="card card-signin my-5">
	          <div class="card-body p-0">
	            <form class="form-account py-4 px-3 pb-lg-2" method="POST" action="validatecontact.php">
	              <h3 class="mb-3">Contacte con nosotros</h3>
		             <div class="form-group">
					    <label for="username" class="text-dark">Nombre: </label>
					    <input type="text" class="form-control" name="username" id="username" pattern="[a-zA-Z]{3,20}" minlength="4" maxlength="20" title="El nombre debe contener entre 4 y 20 caracteres, sin simbolos especiales ni espacios, solo letras o dígitos" autofocus required>
				  	</div>
		             <div class="form-group">
					    <label for="email" class="text-dark">E-mail: </label>
					    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" maxlength="100" placeholder="fulano@mail.com" required>
				  	</div>
		             <div class="form-group">
					    <label for="subject" class="text-dark">Asunto: </label>
					    <input type="text" class="form-control w-50" name="subject" id="subject" maxlength="60" required>
				  	</div>
				  	<label for="message"><b>Su Mensaje: </b></label>
				  	<textarea class="p-3 form-control textarea" id="message" name="message" id="des" cols="93" rows="10" maxlength="1200" required></textarea>
				  	<div class="d-flex mt-2">
				  		<input type="submit" class="btn btn-dark btn-block text-uppercase mt-2 mr-2" name="send-message" value="Enviar Mensaje">
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