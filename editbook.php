<?php
session_start();
if (!isset($_SESSION['admin'])) {
 header("location: ./index.php");
} 
require('./include/header.php');
require_once('./include/connect.php');
if (isset($_REQUEST['id'])) {
	$BookID = $_REQUEST['id'];
}
$sql = "SELECT * FROM libros WHERE id_libro = $BookID";
$query = mysqli_query($link,$sql);
$cell = mysqli_fetch_array($query);
 ?>
	<main class="container-fluid p-0 m-0">
		<div class="container">
			<div class="row no-gutters">
				<section class="col-12 px-3 px-lg-5 py-3 upload-book my-5">
					<form method="post" action="actionedit.php" enctype="multipart/form-data">
						<h2>MODIFICANDO LIBRO</h2>
					    <div class="row">
					    	<div class="form-group col-lg-6">
					    	    <label for="tit" class="control-label font-weight-bold">Título:</label>
								<div class="input-group mb-3">
      								<div class="input-group-prepend">
					    	    		<span class="input-group-text">
					    	    			<i class="fas fa-book-open book-icon"></i>
					    	    		</span>
					    	    	</div>    
					    	    	<?php echo '<input type="text" class="form-control" name="title" id="tit" autofocus="on" value="'.$cell["nombre_libro"].'" required>';?>
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
					    	    	<?php echo '<input type="text" class="form-control" name="isbn" id="isbn" pattern="[0-9]{5,13}" maxlength="13" minlength="5" title="Solo se permite el ingreso de números, preferentemente 13 cifras" value="'.$cell["isbn"].'" required>';?>
					    	    </div>
					    	</div>
					    	<div class="form-group col-lg-3">
					    	    <label class="control-label font-weight-bold" for="anio">Año de Publicación:</label> 					    	   
				    	    	<?php echo '<input type="number" class="form-control w-50" name="anio" id="anio" min="1000" max="2020" title="Solo se permite la cifra de años desde 1000 hasta 2020" value="'.$cell["anio"].'" required>';?>
					    	</div>
					    	<div class="form-group col-lg-6">
					    	    <label class="control-label font-weight-bold" for="aut">Autor:</label>
								<div class="input-group mb-3">
      								<div class="input-group-prepend">
					    	    		<span class="input-group-text">
					    	    			<i class="fas fa-marker"></i>
					    	    		</span>
					    	    	</div>    
					    	    	<?php echo '<input type="text" class="form-control" name="author" id="aut" pattern="[A-Za-z ]{4,25}" maxlength="25" title="No se permite el ingreso de números" value="'.$cell["autor_libro"].'" required>';?>
					    	    </div>
					    	</div>  
							<?php 
								$select = array("Pangea", "Eidos", "Centauri", "Taygeta", "Lyra", "Arda");
								$old_edi = $cell['editorial'];
							?>  
					    	<div class="form-group col-lg-4 col-7">
					    	    <label class="control-label font-weight-bold" for="edi">Editorial:</label>
					    	    <select class="form-control" title="Elegir Editorial" id="edi" name="editorial" required>
								<?php
									echo '<option value="' . $old_edi . '" selected>'.$cell["editorial"].'</option>';
									// BUSCO EL SELECT QUE SE REPITE Y LO BORRO CON UNSET, LUEGO ORDENO
									$repeat = array_search($old_edi, $select);
									unset($select[$repeat]);
									array_values($select);
									sort($select);
									for ($i = 0; $i < count($select); $i++) {
									echo '<option value="' . $select[$i] . '">' . $select[$i] . '</option>';
									}
								?>
								</select>
					    	</div>
					    	<div class="d-sm-none col-5 mt-n3 modify-img-sm">
				    			<img src="<?php echo $cell['imagen_libro'];  ?>" class="img-fluid img-thumbnail" alt="<?php echo $cell['nombre_libro'];  ?>" title="<?php echo $cell['nombre_libro'];  ?>">
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
					    	    	<?php echo '<input type="text" class="form-control" name="price" id="price" pattern="\d+(\,\d{2})?" value="'.$cell["precio_libro"].'" required>';?>
					    		</div>
					    	</div>                                   
					    	<div class="form-group col-lg-3 col-6">
					    	    <label for="sto" class="control-label font-weight-bold">Stock:</label>
					    	    <?php echo '<input type="number" class="form-control" name="stock" id="sto" min="0" value="'.$cell["stock_libro"].'" required>';?>
					    	</div>
							<div class="form-group d-flex flex-column flex-lg-row justify-content-start col-12 col-lg-10">
								<div class="mr-lg-3 mr-auto  align-self-center d-flex flex-column">
									<legend class="col-form-label py-0 mr-2 font-weight-bold mb-0">Temáticas:</legend>
									<small class="mt-0 py-0">Marque al menos una opción.</small>
								</div>
								<?php $subject = $cell['tematicas'];   ?>
				                <div class="d-flex px-2 px-md-5 px-lg-4 mr-lg-1 mr-md-5 py-2 my-2 subject flex-wrap flex-sm-nowrap">
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="classic" name="subject[]" value="Clasico" <?php if (strpos($subject,"Clasico") !== false)  echo "checked"; else echo ""; ?>>
						                <label class="custom-control-label" for="classic">Clásicos</label>
				                	</div>
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="nacionales" name="subject[]" value="Nacional" <?php if (strpos($subject,"Nacional") !== false)  echo "checked"; else echo ""; ?>>
						                <label class="custom-control-label" for="nacionales">Nacionales</label>
				            		</div>
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="suspenso" name="subject[]" value="Suspenso"  <?php if (strpos($subject,"Suspenso") !== false)  echo "checked"; else echo ""; ?>>
						                <label class="custom-control-label" for="suspenso">Suspenso</label>
				                	</div>
				                	<div class="form-check mr-ld-4 mr-3">
						                <input type="checkbox" class="custom-control-input" id="fantasia" name="subject[]" value="Fantasia"  <?php if (strpos($subject,"Fantasia") !== false)  echo "checked"; else echo ""; ?>>
						                <label class="custom-control-label" for="fantasia">Fantasía</label>
				                	</div>
				                	<div class="form-check">
						                <input type="checkbox" class="custom-control-input" id="surrealismo" name="subject[]" value="Surrealismo"  <?php if (strpos($subject,"Surrealismo") !== false)  echo "checked"; else echo ""; ?>>
						                <label class="custom-control-label" for="surrealismo">Surrealismo</label>
				                	</div>
				                </div>
							</div>
					    </div>
				    	<div class="row">
				    		<div class="col-md-10">
				    			<label for="des" class="d-block font-weight-bold">Descripción:</label>
				    			<?php echo '<textarea class="p-3 form-control" name="description" id="des"  rows="10" maxlength="1200" required>'.$cell['descripcion_libro'].'</textarea>';?>
				    		</div>
				    		<div class="col-md-2 mt-md-5 d-none d-md-block">
				    			<img src="<?php echo $cell['imagen_libro'];  ?>" class="img-fluid img-thumbnail" alt="<?php echo $cell['nombre_libro'];  ?>" title="<?php echo $cell['nombre_libro'];  ?>">
				    		</div>
				    	</div>
				    	<!-- BOTONES DESDE TAMAÑO MD -->
		    			<div class="d-none d-md-flex justify-content-between upload-buttons">
	    					<div class="d-flex mt-3">
	    						<a href="./index.php" class="mr-2">
	    							<button type="button" class="btn btn-dark">Cancelar</button>
	    						</a>
	    					</div>
	    					<div>
	    						<div class="form-group mt-3">
	    							<input type="submit" class="btn btn-success" name="editbook" value="Aceptar">
	    						</div>
	    					</div>
		    			</div>
		    			<!-- BOTONES PARA SM -->
		    			<div class="row d-md-none">
		    				<div class="col d-flex justify-content-between">
		    					<a href="./index.php">
		    						<button type="button" class="btn btn-dark mt-3 btn-sm">Cancelar</button>
		    					</a>
		    					<div class="form-group mt-3">
		    						<input type="submit" class="btn btn-success btn-sm" name="editbook" value="Aceptar">
		    					</div>
		    				</div>
		    			</div>
	    				<input type="hidden" name="id" value="<?php echo $cell['id_libro'];  ?>">
					</form>
		        </section>
		    </div>
	    </div>
	</main> 
<?php
require('./include/footer.php');
?>
