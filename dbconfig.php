<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'meylis';
$password = 'root';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=auth', $username, $password, array(
        PDO::ATTR_PERSISTENT => true
    ));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>