<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 shrink-to-fit=no">
	<meta name="keywords" content="libros, autores, best-sellers, best, sellers, novelas, clásicos, libreria, online, policiales, suspenso, fantasia, libreria">
	<meta name="description" content="Variedad de libros, novelas y autores, tienda online">
	<meta name="author" content="Mauricio Mónaca">
	<meta name="distribution" content="global">
	<meta name="Robots" content="all">
	<meta name="MobileOptimized" content="width"> 
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
	<?php
	  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
	?>
	<link rel="shortcut icon" href="./img/book.jpg">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">	
	<link rel="stylesheet" type="text/css" href="./css/normalize.css">
	<link href="https://fonts.googleapis.com/css?family=Paytone+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Spectral+SC&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Special+Elite&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/2e8a4ec2f4.js" crossorigin="anonymous"></script>
	<title>- Librería Gran Callejón -</title>
</head>
<!-- // Extra small devices (portrait phones, less than 576px)
// No media query for `xs` since this is the default in Bootstrap

// Small devices (landscape phones, 576px and up)
@media (min-width: 576px) { ... }

// Medium devices (tablets, 768px and up)
@media (min-width: 768px) { ... }

// Large devices (desktops, 992px and up)
@media (min-width: 992px) { ... }

// Extra large devices (large desktops, 1200px and up)
@media (min-width: 1200px) { ... } -->
<body class="">
	<div>
		<!-- SEARCH PARA MOVILES  -->
		<div class="search-toggle-contain d-lg-none overflow-visible" id="search-toggle-contain">	
			<div class="masthead  overflow-visible">
			  <form method="get" action="./search.php" class="masthead-search  overflow-visible">
			    <label for="masthead-search-toggle" class="masthead-search-toggle" id="toggle"></label>
			    <input type="checkbox" id="masthead-search-toggle" class="isHidden"/>
			    <div class="masthead-search-indicator" id="masthead-search-indicator"></div>
			    <div class="masthead-search-search">
			      <label for="masthead-search-search" class="isHidden"></label>
			      <input type="search" id="masthead-search-search" name="search" aria-label="search" placeholder="Busque por título o autor..." required autofocus />
			    </div>
			  </form>
			</div>
		</div>
		<div class="header-mobile bg-dark p-md-2 pt-0 px-2 pb-2 overflow-hidden d-block d-lg-none" id="header-mobile">
			<div class="row overflow-hidden">
				<div class="col-lg-7 p-0 col-12">
					<div class="title ml-lg-5 mt-lg-2 ml-3 overflow-hidden mt-1">
						<a href="index.php">
							<h1 class="text-nowrap pl-md-5 mb-md-2 ml-md-5">Librería Gran Callejón</h1>
						</a>
					</div>
				</div>
			</div>
		</div>
		<header class="bg-dark p-md-2 pt-0 px-2 pb-2 overflow-hidden d-none d-lg-block">
			<div class="row overflow-hidden">
				<div class="col-lg-7 p-0 col-12">
					<div class="title ml-lg-5 mt-lg-2 ml-3 overflow-hidden">
						<a href="index.php">
							<h1 class="text-nowrap">Librería Gran Callejón</h1>
						</a>
					</div>
				</div>
				<div class="col-lg-5 p-0 pr-4">
					<div class="row d-none d-lg-flex flex-nowrap">
						<div class="col-10 p-0 login">
							<div class="d-flex justify-content-start flex-nowrap hello">
								<!-- ZONA DE CUENTAS PARA PC -->
								<?php 
								$account = "account";
								if (isset($_SESSION['admin'])){
									$account = $_SESSION['admin'];
									echo "<span class='hello-user'>" . $account . "</span>&nbsp|&nbsp<a href='./closesession.php' class='close-session'>Cerrar Sesión</a>";
									}
								else if (isset($_SESSION['user'])){
									$account = $_SESSION['user'];
									echo "<span class='hello-user'>Hola&nbsp" . $account."</span>&nbsp|&nbsp<a href='./closesession.php' class='close-session'>Cerrar Sesión</a>";
									}
								else {
									echo "<a href='register.php' class='mx-2'>
									Regístrate
									</a> |
									<a href='./login.php' class='ml-2'>
									<i class='fas fa-user-circle'></i>
									Inicia Sesión
									</a>";
									}
								?>
							</div>
						</div>
						<div class="col-lg-2 p-0 redes">
							<div class="ml-auto">
								<a href="#">
									<i class="fab fa-facebook mr-2"></i>
								</a>
								<a href="#">
									<i class="fab fa-twitter mr-2"></i>
								</a>
								<a href="#">
									<i class="fab fa-instagram mr-2"></i>
								</a>
							</div>
						</div>
					</div>
					<div class="row w-100 d-none d-lg-block">
						<div class="mt-3 p-0 d-flex  iconos-header">
							<a href="./us.php">
								<div class="ml-auto d-flex justify-content-start">
									<i class="fas fa-info-circle px-2"></i>
									<div class="px-2 p-0 lead">Acerca de Nosotros</div>
								</div>
							</a>
							<a href="./contactform.php">
								<div class="ml-2 d-flex justify-content-start">
									<i class="far fa-envelope px-2"></i>
									<div class="px-2 p-0 lead" id="cont">Contacto</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<nav class="navbar navbar-expand-lg pl-lg-4 pl-1 py-sm-0 justify-content-start justify-content-sm-between">
		  <a class="navbar-brand px-1 ml-1 mr-0 mr-md-2 ml-sm-3 mr-lg-1" href="index.php">
		  	<i class="fas fa-book-open book-icon"></i>
		  </a>
		  <div class="col-9 p-0 login d-lg-none mr-0 ml-n2">
			<div class="d-flex justify-content-start flex-nowrap login-mobile">
				<!-- ZONA DE CUENTA PARA MOVILES -->
				<?php 
				$account = "account";
				if (isset($_SESSION['admin'])){
					echo "<div class='d-flex flex-column flex-sm-row pl-4 ml-sm-n3 ml-md-n4'>";
					$account = $_SESSION['admin'];
					echo "<div>" . $account . "</div><div class='d-none d-sm-block'>&nbsp|&nbsp</div><div class='text-nowrap'><a href='./closesession.php' class='close-session'>Cerrar Sesión</a></div></div>";
					}
				else if (isset($_SESSION['user'])){
					echo "<div class='d-flex flex-column flex-sm-row pl-4 ml-sm-n3 ml-md-n4'>";
					$account = $_SESSION['user'];
					echo "<div>Hola&nbsp" . $account . "</div><div class='d-none d-sm-block mx-sm-2'>&nbsp|&nbsp</div><div class='text-nowrap'><a href='./closesession.php' class='px-0 close-session'>Cerrar Sesión</a></div></div>";
					}
				else {
					echo "<a href='register.php' class='ml-2 mr-1 px-1'>
					Regístrate |
					</a>
					<a href='./login.php' class='ml-0 px-1'>
					<i class='fas fa-user-circle'></i>
					Login
					</a>";
					}
					?>
			</div>
		  </div>
		  <!-- LISTA DE MENU Y BOTON -->
		  <button class="navbar-toggler px-0 ml-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <i class="fas fa-bars"></i>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-lg-auto pl-lg-3 pl-1 mt-sm-n2  mt-md-0 pl-sm-4 px-md-5 px-lg-2">
		      <li class="nav-item ml-5 pr-md-1">
		        <a class="nav-link <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/index.php' ) echo 'actived'; ?>" href="index.php">Inicio <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item ml-5 ml-lg-2 pr-md-1">
		        <a class="nav-link <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=clasico' ) echo 'actived'; ?>" href="./search.php?search=clasico">Clásicos</a>
		      </li>
		      <li class="nav-item ml-5 ml-lg-2 pr-md-1">
		        <a class="nav-link <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=nacional' ) echo 'actived'; ?>" href="./search.php?search=nacional">Nacionales</a>
		      </li>
		      <li class="nav-item ml-5 ml-lg-2 pr-md-1">
		        <a class="nav-link  <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=suspenso' ) echo 'actived'; ?>" href="./search.php?search=suspenso">Suspenso</a>
		      </li>
		      <li class="nav-item dropdown ml-5 ml-lg-2 pr-md-1">
		        <a class="nav-link dropdown-toggle <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=surrealismo' || $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=fantasia' ) echo 'actived'; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Ciencia Ficción
		        </a>
		        <div class="dropdown-menu py-0" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item  <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=fantasia' ) echo 'actived'; ?>" href="./search.php?search=fantasia">Fantasía</a>
		          <a class="dropdown-item  <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/search.php?search=surrealismo' ) echo 'actived'; ?>" href="./search.php?search=surrealismo">Surrealismo</a>
		      </li>
		      <li class="nav-item d-flex d-lg-none align-items-center">
		      	<i class="fas fa-info-circle px-2 mt-1 <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/us.php' ) echo 'actived'; ?>"></i>
		        <a class="nav-link text-nowrap  <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/us.php' ) echo 'actived'; ?> ml-2" href="./us.php">ACERCA DE NOSOTROS</a>
		      </li>
		      <li class="nav-item d-flex d-lg-none align-items-center">
		      	<i class="far fa-envelope px-2 mt-1 <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/contactform.php' ) echo 'actived'; ?>"></i>
		        <a class="nav-link  <?php if ( $_SERVER['REQUEST_URI'] == '/cursos/callejon/contactform.php' ) echo 'actived'; ?> ml-2" href="./contactform.php">CONTACTO</a>
		      </li>
		    </ul>
		    <form class="form-inline my-0 d-none d-lg-block search-top search-pc" method="get" action="./search.php">
		      <input class="form-control searcher" type="search" name="search" size="40" aria-label="Search" placeholder="Busque por título o autor...">
		      <button class="btn my-2 my-sm-0" type="submit">
		      	<i class="fas fa-search fa-2x"></i>
		      </button>
		    </form>
		  </div>
		</nav>
		<!-- PANEL ADMIN  -->
		<?php 
			if(isset($_SESSION['admin'])){
				echo "<div class='admin-options px-lg-5 py-2 px-3'>
				ADMIN: <a href='admintable.php' class='mx-2'>MODIFICAR LIBRERIA</a> | <a href='uploadbook.php' class='mx-2'>ALTA DE LIBROS</a>
				</div>";}
		?>
		</div>
	</div>