<?php 
include ('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
    <title>Formulario</title>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8 my-3"><h2>Agregar <b>Estudiante</b></h2></div>
                </div>
            </div>
    <?php
        $estudiantes= new Database();
        if(isset($_POST) && !empty($_POST)){
            $nombres = $estudiantes->sanitize($_POST['nombres']);
            $apellidos = $estudiantes->sanitize($_POST['apellidos']);
            $tipodoc = $estudiantes->sanitize($_POST['documentoSelect']);
            $numdoc = $estudiantes->sanitize($_POST['documento']);
            $departamento = $estudiantes->sanitize($_POST['departamentoSelect']);
            $ciudad = $estudiantes->sanitize($_POST['ciudad']);
            
            $res = $estudiantes->create($nombres, $apellidos, $tipodoc, $numdoc, $departamento, $ciudad);
            if($res){
                $message= "Datos insertados con éxito";
                $class="alert alert-success";
            }else{
                $message="No se pudieron insertar los datos";
                $class="alert alert-danger";
            }
            
            ?>
        <div class="<?php echo $class?>">
            <?php echo $message;?>
        </div>	
            <?php
        }

    ?>
    <div class="row">
        <form name="capturar_datos" method="post">
            <div class="form-group">
                <label for="name">Nombres</label>
                <input required name="nombres" type="text" class="form-control"  aria-describedby="nombreHelp" placeholder="Nombres...">
            </div>
            <div class="form-group">
                <label for="name">Apellidos</label>
                <input required name="apellidos" type="text" class="form-control"  aria-describedby="apellidoHelp" placeholder="Apellidos...">
            </div>
            <div class="form-group">
                <label for="documentoSelect">Tipo Documento</label>
                <select required class="form-control" name="documentoSelect">
                <option value="">Seleccione Tipo de Documento .:.</option>
                <option value="CC">Cédula de ciudadanía</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="CE">Cédula de extranjería</option>
                </select>
            </div>
            <div class="form-group">
                <label for="documento">Número de documento</label>
                <input required name="documento" type="text" class="form-control"  placeholder="# de documento...">
            </div>
            <div class="form-group">
                <label for="departamentoSelect">Departamento de Residencia</label>
                <select required class="form-control" name="departamentoSelect">
                <option value="">Seleccione Departamento .:.</option>
                <?php
                    $deptos=$estudiantes->readDepto();
                    while ($row=mysqli_fetch_object($deptos)){
                        $id=$row->id_departamento;
                        $departamento=$row->departamento;
                            echo "<option value=".$departamento.">".$departamento."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Ciudad de Residencia</label>
                <input required name="ciudad" type="text" class="form-control" aria-describedby="ciudadHelp" placeholder="Ciudad de Residencia...">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <hr>
        <h2>Estudiantes</h2>
        <div class="my-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombres y Apellidos</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $listado=$estudiantes->read();
                while ($row=mysqli_fetch_object($listado)){
                    $id=$row->id;
                    $nombres=$row->nombres." ".$row->apellidos;
                    $documento=$row->tipodoc." #".$row->numdoc;
                    $departamento=$row->departamento; 
                    $ciudad=$row->ciudad;
                        echo "<tr>";
                        echo "<td>" .$nombres."</td>";
                        echo "<td>" .$documento."</td>";
                        echo "<td>" .$departamento."</td>";
                        echo "<td>" .$ciudad."</td>";
                        echo "<td>"?>
                        <a href="update.php?id=<?php echo $id;?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <a href="delete.php?id=<?php echo $id;?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        <?php
                        echo "</td>";
                        echo "</tr>";
                    }?>
            </tbody>
            </table>
        </div>
    </div>
</body>
</html>