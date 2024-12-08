<?php
//session_start();

if (!empty($_POST["botonIngresar"])) {
    if (!empty($_POST["Usuario"]) and !empty($_POST["password1"])) {
       $usuario=$_POST["Usuario"];
       $password=$_POST["password1"];
       $sql=$enlace->query("SELECT * FROM registroidiomas WHERE Usuario='$usuario' and Contraseña='$password'");
        if($datos=$sql->fetch_object()){  //Si el usuario existe
            $_SESSION["ID"]=$datos->ID;
            $_SESSION["Nombre"]=$datos->Nombre;
            $_SESSION["Apellido"]=$datos->Apellido;
            header("location:PRINCIPAL/index.php");
        }else{
            echo "<div class='alert alert-danger'>Acceso Denegado</div>";
        }

    } else {
       echo "<div class='alert alert-danger'>Los campos estan vacios</div>"; 
    }
}
?>