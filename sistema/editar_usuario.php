<?php


include "../conexion.php";
$conection = conectarBD();

if (!empty($_POST)) {

    $alert = '';

    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])
        // || empty($_POST['rol'])
    ) {

        $alert = '<p>Todos los campos son obligatorios</p>';
    } else {



        // $conection = conectarBD();

        // capturamos el idusuario para el input hidden
        $iduser = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol_id = $_POST['rol'];

        
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';

        

            $query_check = mysqli_query($conection, "SELECT * FROM usuario  
                                    WHERE nombre = '$nombre'
                                    OR correo = '$correo' OR usuario='$usuario' ;");
    

            $query_check_result = mysqli_fetch_assoc($query_check);

        // if($query_check_result){
            
            echo "---> Ya existe";
            
            $query_result =false;

            $query = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario ='$usuario', rol_id = $rol_id WHERE usuario_id = $iduser;";

            $query_result = mysqli_query($conection, $query);
        // }else{

        // }
        
        

        echo $query;

        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';


        if($query_result){

            if(empty($_POST['clave'])){
                $query = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario ='$usuario', rol_id = $rol_id WHERE usuario_id = $iduser;";

                $query_result = mysqli_query($conection, $query);
            }else{
                $query = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario ='$usuario', clave= '$clave' , rol_id = $rol_id WHERE usuario_id = $iduser;";

                $query_result = mysqli_query($conection, $query);
            }

            // exit;
            header('location: /sistema/lista_usuarios.php?resultado=2&id='.$usuario);
        }
    }
}


/* ----------------------------------- GET ---------------------------------- */

if (empty($_GET['id'])) {

    header('location: lista_usuarios.php');
}
    $iduser = $_GET['id'];

    $query = "SELECT u.usuario_id, u.nombre, u.correo, u.usuario, (u.rol_id) as rol_id, (r.rol) as rol from usuario u INNER JOIN rol r ON u.rol_id = r.rol_id WHERE usuario_id = $iduser;";

    $query_result = mysqli_query($conection, $query);

    // $result = mysqli_fetch_assoc($query_result);
    $result = mysqli_num_rows($query_result);

    echo '<pre>';
    // var_dump($result);
    echo '</pre>';

if (!$result) {
    header('location: lista_usuarios.php');
} else {

    $option = "";

    while ($data = mysqli_fetch_assoc($query_result)) {

        $iduser = $data["usuario_id"];
        $nombre = $data["nombre"];
        $correo = $data["correo"];
        $usuario = $data["usuario"];
        $clave = $data["clave"];
        $rol_id = $data["rol_id"];
        $rol = $data["rol"];


        if ($rol_id == 1) {
            $option = '<option value="' . $rol_id . '"selected >' . $rol . '</option>';
        } else if ($rol_id == 2) {
            $option = '<option value="' . $rol_id . '"selected>' . $rol . '</option>';
        } else if ($rol_id == 3) {

            $option = '<option value="' . $rol_id . '"selected>' . $rol . '</option>';
        }
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "includes/scripts.php" ?>

    <link rel="stylesheet" href="includes/css/style.css">
    <title>Actualizar usuario</title>
</head>

<body>



    <?php include "Includes/header.php" ?>
    <div class="header_spacing"></div>

    <section class="container_main">
        <?php include "includes/nav.php"; ?>


        <section class="registro_container">

            <div class="form_register">

                <h1>Actualizar Usuario</h1>

                <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

                <form action="#" method="post" class="formulario_registro">

                    <input type="hidden" name="idUsuario" name="idUsuario" value="<?php echo $iduser ?>">

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre ?>">

                    <label for="correo">Correo electrónico</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo ?>">

                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario ?>">

                    <label for="clave">Clave</label>
                    <input type="password" name="clave" id="clave" placeholder="Clave de acceso">

                    <label for="rol">Tipo Usuario</label>

                    <!-- Traer la tabla rol y mostrar los roles -->
                    <?php
                    $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                    $result_rol = mysqli_num_rows($query_rol);

                    ?>

                    <select name="rol" id="rol" class="notItemOne">
                        <?php
                        echo $option;
                        if ($result_rol > 0) {
                            while ($rol = mysqli_fetch_array($query_rol)) {
                        ?>
                                <option value="<?php echo $rol["rol_id"]; ?>"><?php echo $rol["rol"] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <!--  -->

                    <input type="submit" value="Actualizar Usuario" class="btn_save">
                </form>
            </div>



        </section>
    </section>

    <?php include "Includes/footer.php" ?>



    <?php include "includes/footer.php"; ?>