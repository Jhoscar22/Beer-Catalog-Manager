<?php

include("config.php");

try{
    $conn=mysqli_connect($Host, $User, $Password, $Database, $Port);
    //if($conn){echo "Conectado exitosamente";}
} catch(Exception $exept) {
    echo $exept->getMessage();
}
?>