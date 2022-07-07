<!DOCTYPE html>
<?php
include 'global/configServer.php';
include 'global/connectionDB.php';
?>
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
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body id="category">

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="img/NLogo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
							<li class="nav-item active submenu dropdown">
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

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Categorías</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Inicio<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Productos<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.php">Categorías</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Categorías</div>
					<ul class="main-categories">
						<li class="main-nav-list"><a href="porta-carbones.php">Porta carbones</a></li>
						<li class="main-nav-list"><a href="reguladores.php">Reguladores</a></li>
						<li class="main-nav-list"><a href="porta-diodos.php">Porta diodos</a></li>
					</ul>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<?php
						$QueryProductos=$pdo->prepare("SELECT * FROM `tbl_productos`");
						$QueryProductos->execute();
						$ProductosLista=$QueryProductos->fetchAll(PDO::FETCH_ASSOC);
						//print_r($ProductosLista);
						?>
						<?php foreach($ProductosLista as $producto) { ?>
						<!-- single product -->
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="skydash/images/productImg/<?php echo $producto['imagen']; ?>" alt="">
								<div class="product-details">
									<h6><?php echo $producto['descripcion']; ?></h6>
									<div class="price">
										<h6>$<?php echo $producto['precio']; ?></h6>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>

				</section>
				<!-- End Best Seller -->
			</div>
		</div>
	</div>

	

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
							<li>a
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
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>