<?php
session_start();
if (!isset($_SESSION['admin'])) {
 header("location: ./index.php");
} 
require('./include/header.php');
require_once('./include/connect.php');
 ?>
	<main class="container-fluid p-0 m-0">
		<div class="container">	
			<div class="row no-gutters">
				<section class="col-12 px-3 px-lg-5 py-3 upload-book my-5">
					<form method="post" action="validatebook.php" enctype="multipart/form-data">
						<h2>ALTA DE LIBRO</h2>
					    <div class="row">
						<!-- MENSAJE CON EL ESTADO DE CARGA DEL ARCHIVO, EL SCRIPT validatebook.php LO CONFIGURARA COMO VARIABLE DE SESSION -->
							<?php
								if (isset($_SESSION['message_book']) && $_SESSION['message_book'])
								    {
								      printf("<div class='text-success col-12'><b>%s</b></div>", $_SESSION['message_book']);
								      unset($_SESSION['message_book']);
								    }
							?>
					    	<div class="form-group col-lg-6 mt-2 mt-md-0">
					    	    <label for="tit" class="control-label font-weight-bold">Título:</label>
								<div class="input-group mb-3">
      								<div class="input-group-prepend">
					    	    		<span class="input-group-text">
					    	    			<i class="fas fa-book-open book-icon"></i>
					    	    		</span>
					    	    	</div>    
					    	    	<input type="text" class="form-control" name="title" id="tit" autofocus="on" required>
					    	    </div>
					    	</div>
					    	<div class="form-group col-lg-3">
					    	    <label class="control-label font-weight-bold" for="isbn">ISBN:</label>
								<div class="input-group mb-3">
      								<div class="input-group-prepend">
					    	    		<span class="input-group-text">
					    	    			<b>N°</b>
					    	    		</span>
					    	    	</div>    					    	   
					    	    	<input type="text" class="form-control" id="isbn" name="isbn" pattern="[0-9]{5,13}" maxlength="13" minlength="5" title="Solo se permite el ingreso de números, preferentemente 13 cifras" required>
					    	    </div>
					    	</div>
					    	<div class="form-group col-lg-3">
					    	    <label class="control-label font-weight-bold" for="anio">Año de Publicación:</label> 					    	   
				    	    	<input type="number" class="form-control w-50" name="anio" id="anio" min="1000" max="2020" title="Solo se permite la cifra de años desde 1000 hasta 2020" required>
					    	</div>
					    	<div class="form-group col-lg-6">
					    	    <label class="control-label font-weight-bold" for="aut">Autor:</label>
								<div class="input-group mb-3">
      								<div class="input-group-prepend">
					    	    		<span class="input-group-text">
					    	    			<i class="fas fa-marker"></i>
					    	    		</span>
					    	    	</div>    
					    	    	<input type="text" class="form-control" id="aut" name="author" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+{4,25}" maxlength="25" title="No se permite el ingreso de números" required>
					    	    </div>
					    	</div>    
							<?php 
								$select = array("Pangea", "Eidos", "Centauri", "Taygeta", "Lyra", "Arda");
							?>  
					    	<div class="form-group col-lg-4">
					    	    <label class="control-label font-weight-bold" for="edi">Editorial:</label>
					    	    <select class="form-control" title="Elegir Editorial" id="edi" name="editorial" required>
									<option value="    " disabled selected></option>
									<?php
										for($i = 0;$i < count($select); $i++){
										echo '<option value="'.$select[$i].'">'.$select[$i].'</option>';
										}
									?>
								</select>
					    	</div>     
					    	<div class="form-group col-lg-6">
					    	    <label class="font-weight-bold" for="img">Cargar Tapa de Libro: </label>
					    	    <input type="file" class="form-control-file" id="img" title="Formatos aceptados: .jpg, .png o .gif" name="imgbook" accept="image/*" required>
					    	</div>
					    	<div class="form-group col-6 col-lg-2">
					    	    <label for="price" class="control-label font-weight-bold" pattern="[0,9][\.]">Precio:</label>
								<div class="input-group mb-3">
      								<div class="input-group-prepend">
					    	    		<span class="input-group-text">
					    	    			<b>$</b>
					    	    		</span>
					    	    	</div>
					    	    	<input type="text" class="form-control" name="price" id="price" pattern="\d+(\,\d{2})?" required>
					    		</div>
					    	</div>                                   
					    	<div class="form-group col-lg-3 col-6">
					    	    <label for="sto" class="control-label font-weight-bold">Stock:</label>
					    	    <input type="number" min="0" class="form-control" id="sto" name="stock" required>
					    	</div>
							<div class="form-group d-flex flex-column flex-lg-row justify-content-start col-12 col-lg-10">
								<div class="mr-lg-3 mr-auto  align-self-center d-flex flex-column">
									<legend class="col-form-label py-0 mr-2 font-weight-bold mb-0">Temáticas:</legend>
									<small class="mt-0 py-0">Marque al menos una opción.</small>
								</div>
				                <div class="d-flex px-2 px-md-5 px-lg-4 mr-lg-1 mr-md-5 py-2 my-2 subject flex-wrap flex-sm-nowrap">
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="classic" name="subject[]" value="Clasico">
						                <label class="custom-control-label pt-lg-0" for="classic">Clásicos</label>
				                	</div>
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="nacionales" name="subject[]" value="Nacional">
						                <label class="custom-control-label pt-lg-0" for="nacionales">Nacionales</label>
				            		</div>
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="suspenso" name="subject[]" value="Suspenso">
						                <label class="custom-control-label pt-lg-0" for="suspenso">Suspenso</label>
				                	</div>
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="fantasia" name="subject[]" value="Fantasia">
						                <label class="custom-control-label pt-lg-0" for="fantasia">Fantasía</label>
				                	</div>
				                	<div class="form-check">
						                <input type="checkbox" class="custom-control-input" id="surrealismo" name="subject[]" value="Surrealismo">
						                <label class="custom-control-label pt-lg-0" for="surrealismo">Surrealismo</label>
				                	</div>
				                </div>
							</div>
					    </div>
				    	<label for="des" class="d-block font-weight-bold">Descripción:</label>        
				    	<textarea class="p-3 form-control textarea" name="description" id="des" cols="93" rows="10" maxlength="1200" required></textarea>
				    	<!-- BOTONES DESDE TAMAÑO MD -->
		    			<div class="d-none d-md-flex justify-content-between upload-buttons">
	    					<div class="d-flex mt-3">
	    						<a href="./index.php" class="mr-2">
	    							<button type="button" class="btn btn-dark">Cancelar</button>
	    						</a>
	    						<div class="form-group mt justify-content-between shrink">
	    						    <button type="reset" class="btn btn-primary">Limpiar Campos</button>
	    						</div>
	    					</div>
	    					<div>
	    						<div class="form-group mt-3">
	    							<input type="submit" class="btn btn-success shrink" name="sendbook" value="Dar de Alta">
	    						</div>
	    					</div>
		    			</div>
		    			<!-- BOTONES PARA SM -->
		    			<div class="row d-md-none">
		    				<div class="col d-flex justify-content-between">
		    					<div class="form-group mt-3 mb-0">
		    					      <button type="reset" class="btn btn-primary btn-sm shrink">Limpiar Campos</button>
		    					</div>
		    					<div class="form-group mt-3">
		    						<input type="submit" class="btn btn-success btn-sm shrink" name="sendbook" value="Dar de Alta">
		    					</div>
		    				</div>
		    			</div>
	    				<div class="d-md-none d-flex justify-content-end">
	    					<a href="./index.php">
	    						<button type="button" class="btn btn-dark btn-sm">Cancelar</button>
	    					</a>
	    				</div>
					</form>
		        </section>
		    </div>
	    </div>
	</main> 
<?php
require('./include/footer.php');
?>
