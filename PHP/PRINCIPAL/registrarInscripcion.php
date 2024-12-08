<?php
include 'ConexionSeq.php';

if(isset($_POST['botonInsc'])){
   $nombre=$_POST['nombre'];
   $email=$_POST['mail'];  
   $fecha=$_POST['fecha'];
   $horario=$_POST['horario'];
   $idioma=$_POST['SIdioma'];
   $Plan=$_POST['SPlan'];
   //hacer el insert de datos
   $insertarDatos="INSERT INTO inscripciones(Nombre,Correo,Fecha,Horario,Idioma,Plan) 
   VALUES ('$nombre','$email','$fecha','$horario','$idioma','$Plan')";
   
   
   //Verificar que el correo no se repita en la bd
  

   $verificar_correo = mysqli_query($enlace,"SELECT * FROM inscripciones WHERE Correo='$email' ");

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
   $verificar_usuario = mysqli_query($enlace,"SELECT * FROM inscripciones WHERE Nombre='$nombre'");
               // Mensaje de aviso y que regrese
   if(mysqli_num_rows($verificar_usuario) > 0){
       echo '
           <script type="text/javascript">
               alert("Nombre registrado intenta con otro");
               window.location="Registrarse.php";
           </script>
       ';
       exit();
   }

   $ejecutarInsertar = mysqli_query($enlace,$insertarDatos);

   if($ejecutarInsertar){
    echo '
    <script type="text/javascript">
       alert("Inscrito con exito");
    </script>
    ';
    header("location:service.php");

   }else{
       echo '
       <script type="text/javascript">
          alert("Intentalo de nuevo");
       </script>
       ';
       header("Location:service.php");   

   }
   mysqli_close($enlace);
}

?>