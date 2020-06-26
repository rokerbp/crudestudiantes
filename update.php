<?php
include 'conexion.php';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
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
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Actualizar</title>
</head>
<body>
    <div class="container my-5">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar <b>Estudiante</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-primary add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php
            $iddpto = 5;
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
                echo '<div class="'.$class.'">'.$message.'</div>';
            }
            $datos_estudiante=$estudiantes->single_record($id);
        ?>
        <div class="container col-md-8 custom-form">
            <div class="row  py-5">
                <div class="col-md-8 mx-auto">
                    <form method="post">
                        <div class="form-group">
                            
                                <label>Nombres:</label>
                                <input type="text" name="nombres" id="nombres" class='form-control' maxlength="100" required  value="<?php echo $datos_estudiante->nombres;?>">
                                <input type="hidden" name="id_estudiante" id="id_estudiante" class='form-control' maxlength="100"   value="<?php echo $datos_estudiante->id;?>">
                        </div>
                        <div class="form-group">
                                <label>Apellidos:</label>
                                <input type="text" name="apellidos" id="apellidos" class='form-control' maxlength="100" required value="<?php echo $datos_estudiante->apellidos;?>">
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="documentoSelect">Tipo Documento</label>
                                <select required id="tipoDoc" class="form-control" name="documentoSelect">
                                    <option value="">Seleccione .:.</option>
                                    <option value="CC">Cédula de ciudadanía</option>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="CE">Cédula de extranjería</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="documento">Número de documento</label>
                                <input required name="documento" type="text" class="form-control"  placeholder="# de documento..." value="<?php echo $datos_estudiante->numdoc;?>">
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="departamentoSelect">Departamento de Residencia</label>
                                <select id="depto" required class="form-control change" name="departamentoSelect">
                                <option value="">Seleccione .:.</option>
                                <?php
                                    $deptos=$estudiantes->readDepto();
                                    while ($row=mysqli_fetch_object($deptos)){
                                        $id=$row->id_departamento;
                                        $departamento=$row->departamento;
                                            echo '<option value="'.$departamento.'">'.$departamento.'</option>';
                                    }
                                ?>
                                </select>
                        </div>
                        <div class="form-group">
                                    <label for="ciudad">Ciudad de Residencia</label>
                                    <input required name="ciudad" type="text" class="form-control" maxlength="100" aria-describedby="ciudadHelp" placeholder="Ciudad ..." >
                        </div>
                        <!--
                        <div class="form-group">
                        <label for="departamentoSelect">Departamento de Residencia</label>
                            <select id="depto" required class="form-control" name="departamentoSelect">
                            <option value="">Seleccione .:.</option>
                            <?php
                                $idmpo = 5;
                                $mpos=$estudiantes->readMpo($idmpo);
                                while ($row=mysqli_fetch_object($mpos)){
                                    $municipio=$row->municipio;
                                    echo '<option value="'.$municipio.'">'.$municipio.'</option>';
                                }
                            ?>
                            </select>
                        </div>-->
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <a href="index.php" class="btn btn-secondary add-new"><i class="fa fa-arrow-left"></i> Cancelar</a>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-success"><i class="material-icons pull-left">upgrade</i> Actualizar Datos</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
<script>
    var tipo = '<?php echo $datos_estudiante->tipodoc ?>';
    var depto = '<?php echo $datos_estudiante->departamento ?>';
    $("select.change").change(function(){
        var selectedDepto = $(this).children("option:selected").val();
    });
    $('#tipoDoc option[value="'+ tipo +'"]').prop("selected", true);
    $('#depto option[value="'+ depto +'"]').prop("selected", true);
</script>
</body>
</html>