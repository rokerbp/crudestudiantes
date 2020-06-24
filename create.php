<?php
    include ("conexion.php");
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