<!doctype html>
<html class="no-js" lang="zxx">
    <?php
    $result = "";
    $error  = "";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
  /*  $txtName = (isset($_POST['name']))?$_POST['name']:"";
   $txtEmail = (isset($_POST['email']))?$_POST['email']:"";
   $txtSubject = (isset($_POST['subject']))?$_POST['subject']:"";
   $txtMessage = (isset($_POST['message']))?$_POST['txtCategory']:""; */
try{
   if(isset($_POST['submitB']))
   {

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
       require 'PHPMailer/Exception.php';
       require 'PHPMailer/PHPMailer.php';
       require 'PHPMailer/SMTP.php';
    //Create an instance; passing `true` enables exceptions
       $mail = new PHPMailer(true);
   
   
       //Server settings
       $mail->SMTPDebug = 0;                      //Enable verbose debug output
       $mail->isSMTP();                                            //Send using SMTP
       $mail->Host       = 'elhuastecorefacciones.tk';                     //Set the SMTP server to send through
       $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
       $mail->Username   = 'contacto@elhuastecorefacciones.tk';                     //SMTP username
       $mail->Password   = 'DVx5Kq0lLOsw';                               //SMTP password
       $mail->SMTPSecure = 'ssl';               //Enable implicit TLS encryption
       $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
   
       //Recipients
	   $to = 'contacto@elhuastecorefacciones.tk';
       $mail->setFrom('contacto@elhuastecorefacciones.tk', 'Contacto');
       //$mail->addAddress('contacto@cookietienda.tk', 'Contacto');     //Add a recipient
       //$mail->addAddress('contacto@cookietienda.tk');               //Name is optional
       //$mail->addReplyTo('contacto@cookietienda.tk', 'Information');
       //$mail->addCC('contacto@cookietienda.tk');
       //$mail->addBCC('contacto@cookietienda.tk');
       //$mail->setFrom($_POST['email'],$_POST['name']);
       
       $mail->isHTML(true);    
       $mail->addReplyTo($_POST['email'],$_POST['name']);    
       $mail->addAddress($to);//correo del cliente aqui
       $mail->Subject='Form Submission:' .$_POST['subject'];
       $mail->Body='<h3>Name :'.$_POST['name'].'<br> Email: '.$_POST['email'].'<br>Message: '.$_POST['message'].'</h3>'; 
       //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
       //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
       //Content
       
                               //Set email format to HTML
       //$mail->Subject = 'Here is the subject';
       //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
       $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
   
       
       $mail->send();
       /* if(!$mail->send())
       {
         $error = "Something went worng. Please try again.";
       }
       else 
       {
         $result="Thanks\t" .$_POST['name']. " for contacting us.";
       } */
   }
}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}  
   ?>
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
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.php"><img src="img/NLogo2.png" alt=""></a>
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
							<li class="nav-item active"><a class="nav-link" href="contact2.php">Contáctanos</a></li>
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
					<h1>Contáctanos</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Inicio<span class="lnr lnr-arrow-right"></span></a>
						<a href="contact2.php">Contacto</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6>Reynosa, Tamaulipas, México</h6>
							<p>Blvd. Álvaro Obregón #1812 Col. Cavazos</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6><a href="#">(899) 2920 227</a></h6>
							<p>Lunes a Sábado 9am a 5pm</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6><a href="#">roberto_garciaponce
								@yahoo.com.mx</a></h6>
							<p>Contáctanos en cualquier momento</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" method="POST">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Ingresar nombre" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresar nombre'" required>
							</div>
							<div class="form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Ingresar correo electrónico" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresar correo electrónico'" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Ingresar asunto" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresar asunto'" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="message" id="message" rows="1" placeholder="Ingresar mensaje" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingresar mensaje'"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="submit" name="submitB" value="submitB" class="primary-btn">Enviar mensaje</button>
						</div>
					</form>
				</div>
			</div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254.35151725398327!2d-98.2812123070423!3d26.06694073201638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86650fbbe3d33d53%3A0x4642df320dfc4cf5!2sEl%20Huasteco%20Refacciones!5e0!3m2!1sen!2smx!4v1634099025691!5m2!1sen!2smx" width="1100" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</section>
	<!--================Contact Area =================-->

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

	<!--================Contact Success and Error message Area =================-->
	<div id="success" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Thank you</h2>
					<p>Your message is successfully sent...</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Modals error -->

	<div id="error" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Sorry !</h2>
					<p> Something went wrong </p>
				</div>
			</div>
		</div>
	</div>
	<!--================End Contact Success and Error message Area =================-->


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