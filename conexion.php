<?php

function conectarBD() :mysqli {
// 
    $conection = mysqli_connect('localhost', 'root','root','facturacion_2');

    if(!$conection){
        echo "ERROR con conectar a la DB";

        exit;
    }

    return $conection; 
}
