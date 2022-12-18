<?php include("template/header.php");?>

<?php 
include("dbConnection.php");
$selectTemplate = "SELECT * FROM cervezas;";
//Create a statement
$stmt2 = mysqli_stmt_init($conn);

//Prepare the statement
if(!mysqli_stmt_prepare($stmt2, $selectTemplate)){
    echo "SQL statement failed";
} else {
    //Run parameters
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
}

$Accion = (isset($_POST['accion']))?$_POST['accion']:"";

switch($Accion){
    case "Ver más":
        session_start();
        $ID=(isset($_POST['beerID']))?$_POST['beerID']:"";
        $_SESSION['ID'] = $ID;
        ($_SESSION['ID']!="")?header('Location:detalles.php'):"";
        break;
    case "Ver reseñas":
        session_start();
        $Nombre=(isset($_POST['beerID']))?$_POST['nombre']:"";
        $_SESSION['Nombre'] = $Nombre;
        ($_SESSION['Nombre']!="")?header('Location:resenias.php'):"";
        break;
}

?>

<div class="container">
<div class="row">
    <?php foreach($result as $beer){?>

    <div class="col-md-3">   
        <div class="card">
            <img class="card-img-top" src="img/<?php echo $beer['Imagen']?>">
            <div class="card-body">
                <h4 class="card-title"><?php echo $beer['Nombre'];?></h4>
                <form method="POST">
                        <input type="hidden" name="beerID" id="beerID" value="<?php echo $beer['ID']; ?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo $beer['Nombre']; ?>">
                        <input type="submit" name="accion" value="Ver más" class="btn btn-info btn-sm">
                        <input type="submit" name="accion" value="Ver reseñas" class="btn btn-info btn-sm">
                </form>
            </div>
        </div>
    </div>
<?php }?>


</div>
</div>
<?php include("template/footer.php");?>

