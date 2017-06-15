<?php
session_start();//session starts here
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Login</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;

</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>


                                <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>

<!-- <?php

include('php/funciones.php');

if(isset($_POST['login']))
{
    echo $_POST['login'];
    $usuario=$_POST['email'];
    $contrasena=$_POST['pass'];

    $consulta ="select count(*) as cantidad from departamento WHERE departamento_descri ='$usuario'AND id='$contrasena'";
    $matrizconsulta = consulta($consulta, $conexion);
    
    if($matrizconsulta[0]['cantidad'] > 0) {
        echo "<script>window.open('welcome.php','_self')</script>";

        $_SESSION['email']=$usuario;//here session is used and value of $user_email store in $_SESSION.

    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
?> -->