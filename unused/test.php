<?php include("template/header.php");?>

<h1>Bienvenido</h1>
<div class="col-md-6">
    <div>
        Por favor rellena el formulario
        <div>* Indica campos obligatorios</div>

        <form method="GET" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nombre">*Nombre de la marca:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label>Imagen de la marca:</label>
                <input type="file">        
            </div>
            <div class="form-group">
                <label for="casa">*Casa cervecera: </label>
                <select name="casa" id="casa" required>
                    <option value="modelo">Grupo Modelo</option>
                    <option value="moctezuma">Moctezuma</option>
                    <option value="loba">Loba</option>
                    <option value="colimita">Colimita</option>
                </select>
            </div>
            <div class="form-group">
                *Clasificación:
                <label for="ale">Ale</label> 
                <input type="radio" id="ale" name="clasificacion" value="Ale" required>
                <label for="lager">Lager</label> 
                <input type="radio" id="lager" name="clasificacion" value="Lager" required>
            </div>
            <div class="form-group">
                <label>*Tipo: </label>
                <select name="tipo" id="tipo" required>
                    <option value="ame-light-l">American Light Lager</option>
                    <option value="eng-brown-a">English Brown Ale</option>
                    <option value="ame-brown-a">American Brown Ale</option>
                </select>
            </div>
            <div class="form-group">
                <label>*Contenido alcohólico: </label>
                <input type="text">
            </div>
            <div class="form-group">
                <label>*Color: </label>
                <input type="number" min="1" max ="40">
            </div>
            <div class="form-group">
                <label>*Amargor o IBU: </label>
                <input type="text">
            </div>
            <div class="form-group">
                <label>*PH: </label>
                <input type="text">
            </div>
            <div class="form-group">
                <label>*Gasificación: </label>
                <input type="radio" id="nula" name="gasificacion" value="Nula">
                <label for="nula">Nula</label> 
                <input type="radio" id="baja" name="gasificacion" value="Baja">
                <label for="baja">Baja</label> 
                <input type="radio" id="media" name="gasificacion" value="Media">
                <label for="media">Media</label> 
                <input type="radio" id="alta" name="gasificacion" value="Baja">
                <label for="alta">Alta</label>
            </div>
            <div class="form-group">
                <label>*Espesor: </label>
                <input type="radio" id="nula" name="espesor" value="Nula">
                <label for="nula">Nula</label> 
                <input type="radio" id="baja" name="espesor" value="Baja">
                <label for="baja">Baja</label> 
                <input type="radio" id="media" name="espesor" value="Media">
                <label for="media">Media</label> 
                <input type="radio" id="alta" name="espesor" value="Baja">
                <label for="alta">Alta</label>
            </div>
            <div class="form-group">
                <label>*Viscocidad: </label>
                <input type="radio" id="nula" name="viscocidad" value="Nula">
                <label for="nula">Nula</label> 
                <input type="radio" id="baja" name="viscocidad" value="Baja">
                <label for="baja">Baja</label> 
                <input type="radio" id="media" name="viscocidad" value="Media">
                <label for="media">Media</label> 
                <input type="radio" id="alta" name="viscocidad" value="Baja">
                <label for="alta">Alta</label>
            </div>
            <div class="form-group">
                <label>*Olor: </label>
                <input type="radio" id="nula" name="olor" value="Nula">
                <label for="nula">Nula</label> 
                <input type="radio" id="baja" name="olor" value="Baja">
                <label for="baja">Baja</label> 
                <input type="radio" id="media" name="olor" value="Media">
                <label for="media">Media</label> 
                <input type="radio" id="alta" name="olor" value="Baja">
                <label for="alta">Alta</label>
            </div>
            <div class="form-group">
                <label>*Sabor: </label>
                <input type="radio" id="nula" name="sabor" value="Nula">
                <label for="nula">Nula</label> 
                <input type="radio" id="baja" name="sabor" value="Baja">
                <label for="baja">Baja</label> 
                <input type="radio" id="media" name="sabor" value="Media">
                <label for="media">Media</label> 
                <input type="radio" id="alta" name="sabor" value="Baja">
                <label for="alta">Alta</label>
            </div>
            <div class="form-group">
                <label>*Retrogusto: </label>
                <input type="radio" id="nula" name="retrogusto" value="Nula">
                <label for="nula">Nula</label> 
                <input type="radio" id="baja" name="retrogusto" value="Baja">
                <label for="baja">Baja</label> 
                <input type="radio" id="media" name="retrogusto" value="Media">
                <label for="media">Media</label> 
                <input type="radio" id="alta" name="retrogusto" value="Baja">
                <label for="alta">Alta</label>
            </div>
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" class="btn-success">Añadir</button>
                <button type="button" class="btn-warning">Editar</button>
                <button type="button" class="btn-info">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<div class="col-md-6">
    
</div>


<?php include("template/footer.php");?>