<?php
session_start();
if (!isset($_SESSION["session_username"])) {
    header("Location:../login_admin.php");
} else {
    include './headcode.php'; ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    //debemos revisar si los input tienen informacion
    //isset(what we check)-?-if true-:-if false;
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : ""; //['nombre/id de su input en el formulario']
    $txtCategoria = (isset($_POST['txtCategoria'])) ? $_POST['txtCategoria'] : "";
    $txtUserID = (isset($_POST['txtUserID'])) ? $_POST['txtUserID'] : "";
    $txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
    $txtExistencias = (isset($_POST['txtExistencias'])) ? $_POST['txtExistencias'] : "";
    $txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
    $txtOldImg = (isset($_POST['txtOldImg'])) ? $_POST['txtOldImg'] : "";
    $txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : ""; //aqui se usa $_FILES
    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


    switch ($accion) {
        case 'Añadir':
            $sentenciaSQL = $pdo->prepare("INSERT INTO tbl_productos (categoria_id, descripcion, existencias , imagen, `precio`, `usuario_id`, `fecha` ) 
    VALUES (:categoria_id, :descripcion, :existencias, :imagen, :precio, 1, now());");

            $date = new DateTime();
            $ImgFileName = ($txtImagen != "") ? $date->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "image.jpg";
            $ImgTmp = $_FILES["txtImagen"]["tmp_name"];
            if ($ImgTmp != "") {
                move_uploaded_file($ImgTmp, "images/productImg/" . $ImgFileName);
            }

            $sentenciaSQL->bindParam(':categoria_id', $txtCategoria);
            $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
            $sentenciaSQL->bindParam(':existencias', $txtExistencias);
            $sentenciaSQL->bindParam(':imagen', $ImgFileName);
            $sentenciaSQL->bindParam(':precio', $txtPrecio);

            $sentenciaSQL->execute();
            header('Location: productos.php');
            break;
        case 'Modificar':

            $sentenciaSQL = $pdo->prepare("UPDATE tbl_productos SET categoria_id = :categoria_id, descripcion = :descripcion, 
        existencias = :existencias, precio= :precio, usuario_id=1 WHERE producto_id=:id");

            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->bindParam(':categoria_id', $txtCategoria);
            $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
            $sentenciaSQL->bindParam(':existencias', $txtExistencias);
            $sentenciaSQL->bindParam(':precio', $txtPrecio);
            $sentenciaSQL->execute();

            if ($txtImagen != "") {
                $date = new DateTime();
                //creacion del nuevo nombre de la imagen
                $ImgFileName = ($txtImagen != "") ? $date->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "image.jpg";
                $ImgTmp = $_FILES["txtImagen"]["tmp_name"];
                move_uploaded_file($ImgTmp, "images/productImg/" . $ImgFileName);

                $sentenciaSQL = $pdo->prepare("SELECT imagen FROM tbl_productos WHERE producto_id=:id");
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();

                $product = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
                if (isset($product["imagen"]) && ($product["imagen"] != "image.jpg")) {
                    if (file_exists("images/productImg/" . $product["imagen"])) {
                        unlink("images/productImg/" . $product["imagen"]);
                    }
                }
                $sentenciaSQL = $pdo->prepare("UPDATE tbl_productos SET imagen = :imagen WHERE producto_id=:id");
                $sentenciaSQL->bindParam(':imagen', $ImgFileName);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
            } else {
                $sentenciaSQL = $pdo->prepare("UPDATE tbl_productos SET imagen = :imagen WHERE producto_id=:id");
                $sentenciaSQL->bindParam(':imagen', $txtOldImg);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
            }

            header('Location: productos.php');
            break;
        case 'Cancelar':

            header('Location: productos.php');
            break;
        case 'Seleccionar':
            $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_productos WHERE producto_id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $UnProducto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            $txtCategoria = $UnProducto['categoria_id'];
            $txtDescripcion = $UnProducto['descripcion'];
            $txtExistencias = $UnProducto['existencias'];
            $txtImagen = $UnProducto['imagen'];
            $txtPrecio = $UnProducto['precio'];
            $txtOldImg = $UnProducto['imagen'];

            break;
        case 'Eliminar':
            $sentenciaSQL = $pdo->prepare("SELECT imagen FROM tbl_productos WHERE producto_id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $product = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            if (isset($product["imagen"]) && ($product["imagen"] != "image.jpg")) {
                if (file_exists("images/productImg/" . $product["imagen"])) {
                    unlink("images/productImg/" . $product["imagen"]);
                }
            }


            $sentenciaSQL = $pdo->prepare("DELETE FROM tbl_productos WHERE producto_id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            header('Location: productos.php');
            break;
        default:
            // code...
            echo "Invalid option";
            break;
    }
    ?>

    <body>
        <div class="container-scroller">
            <!-- Here goes the code for menu  but inside the main tag-->
            <?php include './TopMenu.php'; ?>
            <div class="container-fluid page-body-wrapper">
                <!-- Here goes the code for sidebar menu  but inside the container-fluid page-body-wrapper-->
                <?php include './SideMenu.php'; ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="row">
                                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                        <h3 class="font-weight-bold">Productos</h3>
                                        <h6 class="font-weight-normal mb-0"></h6>
                                    </div>

                                </div>
                                <!-- FORM CONTENT AND TABLE -->
                                <div class="row">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <br />
                                                <div class="card">

                                                    <?php
                                                    if ($_SESSION["session_tipousuario"] == 1) { ?>
                                                        <div class="card-header">
                                                            Añadir producto
                                                        </div>
                                                        <div class="card-body">
                                                            <form method="POST" enctype="multipart/form-data">
                                                                <!--change method to POST, we use enctype to allow file submission-->
                                                                <div class="form-group">
                                                                    <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
                                                                    <input type="hidden" name="txtUserID" value="<?php echo $txtUserID; ?>">

                                                                    <h6>Descripción</h6>
                                                                    <input class="form-control" name="txtDescripcion" value="<?php echo $txtDescripcion; ?>" id="txtDescripcion" rows="1" placeholder="Descripción del producto" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h6>Existencias: </h6>
                                                                    <input type="text" class="form-control" value="<?php echo $txtExistencias; ?>" id="txtExistencias" name="txtExistencias" placeholder="Existencias del producto" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h6>Agregar Imagen: </h6>
                                                                    <input type="hidden" class="form-control" id="" name="txtOldImg" value="<?php echo $txtImagen; ?>" placeholder="Imagen">
                                                                    <input type="file" class="form-control" id="txtImagen" name="txtImagen" placeholder="Imagen">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h6>Precio: </h6>
                                                                    <input type="number" class="form-control" value="<?php echo $txtPrecio; ?>" id="txtPrecio" name="txtPrecio" placeholder="Precio" required>
                                                                </div>



                                                                <div class="form-group">
                                                                    <h6 for="txtCategoria">Categoría</h6>


                                                                    <select class="form-control" name="txtCategoria" id="txtCategoria">
                                                                        <option value="00">-- Seleccione --</option>

                                                                        <?php $sentenciaCategories = $pdo->prepare("SELECT * from tbl_categorias;");
                                                                        $sentenciaCategories->execute();

                                                                        if (!empty($txtCategoria)) {
                                                                            $ListCategories = $sentenciaCategories->fetchAll();
                                                                            foreach ($ListCategories as $category) {
                                                                                $selected = ($txtCategoria == $category['categoria_id']) ? ' selected' : null;

                                                                                echo '<option value="' . $category['categoria_id'] . '"' . $selected . '>' . $category['nombre_categoria'] . '</option>';
                                                                            }
                                                                        } else {
                                                                            $ListCategories = $sentenciaCategories->fetchAll();
                                                                            foreach ($ListCategories as $category) {
                                                                                echo '<option value="' . $category['categoria_id'] . '">' . $category['nombre_categoria'] . '</option>';
                                                                            }
                                                                        } ?>

                                                                    </select>
                                                                </div>
                                                                <?php
                                                                if ($_SESSION["session_tipousuario"] == 1) { ?>
                                                                    <div class="btn-group" role="group">

                                                                        <button type="submit" name="accion" value="Añadir" <?php echo ($accion == 'Seleccionar') ? "disabled" : "" ?> class="btn btn-primary">Añadir</button>
                                                                        <!--value must match with switch-->
                                                                        <button type="submit" name="accion" value="Modificar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-info">Modificar</button>
                                                                        <button type="submit" name="accion" value="Cancelar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-danger">Cancelar</button>

                                                                    </div>
                                                                <?php } else if ($_SESSION["session_tipousuario"] == 2) {  ?>
                                                                    <div class="btn-group" role="group">

                                                                        <button type="submit" name="accion" value="Modificar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-info">Modificar</button>
                                                                        <button type="submit" name="accion" value="Cancelar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-danger">Cancelar</button>

                                                                    </div>

                                                                <?php   }

                                                                ?>




                                                            </form>
                                                        </div>
                                                    <?php } else if ($_SESSION["session_tipousuario"] == 2) {  ?>
                                                        <div class="card-header">
                                                        Modificar producto
                                                        </div>
                                                        <div class="card-body">
                                                            <form method="POST" enctype="multipart/form-data">
                                                                <!--change method to POST, we use enctype to allow file submission-->
                                                                <div class="form-group">
                                                                    <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
                                                                    <input type="hidden" name="txtUserID" value="<?php echo $txtUserID; ?>">

                                                                    <h6>Descripción</h6>
                                                                    <input class="form-control" name="txtDescripcion" value="<?php echo $txtDescripcion; ?>" id="txtDescripcion" rows="1" placeholder="Descripción del producto" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h6>Existencias: </h6>
                                                                    <input type="text" class="form-control" value="<?php echo $txtExistencias; ?>" id="txtExistencias" name="txtExistencias" placeholder="Existencias del producto" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h6>Agregar Imagen: </h6>
                                                                    <input type="hidden" class="form-control" id="" name="txtOldImg" value="<?php echo $txtImagen; ?>" placeholder="Imagen">
                                                                    <input type="file" class="form-control" id="txtImagen" name="txtImagen" placeholder="Imagen">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h6>Precio: </h6>
                                                                    <input type="number" class="form-control" value="<?php echo $txtPrecio; ?>" id="txtPrecio" name="txtPrecio" placeholder="Precio" required>
                                                                </div>



                                                                <div class="form-group">
                                                                    <h6 for="txtCategoria">Categoría</h6>


                                                                    <select class="form-control" name="txtCategoria" id="txtCategoria">
                                                                        <option value="00">-- Seleccione --</option>

                                                                        <?php $sentenciaCategories = $pdo->prepare("SELECT * from tbl_categorias;");
                                                                        $sentenciaCategories->execute();

                                                                        if (!empty($txtCategoria)) {
                                                                            $ListCategories = $sentenciaCategories->fetchAll();
                                                                            foreach ($ListCategories as $category) {
                                                                                $selected = ($txtCategoria == $category['categoria_id']) ? ' selected' : null;

                                                                                echo '<option value="' . $category['categoria_id'] . '"' . $selected . '>' . $category['nombre_categoria'] . '</option>';
                                                                            }
                                                                        } else {
                                                                            $ListCategories = $sentenciaCategories->fetchAll();
                                                                            foreach ($ListCategories as $category) {
                                                                                echo '<option value="' . $category['categoria_id'] . '">' . $category['nombre_categoria'] . '</option>';
                                                                            }
                                                                        } ?>

                                                                    </select>
                                                                </div>
                                                                <?php
                                                                if ($_SESSION["session_tipousuario"] == 1) { ?>
                                                                    <div class="btn-group" role="group">

                                                                        <button type="submit" name="accion" value="Añadir" <?php echo ($accion == 'Seleccionar') ? "disabled" : "" ?> class="btn btn-primary">Añadir</button>
                                                                        <!--value must match with switch-->
                                                                        <button type="submit" name="accion" value="Modificar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-info">Modificar</button>
                                                                        <button type="submit" name="accion" value="Cancelar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-danger">Cancelar</button>

                                                                    </div>
                                                                <?php } else if ($_SESSION["session_tipousuario"] == 2) {  ?>
                                                                    <div class="btn-group" role="group">

                                                                        <button type="submit" name="accion" value="Modificar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-info">Modificar</button>
                                                                        <button type="submit" name="accion" value="Cancelar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-danger">Cancelar</button>

                                                                    </div>

                                                                <?php   }

                                                                ?>




                                                            </form>
                                                        </div>
                                                    <?php   }

                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    $sentenciaSQL = $pdo->prepare("SELECT tbl_productos.*, tbl_categorias.nombre_categoria, tbl_tipousuario.nombre_tipoUsuario FROM tbl_productos, tbl_categorias, tbl_tipousuario WHERE (tbl_productos.categoria_id = tbl_categorias.categoria_id) && (tbl_productos.usuario_id = tbl_tipousuario.tipoUsuario_id)");
                                    $sentenciaSQL->execute();
                                    $listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <br />
                                            <table class="display compact" id="MyTable">
                                                <thead class="table-head">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Categoria</th>
                                                        <th>Descripcion</th>
                                                        <th>Fecha</th>
                                                        <th>Existencias</th>
                                                        <th>Precio</th>
                                                        <th>Usuario</th>
                                                        <th>Imagen</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($listaProductos as $producto) { ?>
                                                        <tr class="table-row">
                                                            <th><?php echo $producto['producto_id']; ?></th>
                                                            <td><?php echo $producto['nombre_categoria']; ?></td>
                                                            <td><?php echo $producto['descripcion']; ?></td>
                                                            <td><?php echo $producto['fecha']; ?></td>
                                                            <td><?php echo $producto['existencias']; ?></td>
                                                            <td><?php echo $producto['precio']; ?></td>
                                                            <td><?php echo $producto['nombre_tipoUsuario']; ?></td>
                                                            <td>
                                                                <img src="images/productImg/<?php echo $producto['imagen']; ?>" width="50%">
                                                            </td>

                                                            <td>
                                                                <?php
                                                                if ($_SESSION["session_tipousuario"] == 1) { ?>
                                                                    <form method="post">
                                                                        <input type="hidden" name="txtID" value="<?php echo $producto['producto_id'] ?>">
                                                                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                                                                        <input type="submit" name="accion" value="Eliminar" class="btn btn-danger">
                                                                    </form>
                                                                <?php } else if ($_SESSION["session_tipousuario"] == 2) {  ?>
                                                                    <form method="post">
                                                                        <input type="hidden" name="txtID" value="<?php echo $producto['producto_id'] ?>">
                                                                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                                                                    </form>
                                                                <?php   }

                                                                ?>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include './footer.php'; ?>
                    <!-- partial -->
                </div>
            </div>
        </div>
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="vendors/chart.js/Chart.min.js"></script>
        <script src="vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/template.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        <script src="js/Chart.roundedBarCharts.js"></script>
        <script>
            $(document).ready(function() {
                $('#MyTable').DataTable({
                    "scrollY": 800,
                    "scrollX": true
                });
            });
        </script>
        <!-- End custom js for this page-->


    </body>

    </html>
<?php
}
?>