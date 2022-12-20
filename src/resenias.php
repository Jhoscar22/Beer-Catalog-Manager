<?php
include("template/header.php");
include("dbConnection.php");
include("dbSelects.php");



$Nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$Imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$Accion=(isset($_POST['accion']))?$_POST['accion']:"";

session_start();
if(isset($_SESSION['Nombre'])){
    ($_SESSION['Nombre']!="")?$Nombre=$_SESSION['Nombre']:"";
}

if($Nombre == ""){
    $select_tmplt = "SELECT * FROM cervezas LIMIT 1;";
    $select_stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($select_stmt, $select_tmplt)){echo "SQL preparation failed"; } else {
        $select_stmt->execute();
        $result = mysqli_stmt_get_result($select_stmt);
        $beer = mysqli_fetch_assoc($result);
        $Nombre = $beer['Nombre'];
        $CervezaID = $beer['ID'];
    }
}

switch($Accion){
    case "subir":
        $CervezaID = (isset($_POST['cervezaId']))?$_POST['cervezaId']:"";
        $Fecha = (isset($_POST['fecha']))?$_POST['fecha']:"";
        $Estrellas = (isset($_POST['estrellas']))?$_POST['estrellas']:"";
        $Descripcion = (isset($_POST['descripcion']))?$_POST['descripcion']:"";
        
        $insert_tmplt = "INSERT INTO `resenias` (`CervezaID`, `Fecha`, `Estrellas`, `Descripcion`) VALUES (?, ?, ?, ?);";
        $insert_stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($insert_stmt, $insert_tmplt)){ echo "SQL preparation failed";} else {
            $insert_stmt->bind_param("isis", $CervezaID, $Fecha, $Estrellas, $Descripcion);
            $insert_stmt->execute();
        }
        break;
}

if(isset($_SESSION['Nombre'])){ $_SESSION['Nombre']="";}
$select_tmplt = "SELECT * FROM cervezas WHERE Nombre=?;";
$select_stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($select_stmt, $select_tmplt)){echo "SQL preparation failed"; } else {
    $select_stmt->bind_param("s", $Nombre);
    $select_stmt->execute();
    $result = mysqli_stmt_get_result($select_stmt);
    $beer = mysqli_fetch_assoc($result);
    $CervezaID = $beer['ID'];

    $review_tmplt = "SELECT * FROM resenias WHERE CervezaID = $CervezaID;";
    $review_stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($review_stmt, $review_tmplt)){echo "SQL preparation failed"; } else {
        $review_stmt->execute();
        $reviews = mysqli_stmt_get_result($review_stmt);
    }
}

?>

<div class="row" style="padding: 0px 30px;">
    <div class="card col-md-4">
        <h2>Imagen</h2>
        <img src="../img/<?php echo $beer['Imagen'];?>" style="height:430px; margin:auto;">
    </div>
    <div class="card col">
        <h2>Explorar</h2>
        <form method="POST">
            <input type="hidden" name="cervezaId" id ="cervezaId" value="<?php echo $CervezaID; ?>">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">Selecciona una cerveza</label>
                    <select class="form-control" name="nombre" id="nombre">
                        <?php
                            foreach($beers as $cerveza){ 
                            echo '<option value="'.$cerveza['Nombre'].'" ';
                            if($Nombre == $cerveza['Nombre']){echo "selected";}
                            echo '>'.$cerveza['Nombre'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="action-btn-group col-md-6" style="padding-left:2rem;">
                    <br>
                    <button type="submit" name="accion" value="mostrar" class="btn btn-success col-md-2";">Ver</button>
                </div>
            </div>
            
            <div class="row">
                <?php foreach($reviews as $review){ ?>
                <div class="form-group col-md-6">
                    <label for="review" class="text-info" style="font-weigth:bold;"><?php echo $review['Fecha']." "; ?></label>
                    <label for="review" class="text-warning"><?php echo $review['Estrellas']." estrellas "; ?></label>
                    <textarea class="form-control col-md-6" name="review" id="review" rows=3 readonly><?php echo $review['Descripcion']; ?></textarea>
                </div>
                <?php } ?>
            </div> 
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="fecha" class="text-info" style="font-weigth:bold;"><?php echo date("Y-m-d"); ?></label>
                    <input type="hidden" value="<?php echo date("Y-m-d"); ?>" name="fecha" id="fecha">
                    <label for="descripcion" class="text-warning"></label>
                    <textarea class="form-control col-md-6" name="descripcion" id="descripcion" rows=3></textarea>
                </div>
                <div class="col" style="padding:0;">
                    <div class="form-group" style="width: 8rem;">
                        <label for="estrellas">Estrellas</label>
                        <input type="number" name="estrellas" id="estrellas" class="form-control" min="1" max="5" step="1">
                    </div>
                    <button type="submit" name="accion" value="subir" class="btn form-control btn-outline-info" style="width: 4.1rem; margin-left:2rem;">Subir</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("template/footer.php") ?>