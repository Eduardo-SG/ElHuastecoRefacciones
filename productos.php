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
	<title>Datos del producto</title>

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
<?php
//debemos revisar si los input tienen informacion
//isset(what we check)-?-if true-:-if false;
$txtID = (isset($_POST['txtID']))?$_POST['txtID']:""; //['nombre/id de su input en el formulario']
$txtCategoria = (isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
$txtDescripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtExistencias = (isset($_POST['txtExistencias']))?$_POST['txtExistencias']:"";
$txtPrecio = (isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";//aqui se usa $_FILES
$accion = (isset($_POST['accion']))?$_POST['accion']:"";
var_dump($txtCategoria);
var_dump($txtDescripcion);
var_dump($txtExistencias);
var_dump($txtPrecio);
var_dump($txtImagen);


switch ($accion) {
    case 'Añadir':
    $sentenciaSQL = $pdo->prepare("INSERT INTO tbl_productos (categoria_id, descripcion, existencias , imagen, `precio`, `usuario_id`, `fecha` ) 
    VALUES (:categoria_id, :descripcion, :existencias, :imagen, :precio, 1, now());"); 

    $date = new DateTime();
    $ImgFileName =($txtImagen!="")?$date->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"image.jpg";
    $ImgTmp=$_FILES["txtImagen"]["tmp_name"];
    if($ImgTmp!=""){
        move_uploaded_file($ImgTmp, "images/productImg/".$ImgFileName);
    }

    $sentenciaSQL->bindParam(':categoria_id', $txtCategoria);
    $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
    $sentenciaSQL->bindParam(':existencias', $txtExistencias);
    $sentenciaSQL->bindParam(':imagen', $ImgFileName);
    $sentenciaSQL->bindParam(':precio', $txtPrecio);
    
    $sentenciaSQL->execute();
        break;
    case 'Modificar':
        
        
        break;
    case 'Cancelar':
        // code...
        echo "Click on Cancelar";
        break;
    case 'Seleccionar':
        $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_productos WHERE producto_id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $UnProducto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtCategoria=$UnProducto['categoria_id'];
        $txtDescripcion=$UnProducto['descripcion'];
        $txtExistencias=$UnProducto['existencias'];
        $txtImagen=$UnProducto['imagen'];
        $txtPrecio=$UnProducto['precio'];

        break;
    case 'Eliminar':
        $sentenciaSQL = $pdo->prepare("SELECT imagen FROM tbl_productos WHERE producto_id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $product=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        if(isset($product["imagen"]) && ($product["imagen"]!="image.jpg")){
            if(file_exists("images/productImg/".$product["imagen"])){
                unlink("images/productImg/".$product["imagen"]);
            }
        }


        $sentenciaSQL = $pdo->prepare("DELETE FROM tbl_productos WHERE producto_id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        break;
    default:
        // code...
        echo "Invalid option";
        break;
}
?>
<!--================Form Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<h3>Datos del producto: </h3>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" method="POST" id="contactForm" enctype="multipart/form-data">
						<div class="col-md-6 ">
							<div class="form-group">
                                <h6 for="txtCategoria">Categoría</h6>
                                <?php echo $txtCategoria; ?>
                                <select class="form-control" name= "txtCategoria" id="txtCategoria">    
                                <option value="00">-- Seleccione --</option>
                                <?php $sentenciaCategories = $pdo->prepare("SELECT * from tbl_categorias;");
                                    $sentenciaCategories->execute();
                                    $ListCategories=$sentenciaCategories->fetchAll();
                                 foreach ($ListCategories as $category) { 
                                echo '<option value="'.$category['categoria_id'].'">'.$category['nombre_categoria'].'</option>';
                                }?>    
                                
                                </select>
                            </div>
							
							<div class="form-group">
								<h6>Descripción</h6>
								<textarea class="form-control" name="txtDescripcion" value="<?php echo $txtDescripcion; ?>" id="txtDescripcion" rows="1" placeholder="Descripción del producto" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Descripción del producto'"></textarea>
							</div>
						</div>
						<div class="col-md-6">
                            <div class="form-group">
								<h6>Existencias: </h6>
								<input type="text" class="form-control" value="<?php echo $txtExistencias; ?>" id="txtExistencias" name="txtExistencias" placeholder="Existencias del producto" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Existencias del producto'">
							</div>
							<div class="form-group">
								<h6>Agregar Imagen: </h6>
								<input type="file" class="form-control" id="txtImagen" name="txtImagen" placeholder="Image" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Image'">
							</div>
							<div class="form-group">
								<h6>Precio: </h6>
								<input type="text" class="form-control" value="<?php echo $txtPrecio; ?>" id="txtPrecio" name="txtPrecio" placeholder="Precio" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Precio'">
							</div>
						</div>
						<div class="col-md-12 text-right">
                            <button type="submit" name="accion" value="Añadir" class="genric-btn success circle arrow">Añadir</button> <!--value must match with switch-->
                            <button type="submit" name="accion" value="Modificar" class="genric-btn info circle arrow">Modificar</button>
                            <button type="submit" name="accion" value="Cancelar" class="genric-btn danger circle arrow">Cancelar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--================Form Area =================-->
<?php
$sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_productos");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-md-12">
        <br/>
        <table class="table">
            <thead class="table-head">
                <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th>Existencias</th>
                <th>Precio</th>
                <th>Usuario</th>
                <th>imagen</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaProductos as $producto) {?>
                <tr class="table-row">
                <th><?php echo $producto['producto_id'];?></th>
                <td><?php echo $producto['categoria_id'];?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['existencias']; ?></td>
                <td><?php echo $producto['precio'];?></td>
                <td><?php echo $producto['usuario_id'];?></td>
                <td><?php echo $producto['imagen'];?></td>
                
                <td><form method="post">
                    <input type="hidden" name="txtID" value="<?php echo $producto['producto_id']?>">
                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                    <input type="submit" name="accion" value="Eliminar" class="btn btn-danger">
                </form></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>