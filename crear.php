<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

</head>
<body>
    <div class="container py-5">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Crear <b>Estudiante</b></h2></div>
                    <div class="col-sm-4 ">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Launch demo modal
                    </button>
                </div>
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
        <div class="row py-5">
            <div class="col-md-10 mx-auto">
                <form method="post">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Nombres:</label>
                            <input type="text" name="nombres" id="nombres" class='form-control' maxlength="100" required placeholder="Nombres..." >
                        </div>
                        <div class="col-sm-6">
                            <label>Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos" class='form-control' maxlength="100" required placeholder="Apellidos...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="documentoSelect">Tipo Documento</label>
                            <select required class="form-control" name="documentoSelect">
                                <option value="">Seleccione Tipo de Documento .:.</option>
                                <option value="CC">Cédula de ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de extranjería</option>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="documento">Número de documento</label>
                            <input required name="documento" type="text" class="form-control"  placeholder="# de documento..." >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                            <label for="name">Ciudad de Residencia</label>
                            <input required name="ciudad" type="text" class="form-control" aria-describedby="ciudadHelp" placeholder="Ciudad de Residencia..." >
                        </div>
                    </div>
                    
                    <div class="col-md-12 pull-right">
                    <hr>
                        <button type="submit" class="btn btn-success">Actualizar datos</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal-->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <form method="post">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label>Nombres:</label>
                                    <input type="text" name="nombres" id="nombres" class='form-control' maxlength="100" required placeholder="Nombres..." >
                                </div>
                                <div class="col-sm-6">
                                    <label>Apellidos:</label>
                                    <input type="text" name="apellidos" id="apellidos" class='form-control' maxlength="100" required placeholder="Apellidos...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label for="documentoSelect">Tipo Documento</label>
                                    <select required class="form-control" name="documentoSelect">
                                        <option value="">Seleccione Tipo de Documento .:.</option>
                                        <option value="CC">Cédula de ciudadanía</option>
                                        <option value="TI">Tarjeta de Identidad</option>
                                        <option value="CE">Cédula de extranjería</option>
                                    </select>
                                </div>
                                <div class="col-sm-7">
                                    <label for="documento">Número de documento</label>
                                    <input required name="documento" type="text" class="form-control"  placeholder="# de documento..." >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                    <label for="name">Ciudad de Residencia</label>
                                    <input required name="ciudad" type="text" class="form-control" aria-describedby="ciudadHelp" placeholder="Ciudad de Residencia..." >
                                </div>
                            </div>
                            
                            <div class="col-md-12 pull-right">
                            <hr>
                                <button type="submit" class="btn btn-success">Actualizar datos</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- end modal-->
    </div>    
</body>
</html>