<?php
/* CONEXION
try{
    $conexion=new PDO("mysql:host=$dbHost;dbName=$dbName",$dbUsername,$dbPassword);
    if($conexion){echo "Conectado exitosamente";}
} catch(Exception $exept) {
        echo $exept->getMessage();
}*/


//INSERTION STATEMENT EXAMPLE
//INSERT INTO `cervezas` (`ID`, `Nombre`, `Imagen`, `Casa`, `Clasificacion`, `Tipo`, `Alcohol`, `Color`, `IBU`, `PH`, `Gas`, `Espesor`, `Viscocidad`, `Olor`, `Sabor`, `Retrogusto`, `Sensacion`, `Apariencia`) VALUES (NULL, 'Victoria', 'victoria.jpg', 'Grupo Modelo', 'Lager', 'Vienna', '4.8', '8', '24', '4.2', 'Media', 'Nula', 'Nula', 'Media', 'Media', 'Media', 'Gaseosa y amarga.', 'Efervescente, color ámbar.');

/* SUSCEPTIBLE TO SQL INJECTION, BETTER TO USE PREPARED STATEMENTS
$sql = "INSERT INTO cervezas (Nombre, Imagen, Casa, Clasificacion, Tipo, Alcohol, Color, IBU, PH, Gas, Espesor, Viscocidad, Olor, Sabor, Retrogusto, Sensacion, Apariencia) VALUES ('$Nombre', '$Imagen', '$Casa', '$Clasificacion', '$Tipo', '$Alcohol', '$Color', '$IBU', '$PH', '$Gas', '$Espesor', '$Viscocidad', '$Olor', '$Sabor', '$Retrogusto', '$Sensacion', '$Apariencia');";
mysqli_query($conn, $sql);*/


//USING BINDPARAM()
/*$sentenciaSQL=$conn->prepare("INSERT INTO cervezas (ID, Nombre, Imagen, Casa, Clasificacion, Tipo, Alcohol, Color, IBU, PH, Gas, Espesor, Viscocidad, Olor, Sabor, Retrogusto, Sensacion, Apariencia) VALUES (NULL, :Nombre, :Imagen, :Casa, :Clasificacion, :Tipo, :Alcohol, :Color, :IBU, :PH, :Gas, :Espesor, :Viscocidad, :Olor, :Sabor, :Retrogusto, :Sensacion, :Apariencia);");
$sentenciaSQL->bindParam(':Nombre',$nombre);
$sentenciaSQL->bindParam(':Imagen',$Imagen);
$sentenciaSQL->bindParam(':Casa',$Casa);
$sentenciaSQL->bindParam(':Clasificacion',$Clasificacion);
$sentenciaSQL->bindParam(':Tipo',$Tipo);
$sentenciaSQL->bindParam(':Alcohol',$Alcohol);
$sentenciaSQL->bindParam(':Color',$Color);
$sentenciaSQL->bindParam(':IBU',$IBU);
$sentenciaSQL->bindParam(':PH',$PH);
$sentenciaSQL->bindParam(':Gas',$Gas);
$sentenciaSQL->bindParam(':Espesor',$Espesor);
$sentenciaSQL->bindParam(':Viscocidad',$Viscocidad);
$sentenciaSQL->bindParam(':Olor',$Olor);
$sentenciaSQL->bindParam(':Sabor',$Sabor);
$sentenciaSQL->bindParam(':Retrogusto',$Retrogusto);
$sentenciaSQL->bindParam(':Sensacion',$Sensacion);
$sentenciaSQL->bindParam(':Apariencia',$Apariencia);
//$sentenciaSQL->execute();*/

?>