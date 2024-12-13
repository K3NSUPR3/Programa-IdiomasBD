<?php
include 'ConexionSeq.php';
session_start(); // Comunicación entre Log In de PHP

// En caso de que guste Entrar
if (!isset($_SESSION['Usuario']) || empty($_SESSION['Usuario'])) {
    echo '
    <script type="text/javascript">
        alert("Debes iniciar sesión");
        window.location ="../Log-InU.php";
    </script>
    ';
    session_destroy();
    die();
} else {
    // Conexión a la base de datos
    $enlace = new mysqli("localhost:3307", "root", "", "idiomas");

    if ($enlace->connect_error) {
        die("Conexión fallida: " . $enlace->connect_error);
    }

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
                window.location = "../Log-InU.php";
            </script>
            ';
            session_destroy();
            die();
        }
    } else {
        echo '
        <script>
            alert("Usuario no encontrado en la base de datos.");
            window.location = "../Log-InU.php";
        </script>
        ';
        session_destroy();
        die();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">

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
    <title>Editar Profesor</title>
    <style>
        .btn-group {
            display: flex;
            gap: 5px;
        }

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

        th,
        td {
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

        th,
        td {
            transition: all 0.3s ease;
        }

        th:hover,
        td:hover {
            background-color: #e2e2e2;
            cursor: pointer;
        }
    </style>

    <!-- Favicon -->
    <link href="img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62d309d756.js" crossorigin="anonymous"></script>

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
    <a href="Cerrar_Sesion.php" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: red; text-decoration: none; border-radius: 5px; transition: background-color 0.3s;">Cerrar Sesión</a>
    <?php
    include 'ConexionSeq.php';
    include "ControlEliminarMaes.php";
    // Librerías necesarias XD
    ?>
    <a href="AñadirProfesor.php" class="btn btn-primary btn rounded mb-3"><i class="fa-solid fa-plus"></i> &nbsp;Añadir</a>
    <a href="testimonial.php" class="btn btn-primary btn rounded mb-3">Registros</a>
    <a href="testimonialIns.php" class="btn btn-primary btn rounded mb-3">Inscripciones</a>
    <a href="testimonialCur.php" class="btn btn-primary btn rounded mb-3">Cursos</a>

    <!--Inicio Inscripciones-->
    <div class="container mt-5">
        <div title="TABLA">
            <h4 class="text-center text-secondary">Profesores</h4>
            <table class="table table-bordered table-hover col-12" id="example" id="TablaR">
                <thead>
                    <tr>
                        <th scope="col">NoControl</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Sueldo</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col">Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $enlace = new mysqli("localhost:3307", "root", "", "idiomas");

                    if ($enlace->connect_error) {
                        die("Conexión fallida: " . $enlace->connect_error);
                    }

                    $sql = "SELECT NoControl, Nombre, Apellidos, Contraseña, Correo, Sueldo, FechaIn, Telefono FROM profesor";
                    $stmt = $enlace->prepare($sql);

                    if (!$stmt) {
                        die("Error en la preparación de la consulta: " . $enlace->error);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<form action='updates/updateProf.php' method='POST'>";
                            echo "<td style='color: #007bff; font-weight: bold;'>" . htmlspecialchars($row["NoControl"]) . "</td>";
                            echo "<td style='color: #6c757d;'>" . htmlspecialchars($row["Nombre"]) . "</td>";
                            echo "<td style='color: #17a2b8;'>" . htmlspecialchars($row["Apellidos"]) . "</td>";
                            echo "<td style='color: #dc3545;'>" . htmlspecialchars($row["Contraseña"]) . "</td>";
                            echo "<td style='color: #ffc107;'>" . htmlspecialchars($row["Correo"]) . "</td>";
                            echo "<td style='color: #28a745;'>" . htmlspecialchars($row["Sueldo"]) . "</td>";
                            echo "<td style='color: #28a745;'>" . htmlspecialchars($row["FechaIn"]) . "</td>";
                            echo "<td style='color: #28a745;'>" . htmlspecialchars($row["Telefono"]) . "</td>";
                            echo "<td class='btn-group'>
                                <button type='button' class='btn btn-warning btn-sm' onclick=\"abrirModalEditarProfesor('" . htmlspecialchars($row["NoControl"]) . "','" . htmlspecialchars($row["Nombre"]) . "', '" . htmlspecialchars($row["Apellidos"]) . "', '" . htmlspecialchars($row["Contraseña"]) . "', '" . htmlspecialchars($row["Correo"]) . "','" . htmlspecialchars($row["Sueldo"]) . "','" . htmlspecialchars($row["FechaIn"]) . "', '" . htmlspecialchars($row["Telefono"]) . "')\"><i class='fa-solid fa-pen-to-square'></i></button>
                                <a href='testimonialMaes.php?id=" . htmlspecialchars($row["NoControl"]) . "' class='btn btn-danger btn-sm' title='Eliminar' onclick='return advertencia()'><i class='fa-solid fa-trash'></i></a>
                            </td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align: center; color: #6c757d;'>No hay datos</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--End Inscripcion-->
</body>
</html>

<<div class="modal" tabindex="-1" id="editProfesorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Profesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editProfesorForm" action="updates/updateProf.php" method="post">
          <div class="form-group">
            <label for="editProfesorID">Numero de Control:</label>
            <input type="hidden" name="NoControl" id="editProfesorID">
          </div>
          <div class="form-group">
            <label for="editProfesorNombre">Nombre:</label>
            <input type="text" class="form-control" name="Nombre" id="editProfesorNombre" required>
          </div>
          <div class="form-group">
            <label for="editProfesorApellidos">Apellidos:</label>
            <input type="text" class="form-control" name="Apellidos" id="editProfesorApellidos" required>
          </div>
          <div class="form-group">
            <label for="editProfesorContraseña">Contraseña:</label>
            <input type="password" class="form-control" name="Contraseña" id="editProfesorContraseña" required>
          </div>
          <div class="form-group">
            <label for="editProfesorEmail">Correo Electrónico:</label>
            <input type="email" class="form-control" name="Correo" id="editProfesorEmail" required>
          </div>
          <div class="form-group">
            <label for="editProfesorSueldo">Sueldo:</label>
            <input type="number" class="form-control" name="Sueldo" id="editProfesorSueldo" required>
          </div>
          <div class="form-group">
            <label for="editProfesorFecha">Fecha:</label>
            <input type="date" class="form-control" name="FechaIn" id="editProfesorFecha" required>
          </div>
          <div class="form-group">
            <label for="editProfesorTel">Telefono:</label>
            <input type="text" class="form-control" name="Telefono" id="editProfesorTel" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="submitEditProfesorForm()">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Función para enviar el formulario de edición del profesor
  function submitEditProfesorForm() {
    var form = document.getElementById('editProfesorForm');
    if (form.checkValidity()) {
      form.submit(); // Enviar el formulario si está todo validado
    } else {
      alert('Por favor, complete todos los campos requeridos.');
    }
  }

            <!--End modelo mAES-->

    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="index.php" class="navbar-brand">
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
<scrip src="mail/contact.js"></scrip>

<!-- Querys -->
<scrip src="https://code.jquery.com/jquery-3.6.0.min.js"></scrip>

<!-- Template Javascript -->
<scrip src="js/main.js"></scrip>


    function advertencia() {
        var notif = confirm("¿Estás seguro que deseas eliminar?");
        return notif;
    }
    </script>
    <script>
       function abrirModalEditarProfesor(id, nombre, apellidos, contraseña, email, sueldo, fecha, telefono) {
        document.getElementById('editProfesorID').value = id;
        document.getElementById('editProfesorNombre').value = nombre;
        document.getElementById('editProfesorApellidos').value = apellidos;
        document.getElementById('editProfesorContraseña').value = contraseña;
        document.getElementById('editProfesorEmail').value = email;
        document.getElementById('editProfesorSueldo').value = sueldo;
        document.getElementById('editProfesorFecha').value = fecha;
        document.getElementById('editProfesorTel').value = telefono;

        // Mostrar el modal
        $('#editProfesorModal').modal('show');
    }

    </script>
  




</body>

</html>

