<?php
include '../ConexionSeq.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Calificaciones</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Admin" name="keywords">
    <meta content="administrador" name="description">

    <!-- Editar Registro -->
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
        
    <title>Editar Calificaciones</title>
    <style> .btn-group { display: flex; gap: 5px; }     
    </style>
 
    <!-- Favicon -->
    <link href="../img/favicon_io/favicon.ico" rel="icon">
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
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
    <?php  
    
    include '../ConexionSeq.php';
    
    //libreriras necesarias
    ?>
    <div class="container mt-5">
        <div title="TABLA">
        <h4 class="text-center text-secondary">Calificaciones</h4>
            <table class="table table-bordered table-hover col-12" id="example">
                <thead>
                    <tr>
                        <th scope="cot">Alumno</th>
                        <th scope="col">Unidad 1</th>
                        <th scope="col">Unidad 2</th>
                        <th scope="col">Unidad 3</th>
                        <th scope="col">Unidad 4</th>
                        <th scope="col">Unidad 5</th>
                        <th scope ="col">Promedio</th>
                        <th scope ="col">Grupo</th>
                    </tr>
                </thead>
            <tbody>
            <tbody> 
            <?php 
$sql = "SELECT NoControl, U1, U2, U3, U4, U5, Promedio, Grupo FROM calificacionesa"; 
$result = $enlace->query($sql); 

if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
        echo "<tr>";
        echo "<form action = 'updates/updateCalif.php' method = 'post'>";
        echo "<td style='color: #000000;'>" . htmlspecialchars($row["NoControl"]) . "</td>"; 
        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["U1"]) . "</td>";
        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["U2"]) . "</td>";
        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["U3"]) . "</td>";
        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["U4"]) . "</td>";
        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["U5"]) . "</td>";
        echo "<td style='color: #28a745;'>" . htmlspecialchars($row["Promedio"]) . "</td>"; 
        echo "<td style='color: #000000;'>" . htmlspecialchars($row["Grupo"]) . "</td>"; 
         echo "</form>";
        echo "</tr>"; 
    } 
} else { 
    echo "<tr><td colspan='8' style='text-align: center; color: #6c757d;'>No hay datos</td></tr>"; 
} 
$enlace->close();
?>
            </tbody>
      </tbody>
</table>
</div> 
            <!--Fin Modelo-->
    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="Califalumnos.php" class="navbar-brand">
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
                            <h5 class="text-white text-uppercase mb-4">Enlaces Rápidos</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="Califalumnos.php"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                                <a class="text-white-50" href="../contact.php"><i class="fa fa-angle-right mr-2"></i>Contactanos</a>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Nuestros servicios</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Francés</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Alemán</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inglés</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ruso</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Novedades</h5>
                            <div class="w-100">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="radio" class="btn btn-primary px-4">Bienvenido Profesor</input>
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

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script> 
        function advertencia(){
            var notif=confirm("Estas seguro que desea eliminar?");
            return notif;
        }
    </script>

    
    <script>
            function abrirModalEditarCalif(NoControl,U1,U2,U3,U4,U5,Promedio) {
                document.getElementById('editClaveCalif').value = NoControl;
                document.getElementById('editU1').value = U1;
                document.getElementById('editU2').value = U2;
                document.getElementById('editU3').value = U3;
                document.getElementById('editU4').value =  U4;
                document.getElementById('editU5').value =  U5;
                document.getElementById('editProm').value = Promedio;
                $('#editModalCalif').modal('show');
}
</script>

</body>

</html>