<?php
include 'global/configServer.php';
include 'global/connectionDB.php';
?>
<!DOCTYPE html>
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
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li>
							<li class="nav-item submenu dropdown">
								<a href="category.php" class="nav-link dropdown-toggle" role="button" aria-haspopup="true"
								 aria-expanded="false">Productos</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="porta-carbones.php">Porta Carbones</a></li>
									<li class="nav-item"><a class="nav-link" href="reguladores.php">Reguladores</a></li>
									<li class="nav-item"><a class="nav-link" href="porta-diodos.php">Porta Diodos</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="single-blog.html">Sobre Nosotros</a></li>
							<li class="nav-item"><a class="nav-link" href="contact2.php">Contáctanos</a></li>
							<li class="nav-item"><a class="nav-link" href="login_admin.php">¿Eres empleado?</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>¡Todo lo que necesitas para tu <br>auto!</h1>
									<p>En El Huasteco Autopartes podrás encontrar todo lo que necesitas para el mantenimiento de tu
										automóvil, camioneta o camión.
									</p>
								</div>
								
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/product/alternador.png" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>¡Lo que necesitas a un <br>gran precio!</h1>
									<p>Nos complace brindar productos de calidad a un precio que no encontrarás en otra parte.
									</p>
									
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/product/carbones.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Últimos productos</h1>
							<p>Mira aquí nuestros últimos productos.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/12507.png" alt="">
							<div class="product-details">
								<h6>12507 12507 DELCO CHEVROLET PG260M</h6>
								<div class="price">
									<h6>$195.00</h6>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/41927.png" alt="">
							<div class="product-details">
								<h6>41927 REGULADOR PARA ALTERNADOR DELCO SERIE AD221 CHEVROLET AVEO SUZUKI SWIFT PONTIAC ( 3 TERMINALES )</h6>
								<div class="price">
									<h6>$560.00</h6>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/41892.png" alt="">
							<div class="product-details">
								<h6>41892 PORTA DIODOS PARA ALTERNADOR NIPPONDENSO HONDA ACURA CHEVROLET KIA HYUNDAI ( 117MM )</h6>
								<div class="price">
									<h6>$860.00</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Últimos productos</h1>
							<p>Mira aquí nuestros últimos productos.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/37379.png" alt="">
							<div class="product-details">
								<h6>37379 PORTA CARBON PARA MARCHA DELCO SERIE PG260G CHEVROLET ISUZU</h6>
								<div class="price">
									<h6>$220.00</h6>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/42024.png" alt="">
							<div class="product-details">
								<h6>42024 REGULADOR PARA ALTERNADOR NIPPONDENSO HONDA TOYOTA PDO VERDE IN220</h6>
								<div class="price">
									<h6>$495.00</h6>
								</div>
							</div>
						</div>
					</div>
					<!-- single product -->
					<div class="col-lg-4 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="img/product/43724.png" alt="">
							<div class="product-details">
								<h6>41818 PORTA DIODOS PARA ALTERNADOR FORD SERIE 1G HERRADURA ALAMBRE FR1070</h6>
								<div class="price">
									<h6>$560.00</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->
	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Envio Gratis</h6>
						<p>Entrega por paquetería</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Política de garantía</h6>
						<p>30 días de garantía en marchas y alternadores</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>Contáctanos 24/7</h6>
						<p>Se reciben pedidos a travéz de correo electrónico o llamada telefónica</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Pagos seguros</h6>
						<p>Pagos se realizan mediante depósito</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 col-md-12">
					<div class="row">
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/categorias.jpg" alt="">
								<a href="img/category/c1.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title"><a href="category.php">Productos</a></h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/sobre nosotros.jpg" alt="">
								<a href="img/category/c4.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title"><a href="single-blog.html">Sobre Nosotros</a></h6>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/contactanos.jpg" alt="">
								<a href="img/category/c4.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title"><a href="contact.html">Contáctanos</a></h6>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->

	

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="section-title">
				<h3>Nuestras marcas</h3>
			</div>
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/bosch.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/total-parts.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/WAI2.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/injetech2.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/renard.png" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->

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
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>