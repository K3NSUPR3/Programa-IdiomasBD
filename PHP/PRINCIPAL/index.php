<?php
//iniciar
include 'ConexionSeq.php';

session_start(); //comunicacion entre Log In de PHP

//En caso de que guste Entrar
if (!isset($_SESSION['Usuario'])||empty($_SESSION['Usuario'])){
    echo '
    <script type="text/javascript">
        alert("Debes iniciar sesión");
        window.location ="../Log-In.php"; 
    </script>
    ';// Corregirlo aquí
    session_destroy();
    die();
}


$sql = "SELECT Nombre, Apellido FROM registroidiomas"; 
$result = $enlace->query($sql); 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IDIOMAS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Jose Ken Rene" name="descripcion">

    <!-- Favicon -->
    <link href="img/favicon_io/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

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
     
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-primary"><span class="text-dark">Poly</span>Glob</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="#" class="nav-item nav-link active">INICIO</a>
                    <a href="about.php" class="nav-item nav-link">Acerca de</a>
                    <a href="service.php" class="nav-item nav-link">Servicios</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown">Paginas</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="appointment.php" class="dropdown-item">Quejas y Sugerencias</a>
                            <a href="opening.php" class="dropdown-item">Disponibilidad</a>
                        </div>
                    </div>
                </div>
                <a href="https://www.google.com/search?sca_esv=dc77d35e499118ec&tbm=shop&q=libros+de+idiomas&tbs=mr:1,pdtr0:955598%7C955613&sa=X&ved=0ahUKEwiOv_PV5faJAxWxL9AFHU3KG84QsysIuAcoAQ&biw=1043&bih=995&dpr=0.99" class="btn btn-primary d-none d-lg-block">Libro</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
     
    <!-- Bootstrap Menu Deslizante-->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; height: 100vh; overflow-y: auto;">
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Menu</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="service.php" class="nav-link active" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Inscripciones
            </a>
        </li>
        <li>
            <a href="price.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Cursos
            </a>
        </li>
        <li>
            <a href="ModifDatos.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Modificar 
            </a>
        </li>
        <li>
            <a href="opening.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Horario
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Boleta
            </a>
        </li>
        <li>
            <a href="http://cleitmorelia.mx/convocatorias" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Convocatorias
            </a>
        </li>
        <li>
            <!--Convertirlo a boton-->
            <a href="Cerrar_Sesion.php" class="nav-link text-white">
                Cerrar Sesión
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="img/ImagenPerfil.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>
                <?php
                $userId = $_SESSION['']; // Ajusta esto según cómo estés almacenando el ID del usuario 
                // Realiza la consulta a la base de datos 
                $sql = "SELECT Nombre, Apellido FROM registroidiomas WHERE ID = ?"; 
                $stmt = $enlace->prepare($sql);
                $stmt->bind_param("i", $userId); 
                $stmt->execute(); $result = $stmt->get_result(); 
                if ($result->num_rows > 0) 
                { $row = $result->fetch_assoc();
                     echo "<p style='color: #6c757d;'>" . htmlspecialchars($row["Nombre"]) . " " . htmlspecialchars($row["Apellido"]) . "</p>"; 
                    } else { echo "<p style='color: #6c757d;'>No se encontraron resultados</p>"; 
                    }
                ?>
            </strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Nuevo Proyecto</a></li>
            <li><a class="dropdown-item" href="#">Ajustes</a></li>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <!--verificar aqui-->
            <li><a class="dropdown-item" href="../Log-In.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>

     <!-- END Bootstrap Menu Deslizante  -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" src="img/FONDO.jpeg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Incorporate</h6>
                            <h3 class="display-3 text-capitalize text-white mb-3">2024</h3>
                            <p class="mx-md-5 px-5">Estamos especializados en la enseñanza de idiomas con 20 certificaciones realizadas por grandes empresas inluidas cambridge</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Hacer Reservación</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" src="img/IdiomaBuilt.jpeg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Transformando vidas</h6>
                            <h3 class="display-3 text-capitalize text-white mb-3">2024</h3>
                            <p class="mx-md-5 px-5">En nuestro edificio con mas de 17 años de construida y con la seguridad necesaria</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="min-height: 100vh;">
                    <img class="position-absolute w-100 h-100" src="img/SIGUIENTEX.jpeg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="text-white text-uppercase mb-3 animate__animated animate__fadeInDown" style="letter-spacing: 3px;">Asociación con Tecnologicos</h6>
                            <h3 class="display-3 text-capitalize text-white mb-3">2024</h3>
                            <p class="mx-md-5 px-5">Descubre el poder de conectar culturas y abrir puertas al mundo. En PolyGlob, cada idioma es una nueva oportunidad.</p>
                            <a class="btn btn-outline-light py-3 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Hacer Reservación</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 pb-5 pb-lg-0">
                    <img class="img-fluid w-100" src="img/GlobalWorldE.jpg" alt=""> 
                </div>
                <div class="col-lg-6">
                    <h6 class="d-inline-block text-primary text-uppercase bg-light py-1 px-2">Acerca de nosotros</h6>
                    <h1 class="mb-4">Tu mejor opcion, PolyGlob</h1>
                    <p class="pl-4 border-left border-primary">Tu mejor opcion para aprender toda clase de idiomas es PolyGlob!</p>
                    <div class="row pt-3">
                        <div class="col-6">
                            <div class="bg-light text-center p-4">
                                <h3 class="display-4 text-primary" data-toggle="counter-up">50,000</h3>
                                <h6 class="text-uppercase">Alumnos Egresados</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Open Hours Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/SeWorldE.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="hours-text bg-light p-4 p-lg-5 my-lg-5">
                        <h6 class="d-inline-block text-white text-uppercase bg-primary py-1 px-2">Horarios</h6>
                        <h1 class="mb-4">PolyGlob</h1>
                        <p>Con nosotros aprendes porque aprendes</p>
                        <ul class="list-inline">
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Lunes – Viernes : 9:00 AM - 7:00 PM</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Sabado : 9:00 AM - 6:00 PM</li>
                            <li class="h6 py-1"><i class="far fa-circle text-primary mr-3"></i>Domingo : Cerrado</li>
                        </ul>
                        <a href="https://www.google.com/search?sca_esv=dc77d35e499118ec&tbm=shop&q=libros+de+idiomas&tbs=mr:1,pdtr0:955598%7C955613&sa=X&ved=0ahUKEwiOv_PV5faJAxWxL9AFHU3KG84QsysIuAcoAQ&biw=1043&bih=995&dpr=0.99" class="btn btn-primary mt-2">Libros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Open Hours End -->


    <!-- Footer Start -->
    <div class="footer container-fluid position-relative bg-dark py-5" style="margin-top: 90px;">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6 pr-lg-5 mb-5">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="mb-3 text-white"><span class="text-primary">Poly</span>Glob</h1>
                    </a>
                    <p>Con nostros aprenderas por que aprenderas!</p>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>65 Av. tecnologico, Morelia, MX</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+52 4436123498</p>
                    <p><i class="fa fa-envelope mr-2"></i>PolyGlob@gmail.com</p>
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
                <div class="col-lg-6 pl-lg-5">
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Enlaces Rápidps</h5>
                            <div class="d-flex flex-column justify-content-start">
                               <a class="text-white-50 mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                                <a class="text-white-50 mb-2" href="about.php"><i class="fa fa-angle-right mr-2"></i>Acerca de Nosotros</a>
                                <a class="text-white-50 mb-2" href="service.php"><i class="fa fa-angle-right mr-2"></i>Nuestros Cursos</a>
                                <a class="text-white-50 mb-2" href="price.php"><i class="fa fa-angle-right mr-2"></i>Precios</a>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Nuestros Servicios</h5>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Frances</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Aleman</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ingles</a>
                                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ruso</a>
                                <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Italiano</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-5">
                            <h5 class="text-white text-uppercase mb-4">Novedades</h5>
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary px-4">iniciar-sesion</button>
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

   <footer>
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

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
   </footer>
    
</body>

</html>