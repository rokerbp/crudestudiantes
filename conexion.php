<?php

class Database{
    private $con;
    private $dbhost="localhost";
    private $dbuser="root";
    private $dbpass="";
    private $dbname="CRUD";
    function __construct(){
        $this->connect_db();
    }
    public function connect_db(){
        $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if(mysqli_connect_error()){
            die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
        }
    }
    //Limpia las variables antes de registrarlas en la DB, evita inyecciones SQL
    public function sanitize($var){
    $return = mysqli_real_escape_string($this->con, $var);
    return $return;
    }

    public function create($nombres,$apellidos,$tipodoc,$numdoc,$departamento,$ciudad){
        $sql = "INSERT INTO `estudiantes` (nombres, apellidos, tipodoc, numdoc, departamento_id, ciudad) VALUES ('$nombres', '$apellidos', '$tipodoc', '$numdoc', '$departamento', '$ciudad')";
        $res = mysqli_query($this->con, $sql);
        if($res){
          return true;
        }else{
        return false;
     }
    }
    
    public function read(){
    $sql = "SELECT * FROM estudiantes INNER JOIN departamentos ON estudiantes.departamento_id = departamentos.id_departamento";
    $res = mysqli_query($this->con, $sql);
    return $res;
    }

    public function readDepto(){
    $sql = "SELECT * FROM departamentos";
    $res = mysqli_query($this->con, $sql);
    return $res;
    }

    public function readMpo($id){
        $sql = "SELECT municipio FROM municipios WHERE departamento_id='$id'";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }

    public function single_record($id){
        $sql = "SELECT * FROM estudiantes where id='$id'";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_object($res );
        return $return ;
    }
    public function update($nombres,$apellidos,$tipodoc,$numdoc,$departamento, $ciudad, $id){
        $sql = "UPDATE estudiantes SET nombres='$nombres', apellidos='$apellidos', tipodoc='$tipodoc', numdoc='$numdoc', departamento_id='$departamento', ciudad='$ciudad' WHERE id=$id";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $sql = "DELETE FROM estudiantes WHERE id=$id";
        $res = mysqli_query($this->con, $sql);
        if($res){
        return true;
        }else{
        return false;
        }
    }
}