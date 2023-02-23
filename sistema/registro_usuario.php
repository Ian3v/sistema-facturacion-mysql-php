<?php


include "../conexion.php";
$conection = conectarBD();
if (!empty($_POST)) {
    $alert = '';
    
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave'])) {

        $alert = '<p>Todos los campos son obligatorios</p>';
    } else {
        /* -------------- instanciando la conexion al a Base de Datos ------------- */
        $conection = conectarBD();
        /* ----------------------------- Capturando POST ---------------------------- */
        $nombre = $_POST['nombre'];
        $email = $_POST['correo'];
        $user = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];

        /* ----------- Consultar a la DB - mostrar si hay Usuario o email ----------- */
        $query = mysqli_query(
            $conection,
            "SELECT * FROM usuario WHERE usuario = '{$user}'  OR correo = '{$email}' "
        );
        /* ----------- A la consulta lo formateamos a un Array Asociativo ----------- */
        $result = mysqli_fetch_assoc($query);

        
        /* --------- Si la consulta fue exitosa entonces $result tiene algo --------- */
        /* ------------ Si result tiene algo - entonces ya exite usuario ------------ */
        if ($result > 0) {
            $alert = '<p class="msg_error">Usuario ya existente</p>';
  
        } else { /* ------------------------ Si no existe usuario -------------------- */
            
            /* ----------------------------- Inssertar query ---------------------------- */
            $query_insert = mysqli_query(
                $conection,
                "INSERT INTO usuario(nombre, correo, usuario,clave,rol_id) 
            VALUES  ('$nombre','$email','$user','$clave','$rol')"
            );

            /* ------------------ Verificar si se Inserto correctamente ----------------- */
            if ($query_insert) {
                $alert = '<p class="msg_save">Usuario CREADO</p>';
            } else {
                $alert = '<p class="msg_errro">Error crear usuario</p>';
            }
        }
    }
}
?>

<section class="registro_container">

    <div class="form_register">

        <h1>Registro Usuario</h1>


        /* ------------------------ Mostrar memnsaje de error ----------------------- */
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

        <form action="" method="post" class="formulario_registro">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">

            <label for="correo">Correo electrónico</label>
            <input type="email" name="correo" id="correo" placeholder="Correo electrónico">

            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario">

            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" placeholder="Clave de acceso">

            <label for="rol">Tipo Usuario</label>

            /* ----------------- Traer la tabla rol y mostrar los roles ----------------- */
            <?php
            $query_rol = mysqli_query($conection, "SELECT * FROM rol");
            $result_rol = mysqli_num_rows($query_rol);

            ?>
            
            /* --------------------- Traer Opciones de rol de la DB --------------------- */
            <select name="rol" id="rol">
                <?php
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

            <input type="submit" value="Crear Usuario" class="btn_save">
        </form>
    </div>



</section>
<?php include "includes/footer.php"; ?>