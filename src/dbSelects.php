<?php
$beer_tmplt = "SELECT * FROM cervezas;";
//Create a statement
$beer_stmt = mysqli_stmt_init($conn);

//Prepare the statement
if(!mysqli_stmt_prepare($beer_stmt, $beer_tmplt)){
    echo "SQL statement failed";
} else {
    //Run parameters
    mysqli_stmt_execute($beer_stmt);
    $beers = mysqli_stmt_get_result($beer_stmt);
}

$casas_tmplt = "SELECT * FROM casas;";
//Create a statement
$casas_stmt = mysqli_stmt_init($conn);

//Prepare the statement
if(!mysqli_stmt_prepare($casas_stmt, $casas_tmplt)){
    echo "SQL statement failed";
} else {
    //Run parameters
    mysqli_stmt_execute($casas_stmt);
    $casas = mysqli_stmt_get_result($casas_stmt);
}

$tipos_tmplt = "SELECT * FROM tipos;";
//Create a statement
$tipos_stmt = mysqli_stmt_init($conn);

//Prepare the statement
if(!mysqli_stmt_prepare($tipos_stmt, $tipos_tmplt)){
    echo "SQL statement failed";
} else {
    //Run parameters
    mysqli_stmt_execute($tipos_stmt);
    $tipos = mysqli_stmt_get_result($tipos_stmt);
}

$ingredientes_tmplt = "SELECT * FROM ingredientes;";
//Create a statement
$ingredientes_stmt = mysqli_stmt_init($conn);

//Prepare the statement
if(!mysqli_stmt_prepare($ingredientes_stmt, $ingredientes_tmplt)){
    echo "SQL statement failed";
} else {
    //Run parameters
    mysqli_stmt_execute($ingredientes_stmt);
    $ingredientes = mysqli_stmt_get_result($ingredientes_stmt);
}

$composicion_tmplt = "SELECT * FROM cervezas_ingredientes;";
//Create a statement
$composicion_stmt = mysqli_stmt_init($conn);

//Prepare the statement
if(!mysqli_stmt_prepare($composicion_stmt, $composicion_tmplt)){
    echo "SQL statement failed";
} else {
    //Run parameters
    mysqli_stmt_execute($composicion_stmt);
    $composiciones_raw = mysqli_stmt_get_result($composicion_stmt);
    $composiciones = mysqli_fetch_all($composiciones_raw); 
}

?>