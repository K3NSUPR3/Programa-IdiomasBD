<?php
 include 'Conexion_Be.php';

 if(isset($_POST['registro'])){
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $email=$_POST['mail'];  
    $contra=$_POST['password1'];
    $usuario=$_POST['usuario'];
    //hacer el insert de datos
    //forma anterior  $insertarDatos="INSERT INTO registroidiomas(Nombre,Apellido,Email,Contraseña,ID,Usuario,TipoUsuario) VALUES ('$nombre','$apellido','$email','$contra','','$usuario','alumno')";
    $insertarDatos = "INSERT INTO registroidiomas (Nombre, Apellido, Email, Contraseña, Usuario, TipoUsuario) VALUES ('$nombre', '$apellido', '$email', '$contra', '$usuario', 'alumno')";
    if (mysqli_query($enlace, $insertarDatos)) { 
        $userId = mysqli_insert_id($enlace); // Obtén el ID insertado 
        $_SESSION['ID'] = $userId; // Guarda el ID en la sesión 
       //Verificar que el correo no se repita en la bd
    }
   
    $verificar_correo = mysqli_query($enlace,"SELECT * FROM registroidiomas WHERE Email='$email' ");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script type="text/javascript">
                alert("Este correo ya esta registrado intenta con otro");
                window.location="Registrarse.php";
            </script>
        ';
        exit();
    }

    //No se repita usuario ingresado anteriormente
    $verificar_usuario = mysqli_query($enlace,"SELECT * FROM registroidiomas WHERE Usuario='$usuario'");
                // Mensaje de aviso y que regrese
    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script type="text/javascript">
                alert("Este usuario ya esta registrado intenta con otro");
                window.location="Registrarse.php";
            </script>
        ';
        exit();
    }

    $ejecutarInsertar = mysqli_query($enlace,$insertarDatos);

    if($ejecutarInsertar){
     echo '
     <script type="text/javascript">
        alert("Registrado con exito");
     </script>
     ';
     header("Location:Log-In.php");

    }else{
        echo '
        <script type="text/javascript">
           alert("Intentalo de nuevo");
        </script>
        ';
        header("Location:Registrarse.php");   

    }
    mysqli_close($enlace);

}
?>