<!DOCTYPE html>
<?php
include 'global/configServer.php';
include 'global/connectionDB.php';
//se inicia la sesion 
session_start();
$message = "";
$email = "";
$password = "";
if (isset($_POST["login"])) {

	if (!empty($_POST['email']) && !empty($_POST['contra'])) {
		//se toman los vales de corre y password del formulario 
		$email = $_POST['email'];
		$password = $_POST['contra'];
		//aqui se verifica que trae la  cuenta usando el correo, si es de administradores, se usa la tabla de administradores/usuarios.
		$query = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE email = :email");
		$query->bindParam("email", $email);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$passBD = $result['contra'];
		if (!$result) {
			echo '<p class="error">La combinacion del usuario y la contraseña son invalidos</p>';
		} else {
			if ($result['email'] == $email) {

				if (password_verify($password, $passBD)) {
					//si quieren que aparezca el nombre, usen $result['CampoNombre'];
					$_SESSION['session_username'] = $email;
					$_SESSION['session_tipousuario'] = $result['tipoUsuario_id'];
					if ($_SESSION['session_tipousuario']==1){
						header('Location: skydash/productos.php');	
					}
					else if ($_SESSION['session_tipousuario']==2){
						header('Location: skydash/productos.php');	
					}
					

					
				} else {

					$message = "Contraseña invalida";
				}
			} else {
				$message = "Nombre de usuario invalido";
			}
		}
	} else {
		$message = "Todos los campos son requeridos";
	}
}

?>
<html lang="zxx" class="no-js">

<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/PLogo.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>El Huasteco Refacciones</title>
	<!--
				CSS
				============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
</head>


<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.php"><img src="img/NLogo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
							<li class="nav-item submenu dropdown">
								<a href="category.php" class="nav-link dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Productos</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="porta-carbones.php">Porta Carbones</a></li>
									<li class="nav-item"><a class="nav-link" href="reguladores.php">Reguladores</a></li>
									<li class="nav-item"><a class="nav-link" href="porta-diodos.php">Porta Diodos</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="single-blog.html">Sobre Nosotros</a></li>
							<li class="nav-item"><a class="nav-link" href="contact2.php">Contáctanos</a></li>
							<li class="nav-item active"><a class="nav-link" href="login_admin.php">¿Eres empleado?</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Iniciar sesión</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Inicio<span class="lnr lnr-arrow-right"></span></a>
						<a href="login_admin.php">Iniciar sesión</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/login.jpg" alt="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Iniciar sesión para entrar</h3>
						<span class="error"> <?= $message ?></span>
						<form class="row login_form" action="" method="POST" id="loginform" name="loginform">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Correo">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="contra" name="contra" placeholder="Contraseña">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" name="login" value="submit" class="primary-btn">Entrar</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Sobre nosotros</h6>
						<p>
							“El Huasteco Refacciones” es una empresa de giro comercial dedicada a la venta de refacciones
							para automóviles, camiones y camionetas.
						</p>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Productos</h6>
						<ul style="list-style-type: circle;">
							<li>
								Porta Carbones
							</li>
							<li>
								Reguladores
							</li>
							<li>
								Porta Diodos
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Contactos</h6>
						<ul>
							<i class="lnr lnr-phone-handset"></i>
							<li>(899) 2920 227</li>
							<li>(899) 3409 005</li>
							<li>(899) 1211 632</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>¡Síguenos en Facebook!</h6>
						<div class="footer-social d-flex align-items-center">
							<a href="https://www.facebook.com/ElHuastecoRefacciones"><i class="fa fa-facebook"></i> facebook </a>

						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved </a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->


	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>