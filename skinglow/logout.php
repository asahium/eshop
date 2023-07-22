
<?php
session_start();
//when log out unset SESSION id + session_uniqeID
unset($_SESSION['id']);
unset($_SESSION['session_uniqeID']);
session_destroy();
header("Location: Login.php");
?>