<?php ob_start(); ?>
<?php session_start(); ?>
<?php session_destroy(); ?>


<?php

$_SESSION['email'] = null;

header("Location: /login");

?>