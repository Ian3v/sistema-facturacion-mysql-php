<?php
    session_start();
    if(empty($_SESSION['active']))
    {
        // header('location: ../');
    }
?>

<header>
    <div class="header">
        <div class="container_header">
            <h1>Sistema Facturación</h1>
            <div class="optionsBar">
                <p>Perú, <?php echo fechaC(); ?></p>
                <span>|</span>
                <span class="user"><?php echo $_SESSION['user'] ?></span>
                <img class="photouser" src="includes/img/user.png" alt="Usuario">
                <a href="../sistema/salir.php">Salir del sistema</a>
            </div>
        </div>
        
    </div>
    
</header>