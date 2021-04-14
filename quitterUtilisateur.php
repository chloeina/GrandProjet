<?php
session_start();
unset($_SESSION['ok']);
session_destroy();
header("Location:login.html");
?>