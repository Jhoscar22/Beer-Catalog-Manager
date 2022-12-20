<?php include("template/header.php");?>

<?php
$ID=(isset($_POST['beerID']))?$_POST['beerID']:"";
$Nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$Imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$Casa=(isset($_POST['casa']))?$_POST['casa']:"";
$Clasificacion=(isset($_POST['clasificacion']))?$_POST['clasificacion']:"";
$Tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";
$Alcohol=(isset($_POST['alcohol']))?$_POST['alcohol']:"";
$Color=(isset($_POST['color']))?$_POST['color']:"";
$IBU=(isset($_POST['ibu']))?$_POST['ibu']:"";
$PH=(isset($_POST['ph']))?$_POST['ph']:"";
$Gas=(isset($_POST['gas']))?$_POST['gas']:"";
$Espesor=(isset($_POST['espesor']))?$_POST['espesor']:"";
$Viscocidad=(isset($_POST['viscocidad']))?$_POST['viscocidad']:"";
$Olor=(isset($_POST['olor']))?$_POST['olor']:"";
$Sabor=(isset($_POST['sabor']))?$_POST['sabor']:"";
$Retrogusto=(isset($_POST['retrogusto']))?$_POST['retrogusto']:"";
$Sensacion=(isset($_POST['sensacion']))?$_POST['sensacion']:"";
$Apariencia=(isset($_POST['apariencia']))?$_POST['apariencia']:"";
$Upload_ingredientes=(isset($_POST['ingredientes']))?$_POST['ingredientes']:"";

$Accion=(isset($_POST['accion']))?$_POST['accion']:"";

session_start();
if(isset($_SESSION['ID'])){
    ($_SESSION['ID']!="")?$ID=$_SESSION['ID'] AND $Accion='seleccionar':"";
}


include("dbConnection.php");
include("dbSelects.php");

switch($Accion){
    case "anadir":
        
        //Ceate a template
        $insert_tmplt = "INSERT INTO cervezas (Nombre, Imagen, Casa, Clasificacion, Tipo, Alcohol, Color, IBU, PH, Gas, Espesor, Viscocidad, Olor, Sabor, Retrogusto, Sensacion, Apariencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        //Create a statement
        $insert_stmt = mysqli_stmt_init($conn);

        //Prepare the statement
        if(!mysqli_stmt_prepare($insert_stmt, $insert_tmplt)){
            echo "SQL preparation failed";
        } else {
            //Replace placeholders
            mysqli_stmt_bind_param($insert_stmt, "ssssssiisssssssss", $Nombre, $Imagen, $Casa, $Clasificacion, $Tipo, $Alcohol, $Color, $IBU, $PH, $Gas, $Espesor, $Viscocidad, $Olor, $Sabor, $Retrogusto, $Sensacion, $Apariencia);
            //Run parameters
            mysqli_stmt_execute($insert_stmt);
        }
        $ID = $conn->insert_id;
        $insert_ing_tmplt = "INSERT INTO cervezas_ingredientes (cervezaID, ingredienteID) VALUES (?, ?);";
        $insert_ing_stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($insert_ing_stmt, $insert_ing_tmplt)){echo "SQL preparation failed";
        } else {
            for($i = 0; $i < count($Upload_ingredientes); $i++){
                
                $insert_ing_stmt->bind_param("ii", $ID, $Upload_ingredientes[$i]);
                $insert_ing_stmt->execute();
            }
        }
        break;
    case "editar":
        $ID=(isset($_POST['beerID']))?$_POST['beerID']:"";
        $edit_tmplt = "UPDATE `cervezas` SET `Nombre`=?, `Imagen`=?, `Casa`=?, `Clasificacion`=?, `Tipo`=?, `Alcohol`=?, `Color`=?, `IBU`=?, `PH`=?, `Gas`=?, `Espesor`=?, `Viscocidad`=?, `Olor`=?, `Sabor`=?, `Retrogusto`=?, `Sensacion`=?, `Apariencia`=? WHERE `ID`=?;";
        //Create a statement
        $edit_stmt = mysqli_stmt_init($conn);

        //Prepare the statement
        if(!mysqli_stmt_prepare($edit_stmt, $edit_tmplt)){
            echo "SQL preparation failed";
        } else {
            //Replace placeholders
            $edit_stmt->bind_param("ssssssiisssssssssi", $Nombre, $Imagen, $Casa, $Clasificacion, $Tipo, $Alcohol, $Color, $IBU, $PH, $Gas, $Espesor, $Viscocidad, $Olor, $Sabor, $Retrogusto, $Sensacion, $Apariencia, $ID);
            //Run parameters
            $edit_stmt->execute();
        }
        break;
    case "cancelar":
        if(isset($_SESSION['ID'])){
            $_SESSION['ID']="";
        }
        $ID="";
        header("Location:detalles.php");
        break;
    case "seleccionar":
        if(isset($_SESSION['ID'])){
            $_SESSION['ID']="";
        }
        $select_tmplt = "SELECT * FROM cervezas WHERE ID=?;";
        //Create a statement
        $select_stmt = mysqli_stmt_init($conn);

        //Prepare the statement
        if(!mysqli_stmt_prepare($select_stmt, $select_tmplt)){
            echo "SQL preparation failed";
        } else {
            //Replace placeholders
            if(isset($_POST['beerID'])){
                $ID=$_POST['beerID'];
            }
            mysqli_stmt_bind_param($select_stmt, "i", $ID);
            //Run parameters
            mysqli_stmt_execute($select_stmt);
            $result = mysqli_stmt_get_result($select_stmt);
            $beer = mysqli_fetch_assoc($result);
            $Nombre=$beer['Nombre'];
            $Imagen=$beer['Imagen'];
            $Casa=$beer['Casa'];
            $Clasificacion=$beer['Clasificacion'];
            $Tipo=$beer['Tipo'];
            $Alcohol=$beer['Alcohol'];
            $Color=$beer['Color'];
            $IBU=$beer['IBU'];
            $PH=$beer['PH'];
            $Gas=$beer['Gas'];
            $Espesor=$beer['Espesor'];
            $Viscocidad=$beer['Viscocidad'];
            $Olor=$beer['Olor'];
            $Sabor=$beer['Sabor'];
            $Retrogusto=$beer['Retrogusto'];
            $Sensacion=$beer['Sensacion'];
            $Apariencia=$beer['Apariencia'];

            $beer_ing = array();
            foreach($composiciones as $row){
                if($row[0]==$ID){
                    array_push($beer_ing, $row[1]);
                }
            }
        }

        break;
    case "borrar":
        //Ceate a template
        $delete_tmplt = "DELETE FROM cervezas WHERE ID=?;";

        //Create a statement
        $delete_stmt = mysqli_stmt_init($conn);

        //Prepare the statement
        if(!mysqli_stmt_prepare($delete_stmt, $delete_tmplt)){
            echo "SQL preparation failed";
        } else {
            //Replace placeholders
            mysqli_stmt_bind_param($delete_stmt, "i", $ID);
            //Run parameters
            mysqli_stmt_execute($delete_stmt);
        }
        break;
}






