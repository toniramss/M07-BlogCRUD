<?php
session_start();
session_destroy(); // Destruir la sesión actual
header("Location: ../views/home/login.php"); // Redirigir al formulario de inicio de sesión
exit;
