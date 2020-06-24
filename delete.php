<?php 
if (isset($_GET['id'])){
	include('conexion.php');
	$estudiante = new Database();
	$id=intval($_GET['id']);
	$res = $estudiante->delete($id);
	if($res){
		header('location: index.php');
	}else{
		echo "Error al eliminar el registro";
	}
}
?>