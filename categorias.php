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
	<title>Añadir categoria</title>

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
$txtNombreCategoria = (isset($_POST['txtNombreCategoria']))?$_POST['txtNombreCategoria']:"";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";
var_dump($txtNombreCategoria);


switch ($accion) {
	case 'add':
	$sentenciaSQL = $pdo->prepare("INSERT INTO tbl_categorias (nombre_categoria) VALUES (:nombre_categoria);"); 
    
	$sentenciaSQL->bindParam(':nombre_categoria', $txtNombreCategoria);
	$sentenciaSQL->execute();
    	// code...
	    echo "Click on add";
	break;
	
	case 'Cancel':
		// code...
	    echo "Click on Cancelar";
		break;
    case 'Seleccionar':
        $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_categorias WHERE categoria_id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $UnProducto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombreCategoria=$UnProducto['nombre_categoria'];
        break;
    case 'Eliminar':
        $sentenciaSQL = $pdo->prepare("DELETE FROM tbl_categorias WHERE categoria_id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        break;
	default:
		// code...
        echo "Invalid option";
		break;
}
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <br/>
                <div class="card">
                    <div class="card-header">
                        Agregar categoría
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">  <!--change method to POST, we use enctype to allow file submission-->
                            <div class="form-group">
                                <label for="txtNombreCategoria">Nombre de la categoria</label>
                                <input type="text" name="txtNombreCategoria" id="txtNombreCategoria" value="<?php echo $txtNombreCategoria; ?>" class="form-control single-input" placeholder="Nombre de la categoría">
                            </div>

                            <div class="btn-group" role="group">		
                                <button type="submit" name="accion" value="add" class="genric-btn success circle arrow">Add</button> <!--value must match
                                 with switch-->
                                <button type="submit" name="Modify" class="genric-btn info circle arrow">Modify</button>
                                <button type="submit" name="accion" value="Cancel" class="genric-btn danger circle arrow">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_categorias");
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
                    <th>Nombre de la categoría</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProductos as $producto) {?>
                    <tr class="table-row">
                    <th><?php echo $producto['categoria_id'];?></th>
                    <td><?php echo $producto['nombre_categoria'];?></td>
                    
                    <td><form method="post">
                        <input type="hidden" name="txtID" value="<?php echo $producto['categoria_id']?>">
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