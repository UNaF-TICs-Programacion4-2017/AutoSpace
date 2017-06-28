<?php
include('php/funciones.php');



function login(){
if(isset($_POST['ingreso']))
{
    
    $usuario=$_POST['usuario'];
    $pass=$_POST['pass'];

    $consulta ="SELECT count(*) as cantidad, nombre_usuario, pass, perfil_nombre FROM usuarios INNER JOIN perfiles ON id_perfil=rela_perfil WHERE nombre_usuario ='".$usuario."' AND pass='".$pass."';";

    $matrizconsulta = consulta($consulta);
    
    if($matrizconsulta[0]['cantidad'] > 0) {
        echo "<script>alert('Bienvenido');</script>";
        $perfil = $matrizconsulta[0]['perfil_nombre'];
        guardar_usuario($perfil);
    }
    else
    {
        echo "<script>alert('Usuario o contraseña incorrectos')</script>";
    }
}
}


function validar(){
if(isset($_POST['ingreso']))
{
    $resultado=null;
    $usuario=$_POST['usuario'];
    
    $consulta ="SELECT count(*) as cantidad, nombre_usuario FROM usuarios INNER JOIN perfiles ON id_perfil=rela_perfil WHERE nombre_usuario ='".$usuario."';";

        $matrizconsulta = consulta($consulta);
    
    if($matrizconsulta[0]['cantidad'] > 0) {
        echo "<script>alert('Usuario Existente')</script>";   
    }
    else
    {
        $resultado=1;
    }
}

    
?>
