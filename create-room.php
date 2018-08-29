<?php 
session_start();
require_once("dbconfig.php"); 
require_once("function.php");
$errors = array();
if (isset($_POST['newroom']))
{
    $room_name = htmlspecialchars($_POST['newroom']);
    $room_created = $_SESSION['username'];

    $res = $dbh->prepare("SELECT COUNT(*) FROM auth.users WHERE username = :username AND status = 0"); 
    $res->bindParam(':username', $room_created);
    $res->execute();
    $num_row = ($res->fetchColumn() > 0) ? true : false;

    $query1 = $dbh->prepare("SELECT user_id FROM auth.users WHERE username = :username"); 
    $query1->bindParam(':username', $room_created);
    $query1->execute();
    $user_id = $query1->fetch(PDO::FETCH_ASSOC);
}
    if ($room_name == ''){
        $errors[] = 'The name room field is blank!';
    }
    if (!isset($room_created)){
        $errors[] = 'You must be sign in!';
    }

    if (!$num_row){
        $errors[] = 'You cant creating room!';
    }
    if (count($errors) == 0){
        $query = $dbh->prepare("INSERT INTO auth.rooms (name_room, user_id) VALUES (:name_room, :user_id)");
        $query->bindParam(':name_room', $room_name);
        $query->bindParam(':user_id',  $user_id['user_id']);
        $query->execute();
    }

    echo json_encode($errors);

?>