?>

<h3 class="titulo">Datos del producto</h3>
<div class="row">
<div class="col">
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="beerID", id="beerID" value="<?php echo $ID; ?>">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="nombre">*Nombre de la marca:</label>
            <input class="form-control" type="text" value="<?php echo $Nombre; ?>" name="nombre" id="nombre" required>
        </div>
        <div class="form-group col-md-4">
            <label for="imagen">Imagen de la marca:</label>
            <?php echo $Imagen; ?>
            <input class="form-control" type="file" name="imagen" id="imagen">        
        </div>
        <div class="form-group col-md-4">
            <label for="casa">*Casa cervecera: </label>
            <select name="casa" id="casa" required class="form-control">
                <?php
                    foreach($casas as $casa_op){ 
                    echo '<option value="'.$casa_op['Valor'].'" ';
                    if($Casa == $casa_op['Valor']){echo "selected";}
                    echo '>'.$casa_op['Valor'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            *Clasificación:<br>
            <input class="btn-check" type="radio" <?php if($Clasificacion == "Ale"){echo "checked";}?> id="ale" name="clasificacion" value="Ale" required>
            <label class="btn btn-outline-primary" for="ale">Ale</label> 
            <input class="btn-check" type="radio" <?php if($Clasificacion == "Lager"){echo "checked";}?> id="lager" name="clasificacion" value="Lager" required>
            <label class="btn btn-outline-primary" for="lager">Lager</label> 
        </div>
        <div class="form-group col-md-4">
            <label for="tipo">*Tipo: </label>
            <select class="form-control" name="tipo" id="tipo" required>
                <?php
                    foreach($tipos as $tipo_op){ 
                    echo '<option value="'.$tipo_op['Valor'].'" ';
                    if($Tipo == $tipo_op['Valor']){echo "selected";}
                    echo '>'.$tipo_op['Valor'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="alcohol">*Contenido alcohólico: (%)</label>
            <input type="number" class="form-control" value="<?php echo $Alcohol; ?>" name="alcohol" id="alcohol" min="0" max="100" step="0.1" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="color">*Color: </label>
            <input type="range" class="form-range" value="<?php echo $Color; ?>" name="color" id="color" min="1" max ="40" required>
        </div>
        <div class="form-group col-md-4">
            <label for="ibu">*Amargor o IBU: </label>
            <input type="range" class="form-range" value="<?php echo $IBU; ?>" name="ibu" id="ibu" min="10" max="100" required>
        </div>
        <div class="form-group col-md-4">
            <label for="ph">*PH: </label>
            <input type="range" class="form-range" value="<?php echo $PH; ?>" name="ph" id="ph" min="1" max="4.9" step="0.1" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>*Gasificación: </label><br>
            <input class="btn-check" type="radio" <?php if($Gas == "Nula"){echo "checked";}?> id="gas-n" name="gas" value="Nula" required>
            <label class="btn btn-outline-primary" for="gas-n">Nula</label> 
            <input class="btn-check" type="radio" <?php if($Gas == "Baja"){echo "checked";}?> id="gas-b" name="gas" value="Baja" required>
            <label class="btn btn-outline-primary" for="gas-b">Baja</label> 
            <input class="btn-check" type="radio" <?php if($Gas == "Media"){echo "checked";}?> id="gas-m" name="gas" value="Media" required>
            <label class="btn btn-outline-primary" for="gas-m">Media</label> 
            <input class="btn-check" type="radio" <?php if($Gas == "Alta"){echo "checked";}?> id="gas-a" name="gas" value="Baja" required>
            <label class="btn btn-outline-primary" for="gas-a">Alta</label>
        </div>
        <div class="form-group col-md-4">
            <label>*Espesor: </label><br>
            <input class="btn-check" type="radio" <?php if($Espesor == "Nula"){echo "checked";}?> id="esp-n" name="espesor" value="Nula" required>
            <label class="btn btn-outline-primary" for="esp-n">Nula</label> 
            <input class="btn-check" type="radio" <?php if($Espesor == "Baja"){echo "checked";}?> id="esp-b" name="espesor" value="Baja" required>
            <label class="btn btn-outline-primary" for="esp-b">Baja</label> 
            <input class="btn-check" type="radio" <?php if($Espesor == "Media"){echo "checked";}?> id="esp-m" name="espesor" value="Media" required>
            <label class="btn btn-outline-primary" for="esp-m">Media</label> 
            <input class="btn-check" type="radio" <?php if($Espesor == "Alta"){echo "checked";}?> id="esp-a" name="espesor" value="Baja" required>
            <label class="btn btn-outline-primary" for="esp-a">Alta</label>
        </div>
        <div class="form-group col-md-4">
            <label>*Viscocidad: </label><br>
            <input class="btn-check" type="radio" <?php if($Viscocidad == "Nula"){echo "checked";}?> id="visc-n" name="viscocidad" value="Nula" required>
            <label class="btn btn-outline-primary" for="visc-n">Nula</label> 
            <input class="btn-check" type="radio" <?php if($Viscocidad == "Baja"){echo "checked";}?> id="visc-b" name="viscocidad" value="Baja" required>
            <label class="btn btn-outline-primary" for="visc-b">Baja</label> 
            <input class="btn-check" type="radio" <?php if($Viscocidad == "Media"){echo "checked";}?> id="visc-m" name="viscocidad" value="Media" required>
            <label class="btn btn-outline-primary" for="visc-m">Media</label> 
            <input class="btn-check" type="radio" <?php if($Viscocidad == "Alta"){echo "checked";}?> id="visc-a" name="viscocidad" value="Baja" required>
            <label class="btn btn-outline-primary" for="visc-a">Alta</label>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>*Olor: </label><br>
            <input class="btn-check" type="radio" <?php if($Olor == "Nula"){echo "checked";}?> id="olor-n" name="olor" value="Nula" required>
            <label class="btn btn-outline-primary" for="olor-n">Nula</label> 
            <input class="btn-check" type="radio" <?php if($Olor == "Baja"){echo "checked";}?> id="olor-b" name="olor" value="Baja" required>
            <label class="btn btn-outline-primary" for="olor-b">Baja</label> 
            <input class="btn-check" type="radio" <?php if($Olor == "Media"){echo "checked";}?> id="olor-m" name="olor" value="Media" required>
            <label class="btn btn-outline-primary" for="olor-m">Media</label> 
            <input class="btn-check" type="radio" <?php if($Olor == "Alta"){echo "checked";}?> id="olor-a" name="olor" value="Baja" required>
            <label class="btn btn-outline-primary" for="olor-a">Alta</label>
        </div>
        <div class="form-group col-md-4">
            <label>*Sabor: </label><br>
            <input class="btn-check" type="radio" <?php if($Sabor == "Nula"){echo "checked";}?> id="sabor-n" name="sabor" value="Nula" required>
            <label class="btn btn-outline-primary" for="sabor-n">Nula</label> 
            <input class="btn-check" type="radio" <?php if($Sabor == "Baja"){echo "checked";}?> id="sabor-b" name="sabor" value="Baja" required>
            <label class="btn btn-outline-primary" for="sabor-b">Baja</label> 
            <input class="btn-check" type="radio" <?php if($Sabor == "Media"){echo "checked";}?> id="sabor-m" name="sabor" value="Media" required>
            <label class="btn btn-outline-primary" for="sabor-m">Media</label> 
            <input class="btn-check" type="radio" <?php if($Sabor == "Alta"){echo "checked";}?> id="sabor-a" name="sabor" value="Baja" required>
            <label class="btn btn-outline-primary" for="sabor-a">Alta</label>
        </div>
        <div class="form-group col-md-4">
            <label>*Retrogusto: </label><br>
            <input class="btn-check" type="radio" <?php if($Retrogusto == "Nula"){echo "checked";}?> id="retro-n" name="retrogusto" value="Nula" required>
            <label class="btn btn-outline-primary" for="retro-n">Nula</label> 
            <input class="btn-check" type="radio" <?php if($Retrogusto == "Baja"){echo "checked";}?> id="retro-b" name="retrogusto" value="Baja" required>
            <label class="btn btn-outline-primary" for="retro-b">Baja</label> 
            <input class="btn-check" type="radio" <?php if($Retrogusto == "Media"){echo "checked";}?> id="retro-m" name="retrogusto" value="Media" required>
            <label class="btn btn-outline-primary" for="retro-m">Media</label> 
            <input class="btn-check" type="radio" <?php if($Retrogusto == "Alta"){echo "checked";}?> id="retro-a" name="retrogusto" value="Baja" required>
            <label class="btn btn-outline-primary" for="retro-a">Alta</label>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="sensacion">Sensación bucal:</label>
            <textarea class="form-control col-md-6" name="sensacion" id="sensacion" rows=3><?php echo $Sensacion; ?></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="apariencia">Apariencia:</label>
            <textarea type="text" class="form-control" name="apariencia" id="apariencia" rows=3><?php echo $Apariencia; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="check-box-list">
            <label>*Composición: (Selecciona todas las que apliquen)</label><br>
            <div class="btn-group col-md-4">  
                <?php foreach($ingredientes as $ingrediente){?>
                <input class="btn-check" type="checkbox" id="ing<?php echo $ingrediente['ID'];?>" name="ingredientes[]" value="<?php echo $ingrediente['ID'];?>" <?php if(isset($beer_ing)){if(in_array($ingrediente['ID'], $beer_ing)){echo "checked";}else{echo "not found";}}?> >
                <label class="btn btn-outline-primary" for="ing<?php echo $ingrediente['ID'];?>"><?php echo $ingrediente['Valor'];?></label> 
                <?php }?>
            </div>
        </div>
        
    </div>
    <div class="action-btn-group">
        <button type="submit" name="accion" <?php echo ($Accion!='seleccionar')?"":"disabled"; ?> class="btn btn-success" value="anadir">Añadir</button>
        <button type="submit" name="accion" <?php echo ($Accion=='seleccionar')?"":"disabled"; ?> class="btn btn-warning" value="editar">Editar</button>
        <button type="submit" name="accion" <?php echo ($Accion=='seleccionar')?"":"disabled"; ?> class="btn btn-info" value="cancelar">Cancelar</button>
    </div>
</form>
</div>
<div class="col-md-5">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Casa</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($beers as $beer){?>
            <tr>
                <td><?php echo $beer['ID']; ?></td>
                <td><?php echo $beer['Nombre']; ?></td>
                <td><?php echo $beer['Casa']; ?></td>
                <td>
                    <img src="../img/<?php echo $beer['Imagen'];?>" height="70">
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="beerID" id="beerID" value="<?php echo $beer['ID']; ?>">
                        <input type="submit" name="accion" value="seleccionar" class="btn btn-primary">
                        <input type="submit" name="accion" value="borrar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>



<?php include("template/footer.php");?>