<?php require_once("dbconfig.php"); 
require_once("function.php");
session_start();
unset($_SESSION['username']);
session_destroy();
header('location:users-list.php');
?>