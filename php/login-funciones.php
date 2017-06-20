<?php
//session_start();//session starts here


include('php/funciones.php');

function login(){
if(isset($_POST['ingreso']))
{
    
    $usuario=$_POST['usuario'];
    $contrasena=$_POST['pass'];

    $consulta ="SELECT count(*) as cantidad, nombre_usuario, pass, perfil_nombre FROM usuarios INNER JOIN perfiles ON id_perfil=rela_perfil WHERE nombre_usuario ='".$usuario."' AND pass='".$contraseña."';";

    $matrizconsulta = consulta($consulta);
    
    if($matrizconsulta[0]['cantidad'] > 0) {
        echo "<script>window.open('welcome.php','_self')</script>";

        $_SESSION['email']=$usuario;//here session is used and value of $user_email store in $_SESSION.

    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
}
    
?>
