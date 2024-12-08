<?php
//incluir la libreria para usar la conexion
include 'Conexion_Be.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">

    <!-- Estilos -->
     
    <link rel="stylesheet" href="../CSS/css-Registro.css">

    <title>Formulario Login y Registro de Usuarios</title>
</head>
<body>

   <!-- Formularios -->
    <div class="contenedor-formularios">
        <!-- Links de los formularios -->
        <ul class="contenedor-tabs">
            <li class="tab tab-segunda">
                <a href="Log-In.php">Iniciar Sesión</a></li>
<!-- verificacion -->
            <li class="tab tab-primera active">
                <a href="#">Registrarse</a></li>
        </ul>

        <!-- Contenido de los Formularios -->
            <div id="registrarse">
                <h1>Registrarse</h1>
                
                <form method="POST" action="registrarUser.php"  onsubmit="return validatePasswords()">  
                <!--aqui se quito action= 'Usuario.php' para usar Advertenciaphp-->
<!--ver que se puede añadir a el metodo action-->
                    <div class="fila-arriba">
                        <div class="contenedor-input">
                            <label>
                                 <span class="label-span req">Nombre*</span>
                            </label>
                            <input type="text" id="nombre" oninput="moveLabelUp(this)" name="nombre" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo letras y espacios" required>
                        </div>
                        
                        <div class="contenedor-input">
                            <label>
                                <span class="label-span ">Apellido*</span>
                            </label>
                            <input type="text" oninput="moveLabelUp(this)" name="apellido" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo letras y espacios" required>
                        </div>
                    </div>
                    
                    <div class="contenedor-input">
                        <label>
                            <span class="label-span req">No.Control*</span>
                        </label>
                        <input type="text" oninput="moveLabelUp(this)" name="usuario" required>
                    </div>
                    
                    <div class="contenedor-input">
                            <label>
                                <span class="label-span req">Email*</span>
                            </label>
                        <input type="email" oninput="moveLabelUp(this)"  name="mail" required>
                    </div>

                    <div class="contenedor-input">
                        <label for="password1">
                             <span class="label-span req">Contraseña*</span>
                        </label>
                        <input type="password" minlength="8" oninput="moveLabelUp(this)" id="password1" name="password1" required>
                    </div>

                    <div class="contenedor-input">
                        <label for="password2">
                            <span class="label-span req">Repetir*</span>
                        </label>
                        <input type="password" minlength="8" id="password2" name="password2" oninput="moveLabelUp(this)" required>
                    </div>

                    <input type="submit" class="button button-block" value="Registrarse" name="registro">
                </form>
            </div>
        </div>
        <footer >
            <script src="../JS/ExcepcionesLogin.js"></script>
            <script src="../JS/DesplazarArriba.js"></script>
            <script> function validatePasswords() { var password1 = document.getElementById("password1").value; var password2 = document.getElementById("password2").value; if (password1 !== password2) { alert("Passwords no coinciden "); return false; } return true; } </script>
        </footer>
</body>
<!--Se podria poner aqui-->
<?php 

?>
