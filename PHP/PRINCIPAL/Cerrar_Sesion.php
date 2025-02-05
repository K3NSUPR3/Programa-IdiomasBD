<?php

session_start();
session_destroy();
header ("location:../LogIn/Log-In.php");
//checar espacio y ver donde se encuantra localidado
?>