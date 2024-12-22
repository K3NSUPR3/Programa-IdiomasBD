<?php
include '../ConexionSeq.php';

session_start(); // Comunicación entre Log In de PHP

// En caso de que guste Entrar
if (!isset($_SESSION['Usuario']) || empty($_SESSION['Usuario'])) { // pf
    echo '
    <script type="text/javascript">
        alert("Debes iniciar sesión");
        window.location ="../../Log-InU.php";
    </script>
    ';
    session_destroy();
    die();
  }else {  //este primer if
   

        // Configuración de la conexión 
        $enlace = new mysqli("localhost:3307", "root", "", "idiomas"); 
        // Verificar la conexión 
        if ($enlace->connect_error) { //sf
            die("Conexión fallida: " . $enlace->connect_error); 
        }//sf

        $usuario = $_SESSION['Usuario'];

        // Consulta para obtener el tipo de usuario
        $stmt = $enlace->prepare("SELECT TipoUsuario FROM registroidiomas WHERE Usuario=?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $tipoUsuario = $row['TipoUsuario'];

        if ($tipoUsuario != 'administrador') {
            echo '
            <script>
                alert("No tienes permisos de administrador.");
                window.location = "../../Log-InU.php";
            </script>
            ';
            session_destroy();
            die();
        }
    } else {
        echo '
        <script>
            alert("Usuario no encontrado en la base de datos.");
            window.location = "../../Log-InU.php";
        </script>
        ';
        session_destroy();
        die();
    }
}//else del pf
   ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>ADMIN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Admin" name="keywords">
    <meta content="administrador" name="description">

    <!-- Editar Registro -->
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <title>Editar Registros</title>
    <style> .btn-group { display: flex; gap: 5px; }     
    </style>
 
    <!-- Favicon -->
    <link href="../img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="..//apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="..//favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="..//favicon-16x16.png">
        <link rel="manifest" href="..//site.webmanifest">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="../https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62d309d756.js" crossorigin="anonymous"></script>

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- Aquí van los estilos CSS -->
    <style>
    .table-container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Poppins', sans-serif;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    th, td {
        transition: all 0.3s ease;
    }

    th:hover, td:hover {
        background-color: #e2e2e2;
        cursor: pointer;
    }
</style>

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small><i class="fa fa-phone-alt mr-2"></i>+52 443 612 3498</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>PolyGlob@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-primary px-2" href="https://www.facebook.com/CLEMoreliaOficial">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-primary px-2" href="https://twitter.com/PolyGlob">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-primary px-2" href="https://instagram.com/PolyGlob">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-primary pl-2" href="https://youtube.com/PolyGlobChannel">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
        <!-- Topbar End -->
        <a href="../Cerrar_Sesion.php" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: red; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;">Cerrar Sesión </a>
    <?php
    include '../ConexionSeq.php';  
    include "../CE/ControlEliminarIns.php";
    //libreriras necesarias XD
    ?>
    <a href="testimonial.php" class="btn btn-primary btn rounded mb-3">Registros</a>
    <a href="testimonialMaes.php" class="btn btn-primary btn rounded mb-3">Maestros</a>
    <a href="testimonialCur.php" class="btn btn-primary btn rounded mb-3">Cursos</a>
    
