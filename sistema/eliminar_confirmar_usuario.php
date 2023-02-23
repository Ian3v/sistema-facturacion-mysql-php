<?php 
 
    
    
    include "../conexion.php";
        
    $conection = conectarBD();
    

    if(!empty($_POST)){

        $idusuario = $_POST['idusuario'];

        echo "--->".$idusuario;

        $query = "UPDATE usuario SET estatus = 0 WHERE usuario_id = $idusuario";

        echo $query;

        /* ---------------- Intentar consulta si no cpaturar el error --------------- */
        // try{
            $query_delete = mysqli_query($conection, $query);
        // }catch(Exception $e){
            // echo $e->getMessage();
        // }

        if($query_delete){
            header('location: lista_usuarios.php');
        }else{
            echo "Error al eliminar";
        }


    }

    echo '<pre>';
    var_dump($_GET['id']);
    echo '</pre>';

 
    

    if(empty($_REQUEST['id']) || $_REQUEST['id'] ==1){
        header('location: lista_usuarios.php'); 
    }else{

        $idusuario = $_REQUEST['id'];

        $query = "SELECT u.nombre, u.usuario, r.rol FROM usuario u INNER JOIN rol r 
        ON u.rol_id = r.rol_id  WHERE u.usuario_id = $idusuario;";
        
        $query_result = mysqli_query($conection, $query);

        // $result = mysqli_num_rows($query_result);
        $result = mysqli_num_rows($query_result);

        echo '<pre>';
        var_dump( $result);
        echo '</pre>';
        
        if($result > 0){

            while($data = mysqli_fetch_assoc($query_result)){

            $nombre = $data['nombre'];
            $usuario = $data['usuario'];
            $rol = $data['rol'];
            $nombre = $data['nombre'];

            }   
        }else{

            header('location: /sistema/lista_usuarios.php');
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

        <link rel="stylesheet" href="includes/css/style.css ">
    <title>Eliminar</title>
</head>
<body>  
    

        
    <?php include "Includes/header.php" ?>
    <div class="header_spacing"></div>

    <section class="container_main">

            <?php include "includes/nav.php"; ?>
            
            <div class="data_delete">

                <div class="container_data_delete">
                    
                    <h1>¿Esta seguro de eliminar el Registro?</h1>  
                    <br>
                    <p><strong>Nombre:</strong><span><?php echo $nombre; ?></span></p>
                    <p><strong>Usuario</strong> <span><?php echo $usuario; ?></span></p>
                    <p><strong>Tipo de usuario</strong> <span><?php echo $rol; ?></span></p>

                </div>

                <div class="form_cancelar">
                    <form method="POST" action="">
                        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                        <a href="lista_usuarios.php" class="btn_cancel btn_verde">Cancelar</a>
                        <input type="submit" value="Aceptar" class="btn_rojo">
                    </form>
                </div>
                
            </div

            
    </section>

    <?php include "Includes/footer.php" ?>
</body>
</html>