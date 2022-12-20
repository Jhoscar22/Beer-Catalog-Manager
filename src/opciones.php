<?php
include("template/header.php");
include("dbConnection.php");


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

include("dbSelects.php");

$Accion=(isset($_POST['accion']))?$_POST['accion']:"";
$Campo=(isset($_POST['campo']))?$_POST['campo']:"";
$ID=(isset($_POST['campoID']))?$_POST['campoID']:"";
$Valor=(isset($_POST['valor']))?$_POST['valor']:"";

switch($Accion){
    case "agregar":
        $insert_tmplt = "INSERT INTO $Campo (`Valor`) VALUES (?);";
        $insert_stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($insert_stmt, $insert_tmplt)){
            echo "SQL preparation failed";
        } else {
            $insert_stmt->bind_param("s", $Valor);
            $insert_stmt->execute();
        }

        break;
    case "editar":
        $edit_tmplt = "UPDATE $Campo SET `Valor`=? WHERE `ID`=?;";
        $edit_stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($edit_stmt, $edit_tmplt)){
            echo "SQL preparation failed";
        } else {
            $edit_stmt->bind_param("si", $Valor, $ID);
            $edit_stmt->execute();
        }
        break;
    case "cancelar":
        $Valor="";
        break;
    case "seleccionar":
        break;
    case "eliminar":
        #echo "Se desea borrar: ".$Valor." perteneciente al campo ".$Campo." y con id ".$ID."<br>";
        //COMPROBAMOS QUE NO SE USE
        if($Campo != "ingredientes"){
            if($Campo == "casas"){
                $Columna = "Casa";
            }elseif($Campo == "tipos"){
                $Columna = "Tipo";
            }
            $select_tmplt = "SELECT * FROM `cervezas` WHERE $Columna = ?;";
            $select_stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($select_stmt, $select_tmplt)){
                echo "SQL preparation failed";
            } else {
                mysqli_stmt_bind_param($select_stmt, "s", $Valor);
                //Run parameters
                mysqli_stmt_execute($select_stmt);
                $result = mysqli_stmt_get_result($select_stmt);
                $rows = mysqli_num_rows($result);
            }
            if($rows != 0){
                echo "NO PUEDES ELIMINAR UN VALOR EN USO, LAS CERVEZAS QUE LO INCLUYEN SON: ";
                foreach($result as $beer){
                    echo $beer['Nombre'].", ";
                }
            } else {
                $delete_tmplt = "DELETE FROM $Campo WHERE ID=?;";
                $delete_stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($delete_stmt, $delete_tmplt)){
                    echo "SQL preparation failed";
                } else {
                    mysqli_stmt_bind_param($delete_stmt, "i", $ID);
                    mysqli_stmt_execute($delete_stmt);
                }
            }
        }else{
            $en_uso = false;
            foreach($composiciones as $row){
                if($row[1]==$ID){
                    $en_uso = true;
                }
            }
            if($en_uso){
                echo "NO SE PUDO ELIMINAR EL INGREDIENTE PORQUE UNA O MÁS CERVEZAS LO CONTIENEN";
            }else{
                $delete_tmplt = "DELETE FROM ingredientes WHERE ID=?;";
                $delete_stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($delete_stmt, $delete_tmplt)){
                    echo "SQL preparation failed";
                } else {
                    mysqli_stmt_bind_param($delete_stmt, "i", $ID);
                    mysqli_stmt_execute($delete_stmt);
                }
            }
        }
        break;
}

switch($Campo){
    case "casas":
        $result = $casas;
        break;
    case "tipos":
        $result = $tipos;
        break;
    case "ingredientes":
        $result = $ingredientes;
        break;
    case "":
        $result = $casas;
        $Campo = "casas";
        break;
}

?>

<div class="row" style="padding: 0px 30px;">
    <div class="card col-md-8">
        <form method="POST">
            <input type="hidden" name="campoID", id="campoID" value="<?php echo $ID; ?>">
            <div class="row">
                <h3>Información sobre los campos</h3>
                <div class="form-group col-md-6">
                    <label for="campo">Selecciona un campo</label>
                    <select class="form-control" name="campo" id="campo">
                        <option value="casas" <?php if($Campo=="casas"){echo "selected";} ?> >Casa</option>
                        <option value="tipos" <?php if($Campo=="tipos"){echo "selected";} ?> >Tipo</option>
                        <option value="ingredientes" <?php if($Campo=="ingredientes"){echo "selected";} ?> >Ingrediente</option>
                    </select>
                </div>
                <div class="action-btn-group col-md-6">
                    <br>
                    <button type="submit" name="accion" value="ver" class="btn btn-success col-md-2";">Ver</button>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="valor">Valor de la opcion</label>
                    <input type="text" class="form-control" name="valor" id="valor" value="<?php echo $Valor;?>">
                </div>
                <div class="action-btn-group col-md-6">
                    <br>
                    <button type="submit" name="accion" <?php echo ($Accion=='seleccionar')?"":"disabled"; ?> class="btn btn-warning col-md-3" value="editar">Editar</button>
                    <button type="submit" name="accion" <?php echo ($Accion=='seleccionar')?"":"disabled"; ?> class="btn btn-info col-md-3" value="cancelar" style="margin-left:10px;">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card col-md-4">
        <h3>Resultados de la búsqueda</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $row){?>
                <tr>
                    <td><?php echo $row['ID'];?></td>
                    <td><?php echo $row['Valor'];?></td>
                    <td><form method="POST">
                        <input type="hidden" name="campoID" id="campoID" value="<?php echo $row['ID']; ?>">
                        <input type="hidden" name="valor" id="valor" value="<?php echo $row['Valor']; ?>">
                        <input type="hidden" name="campo" id="campo" value="<?php echo $Campo; ?>">
                        <input type="submit" name="accion" value="seleccionar" class="btn btn-primary">
                        <input type="submit" name="accion" value="eliminar" class="btn btn-danger">
                    </form></td>
                </tr>
                <?php }?>
                <tr>
                    <form method="POST">
                        <td></td>
                        <td><div class="form-group">
                            <input type="text" class="form-control" name="valor" id="valor" placeholder="nuevo valor">
                            <input type="hidden" name="campo" id="campo" value="<?php echo $Campo; ?>">
                        </div></td>
                        <td><input type="submit" name="accion" value="agregar" class="btn btn-success"></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    

<?php include("template/footer.php"); ?>