<!--Inicio Inscripciones-->
<div class="container mt-5">
        <div title="TABLA">
        <h4 class="text-center text-secondary">Inscripciones</h4>
            <table class="table table-bordered table-hover col-12" id="example" id="TablaR">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo Eléctronico</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Idioma</th>
                        <th scope="col">Plan</th>
                        <th scope="col">ID</th>
                    </tr>
                </thead>
            <tbody>
            <tbody> 
            <?php 

                    if ($enlace instanceof mysqli) {
                        echo "Conexión está abierta y lista.";
                    } else {
                        echo "Error: Conexión fallida.";
                    }


                    if ($enlace->connect_errno) {
                        echo "Error de conexión a la base de datos: " . $enlace->connect_error;
                        exit();
                    }
                    


                if ($enlace instanceof mysqli) {
                 $sql = "SELECT Nombre,Correo,Fecha,Horario,Idioma,Plan,Id_Insc FROM inscripciones";
                    
                } else {
                    echo "Error: Conexión fallida";
                }


                include '../ConexionSeq.php';
               // session_start();

                if ($enlace instanceof mysqli) {
                    $sql = "SELECT Nombre,Correo,Fecha,Horario,Idioma,Plan,Id_Insc FROM inscripciones";
                    if ($result = $enlace->query($sql)) {
                        // Procesar los resultados aquí
                    } else {
                        echo "Error en la consulta: " . $enlace->error;
                    }
                } else {
                    echo "Error: Conexión fallida";
                }



            

        if ($result === false) { die("Error en la consulta: " . $enlace->error); }

                if ($result->num_rows > 0) { 
                    while($row = $result->fetch_assoc()) { 
                        echo "<tr>";
                        echo "<form action = '../updates/updateIns.php' method = 'POST'>";
                        echo "<td style='color: #007bff; font-weight: bold;'>" . htmlspecialchars($row["Nombre"]) . "</td>"; 
                        echo "<td style='color: #6c757d;'>" . htmlspecialchars($row["Correo"]) . "</td>"; 
                        echo "<td style='color: #17a2b8;'>" . htmlspecialchars($row["Fecha"]) . "</td>"; 
                        echo "<td style='color: #dc3545;'>" . htmlspecialchars($row["Horario"]) . "</td>"; 
                        echo "<td style='color: #ffc107;'>" . htmlspecialchars($row["Idioma"]) . "</td>"; 
                        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["Plan"]) . "</td>";
                        echo "<td style='color: #ffc107;'>" . htmlspecialchars($row["Id_Insc"]) . "</td>"; 
                        echo "<td class='btn-group'>
                         <a href='testimonialIns.php?id=" . htmlspecialchars($row["Id_Insc"]) . "' 
                            class='btn btn-danger btn-sm' 
                            title='Eliminar' 
                            onclick='return advertencia()'>
                            <i class='fa-solid fa-trash'></i>
                            </a> 
                        </td>";
                        echo "</form>";
                        echo "</tr>"; 
                    } // aqui arriba hay que tener cuidado de que relizamos en los href
                } else { 
                    echo "<tr><td colspan='7' style='text-align: center; color: #6c757d;'>No hay datos</td></tr>"; 
                } 
            ?>
            </tbody>
      </tbody>
</table>
<!--End Inscripcion-->

            <!--Modelo Ins-->
<!-- Model -->
<div class="modal" tabindex="-1" id="editUserModalIns">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Incripción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editInsForm" action="../updates/updateIns.php" method="post">
          <input type="hidden" name="ID" id="IdnombreIns">
          <div class="form-group">
            <label for="editNombreIns">Nombre:</label>
            <input type="text" class="form-control" name="Nombre" id="editNombreIns">
          </div>
          <div class="form-group">
            <label for="editCorreoIns">Correo Eléctronico:</label>
            <input type="email" class="form-control" name="Correo" id="editCorreoIns">
          </div>
          <div class="form-group">
            <label for="editFechaIns">Fecha</label>
            <input type="date" class="form-control" name="Fecha" id="editFechaIns">
          </div>
          <div class="form-group">
            <label for="editHorarioIns">Horario:</label>
            <input type="text" class="form-control" name="Horario" id="editHorarioIns">
          </div>
          <div class="form-group">
            <label for="editIdiomaIns">Idioma:</label>
            <input type="text" class="form-control" name="Idioma" id="editIdiomaIns">
          </div>
          <div class="form-group">
            <label for="editPlan">Plan:</label>
            <input type="text" class="form-control" name="Plan" id="editPlan">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('editInsForm').submit();">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
            <!--End modelo Insc-->

    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="../index.php" class="navbar-brand">
                        <h1 class="mb-3 text-white"><span class="text-primary">Poly</span> Glob</h1>
                    </a>
                    <p>Con nostros aprenderas por que aprenderas si o que.</p>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>65 Av Tecnologico, Morelia, MX</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+52 4436123498</p>
                    <p><i class="fa fa-envelope mr-2"></i>PolyGlob@gmail.com</p>
                    <div class="d-flex justify-content-start mt-4">
                    </div>
                </div>
                <div class="col-lg-6 pl-lg-5">
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Nuestros servicios</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Francés</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Aleman</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inglés</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ruso</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2">Italiano</i></a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Novedades</h5>
                            <div class="w-100">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="radio" class="btn btn-primary px-4">Bienvenido Administrador</input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top py-4" style="border-color: rgba(256, 256, 256, .15) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0 text-white">&copy; <a href="#">Poly Glob</a>. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0 text-white">Designed by Ken, Jose and René</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    

            <!--querys-->
            <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/jquery-latest.min.js"></script>





    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script> 
        function advertencia(){
            var notif=confirm("Estas seguro que desea eliminar?");
            return notif;
        }
    </script>
<!--Ventana Insscripcion-->
    <script type="text/javascript">
            function abrirModalEditarIns(nombre, email, fecha, horario, idioma, plan,id) {
                document.getElementById('IdNombreIns').value = nombre;
                document.getElementById('editCorreoIns').value = email;
                document.getElementById('editFechaIns').value = fecha;
                document.getElementById('editHorarioIns').value = horario;
                document.getElementById('editIdiomaIns').value=idioma
                document.getElementById('editPlan').value = plan;
                document.getElementById('IdnombreIns').value = id;
                $('#editUserModalIns').modal('show');
     }
    </script>



</body>

</html>

