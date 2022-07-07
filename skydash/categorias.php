<!DOCTYPE html>
<?php
session_start();
if ($_SESSION["session_tipousuario"] == 1) { ?>
<?php
if (!isset($_SESSION["session_username"])) {
    header("Location:../login_admin.php");
} else {
    include './headcode.php'; ?>
    <html lang="en">
    <?php
    //debemos revisar si los input tienen informacion
    //isset(what we check)-?-if true-:-if false;


    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : ""; //['nombre/id de su input en el formulario']
    $txtNombreCategoria = (isset($_POST['txtNombreCategoria'])) ? $_POST['txtNombreCategoria'] : "";

    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


    switch ($accion) {
        case 'add':
            $sentenciaSQL = $pdo->prepare("INSERT INTO tbl_categorias (nombre_categoria) VALUES (:nombre_categoria);");

            $sentenciaSQL->bindParam(':nombre_categoria', $txtNombreCategoria);
            $sentenciaSQL->execute();
            // code...
            header('Location: categorias.php');
            break;
        case 'Modificar':
            $sentenciaSQL = $pdo->prepare("UPDATE tbl_categorias SET nombre_categoria = :nombre_categoria WHERE categoria_id=:id");

            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->bindParam(':nombre_categoria', $txtNombreCategoria);
            $sentenciaSQL->execute();
            header('Location: categorias.php');
            break;
        case 'Cancel':

            header('Location: categorias.php');
            break;
        case 'Seleccionar':
            $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_categorias WHERE categoria_id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $UnProducto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            $txtNombreCategoria = $UnProducto['nombre_categoria'];
            break;
        case 'Eliminar':
            $sentenciaSQL = $pdo->prepare("DELETE FROM tbl_categorias WHERE categoria_id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            header('Location: categorias.php');
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
                                        <h3 class="font-weight-bold">Categorías</h3>
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
                                                    <div class="card-header">
                                                        Añadir categoría
                                                    </div>
                                                    <div class="card-body">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <!--change method to POST, we use enctype to allow file submission-->
                                                            <div class="form-group">
                                                                <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
                                                                <label for="txtNombreCategoria">Nombre de la categoria</label>
                                                                <input type="text" name="txtNombreCategoria" id="txtNombreCategoria" value="<?php echo $txtNombreCategoria; ?>" class="form-control single-input" placeholder="Nombre de la categoría" required>
                                                            </div>

                                                            <div class="btn-group" role="group">
                                                                <button type="submit" name="accion" value="add" <?php echo ($accion == 'Seleccionar') ? "disabled" : "" ?> class="btn btn-primary">Añadir</button>
                                                                <!--value must match with switch-->
                                                                <button type="submit" name="accion" value="Modificar" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-info">Modificar</button>
                                                                <button type="submit" name="accion" value="Cancel" <?php echo ($accion !== 'Seleccionar') ? "disabled" : "" ?> class="btn btn-danger">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_categorias");
                                    $sentenciaSQL->execute();
                                    $listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <br />
                                            <table class="table" id="MyTable">
                                                <thead class="table-head">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre de la categoría</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($listaProductos as $producto) { ?>
                                                        <tr class="table-row">
                                                            <th><?php echo $producto['categoria_id']; ?></th>
                                                            <td><?php echo $producto['nombre_categoria']; ?></td>

                                                            <td>
                                                                <form method="post">
                                                                    <input type="hidden" name="txtID" value="<?php echo $producto['categoria_id'] ?>">
                                                                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                                                                    <input type="submit" name="accion" value="Eliminar" class="btn btn-danger">
                                                                </form>
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
                    "scrollY": 300,
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
<?php } else if ($_SESSION["session_tipousuario"] == 2) {  
    header('Location: productos.php');

} ?>