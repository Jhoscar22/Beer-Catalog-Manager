<?php
$dbHost="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="beerdb";
$XamppPort="8111";

try{
    $conn=mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName, $XamppPort);
    //if($conn){echo "Conectado exitosamente";}
} catch(Exception $exept) {
    echo $exept->getMessage();
}
?>