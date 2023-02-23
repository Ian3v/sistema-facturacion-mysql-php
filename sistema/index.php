<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include "includes/scripts.php" ?>

        <link rel="stylesheet" href="includes/css/style.css">
    <title>Document</title>
</head>
<body>  
    

    
    <?php include "Includes/header.php" ?>
    
    <div class="header_spacing"></div>

    <section class="container_main">
            <?php include "includes/nav.php"; ?>
            
            <?php  
            include "registro_usuario.php";
            ?>
    </section>

    <?php include "Includes/footer.php" ?>
</body>
</html>