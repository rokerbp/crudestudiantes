<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Actualizar</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar <b>Estudiante</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php
                include 'conexion.php';
                $estudiantes= new Database();
                if(isset($_POST) && !empty($_POST)){
                    $nombres = $estudiantes->sanitize($_POST['nombres']);
                    $apellidos = $estudiantes->sanitize($_POST['apellidos']);
                    $tipodoc = $estudiantes->sanitize($_POST['documentoSelect']);
                    $numdoc = $estudiantes->sanitize($_POST['documento']);
                    $departamento = $estudiantes->sanitize($_POST['departamentoSelect']);
                    $ciudad = $estudiantes->sanitize($_POST['ciudad']);
                    $id=intval($_POST['id_estudiante']);
                    
                    $res = $estudiantes->update($nombres, $apellidos, $tipodoc, $numdoc, $departamento, $ciudad, $id);
                    if($res){
                        $message= "Datos actualizados con éxito";
                        $class="alert alert-success";
                    }else{
                        $message="No se pudieron actualizar los datos";
                        $class="alert alert-danger";
                    }
                    
                    ?>
                <div class="<?php echo $class?>">
                    <?php echo $message;?>
                </div>	
                    <?php
                }
                $datos_estudiante=$estudiantes->single_record($id);
            ?>
			<div class="row">
				<form method="post">
				<div class="col-md-6">
					<label>Nombres:</label>
					<input type="text" name="nombres" id="nombres" class='form-control' maxlength="100" required  value="<?php echo $datos_estudiante->nombres;?>">
					<input type="hidden" name="id_estudiante" id="id_estudiante" class='form-control' maxlength="100"   value="<?php echo $datos_estudiante->id;?>">
				</div>
				<div class="col-md-6">
					<label>Apellidos:</label>
					<input type="text" name="apellidos" id="apellidos" class='form-control' maxlength="100" required value="<?php echo $datos_estudiante->apellidos;?>">
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
                    <input required name="documento" type="text" class="form-control"  placeholder="# de documento..." value="<?php echo $datos_estudiante->numdoc;?>">
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
                    <input required name="ciudad" type="text" class="form-control" aria-describedby="ciudadHelp" placeholder="Ciudad de Residencia..." value="<?php echo $datos_estudiante->ciudad;?>">
                </div>
				
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
				</form>
			</div>
        </div>
    </div>     
</body>
</html>