<?php ob_start(); ?>
<?php session_start(); ?>
<?php session_destroy(); ?>


<?php

$_SESSION['sup_email'] = null;

header("Location: /admin/login");

?>