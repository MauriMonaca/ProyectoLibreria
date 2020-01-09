<?php
session_start();
require ('./include/header.php');
require_once ('./include/connect.php');
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$sql = "SELECT * FROM libros WHERE ( autor_libro LIKE '%$search%' OR nombre_libro LIKE '%$search%' OR tematicas LIKE '%$search%' ) ";
	$query = mysqli_query($link,$sql);
	if (mysqli_num_rows($query) < 1) {
		$noSearch = "<div class='row d-flex justify-content-center'><div class='alert alert-danger text-center mt-3 nosearch'><p><b>No se encontraron resultados para lo que usted está buscando.</b></p><p><a href='./index.php'>Volver al Inicio</a></p></div></div>";
		echo $noSearch;
	}
	else { ?>
		<main class="container-fluid p-0 m-0">
			<div class="container">	
				<div class="row no-gutters d-sm-none">
				<!-- CARRITO PARA MOBILE -->
				<?php if ( (isset($_SESSION['user'])) || (isset($_SESSION['admin'])) ) { ?>
						<div class="offset-6 offset-md-8 offset-sm-7 col-6 col-sm-4 cart-button cart-button-mobile pt-1 px-2 mt-3 overflow-hidden shrink" >
							<a href="cart.php" class="d-flex overflow-hidden px-2">
								<p class="text-nowrap">Tu carrito</p>
								<p class="overflow-hidden d-flex">
									<i class="ml-1 fas fa-shopping-cart"></i>
									<!-- CONTADOR DE CARRITO -->
									<?php if (isset($_SESSION['total'])) {
										$totalBooks = $_SESSION['total'];
										if ($totalBooks != 0) {
											echo "<p class='counter-cart px-1 pt-1'>$totalBooks</p>";
											}
										}
									?>
								</p>
							</a>
						</div>
				<?php } ?>
			</div>
			<div class="row no-gutters">
				<div class="d-flex flex-column-reverse flex-md-row justify-content-between align-items-md-end mb-lg-3 col-md-8 col-lg-7">
					<div class="mb-4 mt-md-5 my-lg-0">
						<div class="recommended px-lg-4 py-lg-2 pt-1 px-2">
							<h2>Obras recomendadas...</h2>
						</div>
					</div>
					<div class="welcome align-self-center">
						<div class="welcome-img p-lg-3 p-1 overflow-hidden">
							<img src="img/magicbook.png" alt="Bienvenido" class="img-fluid" title="Bienvenido">
						</div>
					</div>
				</div>
				<?php if ( (isset($_SESSION['user'])) || (isset($_SESSION['admin'])) ) { ?>
						<div class="offset-md-8 offset-lg-2 col-md-4 col-lg-2 cart-button 
						 py-1 px-2 mt-3 mb-3 ml-lg-auto  d-none d-lg-block" >
							<a href="cart.php">
								<p>Tu carrito
									<i class="ml-1 fas fa-shopping-cart"></i>
									<!-- CONTADOR DE CARRITO -->
									<?php if (isset($_SESSION['total'])) {
										$totalBooks = $_SESSION['total'];
										if ($totalBooks != 0) {
											echo "<p class='counter-cart px-1'>$totalBooks</p>";
											}
										}
									?>
								</p>
							</a>
						</div>
				<?php } ?>
			</div>
			<div class="row no-gutters">
				<section class="col-12 px-5 pt-lg-3 books-wrap py-3" id="books-catalogue">
					<div class="row px-0 pt-2">
						<div class="offset-lg-11 col-lg-1 mb-4 offset-8 offset-sm-10">
							<select class="coin" id="selectCoin" title="Elegir Moneda">
								<option value="ARS">$ ARS</option>
								<option value="BRL">$ BRL</option>
								<option value="UYU">$ UYU</option>
								<option value="MXN">$ MXN</option>
								<option value="USD">$ USD</option>
								<option value="EUR">€ EUR</option>
							</select>
						</div>
					</div>
					<div class="row">
							<?php
							while ($cell = mysqli_fetch_array($query)) {
							?>
							<article class="col-lg-4 border border-dark col-sm-6 pb-lg-3 pb-0">
								<div class="card p-3 pb-lg-0">
							 		<div class="img-container overflow-hidden px-lg-4 px-2 py-0">
							 			<a href="#" data-toggle="modal" data-target="#modalBookIDnumber<?php echo $cell['id_libro']; ?>">
							 				<img src="<?php echo $cell['imagen_libro'];  ?>" class="card-img-top img-fluid" alt="<?php echo $cell['nombre_libro'];  ?>" title="<?php echo $cell['nombre_libro'];  ?>">
							 			</a>
							 		</div>
						  			<div class="card-body p-0">
									   <div class="d-flex justify-content-between mx-lg-3">
									   	<div class="d-flex flex-column justify-content-between mt-2 p-0">
									   	  <h3 class="card-title mb-0 title-book mx-n2"><?php echo $cell['nombre_libro'] . "&nbsp(" . $cell['anio'] . ")";  ?></h3>
									   	  <p class="card-text mt-1 mx-n2"><small><?php echo $cell['autor_libro'];  ?></small></p>
									   	</div>
									   </div>
									   <p class="price mx-lg-3 mb-0 mx-n2">
									   	<span class="priceSign"></span>
									   	<span class="priceBook"><?php echo $cell['precio_libro']; ?></span><small class="smallCoin"></small>
									   </p>
									   <div class="card-buttons d-flex flex-row justify-content-between mx-n2 mx-sm-n4 mx-md-0 mx-lg-2">
										    <button class="add-cart-button text-left pb-sm-3 px-2 mb-0  m-sm-0" type="button">
									    	  	<a href="./add_cart.php?item=<?php echo $cell['id_libro'];?>" title="Añadir">Añadir al carro</a>
									    	</button>
									        <a href="#" data-toggle="modal" data-target="#modalBookIDnumber<?php echo $cell['id_libro']; ?>">
									    	 	<p class='detail px-2 ml-auto'>Detalles</p>
									    	</a>
									   	</div>
							  		</div>
								</div>
							</article>
							<!-- MODAL DESCRIPCION LIBRO -->
							<div class="modal fade" id="modalBookIDnumber<?php echo $cell['id_libro']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalBookIDnumber<?php echo $cell['id_libro']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content modal-window pb-lg-2">
							      <div class="modal-header pb-1">
							        <div>
							        	<h4 class="modal-title font-weight-bold" id="modalBookIDnumber<?php echo $cell['id_libro']; ?>"><?php echo $cell['nombre_libro']; ?><br>
							        		<small class="lead"><?php echo $cell['autor_libro'] . "&nbsp(" . $cell['anio'] . ")";  ?></small>
							        	</h4>
							        	<p class="mb-0"><u>Editorial</u>: <?php echo $cell['editorial'];  ?></p>
							        </div>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body d-sm-none d-md-block">
							        <div class="row">
						        		<div class="modal-img mx-auto ">
						        			<img src="<?php echo $cell['imagen_libro'];  ?>" class=" img-fluid" alt="<?php echo $cell['nombre_libro'];  ?>" title="<?php echo $cell['nombre_libro'];  ?>">
						        		</div>
						        	</div>
						        	<div class="row pt-4">
						        		<p class="modal-descri mt-4 text-justify text-indent">
						        			<?php echo $cell['descripcion_libro'];  ?>
						        		</p>
						        	</div>
							      </div>
							      <div class="modal-body d-none d-sm-block d-md-none">
							        <div class="row">
							        	<div class="col-6">
							        		<div class="modal-img">
							        			<img src="<?php echo $cell['imagen_libro'];  ?>" class=" img-fluid" alt="<?php echo $cell['nombre_libro'];  ?>" title="<?php echo $cell['nombre_libro'];  ?>">
							        		</div>
							        	</div>
							        	<div class="col-6">
							        		<div class="modal-descri">
							        			<?php echo $cell['descripcion_libro'];  ?>
							        		</div>
							        	</div>
							        </div>
							      </div>
							    </div>
							  </div>
							</div>
						<?php }  ?>
						</div>
					</section>
				</div>
			</div>
		</main>	
	<?php }
	mysqli_close($link);
	require('./include/footer.php');
	}
?>