<?php
session_start();
require_once("dbconfig.php"); 
require_once("function.php");
$errors = array();
if (isset($_POST['newroom']))
{
    $room_name = htmlspecialchars($_POST['newroom']);
    $id_room = $_POST['id_room'];
    $room_created = $_SESSION['username'];

    $res = $dbh->prepare("SELECT COUNT(*) FROM auth.users WHERE username = :username AND status = 0"); 
    $res->bindParam(':username', $room_created);
    $res->execute();
    $num_row = ($res->fetchColumn() > 0) ? true : false;
}
    if ($room_name == ''){
        $errors[] = 'The name room field is blank!';
    }

    if (!$num_row){
        $errors[] = 'You cant changing room!';
    }
    if (count($errors) == 0){
        $stmt = $dbh->prepare("UPDATE auth.rooms SET name_room = :name_room WHERE id_room = :id_room");
        $stmt->bindParam(':name_room', $room_name);
        $stmt->bindParam(':id_room', $id_room);
        $stmt->execute();
    }

    echo json_encode($errors);
    ?>