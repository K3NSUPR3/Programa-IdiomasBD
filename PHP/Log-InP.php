<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">

    <!-- Estilos -->
    <link rel="stylesheet" href="../CSS/ProcesoLogin.css">
    <link rel="stylesheet" href="../CSS/EstiloLogIn.scss">
 
    <!--favicon-->
    <link href="PRINCIPAL/img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">


    <title>Formulario Login y Registro de Usuarios</title>

    <style> .custom-tabs { list-style-type: none; /* Eliminar viñetas */ padding: 0; /* Eliminar padding */ margin: 0; /* Eliminar margin */ display: flex; /* Hacer que los elementos estén en línea */ } .custom-tab { margin-right: 10px; /* Espacio entre los elementos */ padding: 5px 10px; /* Tamaño del padding para hacerlos más pequeños */ background-color: #ccc; /* Color de fondo */ border-radius: 5px; /* Bordes redondeados */ } .custom-tab a { text-decoration: none; /* Sin subrayado */ color: #000; /* Color del texto */ } .custom-tab-segunda.active { background-color: #666; /* Color de fondo para el activo */ color: #fff; /* Color del texto para el activo */ } </style>
</head>
<body>
  <!-- Formularios -->
  <div class="contenedor-formularios">
        <!-- Links de los formularios -->
         <img src="../SRC/IMG/lenguas.png" />
        <ul class="contenedor-tabs">
            <li class="tab tab-segunda active"><a href="#">Iniciar Sesión</a></li>
            <li class="tab tab-primera"><a href="Registrarse.php">Registrarse</a></li>
        </ul>
        <ul class="custom-tabs">
            <ul class="custom-tabs">
    <li class="custom-tab custom-tab-primera">
        <a href="Log-In.php" id="administrador">Alumno</a>
    </li>
    <li class="custom-tab custom-tab-primera">
        <a href="Log-InU.php" id="administrador">Administrador</a>
    </li>
    <li class="custom-tab custom-tab-segunda active">
        <p>Profesor</p>
    </li>
</ul>

  </ul>

        <!-- Contenido de los Formularios -->
            <!-- Iniciar Sesion -->
            <div id="iniciar-sesion">
                <h1>Iniciar Sesión</h1>
                <!-- Contenido action se cambio -->
                <form method="POST" action="UsuarioP.php">
                   <!-- Añadido -->
                    <div class="contenedor-input">
                        <label>
                             <span class="label-span req">Usuario</span>
                        </label>
                        <input type="text" name="Usuario" oninput="moveLabelUp(this)" required>
                    </div>
                    <div class="contenedor-input">
                        <label>
                             <span class="label-span req">Contraseña</span>
                        </label>
                        <input type="password" minlength="8" name="password1" oninput="moveLabelUp(this)" required>
                    </div>
                    <p class="forgot"><a href="CorreoPerdido.php">Olvidó la contraseña?</a></p>
                    <!-- Enviar consulta1 -->
                    <input type="submit" class="button button-block" name="botonIngresar" value="Iniciar Sesión">
                </form>
            </div>
    </div>
    
    <footer>
        <script src="../JS/ExcepcionesLogin.js"></script>
        <script src="../JS/DesplazarArriba.js"></script>
    </footer>
</body>
</html>


