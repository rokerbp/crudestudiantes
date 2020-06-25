<?php 
// Si se desea hacer con get mediante un botón sin confirmación
/*if (isset($_GET['id'])){
	include('conexion.php');
	$estudiante = new Database();
	$id=intval($_GET['id']);
	$res = $estudiante->delete($id);
	if($res){
		header('location: index.php');
	}else{
		echo "Error al eliminar el registro";
	}
}*/
if (isset($_POST['id'])){
	include('conexion.php');
	$estudiante = new Database();
	$id=intval($_POST['id']);
	$res = $estudiante->delete($id);
	if($res){
		echo 1;
		exit;
	}else{
		echo 0;
		exit;
	}
}
?>