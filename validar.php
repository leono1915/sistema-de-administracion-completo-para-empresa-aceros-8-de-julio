<?php

include 'conecta.php';
$usuario=$_POST['usuario'];
$pass=$_POST['password'];
$sql=$dbConexion->query("select * from usuarios where usuario='$usuario' and password='$pass' ;");
if($sql->num_rows==0){
    die("credenciales invalidas");
    
}
session_start();
$_SESSION['usuario']=$usuario;
header("Location:cotizador.php");

?>