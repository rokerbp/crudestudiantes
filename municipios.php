<?php
include "Conexion.php";
$id = $_GET['depto_id'];
$municipios= new Database();
$munic=$municipios->readMpo($id);
print "<option value=''>-- SELECCIONE --</option>";
while ($row=mysqli_fetch_object($munic)){
    $municipio=$row->municipio;
    echo $municipio;
    print "<option value='$municipio'>$municipio</option>";
}
?>