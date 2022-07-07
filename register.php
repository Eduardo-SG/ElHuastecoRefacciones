<?php
include 'global/configServer.php';
include 'global/connectionDB.php';
session_start();

if(isset($_POST["register"])){
    if(!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['nombre_usuario']) && !empty($_POST['contra'])){
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $contra = $_POST['contra'];
        $password_hash = password_hash($contra, PASSWORD_BCRYPT);

        $query = $pdo->prepare("SELECT * FROM tbl_usuarios WHERE email = :email");
        $query-> bindParam("email", $email);
        $query->execute();

        if($query->rowCount() >0){
            echo '<p class = "error">El email ya se encuentra registrado</p>';
        }
        if($query->rowCount() ==0){
            $query = $pdo->prepare("INSERT INTO tbl_usuarios (nombre, contra, email, nombre_usuario, tipoUsuario_id) VALUES
             (:nombre, :password_hash, :email, :nombre_usuario, 1)");
            $query -> bindParam(":nombre", $nombre);
            $query-> bindParam(":password_hash", $password_hash);
            $query -> bindParam(":email", $email);
            $query -> bindParam(":nombre_usuario", $nombre_usuario);

            $result = $query->execute();

            if($result){
                $message = "Cuneta correctamente creada";
            }
            else{
                $message = "Error al ingresar datos de la informacion!";
            }
        }
        else{
            $message = "El nombre de usuario ya existe! Por favor, intenta con otro!";
        }
    }
    else{
        $message = "Todos los campos no deben de estar vacios";
    }
}

?>

<?php if(!empty($message)) {
    echo "<p class = \"error\">" ."Mensaje: ". $message ."</p>";
}
?>

<div class = "container mregister">
    <div id = "login">
        <h1>Registrar</h1>
        <form name = "registerform" id = "registerform" action = "register.php" method = "POST">
            <p>
                <label for = "user_login"> Nombre completo
                    <br/>
                    <input type = "text" name = "nombre" id = "nombre" class = "input" value = "" size = "32"/>
                </label>
            </p>
            <p>
                <label for = "user_pass"> E-mail
                    <br/>
                    <input type = "email" name = "email" id = "email" class = "input" value = "" size = "32"/>
                </label>
            </p>
            <p>
                <label for = "user_name"> Nombre de usuario
                    <br/>
                    <input type = "text" name = "nombre_usuario" id = "nombre_usuario" class = "input" value = "" size = "20"/>
                </label>
            </p>
            <p>
                <label for = "user_pass"> Contraseña
                    <br/>
                    <input type = "password" name = "contra" id = "contra" class = "input" value = "" size = "32"/>
                </label>
            </p>
            <p class = "submit">
                <input type = "submit" name = "register" id = "register" class = "button" value = "Registrar" />
            </p>
            <p class = "regtext">Ya tienes una cuenta? <a href = "login.php">Entra aqui</a>!</p>
        </form>
    </div>
</div>
