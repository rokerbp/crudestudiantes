<?php 
include ('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
    <title>Formulario</title>
</head>
<body>
    <div class="container my-3">
    <?php
        if (isset($_GET["success"]) && $_GET['success']==1){
            ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                La persona se agregó correctamente
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php
        }
    ?>
        <form name="capturar_datos" action="capturar.php" method="get">
            <div class="form-group">
                <label for="name">Nombres</label>
                <input required name="nombres" type="text" class="form-control" id="Nombres" aria-describedby="nombreHelp" placeholder="Nombres...">
            </div>
            <div class="form-group">
                <label for="name">Apellidos</label>
                <input required name="apellidos" type="text" class="form-control" id="Apellidos" aria-describedby="apellidoHelp" placeholder="Apellidos...">
            </div>
            <div class="form-group">
                <label for="documentoSelect">Tipo Documento</label>
                <select class="form-control" id="documentoSelect">
                <option>Cédula de ciudadanía</option>
                <option>Tarjeta de Identidad</option>
                <option>Cédula de extranjería</option>
                </select>
            </div>
            <div class="form-group">
                <label for="documento">Número de documento</label>
                <input required name="documento" type="text" class="form-control" id="documento" placeholder="# de documento...">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <div class="my-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
            <?php
                
                $sql = "SELECT * FROM departamentos";
                if($resultado = $conn->query($sql)){
                    while ($fila = $resultado->fetch_row()){
                        echo "<tr>";
                        echo "<td>" .$fila[0]."</td>";
                        echo "<td>" .$fila[1]."</td>";
                        echo "</tr>";
                    }
                    $resultado->close();
                }
            ?>
            </tbody>
            </table>
        </div>
    
    </div>
</body>
</html>