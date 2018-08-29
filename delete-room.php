<?php
session_start();
require_once("dbconfig.php"); 
require_once("function.php");
$errors = array();
if (isset($_POST['id_room']))
{
    $id_room = htmlspecialchars($_POST['id_room']);
    $room_created = $_SESSION['username'];

    $res = $dbh->prepare("SELECT COUNT(*) FROM auth.users WHERE username = :username AND status = 0"); 
    $res->bindParam(':username', $room_created);
    $res->execute();
    $num_row = ($res->fetchColumn() > 0) ? true : false;
}
    if (!isset($room_created)){
        $errors[] = 'You must be sign in!';
    }

    if (!$num_row){
        $errors[] = 'You cant deleting room!';
    }
    if (count($errors) == 0){
        $query = $dbh->prepare("DELETE FROM auth.rooms WHERE id_room = :id_room");
        $query->bindParam(':id_room', $id_room);
        $query->execute();
    }

    echo json_encode($errors);
?>