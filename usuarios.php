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
	<title>Datos del usuario</title>

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
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtEmail = (isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$txtTipoUsuario = (isset($_POST['txtTipoUsuario']))?$_POST['txtTipoUsuario']:"";
$txtNombreUsuario = (isset($_POST['txtNombreUsuario']))?$_POST['txtNombreUsuario']:"";
$txtContra = (isset($_POST['txtContra']))?$_POST['txtContra']:"";

$accion = (isset($_POST['accion']))?$_POST['accion']:"";
var_dump($txtNombre);
var_dump($txtEmail);
var_dump($txtTipoUsuario);
var_dump($txtNombreUsuario);
var_dump($txtContra);

switch ($accion) {
	case 'add':
	$sentenciaSQL = $pdo->prepare("INSERT INTO tbl_usuarios (nombre, email , tipoUsuario_id, 
    nombre_usuario, contra) VALUES (:nombre, :email, :tipoUsuario_id, 
    :nombre_usuario, :contra);"); 
    
	$sentenciaSQL->bindParam(':nombre', $txtNombre);
    $sentenciaSQL->bindParam(':email', $txtEmail);
	$sentenciaSQL->bindParam(':tipoUsuario_id', $txtTipoUsuario);
    $sentenciaSQL->bindParam(':nombre_usuario', $txtNombreUsuario);
	$sentenciaSQL->bindParam(':contra', $txtContra);
	$sentenciaSQL->execute();
    	// code...
	    echo "Click on add";
	break;
	
	case 'Cancel':
		// code...
	    echo "Click on Cancelar";
		break;
    case 'Select':
        $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE usuario_id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $UnProducto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre=$UnProducto['nombre'];
        $txtEmail=$UnProducto['email'];
        $txtTipoUsuario=$UnProducto['tipoUsuario_id'];
        $txtNombreUsuario=$UnProducto['nombre_usuario'];
        $txtContra=$UnProducto['contra'];
        break;
    case 'Delete':
        $sentenciaSQL = $pdo->prepare("DELETE FROM tbl_usuarios WHERE usuario_id=:id");
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
                        Añadir usuario
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">  <!--change method to POST, we use enctype to allow file submission-->
                            <div class="form-group">
        
                                <label for="txtNombre">Nombre</label>
                                <input type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" class="form-control single-input" placeholder="Nombre completo">
                            </div>

                            <div class="form-group">
                                <label for="txtEmail">Correo Electrónico</label>
                                <input type="email" name="txtEmail" id="txtEmail" value="<?php echo $txtEmail; ?>" class="form-control progress-table-wrap" placeholder="Correo Electrónico">
                            </div>
                            <div class="form-group">
                                <label for="txtNombreUsuario">Nombre de Usuario</label>
                                <input type="text" name="txtNombreUsuario" value="<?php echo $txtNombreUsuario; ?>" id="txtNombreUsuario" class="form-control progress-table-wrap" 
                                placeholder="Nombre de usuario">
                            </div>
                            <div class="form-group">
                                <label for="txtContra">Contraseña</label>
                                <input type="password" name="txtContra" id="txtContra" value="<?php echo $txtContra; ?>" class="form-control progress-table-wrap" placeholder="Contraseña">
                            </div>
                            <div class="form-group">
                                <label for="txtTipoUsuario">Tipo de Usuario</label>
                                <?php echo $txtTipoUsuario; ?>
                                <select class="form-control" name="txtTipoUsuario"  id="txtTipoUsuario">       
                                 <option value="00">-- Seleccione --</option>
                                <?php $sentenciaCategories = $pdo->prepare("SELECT * from tbl_tipousuario;");
                                    $sentenciaCategories->execute();
                                    $ListCategories=$sentenciaCategories->fetchAll();
                                 foreach ($ListCategories as $category) { 
                                echo '<option value="'.$category['tipoUsuario_id'].'">'.$category['nombre_tipoUsuario'].'</option>';
                                }?>
 
                                </select>
                          
                            </div>

                        
                           
                            <div class="btn-group" role="group">		
                                <button type="submit" name="accion" value="add" class="genric-btn success circle arrow">Añadir</button> <!--value must match
                                 with switch-->
                                <button type="submit" name="Modify" class="genric-btn info circle arrow">Modificar</button>
                                <button type="submit" name="accion" value="Cancel" class="genric-btn danger circle arrow">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_usuarios");
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
                    <th>Tipo de Usuario</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Nombre de Usuario</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProductos as $producto) {?>
                    <tr class="table-row">
                    <th><?php echo $producto['usuario_id'];?></th>
                    <td><?php echo $producto['tipoUsuario_id'];?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['email']; ?></td>
                    <td><?php echo $producto['nombre_usuario'];?></td>
                    <td><?php echo $producto['contra'];?></td>
                    
                    <td><form method="post">
                        <input type="hidden" name="txtID" value="<?php echo $producto['usuario_id']?>">
                        <input type="submit" name="accion" value="Add" class="btn btn-primary">
                        <input type="submit" name="accion" value="Delete" class="btn btn-danger">
                    </form></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>