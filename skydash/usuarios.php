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
        $txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
        $txtEmail = (isset($_POST['txtEmail'])) ? $_POST['txtEmail'] : "";
        $txtTipoUsuario = (isset($_POST['txtTipoUsuario'])) ? $_POST['txtTipoUsuario'] : "";
        $txtNombreUsuario = (isset($_POST['txtNombreUsuario'])) ? $_POST['txtNombreUsuario'] : "";
        $txtContra = (isset($_POST['txtContra'])) ? $_POST['txtContra'] : "";
        $password_hash = password_hash($txtContra, PASSWORD_BCRYPT);
        $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

        switch ($accion) {
            case 'add':
                $sentenciaSQL = $pdo->prepare("INSERT INTO tbl_usuarios (nombre, email , tipoUsuario_id, 
    nombre_usuario, contra) VALUES (:nombre, :email, :tipoUsuario_id, 
    :nombre_usuario, :password_hash);");

                $sentenciaSQL->bindParam(':nombre', $txtNombre);
                $sentenciaSQL->bindParam(':email', $txtEmail);
                $sentenciaSQL->bindParam(':tipoUsuario_id', $txtTipoUsuario);
                $sentenciaSQL->bindParam(':nombre_usuario', $txtNombreUsuario);
                $sentenciaSQL->bindParam(':password_hash', $password_hash);
                $sentenciaSQL->execute();

                header('Location: usuarios.php');
                break;
            case 'Modificar':
                $sentenciaSQL = $pdo->prepare("UPDATE tbl_usuarios SET nombre = :nombre, email = :email, 
        tipoUsuario_id = :tipoUsuario_id, nombre_usuario= :nombre_usuario, contra= :password_hash WHERE usuario_id=:id");

                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->bindParam(':nombre', $txtNombre);
                $sentenciaSQL->bindParam(':email', $txtEmail);
                $sentenciaSQL->bindParam(':tipoUsuario_id', $txtTipoUsuario);
                $sentenciaSQL->bindParam(':nombre_usuario', $txtNombreUsuario);
                $sentenciaSQL->bindParam(':password_hash', $password_hash);
                $sentenciaSQL->execute();
                header('Location: usuarios.php');
                break;
            case 'Cancel':

                header('Location: usuarios.php');
                break;
            case 'Seleccionar':
                $sentenciaSQL = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE usuario_id=:id");
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
                $UnProducto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
                $txtNombre = $UnProducto['nombre'];
                $txtEmail = $UnProducto['email'];
                $txtTipoUsuario = $UnProducto['tipoUsuario_id'];
                $txtNombreUsuario = $UnProducto['nombre_usuario'];
                $txtContra = $UnProducto['contra'];
                break;
            case 'Eliminar':
                $sentenciaSQL = $pdo->prepare("DELETE FROM tbl_usuarios WHERE usuario_id=:id");
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
                header('Location: usuarios.php');
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
                                            <h3 class="font-weight-bold">Usuarios</h3>
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
                                                            Añadir usuario
                                                        </div>
                                                        <div class="card-body">
                                                            <form method="POST" enctype="multipart/form-data">
                                                                <!--change method to POST, we use enctype to allow file submission-->
                                                                <div class="form-group">
                                                                    <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">
                                                                    <label for="txtNombre">Nombre</label>
                                                                    <input type="text" name="txtNombre" id="txtNombre" value="<?php echo $txtNombre; ?>" class="form-control single-input" placeholder="Nombre completo" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="txtEmail">Correo Electrónico</label>
                                                                    <input type="email" name="txtEmail" id="txtEmail" value="<?php echo $txtEmail; ?>" class="form-control progress-table-wrap" placeholder="Correo Electrónico" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="txtNombreUsuario">Nombre de Usuario</label>
                                                                    <input type="text" name="txtNombreUsuario" value="<?php echo $txtNombreUsuario; ?>" id="txtNombreUsuario" class="form-control progress-table-wrap" placeholder="Nombre de usuario" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="txtContra">Contraseña</label>
                                                                    <input type="password" name="txtContra" id="txtContra" value="<?php echo $txtContra; ?>" class="form-control progress-table-wrap" placeholder="Contraseña" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="txtTipoUsuario">Tipo de Usuario</label>

                                                                    <select class="form-control" name="txtTipoUsuario" id="txtTipoUsuario">
                                                                        <option value="00">-- Seleccione --</option>

                                                                        <?php $sentenciaCategories = $pdo->prepare("SELECT * from tbl_tipousuario;");
                                                                        $sentenciaCategories->execute();

                                                                        if (!empty($txtTipoUsuario)) {

                                                                            $ListCategories = $sentenciaCategories->fetchAll();
                                                                            foreach ($ListCategories as $category) {
                                                                                $selected = ($txtTipoUsuario == $category['tipoUsuario_id']) ? ' selected' : null;

                                                                                echo '<option value="' . $category['tipoUsuario_id'] . '"' . $selected . '>' . $category['nombre_tipoUsuario'] . '</option>';
                                                                            }
                                                                        } else {

                                                                            $ListCategories = $sentenciaCategories->fetchAll();
                                                                            foreach ($ListCategories as $category) {
                                                                                echo '<option value="' . $category['tipoUsuario_id'] . '">' . $category['nombre_tipoUsuario'] . '</option>';
                                                                            }
                                                                        } ?>

                                                                    </select>

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
                                        $sentenciaSQL = $pdo->prepare("SELECT tbl_usuarios.*, tbl_tipousuario.nombre_tipoUsuario FROM tbl_usuarios, tbl_tipousuario WHERE(tbl_usuarios.tipoUsuario_id = tbl_tipousuario.tipoUsuario_id)");
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
                                                            <th>Tipo de Usuario</th>
                                                            <th>Nombre</th>
                                                            <th>Correo Electrónico</th>
                                                            <th>Nombre de Usuario</th>
                                                            <th>Contraseña</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($listaProductos as $producto) { ?>
                                                            <tr class="table-row">
                                                                <th><?php echo $producto['usuario_id']; ?></th>
                                                                <td><?php echo $producto['nombre_tipoUsuario']; ?></td>
                                                                <td><?php echo $producto['nombre']; ?></td>
                                                                <td><?php echo $producto['email']; ?></td>
                                                                <td><?php echo $producto['nombre_usuario']; ?></td>
                                                                <td><?php echo $producto['contra']; ?></td>

                                                                <td>
                                                                    <form method="post">
                                                                        <input type="hidden" name="txtID" value="<?php echo $producto['usuario_id'] ?>">
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