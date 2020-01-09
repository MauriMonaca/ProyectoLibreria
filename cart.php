<?php 
session_start();
if (!isset($_SESSION['cart'])) {
	echo "<script type='text/javascript'>
    alert('Carrito Vacio..');
    window.location.href='index.php';</script>";
}
else{
	require('./include/header.php');
	// require('./include/connect.php');
	?>
	<div class="container py-4">
		<div class="row">
			<div class="col-12 mb-3">
				<h2 class="text-center" id="cartTitle">Tu Carrito</h2>
			</div>
		</div>
		<div class="row px-0 pt-2">
			<div class="offset-lg-11  offset-md-9 offset-7 col-lg-1 col-5 mb-1 offset-8">
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
		<div class="d-flex flex-column cart-page mt-2">
			<?php
			  	$total = 0;
				$array = $_SESSION['cart'];
				if (isset($_REQUEST['takeOff'])) {
					$takeKey = $_REQUEST['takeOff'];
					// CONTADOR DE CARRITO
					 if (isset($_SESSION['total'])) {
						$totalBooks = $_SESSION['total'];
						$totalBooks -= $array[$takeKey]['quantity'];
						$_SESSION['total'] = $totalBooks;
						}
					// CORTO ESE ELEMENTO POR MEDIO DE SU INDICE
					array_splice($array,$takeKey,1);
				}
				foreach ($array as $row) {
					$id = $row['id'];
					$name = $row['name'];
					$author = $row['author'];
					$img = $row['img'];
					$price = $row['price'];
					$quantity = $row['quantity'];
					$stock = $row['stock'];
					$total += $price;
			  ?>	
			<div class="row d-flex pl-md-5 pt-2 order-1 order-md-0 flex-column flex-md-row flex-wrap flex-shrink-1 overflow-hidden">
				<div class="pl-md-5 pl-3 pt-md-3 order-1 order-md-0 overflow-hidden mt-3 title">
					<p class="mb-2 title-name"><b><?php echo $name; ?></b></p>
					<p class="author"><?php echo $author; ?></p>
				</div>
		    	<div class="order-0 order-md-1 portrait mx-5 my-1">
		    		<div class="text-center d-inline-block mx-md-auto img-carrito mb-md-2">
		    			<img  class="img-fluid mb-2" src="<?php echo $img; ?>" alt="<?php echo $name;  ?>" title="<?php echo $name; ?>"/>
		    		</div>
		    	</div> 
				<div class="mr-md-auto mt-md-4 pt-md-3 order-2 pl-3 pl-md-0 flex-grow-1 quant">
						<label for="quan">Cantidad: </label>
						<input type="number" name="quantity" min="0" max="<?php echo $stock; ?>" value="<?php echo $quantity; ?>" class="pl-2 quan" id="quan"> 
						<span class="priceBook d-none unitPrice"><?php echo $price; ?></span>	
				</div>
				<div class="mr-md-5 pr-md-4 pt-1 pt-md-3 pl-3 pl-md-auto mt-md-4 order-3 flex-grow-1 d-flex justify-content-md-end text-right">
					<p class="mb-1 lead mr-1 mr-sm-5 mr-lg-3 price mt-md-1">
						<span class="priceSign"></span>
						<span class="priceBook subtotalPrice"><?php echo $price; ?></span>
						<small class="smallCoin"></small>
					</p>
					<?php echo "<a href='./cart.php?takeOff=" . key($array) . "' title='Quitar del Carrito' class='align-self-start'>";?>
					<?php next($array); ?>
					<button class="btn btn-sm take-off">
						<i class="fas fa-window-close"></i>
					</button>
					</a>
				</div>
			</div>
			<?php } ?>
			<div class="d-flex justify-content-md-between align-items-center align-content-center mb-3 mb-md-0 pt-lg-4 order-0 order-md-1 total-buy pl-lg-5 pl-3 mt-md-5">
				<div class="d-flex flex-column flex-md-row align-items-center align-content-center">
					<button  onclick=window.location="buybook.php" class="btn-buy btn mb-2 mb-md-0 mr-4 py-lg-1 px-2 ">Comprar</button>
				</div>
				<h5 class="mt-2 text-right ml-auto total-price">
					Total: 
					<span class="font-weight-bold p-2">
						<span class="priceSign"></span>
						<span class="priceBook" id="totalPrice"><?php echo $total; ?></span>
						<small class="smallCoin"></small>
					</span>
				</h5>
			</div>
		</div>
	</div>
	<?php
	if (empty($array)){
		$totalBooks = 0;
		unset($_SESSION['total']);
		unset($_SESSION['cart']);?>
		<script type="text/javascript">
		// vaciar localstorage al haber carrito vacio
		if (localStorage.getItem("quantities")) {
			localStorage.removeItem("quantities");
		}
		window.location = "./index.php?page=1";
		</script>
	<?php
	}
	else {
		$_SESSION['cart'] = $array;
	}
 } 
// mysqli_close($link);
include('./include/footer.php');
 ?>


