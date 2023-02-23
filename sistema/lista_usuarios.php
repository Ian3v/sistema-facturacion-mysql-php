<?php


include "../conexion.php";
$conection = conectarBD();

$resultado = $_GET['resultado'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "includes/scripts.php" ?>

    <!-- <link rel="stylesheet" href="includes/css/style.css"> -->
    <link rel="stylesheet" href="includes/css/style.css">

    <title>Document</title>
</head>

<body>

    <!-- <H1>Lista de usuairos</H1> -->

    <?php include "Includes/header.php" ?>
    <div class="header_spacing"></div>

    <section class="container_main">

        <?php include "includes/nav.php"; ?>

        <section class="lista_usuarios">

            <div class="container_lista_usuarios">
                <div class="header_listausuario">
                    <h2 class="h2_listaUser">lista de usuarioss</h2>

                    <!-- <div class="cont_registro"> -->
                    <!-- <a href="registro_usuario.php" class="btn_new link_b">registro</a> -->
                    <a href="index.php" class="btn_new link_b">registro</a>
                    <!-- </div>} -->
                </div>

                <?php
                    if(intval($resultado)===2): ?>
                    <p class="alert">Se a actualizado el Usuario <strong><?php echo $_GET['id'] ?></strong> correctamente</p>
                <?php
                    endif
                ?>
                <div class="table_lista">
                    <table class="tabla_listausuarios">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th>ROl</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            /* ------ Consultar y mostrar todos los datos donde su estatus sea = 1 ------ */
                            <?php
                            $query = "SELECT u.usuario_id, u.nombre, u.correo, u.usuario, u.clave, u.rol_id FROM usuario u INNER JOIN  rol r ON u.rol_id = r.rol_id WHERE estatus = 1; ";
    
                            $query_resutl = mysqli_query($conection, $query);
    
                            $result = mysqli_num_rows($query_resutl);
    
                            if ($result > 0) {
                                echo "hay datos ";
    
                                while ($data = mysqli_fetch_assoc($query_resutl)) {
    
                            ?>
                                    <tr>
                                        <td><?php echo $data['usuario_id'] ?></td>
                                        <td><?php echo $data['nombre'] ?></td>
                                        <td><?php echo $data['correo'] ?></td>
                                        <td><?php echo $data['usuario'] ?></td>
    
                                        <td><?php switch ($data['rol_id']){ 
                                            case 1:
                                                echo "administrador";
                                                break;
                                            case 2:
                                                echo "Supervisor";
                                                break;
                                            case 3:
                                                echo "usuario";
                                                break;
                                        }  ?></td>
                                        <td> 
                                            <div class="edit_delet">
    
                                                <a  href="editar_usuario.php?id=<?php echo $data['usuario_id'] ?>" class="link_edit">Editar</a>

                                            <?php 
                                                if($data["usuario_id"] != 1){

                                             ?>
                                                <a href="eliminar_confirmar_usuario.php?id=<?php echo $data['usuario_id'] ?>" class="link_delete">Eliminar</a>

                                             <?php       
                                                }
                                            ?>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
    
                                    // echo $data['rol_id'];
                                }
                            } else {
                                echo "no captiura ";
                            }
    
                            ?>

                        </tbody>
    
    
                    </table>

                </div>
            </div>

        </section>

    </section>

    <?php include "Includes/footer.php" ?>
</body>

</html>

<!-- USE facturacion_2;

SELECT u.usuario_id, u.nombre, u.correo, u.usuario, u.clave, u.rol_id FROM usuario u INNER JOIN  rol r ON u.rol_id = r.rol_id; -->