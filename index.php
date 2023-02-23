<?php

if (!empty($_SESSION['active'])) {
    header('location: sistema/');
} else {

    if (!empty($_POST)) {


        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';

        require "conexion.php";

        $conection = conectarBD();

        $user = mysqli_real_escape_string($conection, $_POST['usuario']);
        $pass = mysqli_real_escape_string($conection, $_POST['clave']);


        $query = "SELECT * FROM usuario WHERE usuario = '{$user}' AND clave = '{$pass}'";

        $query_result = mysqli_query($conection, $query);

        $result = mysqli_num_rows($query_result);

        echo '<pre>';
        var_dump($result);
        echo '</pre>';

        if ($result) {

            echo "Si exite";

            echo '<pre>';
            var_dump($result);
            echo '</pre>';

            $data = mysqli_fetch_assoc($query_result);
            $_SESSION['active'] = true;
            $_SESSION['usuario_id'] = $data['usuario_id'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['email'] = $data['correo'];
            $_SESSION['user'] = $data['usuario'];
            $_SESSION['rol_id'] = $data['rol_id'];


            session_start();
            header('location: sistema/');
        } else {
            $alert = 'Usuario o clave incorrecto';
            session_destroy();
        }


    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Invetario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <div class="wrapper">
        <div class="container main">
            <div class="row shadow">
                <div class="col-md-6 side-image">
                    <!--Image-->
                    <img src="images/logo.png" alt="">
                    <div class="text">
                        <p>Siendo parte del cambio.</p>
                    </div>
                </div>
                <div class="col-md-6 right">
                    <form class="input-box" method="POST" action="#">
                        <header>Iniciar Sesión</header>
                        <div class="input-field">
                            <input type="text" name="usuario" id="email" class="input" required autocomplete="off">
                            <label for="email">Usuario</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="clave" id="password" class="input" required>
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="input-field">
                            <input type="submit" id="" class="submit" value="INGRESAR">
                        </div>
                        <div class="signin">
                            <span>Olvidaste tu contraseña <a href="#">Comunicarse con Soporte</a></span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>