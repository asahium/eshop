<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['session_uniqeID']);
session_destroy();
header("Location: Login.php");
?>