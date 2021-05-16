<?php
session_start();
unset($_SESSION['connexion']);
session_destroy();
header("Location:../html/login.html");
?>
